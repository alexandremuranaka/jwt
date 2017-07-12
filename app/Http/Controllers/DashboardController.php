<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dashboard;
use App\User;
use App\Hospital;
use Image;
use Validator;
use Hash;
use Carbon\Carbon;
use Auth;


class DashboardController extends Controller
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
      $user = Auth::user();
      return view('dashboard.index')->with('user',$user);
    }
    public function edit()
    {
      $user = Auth::user();
      $message = "";
      $user->cellphone = $user->cellphone;
      return view('dashboard.profile')->with('user',$user)->with('message',$message);
    }
    public function update(Request $request)
    {
      $user = Auth::user();
      if($user->id == $request->id)
      {
        $user_update = User::find($user->id);
        $user_update->name = $request->name;
        $user_update->save();
        return redirect()->back()->with('success','Dados atualizados com Sucesso');
      }
      else
      {
        return redirect()->back()->with('fail','Erro ao atualizar perfil, tente mais tarde.');
      }
    }

    public function updatepass(Request $request)
    {

        $pass_rules = [
        'oldpass' => 'required',
        'newpass' => 'required',
        'confirmpass' => 'required|same:newpass',
        ];

        $pass_messages = [
        'oldpass.required' => 'Digite sua Senha Atual',
        'newpass.required' => 'Digite sua nova senha',
        'confirmpass.required' => 'Confirme a sua nova senha',
        'confirmpass.same' => 'Senha não coincide',
        ];

        $validator = Validator::make($request->all(),$pass_rules,$pass_messages);
        if ($validator->fails()) {
        $errors = $validator->errors();
        //echo $errors;
        return redirect()->back()->with('errors',$errors);
        }
        else
        {
          $user = Auth::user();
          if($user->id == $request->id)
          {
            $user_pass = User::find($user->id);

            $db_pass = Auth::user()->password;
            $pass_match = password_verify( $request->oldpass, $db_pass );

            if($pass_match)
            {
             $user_pass->password = bcrypt($request->newpass);
             $user_pass->save();
             return redirect()->back()->with('success','Senha atualizada com sucesso!');
            }
            else
            {
              return redirect()->back()->with('fail','Senha Atual não confere');
            }
          }
          else
          {
            return redirect()->back()->with('fail','Erro ao atualizar perfil, tente mais tarde.');
          }
        }


    }








}
