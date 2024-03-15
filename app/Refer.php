<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refer extends Model
{
    protected $fillable = [
        'refer_code', 'referer_uid', 'off_percentage', 'use_count', 'valid_till',
    ];
}
