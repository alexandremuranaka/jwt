<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    //
    public function tuss(){
      return $this->belongsTo('App\Tuss','tuss_id');
    }
    public function hospital(){
      return $this->belongsTo('App\Hospital','hospital_id');
    }
    public function setDateAttribute($value)
    {
        $arrPartes = explode('/',$value);
        $us_date = implode('-',array_reverse($arrPartes));
        $this->attributes['date']=$us_date;
    }
    public function getDateAttribute($value)
    {
        return date('d/m/Y',strtotime($value));
    }
}
