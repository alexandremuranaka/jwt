<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bymedspay;
use App\Hospital;
use Image;
use Validator;
use Carbon\Carbon;

class BymedspayController extends Controller
{
  /*
  * Create a new controller instance.
  *
  * @return void
  */

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function hospital()
  {
    $hospitals = Hospital::get();
    return view("dashboard.bymedspay.hospital")->with('hospitals',$hospitals);
  }

  public function hospitalselected(Request $request)
  {
    if($request->id != 0)
    {
      $hospital = Hospital::find($request->id);
      session()->put('hospital_id', $hospital->id);
      session()->put('hospital_name', $hospital->name);
      return redirect()->action('BymedspayController@myregister');
    }
    else
    {
      return redirect()->back()->with('fail','Selecione um hospital');
    }
  }

  public function myregister()
  {
    
  }

  public function register()
  {

  }

  public function registershow($id)
  {

  }

  public function registerall()
  {

  }

}
