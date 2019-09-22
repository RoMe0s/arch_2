<?php

namespace Core\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'shape_id',
        'action_id',
        'type',
        'color',
    ];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
