<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Jobs;
use App\WorkRequest;
use App\ActionRequest;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;


class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
       //return WorkRequest::where('request_company_id', Auth::user()->id)->with('getJob')->get();


       $my_array = DB::table('requests')
       ->leftjoin('jobs','requests.request_job_id','=','jobs.jobs_id')
       ->leftjoin(DB::raw('(SELECT action_assigned as aaa, count(*) as too FROM `action_request` group BY action_assigned) as too_table'),'requests.request_id','too_table.aaa')
       ->where('requests.request_company_id',Auth::user()->id)
       ->select('requests.*', 'jobs.jobs_name', 'too_table.too')
       ->orderby('requests.request_start_time','desc')
       ->get();


       return \Response::json($my_array);
   }

   public function indexforagenta()
   {
       //DB::enableQueryLog();

       // return WorkRequest::with(array('getJob'=>function($query){$query->select('jobs_id','jobs_name');}))
       // ->with(array('getCompany'=>function($query){$query->select('id','name');}))
       // ->orderBy('request_id','desc')
       // ->get();

       //dd(DB::getQueryLog());

         $my_array = DB::table('requests')
       ->leftjoin('jobs','requests.request_job_id','=','jobs.jobs_id')
       ->leftjoin('users','requests.request_company_id','=','users.id')
       ->leftjoin(DB::raw('(SELECT action_assigned as aaa, count(*) as too FROM `action_request` group BY action_assigned) as too_table'),'requests.request_id','too_table.aaa')
       ->leftjoin(DB::raw('(SELECT action_requested as bbb, count(*) as too1 FROM `action_request` group BY action_requested) as too_table1'),'requests.request_id','too_table1.bbb')

       ->where('requests.request_agent_id',Auth::user()->id)
       ->select('requests.*', 'jobs.jobs_name', 'users.name as company_name', 'too_table.too', 'too_table1.too1')
       ->where('requests.request_finished', 0)
       ->orderby('requests.request_start_time','desc')
       ->get();

       return \Response::json($my_array);
   }

    public function indexforagentb()
   {
       //DB::enableQueryLog();

       // return WorkRequest::with(array('getJob'=>function($query){$query->select('jobs_id','jobs_name');}))
       // ->with(array('getCompany'=>function($query){$query->select('id','name');}))
       // ->orderBy('request_id','desc')
       // ->get();

       //dd(DB::getQueryLog());

         $my_array = DB::table('requests')
       ->leftjoin('jobs','requests.request_job_id','=','jobs.jobs_id')
       ->leftjoin('users','requests.request_company_id','=','users.id')
       ->leftjoin(DB::raw('(SELECT action_assigned as aaa, count(*) as too FROM `action_request` group BY action_assigned) as too_table'),'requests.request_id','too_table.aaa')
       ->leftjoin(DB::raw('(SELECT action_requested as bbb, count(*) as too1 FROM `action_request` group BY action_requested) as too_table1'),'requests.request_id','too_table1.bbb')

       ->where('requests.request_agent_id',Auth::user()->id)
       ->select('requests.*', 'jobs.jobs_name', 'users.name as company_name', 'too_table.too', 'too_table1.too1')
       ->where('requests.request_finished', 1)
       ->orderby('requests.request_start_time','desc')
       ->get();

       return \Response::json($my_array);
   }

   public function listforagent(Request $request)
   {

    // return User::with(array('getActions'=>function($query){$query->where('action_request.action_date', Input::get('id'));}))
    // ->where('user_type', '1')
    // ->get();

       $my_array = DB::table('users')
       ->leftjoin(DB::raw('(select * from `action_request` where action_request.action_date = "'.$request['id'].'") as action_request'), 'users.id', '=', 'action_request.action_worker_id')
       ->select('users.id','users.name','users.worker_lname','action_request.action_requested','action_request.action_confirmed','action_request.action_assigned')
       ->where([
        ['users.user_type','1'],
        ['agent_id', Auth::user()->id]])
       ->orderby('users.id')
       ->get();

       return \Response::json($my_array);


   }

public function changestatus(Request $request)
    {
        $request_id = $request['id'];

        $userStatus = DB::table('requests')
        ->where('request_id',$request_id)
        ->pluck('request_finished');

        

        if($userStatus[0] == '0') 
            {DB::table('requests')
        ->where('request_id',$request_id)
        ->update([
            'request_finished' => 1
            ]);}

        if($userStatus[0] == '1') 
            {DB::table('requests')
        ->where('request_id',$request_id)
        ->update([
            'request_finished' => 0
            ]);}
                    
        
        $my_array = DB::table('requests')
       ->leftjoin('jobs','requests.request_job_id','=','jobs.jobs_id')
       ->where('requests.request_id',$request_id)
       ->select('requests.*', 'jobs.jobs_name')
       ->get();


       return \Response::json($my_array[0]);

       //return WorkRequest::where('request_id',  $request_id)->first();
         
      }

   public function saveworkertime(Request $request)
   {
       DB::table('action_request')
       ->where([
        'action_worker_id'=>$request['action_worker_id'],
        'action_id'=>$request['action_id']
        ])
       ->update([
        'action_start_time' =>  $request['action_start_time'],
        'action_finish_time' =>  $request['action_finish_time'],
        'action_break_time' =>  $request['action_break_time'],
        'action_total_time' =>  $request['action_total_time']
        ]);

       return response()->json($request);

   }

   public function infofortime(Request $request)
   {
       $val =  $request['id'];
       $my_array = DB::table('action_request')
       ->where('action_assigned', $val)
       ->join('users','action_request.action_worker_id','=','users.id')
       ->select('action_request.action_id','action_request.action_worker_id','action_request.action_assigned', DB::raw('TIME_FORMAT(action_request.action_start_time, "%H:%i") as action_start_time'), DB::raw('TIME_FORMAT(action_request.action_finish_time, "%H:%i") as action_finish_time'), DB::raw('TIME_FORMAT(action_request.action_break_time, "%H:%i") as action_break_time'), 'action_request.action_total_time','users.name as f_name', 'users.worker_lname as l_name')
       ->get();

       return \Response::json($my_array);

   }

   public function infoforworker(Request $request)
   {
       $val =  $request['id'];

       $my_request = DB::table('requests')
       ->where('request_id', $val)
       ->join('jobs','requests.request_job_id','=','jobs.jobs_id')
       ->join('users','requests.request_company_id','=','users.id')
       ->select('requests.*', 'jobs.jobs_name','users.name as company_name')
       ->get();

       return response()->json([
        'job_name' => $my_request[0]->jobs_name,
        'company_name' => $my_request[0]->company_name,
        'request_location' => $my_request[0]->request_location,
        'foreman_name' => $my_request[0]->request_foreman,
        'foreman_contact' => $my_request[0]->request_foreman_contact,
        'request_start_date' => $my_request[0]->request_start_date,
        'request_start_time' => $my_request[0]->request_start_time,
        'request_worker_count' => $my_request[0]->request_worker_count
        ]);

   }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return WorkRequest::create([
            'request_id' => uniqid(),
            'request_job_id' =>  $request['request_job_id'],
            'request_company_id' => Auth::user()->id,
            'request_agent_id' => Auth::user()->agent_id,
            'request_start_date' => $request['request_start_date'],   
            'request_start_time' => $request['request_start_time'],
            'request_worker_count' => $request['request_worker_count'],
            'request_location' => $request['request_location'],
            'request_foreman' => $request['request_foreman'],
            'request_foreman_contact' => $request['request_foreman_contact']
            ]);
    }

    public function agentsentrequest(Request $request)
    {
        $flag = DB::table('action_request')
        ->where([
            'action_worker_id'=>$request['action_worker_id'],
            'action_date'=>$request['action_date']
            ])
        ->count();
        
        if($flag==0)
        {
            return ActionRequest::create([
                'action_worker_id' =>  $request['action_worker_id'],
                'action_date' =>  $request['action_date'],
                'action_requested' =>  $request['action_requested'],
                ]);
        }
        else
        {

            DB::table('action_request')
            ->where([
                'action_worker_id'=>$request['action_worker_id'],
                'action_date'=>$request['action_date']
                ])
            ->update([
               'action_requested' =>  $request['action_requested'],
               ]);
            return response()->json($request);
        }
    }

    public function agentassign(Request $request)
    {

       $flag = DB::table('action_request')
       ->where([
        'action_worker_id'=>$request['action_worker_id'],
        'action_date'=>$request['action_date']
        ])
       ->count();

       if($flag==0)
       {
         return ActionRequest::create([
            'action_worker_id' =>  $request['action_worker_id'],
            'action_date' =>  $request['action_date'],
            'action_assigned' =>  $request['action_assigned'],
            ]);
     }
     else
     {
        DB::table('action_request')
        ->where([
            'action_worker_id'=>$request['action_worker_id'],
            'action_date'=>$request['action_date']
            ])
        ->update([
            'action_assigned' =>  $request['action_assigned'],
            'action_requested' =>  '',

            ]);
        return response()->json($request);
    }

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleterequest(Request $request)
    {
        return WorkRequest::where('request_id',$request['request_id'])->delete();
    }
}
