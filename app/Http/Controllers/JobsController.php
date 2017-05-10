<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Jobs;


class JobsController extends Controller
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
       // return Jobs::where('jobs_company_id', Auth::user()->id)->get();
     $my_array = DB::table('jobs')
        ->leftjoin(DB::raw('(SELECT request_job_id as aaa, count(*) as too FROM `requests` group BY request_job_id) as too_table'),'jobs.jobs_id','too_table.aaa')
       ->where('jobs.jobs_company_id',Auth::user()->id)
       ->select('jobs.*', 'too_table.too')
       ->orderby('jobs.jobs_id','desc')
       ->get();


       return \Response::json($my_array);

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
         $newjob =  Jobs::create([
           'jobs_name' => $request['jobs_name'],
           'jobs_desc' => $request['jobs_desc'],
           'jobs_start_date' => $request['jobs_start_date'],
           'jobs_finish_date' => $request['jobs_finish_date'],
           'jobs_location' => $request['jobs_location'],
           'jobs_company_id' => Auth::user()->id,
           'jobs_agent_id' => Auth::user()->agent_id,
           'jobs_active' => 1
        ]);

         $newjob->jobs_id = $newjob->id;


        return response()->json($newjob);
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


     public function deletejob(Request $request)
    {
        return Jobs::where('jobs_id',$request['jobs_id'])->delete();
    }
}
