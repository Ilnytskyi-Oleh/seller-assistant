<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportTask extends Model
{

    protected $casts = [
        'finished_at' => 'datetime',
    ];

    protected $guarded = [];


    //Statuses
    const int STATUS_RUNNING = 0;
    const int STATUS_FINISHED = 1;
    const int STATUS_ERROR = 13;

    static public array $statuses = [
        self::STATUS_RUNNING => 'In progress',
        self::STATUS_FINISHED => 'Completed',
        self::STATUS_ERROR => 'Error',
    ];


    public function getStatusName()
    {
        return !empty(self::$statuses[$this->status])
            ? self::$statuses[$this->status]
            : $this->status;
    }
}
