<?php

namespace CodeBridge\CBLogger\Model;

use Illuminate\Database\Eloquent\Model;

class CBLogger extends Model
{
    /**
     * @var string
     */
    protected $table = 'cblogger';

    /**
     * @var array
     */
    protected $fillable = [
        'message',
        'context',
        'channel',
        'level_int',
        'level_string',
        'created_at'
    ];

}