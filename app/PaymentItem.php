<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
  public function procedure()
  {
      return $this->hasOne('App\Procedure');
  }
}
