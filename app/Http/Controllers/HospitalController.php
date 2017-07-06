<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Hospital;
use JWTAuthException;
//use Validator;

class HospitalController extends Controller
{

    public function hospitalList(Request $request)
    {
      $hospitals = Hospital::get();
      return response()->json($hospitals);
    }
}
