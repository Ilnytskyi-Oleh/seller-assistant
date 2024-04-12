<?php
namespace App\Http\Controllers\API\V1\ImportTask;
use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\API\Upload\IndexRequest;
use App\Http\Resources\ImportTask\ImportTaskResource;
use App\Jobs\ImportJob;
use App\Models\ErrorRows;
use App\Models\ImportTask;
use App\Models\SuccessRows;
use App\Models\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;
use function PHPUnit\Framework\logicalAnd;

class IndexController extends BaseController
{

    public function __invoke()
    {
        return ImportTaskResource::collection(ImportTask::all());
    }
}
