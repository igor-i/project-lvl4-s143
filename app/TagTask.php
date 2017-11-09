<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagTask extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tag_task';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id', 'task_id'
    ];
}
