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
use Carbon\Carbon;

class UserController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }


    public function register(Request $request){


        $replaces = array("(",")","-"," ");
        $request->cellphone = str_replace($replaces, "", $request->get('cellphone'));

      $register_rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'cellphone' => 'required|string|unique:users',
        'password' => 'required|string|min:6',
      ];

      $register_data = array(
        'name' => $request->name,
        'email' => $request->email,
        'cellphone' => $request->cellphone,
        'password' => $request->password,
        'photo' => $request->photo
      );

     $validator = Validator::make($register_data,$register_rules);

      if ($validator->fails()) {
        return response()->json($validator->messages(), 200);
       }
      else
      {


        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->cellphone = intval($request->cellphone);
        $user->password =  bcrypt($request->get('password'));
        $user->created_at =  Carbon::now();
        $user->updated_at =  Carbon::now();

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
        return response()->json("Registered successfully");
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
    }

    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

}
