<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Device extends Model
{

    protected $table = 'devices';

    public function application()
    {
        return $this->belongsToMany(Application::class);
    }
}
