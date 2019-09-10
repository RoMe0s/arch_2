<?php

namespace Core\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'id'
    ];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function changes()
    {
        return $this->hasMany(Change::class);
    }
}
