<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkRequest extends Model
{
   protected $table = 'requests';

      protected $fillable = [
        'request_id','request_job_id','request_company_id','request_agent_id','request_start_date','request_start_time','request_worker_count','request_location','request_foreman','request_foreman_contact',
  ];

 public function getJob()
{
    return $this->belongsTo('App\Jobs', 'request_job_id', 'jobs_id');
}

public function getCompany()
{
    return $this->belongsTo('App\User', 'request_company_id', 'id');
}

}
