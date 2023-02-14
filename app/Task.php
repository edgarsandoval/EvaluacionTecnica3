<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    protected $table = 'tasks';
    protected $fillable = [
        'id',
        'userId',
        'title',
        'completed'
    ];

    public $timestamps = false;
}
