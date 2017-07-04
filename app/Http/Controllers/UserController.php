<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;
use Image;
use Validator;

class UserController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }


    public function teste(Request $request)
    {
      return response()->json('ola');
    }
    public function register(Request $request){

      $register_rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'cellphone' => 'required|string|unique:users',
        'password' => 'required|string|min:6',
      ];
     $validator = Validator::make($request->all(),$register_rules);

      if ($validator->fails()) {
        return response()->json($validator->messages(), 200);
       }
      else
      {


        $replaces = array("(",")","-"," ");
        $cellphone = str_replace($replaces, "", $request->get('cellphone'));

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->cellphone = intval($cellphone);
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
        $user->save();
      }

    }

    public function login(Request $request){

      $pre_rules = [
        'user' => 'email',
      ];
      $validator = Validator::make($request->all(),$pre_rules);
      if ($validator->fails()) {
        // cellphone

        $replaces = array("(",")","-"," ");
        $cellphone = str_replace($replaces, "", $request->user);

        $credentials = [
          'cellphone' => intval($cellphone),
          'password' => $request->password
        ];

        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        $user = JWTAuth::toUser($token);
        return response()->json(['token' => $token, 'user' => $user]);

      }
      else{
        //email
        $credentials = [
          'email' => $request->user,
          'password' => $request->password
        ];


        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        $user = JWTAuth::toUser($token);
        return response()->json(['token' => $token, 'user' => $user]);


      }

      /*
      if (filter_var($request->user, FILTER_VALIDATE_EMAIL)) {
      {


        $validator = Validator::make($request->all(),$register_rules);

        if ($validator->fails()) {
          return response()->json($validator->messages(), 200);
        }
        else
        {
          $data = ['user' => 'email'];
          return response()->json($data);
        }
      }
      else
      {
        $register_rules = [
          'user' => 'int',
          'password' => 'required',
        ];

        $validator = Validator::make($request->all(),$register_rules);
        $data = ['user' => 'cellphone'];
        return response()->json($data);
      }
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        $user = JWTAuth::toUser($token);
        return response()->json(['token' => $token, 'user' => $user]);
        */
    }


    //
    // public function getAuthUser(Request $request){
    //     $user = JWTAuth::toUser($request->token);
    //     return response()->json(['result' => $user]);
    // }
    // public function all(Request $request){
    //   $user = JWTAuth::toUser($request->token);
    //   $users = User::get();
    //   return response()->json($users);
    // }
}
