<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Tuss;
use JWTAuthException;

class TussController extends Controller
{
  public function tuss()
  {
    $tuss = Tuss::get();
    return response()->json($tuss);
  }

  public function index()
  {
    $tuss = Tuss::get();
    return response()->json($tuss);
  }
}
