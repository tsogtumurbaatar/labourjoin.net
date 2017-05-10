<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionRequest extends Model
{
     protected $table = 'action_request';

      protected $fillable = ['action_worker_id','action_date','action_requested','action_confirmed','action_assigned',
      ];
}
