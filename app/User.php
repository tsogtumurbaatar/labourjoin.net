<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'worker_lname', 'email', 'password', 'address', 'phone1', 'phone2', 'user_type','agent_id','user_info', 'company_fax', 'company_email2', 'company_busname', 'company_abn','active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function getActions()
{
    return $this->hasOne('App\ActionRequest', 'action_worker_id', 'id');
}
}
