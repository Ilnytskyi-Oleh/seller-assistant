<?php

namespace App\Jobs;

use App\Models\ErrorRows;
use App\Models\ImportTask;
use App\Models\SuccessRows;
use App\Models\UploadedFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private UploadedFile $uploadedFile;

    /**
     * Create a new job instance.
     */
    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {;
        $task = ImportTask::firstOrCreate(
            ['path' => $this->uploadedFile->path],
            ['status' => ImportTask::STATUS_RUNNING]
        );

        $success_count = 0;
        $errors_count = 0;

        $rows = SimpleExcelReader::create($this->uploadedFile->path)
            ->noHeaderRow()
            ->getRows();

        $rows->each(function(array $rowProperties) use(&$success_count, &$errors_count) {
            $isValid = true;
            $values = explode(';', $rowProperties[0]);

            $result = [];
            $i=1;
            foreach ($values as $value) {
                $isAlpha = $this->check_alpha($value);

                if($isValid && !$isAlpha) {
                    $isValid = false;
                }

                $result['row'.$i] = $value;

                $isAlpha ? $success_count++ : $errors_count++;
                $i++;
            }

            if ($isValid) {
                SuccessRows::create($result);
            } else {
                ErrorRows::create($result);
            }
        });

        $task->update([
            'status' => ImportTask::STATUS_FINISHED,
            'finished_at' => now(),
            'success_count' => $success_count,
            'errors_count' => $errors_count,
        ]);
    }

    public function check_alpha($string): bool
    {
        if (empty($string) || preg_match('/[^а-яА-Яa-zA-Z\s]/u', $string)) {
            return false;
        }
        return true;
    }
}
