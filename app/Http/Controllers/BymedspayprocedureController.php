<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Hospital;
use App\Register;
use App\Procedures;
use Validator;
use Carbon\Carbon;
use Auth;
use DB;

class BymedspayprocedureController extends Controller
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

  public function index()
  {
    //$procedures = BD::table('users')->join()
    //return view()->with('procedures',$procedures);
  }
  public function create()
  {

  }
  public function store(Request $request)
  {

  }
  public function edit($id)
  {

  }
  public function update(Request $request)
  {

  }
  public function show($id)
  {

  }
  public function destroy($id)
  {

  }

}
