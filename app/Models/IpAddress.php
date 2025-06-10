<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    protected $fillable = [
        'address',
        'label',
        'user_id',
        'comment',
    ];

    protected $casts = [
        'address' => 'string',
        'label'   => 'string',
        'user_id' => 'integer',
        'comment' => 'string',
    ];
}
