<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use JWTAuth;
use JWTAuthException;
use App\User;
use DB;
use App\Procedure;
use Carbon\Carbon;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function procedureList($id)
    {
      $procedures = DB::table('procedures')
        ->join('users', 'users.id', '=', 'procedures.user_id')
        ->select('procedures.*')
        ->where('procedures.user_id','=',$id)
        ->get();
        return response()->json($procedures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("web.procedures.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $replaces = array("/"," ");
      $request->date = str_replace($replaces, "-", $request->get('date'));

      $procedure_rules = [
        'user_id' => 'required',
        'hospital_id' => 'required',
        'tuss_id' => 'required',
        'date' => 'required',
      ];
      $procedure_messages = [
         'user.required' => ['User ID is required','1201'],
         'date.required' => ['E-mail is required','1211'],
         'hospital_id.required' => ['Hospital ID is required','1212'],
         'tuss_id.required' => ['TUSS is required','1213'],
      ];

      $validator = Validator::make($request->all(),$procedure_rules,$procedure_messages);

      if ($validator->fails()) {
        return response()->json($validator->messages(), 200);
       }
      else
      {
        $procedure = new Procedure;
        $procedure->user_id = $request->user_id;
        $procedure->hospital_id = $request->hospital_id;
        $procedure->tuss_id = $request->tuss_id;
        $procedure->date = Carbon::createFromFormat('d-m-Y',$request->date);
        $procedure->member_id = $request->member_id;
        $procedure->medical_insurance = $request->medical_insurance;
        $procedure->insurance_type = $request->insurance_type;
        $procedure->patient_name = $request->patient_name;
        $procedure->register_number = $request->register_number;
        $procedure->procedured_number = $request->procedured_number;
        $procedure->procedured_comment = $request->procedured_comment;
        $procedure->save();

        if($procedure->save())
        {
          return response()->json(['success'], 200);
        }
        else
        {
          return response()->json(['fail'], 500);
        }
        //$all_procedures = Procedure::where("user_id",'=', $procedure->user_id)->first()->get();
        //return response()->json($all_procedures);
      }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function show(Procedure $procedure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedure $procedure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procedure $procedure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedure $procedure)
    {
        //
    }
}
