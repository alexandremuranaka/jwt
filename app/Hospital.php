<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
  protected $table = 'hospitals';
  public function procedure()
  {
    return $this->hasMany('App\Procedure');
  }
}
