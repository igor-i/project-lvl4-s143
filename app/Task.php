<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status_id', 'creator_id', 'assignedto_id'
    ];

    /**
     * @return \EloquentFilter\ModelFilter
     */
    public function modelFilter()
    {
        return $this->provideFilter(ModelFilters\TaskFilter::class);
    }

    /**
     * Get the status record associated with the task.
     */
    public function status()
    {
        return $this->belongsTo('App\Status')->withDefault();
    }

    /**
     * Get the user record associated with the task.
     */
    public function creator()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    /**
     * Get the user record associated with the task.
     */
    public function assignedto()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    /**
     * The tags that belong to the task.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
