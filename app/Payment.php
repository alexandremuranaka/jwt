<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  public function items()
  {
    return $this->hasMany('App\PaymentItem');
  }
}
