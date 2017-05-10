@extends('layouts.app')
@section('content')

<main class="page-content" ng-app="myApp" ng-controller="myHomeController">
  <section class="section-98 section-sm-50">
    <div class="shell-wide">
      <div class="range range-xs-center">
        <div class="cell-lg-11">
          <div class="range range-xs-center">

            <div class="cell-sm-9 cell-md-12">
              <!-- Post Modern-->
              <article class="post post-modern">
                <!-- Post media-->
                <!-- Post content-->
                <section class="post-content text-left">


                  <div class="row">
                    <div class="col-md-4">                 
                      <img src="{{url('/')}}/imagesworker/blank.jpg" width="200" height="200" alt="" class="img-responsive center-block" style="border-radius: 50%;">
                    </div>

                    <div class="col-md-8 text-left">                 
                      Hello : <b> {{Auth::user()->name}} {{Auth::user()->worker_lname}}  </b><br>

                      Last login date : 10 Nov 2016 11:48:03 PM


                      <div class="alert alert-success">
                        <strong>You have {{$count_my_requests}} inbound work requests</strong>
                      </div>

                      <div class="alert alert-success">
                        <strong>You have {{$count_my_assignments}} sent work requests</strong>
                      </div>
                      <div class="alert alert-warning text-dark">
                        <strong>You have completed 5 works this week</strong>
                      </div>
                    </div>
                    <div class="col-md-4">                 
                    </div>
                  </div>     


                  <div class="offset-top-50">
                  </div>

                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#section1">Inbound work requests</a></li>
                    <li ><a data-toggle="tab" href="#section2">Assignments</a></li>
                  </ul>
                  <div class="tab-content">
                    <div id="section1" class="tab-pane fade in active">
                     <div class="shell">
                      <div class="range range-xs-center offset-top-0">
                        <div class="cell-sm-10">
                          <div class="range">
                            <div class="cell-lg-12 offset-top-30 offset-md-top-20">
                              <table class="table table-condensed">
                                <thead>
                                  <tr class="success" style="color:white">
                                    <th>Request ID</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Confirm</th>
                                    <th>Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 @foreach($my_inbound_request as $request)
                                 <tr>
                                  <td><span class="text-primary" data-toggle="modal" data-target="#myModalInfo" style="cursor:pointer" ng-click="getInfoCont('{{$request->action_requested}}')">{{$request->action_requested}}
                                  </span>
                                </td>
                                <td>{{$request->request_location}}</td>
                                <td>{{$request->action_date}}</td>
                                <td>
                                 @if($request->action_requested == 1) 
                                 <span class="icon icon-xs fa fa-thumbs-up text-primary"></span>
                                 @else
                                 <a href="{{ route('confirmjobreq', $request->action_id) }}" data-token="{{csrf_token()}}"><span class="icon icon-xs fa fa-check text-primary"></span> </a>
                                 @endif
                               </td>
                               <td> 
                                <a href="{{ route('login', $request->action_id) }}" data-token="{{csrf_token()}}"><span class="icon icon-xs fa fa-times text-danger"></span> </a>
                              </td>
                            </tr>
                            @endforeach  
                            <tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 

                <div id="section2" class="tab-pane fade">
                 <div class="shell">
                  <div class="range range-xs-center offset-top-0">
                    <div class="cell-sm-10">
                      <div class="range">
                        <div class="cell-lg-12 offset-top-30 offset-md-top-20">
                          <table class="table table-condensed">
                            <thead>
                              <tr class="success" style="color:white">
                                <th>Request ID</th>
                                <th>Location</th>
                                <th>Date</th>

                                <th>Cancel</th>
                              </tr>
                            </thead>
                            <tbody>
                             @foreach($my_assignments as $request)
                             <tr>
                              <td><span class="text-primary" data-toggle="modal" data-target="#myModalInfo" style="cursor:pointer" ng-click="getInfoCont('{{$request->action_assigned}}')">{{$request->action_assigned}}
                              </span>
                            </td>
                            <td>{{$request->request_location}}</td>
                            <td>{{$request->action_date}}</td>
                            <td> 
                              <a href="{{ route('login', $request->action_id) }}" data-token="{{csrf_token()}}"><span class="icon icon-xs fa fa-times text-danger"></span> </a>
                            </td>
                          </tr>
                          @endforeach  
                          <tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </section>
        </article>


      </div>

    </div>
  </div>



</div>
</div>
</section>

<div id="myModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal modal-custom fade">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
          <!--span(aria-hidden='true') ×--><span aria-hidden="true" class="icon icon-xs fa fa-close text-primary"></span>
        </button>
        <h3 id="myModalLabel" class="modal-title offset-top-10">Work information</h3>
      </div>
      <div class="modal-body">


        
        <div class="range">
         
         <div class="cell-lg-6">
          <div class="form-group">
            <label for="foreman-name" class="form-label form-label-outside">Foreman name</label>
            <input id="foreman-name" type="text" name="foreman-name" class="form-control" value="@{{info['foreman_name']}}" readonly>
          </div>
        </div>
        <div class="cell-lg-6">
          <div class="form-group">
            <label for="foreman-contact" class="form-label form-label-outside">Foreman contact</label>
            <input id="foreman-contact" type="text" name="foreman-contact"  class="form-control" value="@{{info['foreman_contact']}}" readonly>
          </div>
        </div>

        <div class="cell-lg-6 offset-top-20">
          <div class="form-group">
            <label for="foreman-name" class="form-label form-label-outside">Job name</label>
            <input id="foreman-name" type="text" name="foreman-name" class="form-control" value="@{{info['job_name']}}" readonly>
          </div>
        </div>
        <div class="cell-lg-6 offset-top-20">
          <div class="form-group">
            <label for="foreman-contact" class="form-label form-label-outside">Company name</label>
            <input id="foreman-contact" type="text" name="foreman-contact" class="form-control" value="@{{info['company_name']}}" readonly>
          </div>
        </div>

        <div class="cell-lg-4 offset-top-20">
          <div class="form-group">
            <label for="request-date" class="form-label form-label-outside">Date</label>
            <input id="request-date" type="text" name="request-date" class="form-control" value="@{{info['request_start_date']}}" readonly>
          </div>
        </div>
        <div class="cell-lg-4 offset-top-20">
          <div class="form-group">
            <label for="request-time" class="form-label form-label-outside">Start time</label>
            <input id="request-time" type="text" name="request-time" class="form-control" value="@{{info['request_start_time']}}" readonly>
          </div>
        </div>
        <div class="cell-lg-4 offset-top-20">
          <div class="form-group">
            <label for="worker-count" class="form-label form-label-outside">Worker count</label>
            <input id="worker-count" type="text" name="worker-count" class="form-control" value="@{{info['request_worker_count']}}" readonly>
          </div>
        </div>
        
        <div class="cell-lg-12 offset-top-20">
          <div class="form-group">
            <label for="request-location" class="form-label form-label-outside">Location</label>
            <input id="request-location" type="text" name="request-location" class="form-control" value="@{{info['request_location']}}" readonly>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
</div>
</div>

</main>
@endsection