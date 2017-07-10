<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuss extends Model
{
    protected $table = 'tuss';
    public function procedure()
    {
      return $this->hasMany('App\Procedure');
    }
}
