<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin;
use App\User;
use Image;
use Validator;
use Carbon\Carbon;
use Auth;

//use SendsPasswordResetEmails;


class AdminController extends Controller
{


  public function login(Request $request){

    $login_rules = [
      'user' => 'required',
      'password' => 'required',
    ];

    $login_m = [
      'user.required' => 'Preencha um login ou um E-mail',
      'password.required' => 'Senha Obrigatória',
    ];

    $validator = Validator::make($request->all(),$login_rules,$login_m);

    if ($validator->fails()) {
      $errors = $validator->errors();
      return redirect()->back()->with('errors',$errors);

    }


    $pre_rules = [
      'user' => 'email',
    ];
    $validator = Validator::make($request->all(),$pre_rules);
    if ($validator->fails()) {
      // cellphone

      $replaces = array("(",")","-"," ");
      $cellphone = intval(str_replace($replaces, "", $request->user));




        if (Auth::attempt(['cellphone' => $cellphone, 'password' => $request->password])) {
            $user = Auth::user();
            return response()->json($user,200);
        }
        else
        {
          return redirect()->back()->with('fail','Login ou Senha Inválido');
        }

    }
    else{
      //email
      $credentials = [
        'email' => $request->user,
        'password' => $request->password
      ];
        if (Auth::attempt(['email' => $request->user, 'password' => $request->password])) {
            $user = Auth::user();
            return redirect()->action('DashboardController@index');
        }
        else
        {
            return redirect()->back()->with('fail','Login ou Senha Inválido');
        }
    }
  }

  public function register(Request $request)
  {


          $replaces = array("(",")","-"," ");
          $request->cellphone = str_replace($replaces, "", $request->get('cellphone'));

          $register_rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cellphone' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
          ];

          $register_messages = [
            'name.required' => 'Name is required',
            'name.max' => 'Name max lenth 255',
            'name.string' => 'Name must be string',
            'email.required' => 'E-mail is required',
            'email.max' => 'E-mail max lenth 255',
            'email.string' => 'E-mail must be string',
            'email.unique' => 'E-mail is alredy taken',
            'cellphone.required' => 'Cellphone is required',
            'cellphone.max' => 'Cellphone max lenth 255',
            'cellphone.string' => 'Cellphone must be string',
            'cellphone.unique' => 'Cellphone is alredy taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password min lenth 255',
            'password.string' => 'Password must be string',
          ];

          $register_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'cellphone' => $request->cellphone,
            'password' => $request->password,
            'photo' => $request->photo
          );

         $validator = Validator::make($register_data,$register_rules,$register_messages);

          if ($validator->fails()) {
            $errors = $validator->errors();
            //echo $errors;
            return redirect()->back()->withInput()->with('errors',$errors);
           }
          else
          {


            $user = new User;
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->cellphone = intval($request->cellphone);
            $user->password =  bcrypt($request->get('password'));

            //image
            if( $request->photo )
            {
              $image_ext = $request->photo->getClientOriginalExtension();
              $image_src = time(). '.' . $image_ext;
              $image_alt = $request->photo->getClientOriginalName();
              $image_alt = str_replace('.' . $image_ext, '', $image_alt);
              $image_avatar_path = public_path('assets/avatar/' . $image_src);
              Image::make($request->photo->getRealPath())->resize(300, 300)->save($image_avatar_path);

              $user->photo = "/assets/avatar/$image_src";
            }
            else {
              $user->photo ="/assets/avatar/avatar_doc.jpg";
            }
            $user->save();
            return redirect('/');
          }

  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect('dashboard');
  }
  public function recover(Request $request)
  {
    echo $request;
  //  $this->sendResetLinkEmail($request);
  }
}
