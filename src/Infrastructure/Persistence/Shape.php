<?php

namespace Core\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;

class Shape extends Model
{
    protected $fillable = [
        'id',
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
}
