<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
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
          return User::where('user_type', '2')
        ->where('agent_id', Auth::user()->id )
        ->get();
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
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'address' => $request['address'],
            'phone1' => $request['phone1'],
            'phone2' => $request['phone2'],
            'agent_id' => Auth::user()->id,
            'active' => 1,
            'company_fax' => $request['company_fax'],
            'company_email2' => $request['company_email2'],
            'company_abn' => $request['company_abn'],
            'company_busname' =>$request['company_busname'],
            'user_info' => $request['user_info'],
            'user_type' => 2 /*     1 - worker
                                    2 - company
                                    3 - work hire company 
                            */
            ]);
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

  public function changestatus(Request $request)
    {
        $userStatus = DB::table('users')
        ->where('id',$request['id'])
        ->pluck('active');

        

        if($userStatus[0] == '0') 
            {DB::table('users')
        ->where('id',$request['id'])
        ->update([
            'active' => 1
            ]);}

        if($userStatus[0] == '1') 
            {DB::table('users')
        ->where('id',$request['id'])
        ->update([
            'active' => 0
            ]);}
                    
        return User::find($request['id']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('users')
        ->where('id',$request['id'])
        ->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'address' => $request['address'],
            'phone1' => $request['phone1'],
            'phone2' => $request['phone2'],
            'company_fax' => $request['company_fax'],
            'company_email2' => $request['company_email2'],
            'company_abn' => $request['company_abn'],
            'company_busname' =>$request['company_busname'],
            'user_info' => $request['user_info']
            ]);
        
        
        return response()->json($request);
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

     public function deletecompany(Request $request)
    {
        return User::where('id',$request['id'])->delete();
    }
}
