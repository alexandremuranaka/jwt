<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    //

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
