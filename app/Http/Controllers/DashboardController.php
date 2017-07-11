<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dashboard;
use App\User;
use Image;
use Validator;
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
    return view('dashboard.index');
  }










}
