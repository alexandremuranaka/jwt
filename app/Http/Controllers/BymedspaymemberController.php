<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Member;
use App\User;
use Validator;
use Carbon\Carbon;
use Auth;
use DB;

class BymedspaymemberController extends Controller
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
    $members = Member::orderBy()->get();
    return view('dashboard.bymedspay.memberall')->with('members',$members);
  }
  public function create()
  {
    return view('dashboard.bymedspay.membercreate');
  }
  public function store(Request $request)
  {
    $user = Auth::user()->id;
    //validation
    $member = DB::table('members')->join('users', "members.user_id" , '=', 'users.id')
    ->where('member.user_id', '=',$user )
    ->where('member_cellphone','=',$request->cellphone);
    ->select('members.*')->first();

    if($member)
    {
      //return error message
    }
    else
    {
      $user = Auth::user()->id;
      $member = new Member;
      $member->member_name = $request->member_name;
      $member->cellphone = $request->cellphone;
      $member->profession = $request->profession;
      $member->user_id = $user;
      $member->save();
    }

  }
  public function edit($id)
  {
    return view('dashboard.bymedspay.memberedit');
  }

  public function update(Request $request)
  {

    $member = Member::find($request->id);
    if($member)
    {
      //validate

      $member->member_name = $request->member_name;
      $member->cellphone = $request->cellphone;
      $member->profession = $request->profession;
      $member->save();
    }
    else
    {
      //return error message
    }
  }

  public function show($id)
  {
    $member = Member::find($id);
    return view('dashboard.bymedspay.membershow')->with('member',$member);
  }

  public function destroy($id)
  {
    $member = Member::find($id);
    $member->delete();
    return redirect()->action('BymedspaymemberController@index');
  }

/*
user_id
cellphone
profession
*/
}
