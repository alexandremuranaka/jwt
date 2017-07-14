<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bymedspay;
use App\Hospital;
use App\Register;
use Validator;
use Carbon\Carbon;
use Auth;
use DB;

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
      return redirect()->action('ConciliacaoController@index');
    }
    else
    {
      return redirect()->back()->with('fail','Selecione um hospital');
    }
  }


  public function registerStore(Request $request)
  {
    $replaces = array("/"," ");
    $request->patient_birthday = str_replace($replaces, "-", $request->patient_birthday);

    $register_rules = [
      'barcode' => 'required',
      'secondary_number' => 'required',
      'user_id' => 'required',
      'hospital_id' => 'required',
    ];

    $register_m = [
      'barcode.required' => 'Preencha o campo acima',
      'secondary_number.required' => 'Preencha o campo acima',
      'user_id.required' => 'Usuário não encontrado, faça o login para continuar',
      'hospital_id.required' => 'Selecione um Hospital',
    ];

    $validator = Validator::make($request->all(),$register_rules,$register_m);

    if ($validator->fails()) {
      $errors = $validator->errors();
      return redirect()->back()->with('errors',$errors);
    }
    else
    {
      $taken = DB::table('registers')->join('hospitals', 'registers.hospital_id', '=', 'hospitals.id')
      ->where('registers.hospital_id','=', $request->hospital_id)
      ->where('registers.barcode','=', $request->barcode)
      ->select('registers.*')->first();

      if($taken )
      {
        return redirect()->back()->with('fail','Código de Barras ja foi registrado');
      }
      else
      {
        $register = new Register;
        $register->user_id = $request->user_id;
        $register->hospital_id = $request->hospital_id;
        $register->barcode = $request->barcode;
        $register->secondary_number = $request->secondary_number;
        $register->patient_name = $request->patient_name;
        $register->patient_birthday = Carbon::createFromFormat('d-m-Y',$request->patient_birthday);
        $register->medical_insurance = $request->medical_insurance;
        $register->insurance_type = $request->insurance_type;
        if ($request->favorite)
        {
          $register->favorite = 1;
        }
        else {
          $register->favorite = 0;
        }
        $register->save();
        return redirect()->action('BymedspayController@myregister');
      }
    }


  }
  public function registerdestroy($id)
  {
    $register = Register::find($id);
    if($register)
    {
      $register->delete();
      return redirect()->action('BymedspayController@myregister');
    }
    else
    {
      return redirect()->back()->with('fail','Registro não encontrado');
    }
  }
  public function register()
  {
    return view('dashboard.bymedspay.register');
  }

  public function registershow($id)
  {
    $user = Auth::user()->id;
    $register = DB::table('registers')
    ->join('users', 'registers.user_id','=','users.id')
    ->join('hospitals', 'registers.hospital_id','=','hospitals.id')
    ->where('registers.user_id', '=', $user)
    ->where('registers.id', '=', $id)
    ->select('registers.*','hospitals.name')->first();

    return view('dashboard.bymedspay.registershow')->with('register',$register);
  }

  public function registeredit($id)
  {
    $user = Auth::user()->id;
    $register = DB::table('registers')
    ->join('users', 'registers.user_id','=','users.id')
    ->join('hospitals', 'registers.hospital_id','=','hospitals.id')
    ->where('registers.user_id', '=', $user)
    ->where('registers.id', '=', $id)
    ->select('registers.*','hospitals.name')->first();
    $hospitals = Hospital::orderBy('name')->pluck('name', 'id');;
    return view('dashboard.bymedspay.registeredit')->with('register',$register)->with('hospitals',$hospitals);

  }


  function registerupdateSave($request)
  {
    $register = Register::find($request->id);
    $register->user_id = $request->user_id;
    $register->hospital_id = $request->hospital_id;
    $register->barcode = $request->barcode;
    $register->secondary_number = $request->secondary_number;
    $register->patient_name = $request->patient_name;
    $register->patient_birthday = Carbon::createFromFormat('d-m-Y',$request->patient_birthday);
    $register->medical_insurance = $request->medical_insurance;
    $register->insurance_type = $request->insurance_type;
    if ($request->favorite)
    {
      $register->favorite = 1;
    }
    else {
      $register->favorite = 0;
    }
    $register->save();
    return redirect('/dashboard/bymedspay/register/'.$request->id.'/edit');
  }

  public function registerupdate(Request $request)
  {

      $replaces = array("/"," ");
      $request->patient_birthday = str_replace($replaces, "-", $request->patient_birthday);

      $register_rules = [
        'barcode' => 'required',
        'secondary_number' => 'required',
        'user_id' => 'required',
        'hospital_id' => 'required',
      ];

      $register_m = [
        'barcode.required' => 'Preencha o campo acima',
        'secondary_number.required' => 'Preencha o campo acima',
        'user_id.required' => 'Usuário não encontrado, faça o login para continuar',
        'hospital_id.required' => 'Selecione um Hospital',
      ];

      //check all required inputs
      $validator = Validator::make($request->all(),$register_rules,$register_m);

      //if fail return errors
      if ($validator->fails()) {
        $errors = $validator->errors();
        return redirect()->back()->with('errors',$errors);
      }
      else
      {

        // check hospital_id
        $old = DB::table('registers')->join('hospitals', 'registers.hospital_id', '=', 'hospitals.id')
        ->where('registers.id','=', $request->id)
        ->select('registers.*')->first();

        if($old->hospital_id == $request->hospital_id )
        {
          //hospital is the same
          //check if barcode is the same
          if( $old->barcode == $request->barcode )
          {
            //if barcode is the same update request
            return $this->registerupdateSave($request);
          }
          else
          {
            // if barcode changed check if its already exists in new hospital_id
            $barcode_taken = DB::table('registers')->join('hospitals', 'registers.hospital_id', '=', 'hospitals.id')
            ->where('registers.hospital_id','=', $request->hospital_id)
            ->where('registers.barcode','=', $request->barcode)
            ->select('registers.*')->first();

            if( $barcode_taken )
            {
              //if barcode exists return error message
              return redirect()->back()->with('fail','Código de Barras ja foi registrado');
            }
            else
            {
              //if barcode do not exists, update request
              return $this->registerupdateSave($request);
            }

          }
        }
        else
        {
          //hospitals has changed
          $taken = DB::table('registers')->join('hospitals', 'registers.hospital_id', '=', 'hospitals.id')
          ->where('registers.hospital_id','=', $request->hospital_id)
          ->where('registers.barcode','=', $request->barcode)
          ->select('registers.*')->first();
          //check if barcode exists in new hospital id
          if($taken)
          {
            // if barcode exists return error
            return redirect()->back()->with('fail','Código de Barras ja foi registrado');
          }
          else
          {
            //if barcode do NOT exists update request
            return $this->registerupdateSave($request);
          }
        }





      }
  }

  public function registerfavoriteupdate(Request $request)
  {
    $register = register::find($request->id);
    $register->favorite = $request->favorite;
    $register->save();
    return redirect()->action('BymedspayController@registershow', ['id' => $request->id]);
  }


  public function myregister()
  {
    $user = Auth::user()->id;

        $favorities = DB::table('registers')
        ->join('users', 'registers.user_id','=','users.id')
        ->join('hospitals', 'registers.hospital_id','=','hospitals.id')
        ->where('registers.user_id', '=', $user)
        ->where('registers.favorite', '=', 1)
        ->select('registers.*','hospitals.name')->take(10)->get();

        $registers = DB::table('registers')
        ->join('users', 'registers.user_id','=','users.id')
        ->join('hospitals', 'registers.hospital_id','=','hospitals.id')
        ->where('registers.user_id', '=', $user)
        ->select('registers.*','hospitals.name')->take(10)->get();
        return view('dashboard.bymedspay.myregister')->with('registers',$registers)->with('favorities',$favorities);

  }
  public function registerall()
  {
      $user = Auth::user()->id;
      $registers = DB::table('registers')
      ->join('users', 'registers.user_id','=','users.id')
      ->join('hospitals', 'registers.hospital_id','=','hospitals.id')
      ->where('registers.user_id', '=', $user)
      ->select('registers.*','hospitals.name')->take(10)->get();
      return view('dashboard.bymedspay.registerall')->with('registers',$registers);
  }
  public function registerpagination(Request $request)
  {

      $user = Auth::user()->id;
      $registers = DB::table('registers')
      ->join('users','users.id', '=', 'registers.user_id')
      ->join('hospitals','hospitals.id', '=', 'registers.hospital_id')
      ->select('registers.*','hospitals.name')->where('users.id' ,'=', $user)->paginate(10);
      return response()->json($registers);

  }
}
