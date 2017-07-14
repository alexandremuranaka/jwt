<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Hospital;
use App\Register;
use App\Procedure;
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
    $user = Auth::user()->id;
    $procedures = Procedure::where('user_id','=',$user)->get();
    return view('dashboard.bymedspay.procedure.index')->with('procedures',$procedures);
  }

  /*
  public function create()
  {
    return view('dashboard.bymedspay.procedure.create');
  }
  public function store(Request $request)
  {

  }
  */
  public function edit($id)
  {
    $procedure = Procedure::find($id);
    $hospitals = Hospital::orderBy('name')->get();
    return view('dashboard.bymedspay.procedure.edit')->with('procedure',$procedure)->with('hospitals',$hospitals);
  }
  public function update(Request $request)
  {
    $procedure =  Procedure::find($request->id);
    $procedure->tuss_id = $request->tuss_id;
    $procedure->date = $request->date;
    $procedure->member_id = $request->member_id;
    $procedure->medical_insurance = $request->medical_insurance;
    $procedure->insurance_type = $request->insurance_type;
    $procedure->patient_name = $request->patient_name;
    $procedure->register_number = $request->register_number;
    $procedure->procedured_number = $request->procedured_number;
    $procedure->procedured_comment = $request->procedured_comment;
  }
  public function show($id)
  {

  }
  public function destroy($id)
  {

  }

}
