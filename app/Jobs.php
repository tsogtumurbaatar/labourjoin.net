<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
     protected $table = 'jobs';

      protected $fillable = [
        'jobs_name','jobs_desc','jobs_start_date','jobs_finish_date','jobs_location','jobs_company_id','jobs_agent_id','jobs_active',
    ];
    
}
