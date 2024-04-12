<?php
namespace App\Http\Controllers\API\V1\Upload;
use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\API\Upload\IndexRequest;
use App\Jobs\ImportJob;
use App\Models\ErrorRows;
use App\Models\SuccessRows;
use App\Models\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;
use function PHPUnit\Framework\logicalAnd;

class IndexController extends BaseController
{

    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();

        $final_size = (int) $data['size'];

        $path = Storage::disk('uploads')->path($data['uuid']. '.csv');

        $uploadedFile = UploadedFile::firstOrCreate(
            ['uuid' =>  $data['uuid']],
            ['path' => $path],
        );

        $chunk = $data['file'];

        $file = null;

        try {
            $file = fopen($path, $request->input('start') == 0 ? 'c' : 'a');

            if ($file === false) {
                return response()->json(['message' => 'Could not open file for writing'], 500);
            }
            $written = fwrite($file, $chunk->getContent());

            clearstatcache(true, $path);
            $current_size = filesize($path);

            if ($written === false) {
                return response()->json(['message' => 'Could not write to file'], 500);
            }

            if($final_size === $current_size) {
                ImportJob::dispatch($uploadedFile);

                return response()->json(['message' => 'Chunk appended successfully and File Uploaded Completely']);
            }

            return response()->json(['message' => 'Chunk appended successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: '.$e->getMessage()], 500);
        } finally {
            if ($file !== null) {
                fclose($file);
            }
        }
    }
}
