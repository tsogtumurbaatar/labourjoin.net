<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()->active == 0)
       {
        Auth::logout();
        return redirect('/login')->withErrors(['Register request has sent to administrator, you can get access shortly']);
        }

   if(Auth::user()->user_type == 1)
   {

     $my_requests = DB::table('action_request')
     ->where('action_worker_id',auth::user()->id)
     ->where('action_requested','<>','')
     ->join('requests', 'action_request.action_requested', '=', 'requests.request_id')
     ->select('action_request.*','requests.*')
     ->orderby('action_date','desc')
     ->get();


     $my_assignments = DB::table('action_request')
     ->where('action_worker_id',auth::user()->id)
     ->where('action_assigned','<>','')
     ->join('requests', 'action_request.action_assigned', '=', 'requests.request_id')
     ->select('action_request.*','requests.*')
     ->orderby('action_date','desc')
     ->get();

     $count_my_requests = count($my_requests);
     $count_my_assignments = count($my_assignments);

     return view('homeworker',[
      'my_inbound_request' => $my_requests,
      'my_assignments' => $my_assignments,
      'count_my_requests' => $count_my_requests,
      'count_my_assignments' => $count_my_assignments
      ]);
   }
   else
    return view('home');

}


public function confirmJobRequest($id)
{

  $request_info =  DB::table('action_request')
  ->where('action_id', $id)
  ->get();

  DB::table('action_request')
  ->where('action_id', $id)
  ->update([
    'action_assigned' => $request_info[0]->action_requested,
    'action_confirmed' => $request_info[0]->action_requested,
    'action_requested' => '',
    ]);

  return Redirect::route('dashboard');
}




public function workers()
{
  if(Auth::user()->user_type <> 3)
    return redirect('/home');

  return view('workers');
}

public function companies()
{
  if(Auth::user()->user_type <> 3)
    return redirect('/home');

  return view('companies');
}

public function jobs()
{
  return view('jobs');
}

public function requests()
{
  $jobid = \Request::get('jobid');

  if ($jobid <> '')
  {
    $jobname = DB::table('jobs')
    ->where('jobs_id', $jobid)
    ->pluck('jobs_name');

    return view('workrequests',[
      'jobname' => $jobname[0]
      ]);
  }
  else
  {
    return view('workrequests');
  }
}
public function requestsforagenta()
{
  return view('agentrequests');
}

public function requestsforagentb()
{
  return view('agentrequestsfinished');
}


}
