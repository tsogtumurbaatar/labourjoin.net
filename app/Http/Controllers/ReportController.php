<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function indexagent()
	{
		$workers = DB::table('users')
		->where([
			'user_type'=>1,
			'active'=>1,
			'agent_id' => Auth::user()->id
			])
		->get();

		$companies = DB::table('users')
		->where([
			'user_type'=>2,
			'active'=>1,
			'agent_id' => Auth::user()->id
			])
		->get();

		// $requests = DB::table('requests')
		// ->where('request_finished', 1)
		// ->get();

		// $jobs = DB::table('jobs')
		// ->where('jobs_active',1)
		// ->get();



		return view('reports.home_agent',[
			'workers' => $workers,
			'companies' => $companies,
			//'requests' => $requests,
			//'jobs' => $jobs
			]);
	}

	public function generate(Request $request)
	{
		$start_date = $request['start_date'];
		$finish_date = $request['finish_date'];
		$optradio = $request['optradio'];

		if($optradio == 1)
		{
			$worker_id = $request['worker_id'];

			if($worker_id=="summary")
			{
				
				$days = DB::table('action_request')
				->select('action_worker_id','name','worker_lname', DB::raw('SUM(action_total_time) as total_sales'))
				->groupBy('action_worker_id')
				->where([
					['action_date', '>=', $start_date],
					['action_date', '<=', $finish_date],
					['action_assigned', '<>', ''],
					])
				->leftjoin('users', 'action_request.action_worker_id','=','users.id')
				->where('users.agent_id', Auth::user()->id)
				->get();


				$days_summary = DB::table('action_request')
				->where([
					['action_date', '>=', $start_date],
					['action_date', '<=', $finish_date],
					['action_assigned', '<>', ''],
					])
				->leftjoin('users', 'action_request.action_worker_id','=','users.id')
				->where('users.agent_id', Auth::user()->id)
				->sum('action_total_time');

				

				return view('reports.report_by_worker_summary',[
					'start_date' => $start_date,
					'finish_date' => $finish_date,
					'days' => $days,
					'days_summary' => $days_summary
					]);

			}
			else
			{
				$days = DB::table('action_request')
				->where([
					['action_worker_id', '=', $worker_id],
					['action_date', '>=', $start_date],
					['action_date', '<=', $finish_date],
					['action_assigned', '<>', ''],
					])
				->orderby('action_date')
				->get();

				$days_summary = DB::table('action_request')
				->where([
					['action_worker_id', '=', $worker_id],
					['action_date', '>=', $start_date],
					['action_date', '<=', $finish_date],
					])
				->sum('action_total_time');

				$worker_info = DB::table('users')
				->where('id', $worker_id)
				->first();


				return view('reports.report_by_worker',[
					'start_date' => $start_date,
					'finish_date' => $finish_date,
					'days' => $days,
					'days_summary' => $days_summary,
					'worker_info' => $worker_info	
					]);
			}
		}

		if($optradio == 4)
		{
			$worker_id = $request['company_id'];

			if($worker_id=="summary")
			{

				$days = DB::select('select users.name, bbb.aaa_total_time,bbb.aaa_worker_count from (select requests.request_company_id, sum(aaa.total_time) as aaa_total_time,sum(aaa.worker_count) as aaa_worker_count from (SELECT action_assigned, sum(action_total_time) as total_time, count(*) as worker_count FROM `action_request` where (action_date > "'.$start_date.'" and action_date < "'.$finish_date.'" and action_assigned <> "") group by action_assigned) as aaa left join requests on aaa.action_assigned = requests.request_id where requests.request_agent_id = '.Auth::user()->id.' group by requests.request_company_id) as bbb left join users on users.id = bbb.request_company_id');
				


				$days_summary = 0;
				$days_workers = 0;
				foreach($days as $day)
				{
					$days_summary = $days_summary + $day->aaa_total_time;
					$days_workers = $days_workers + $day->aaa_worker_count;
				}



				return view('reports.report_by_company_summary',[
					'start_date' => $start_date,
					'finish_date' => $finish_date,
					'days' => $days,
					'days_summary' => $days_summary,
					'days_workers' => $days_workers
					]);

			}
			else
			{
				$days = DB::table('action_request')
				->select('action_assigned','requests.request_start_date','requests.request_company_id', DB::raw('SUM(action_total_time) as total_sales, count(*) as worker_count'))
				->groupBy('action_assigned')
				->where([
					['action_date', '>=', $start_date],
					['action_date', '<=', $finish_date],
					['action_assigned', '<>', ''],
					])
				->leftjoin('requests', 'action_request.action_assigned','=', 'requests.request_id')
				->leftjoin('users', 'requests.request_company_id','=','users.id')
				->where('requests.request_company_id',$worker_id)
				->orderby('requests.request_start_date')
				->get();

				$days_summary = 0;
				$days_workers = 0;
				foreach($days as $day)
				{
					$days_summary = $days_summary + $day->total_sales;
					$days_workers = $days_workers + $day->worker_count;
				}

	
				$worker_info = DB::table('users')
				->where('id', $worker_id)
				->first();


				return view('reports.report_by_company',[
					'start_date' => $start_date,
					'finish_date' => $finish_date,
					'days' => $days,
					'days_summary' => $days_summary,
					'days_workers' => $days_workers,
					'worker_info' => $worker_info	
					]);
			}

		}





		return view('home');

	}
}
