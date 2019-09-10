<?php

namespace Core\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'shape_id',
        'state_id',
        'previous_state_id'
    ];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function state()
    {
        return $this->hasOne(State::class, 'state_id');
    }

    public function previousState()
    {
        return $this->hasOne(State::class, 'previous_state_id');
    }
}
