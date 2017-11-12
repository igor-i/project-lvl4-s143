<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TaskFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        return $this->whereLike('name', $name);
    }

    /**
     * @param $text
     * @return $this
     */
    public function fulltext($text)
    {
        return $this
            ->whereLike('name', $text)
            ->orWhere('description', 'LIKE', "%$text%");
    }

    /**
     * @param $status_id
     * @return $this
     */
    public function statusId($status_id)
    {
        return $this->related('status', 'id', $status_id);
    }

    /**
     * @param $user_id
     * @return $this
     */
    public function creatorId($user_id)
    {
        return $this->related('creator', 'id', $user_id);
    }

    /**
     * @param $user_id
     * @return $this
     */
    public function assignedtoId($user_id)
    {
        return $this->related('assignedto', 'id', $user_id);
    }

    /**
     * @param $tag_id
     * @return $this
     */
    public function tagId($tag_id)
    {
        return $this->related('tags', 'tag_id', [$tag_id]);
    }
}
