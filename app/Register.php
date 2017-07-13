<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
  public function dateformat()
  {
  return Carbon::createFromFormat('m/d/Y', $this->patient_birthday);
}


}
