@extends('layouts.app')
@section('content')
<style type="text/css">

  .scrolling table {
    table-layout: inherit;
    *margin-left: -100px;/*ie7*/
  }
  .scrolling td, th {
    vertical-align: top;
    padding: 0px;
    min-width: 100px;
  }
  .scrolling th {
    position: absolute;
    *position: relative; /*ie7*/
    left: 0;
    width: 110px;
  }
  .outer {
    position: relative
  }
  .inner {
    overflow-x: auto;
    overflow-y: visible;
    margin-left: 110px;
  }


</style>



<main class="page-content" ng-app="myApp" ng-controller="myRequestController">
  <section class="section-98 section-sm-50">
    <div class="shell-wide">
      <div class="range range-xs-center">
        <div class="cell-lg-12">
          <div class="range range-xs-center">

            <div class="cell-sm-9 cell-md-12">
              <!-- Post Modern-->
              <article class="post post-modern">
                <!-- Post media-->
                <!-- Post content-->
                <section class="post-content text-left">


                  <!-- Post Title-->
                  <div class="post-title">
                    <h6 class="offset-top-24">Request administration page.</h6>
                  </div>
                  <!-- Post Body-->
                  <div class="post-body offset-top-20">
                    <p>In this page you can create, edit, update and delete company records. {{$jobname or ''}}</p>
                  </div>
                  <div class="offset-top-10">
                    <!-- RD Search Form-->

                    <span class="input-group">


                      <input id="blog-sidebar-2-form-search-widget" type="text" name="s" ng-model="namefilter_req" ng-init="namefilter_req='{{$jobname or ''}}'" autocomplete="off" class="form-search-input input-sm form-control input-sm" placeholder="search.."/>
                      <span class="input-group-addon">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </span>

                  </div>

                  <div class="scrolling outer">
                    <div class="inner">

                      <table class="table table-condensed offset-top-20">

                        <tr class="success" style="color:white;">
                         <th >Action</th>
                         <td  class="text-nowrap" ng-click="sort('request_id')">Request ID <span class="glyphicon sort-icon" ng-show="sortkey=='request_id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                         <td class="text-nowrap" ng-click="sort('jobs_name')" >Job name <span class="glyphicon sort-icon" ng-show="sortkey=='jobs_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                         <td class="text-nowrap" ng-click="sort('request_location')" >Location <span class="glyphicon sort-icon" ng-show="sortkey=='request_location'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                         <td  class="text-nowrap" ng-click="sort('request_start_date')" >Date<span class="glyphicon sort-icon" ng-show="sortkey=='request_start_date'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                         <td  class="text-nowrap" ng-click="sort('request_worker_count')" >Attendance<span class="glyphicon sort-icon" ng-show="sortkey=='request_worker_count'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                       </tr>

                       <tr dir-paginate="workrequest in workrequests | filter:namefilter_req | orderBy: sortkey : reverse |itemsPerPage:itemsPerPageVal" pagination-id="req1" >

                        <th class="text-nowrap">


                          <span class="icon icon-xs fa fa-user text-warning" data-toggle="modal" data-target="#myModalRequestInfo" style="cursor:pointer" ng-click="getRequestInfoCompanyCont(workrequest)"></span>&nbsp;&nbsp;


                          <span class="icon icon-xs fa fa-pencil-square-o text-primary" data-toggle="modal" data-target="#myModalEdit" style="cursor:pointer" ng-click="editWorkerCont(worker)"></span>&nbsp;&nbsp;
                          
                          
                          <span ng-show="@{{workrequest.request_finished}}" class="icon icon-xs fa fa-flag-checkered text-info"></span>
                          <span ng-hide="@{{workrequest.request_finished}}" class="icon icon-xs fa fa-flag-o text-muted"></span>&nbsp;&nbsp;

                          <span class="icon icon-xs fa fa-times text-danger" ng-click="deleteRequestCont(workrequest)" style="cursor:pointer"></span>


                        </th>
                        <td class="text-nowrap">@{{workrequest.request_id}}</td>
                        <td class="text-nowrap">@{{workrequest.jobs_name}}</td>
                        <td class="text-nowrap">@{{workrequest.request_location}}</td>
                        <td class="text-nowrap">@{{workrequest.request_start_date}}</td>
                        <td class="text-nowrap">@{{workrequest.too ? workrequest.too : 0 }}/@{{workrequest.request_worker_count}}</td>

                      </tr>
                    </table>
                  </div>
                </div>
                <br>
                <dir-pagination-controls
                max-size="10"
                direction-links="true"
                boundary-links="true"
                pagination-id="req1" >
              </dir-pagination-controls>

            </section>
          </article>


        </div>
        <div class="range range-xs-center offset-top-66">
          <div class="cell-xs-7 cell-sm-5 cell-md-4 cell-lg-5 cell-xl-3">
            <div class="inset-lg-left-20 inset-lg-right-20"><input ng-click="refreshContentRequestsCont()" type="button" class="btn btn-primary reveal-xs-block" value="Refresh the requests"></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</section>

<div id="myModalRequestInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal modal-custom fade">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
          <!--span(aria-hidden='true') ×--><span aria-hidden="true" class="icon icon-xs fa fa-close text-primary"></span>
        </button>
        <h3 id="myModalLabel" class="modal-title offset-top-10"><b>Request ID :</b> @{{modal_id_info}}</h3>

      </div>
      <div class="modal-body">
        <div class="range">
          <div class="cell-lg-3"><b>Job name</b> : @{{modal_name_info}}</div>
          <div class="cell-lg-3"><b>Date</b> : @{{modal_date_info}}</div> 

          <div class="cell-lg-3"><b>Attendance</b> : @{{workertimes.length}} / @{{modal_worker_count}}</div> 
          <div class="cell-lg-3"><b>Status</b> : <input type="checkbox" ng-checked="modal_request_finished" ng-click="changeRequestCont(modal_id_info)"> @{{modal_request_status}} </div> 


        </div>

        <div class="range">
         <div class="cell-lg-12">
          <div class="form-group">
            <input type="text" class="form-control" ng-model="namefilter" placeholder="search...">
          </div>
        </div>

        <div class="cell-lg-12">
          <div class="form-group">
            <div class="table-responsive" style="overflow-x:auto;">
              <table class="table table-condensed offset-top-10">
               <thead>
                <tr class="success" style="color:white;">


                  <th  class="text-nowrap" ng-click="sort('name')">Worker name <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  
                  <th  class="text-nowrap" ng-click="sort('name')">Start time <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th  class="text-nowrap" ng-click="sort('name')">Finish time <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th  class="text-nowrap" ng-click="sort('name')">Lunch time <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th  class="text-nowrap" ng-click="sort('name')">Summary <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                </tr>
              </thead>

              <tr dir-paginate="workertime in workertimes | filter:namefilter | orderBy: sortkey : reverse |itemsPerPage:itemsPerPageVal" pagination-id="req2" >
                <td>@{{workertime.f_name}} @{{workertime.l_name}}</td>
                <td><input type="text" class="form-control" ng-model="workertime.action_start_time"></td>
                <td><input type="text" class="form-control" ng-model="workertime.action_finish_time"></td>
                <td><input type="text" class="form-control" ng-model="workertime.action_break_time"></td>
                <td><input type="text" class="form-control" ng-model="workertime.action_total_time"></td> 
              </tr>
            </table>
          </div>
          <dir-pagination-controls
          max-size="10"
          direction-links="true"
          boundary-links="true"
          pagination-id="req2" >
        </dir-pagination-controls>
      </div>
    </div>
    <div class="text-left">
      <b>Total hours :</b> @{{total_hours1}} 
    </div>

  </div>
  <div class="range range-xs-center offset-top-30">
 
   <input type="button" style="max-width: 250px;" class="btn btn-block btn-primary center-block" value="Calculate" ng-click="calculateTheTime()">
   
   <input type="button" style="max-width: 250px;" class="btn btn-block btn-primary center-block" value="Save" ng-click="saveTheWorkerTimes()">

    
 
 </div>


</div>
</div>
</div>
</div>

<div id="myModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal modal-custom fade">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
          <!--span(aria-hidden='true') ×--><span aria-hidden="true" class="icon icon-xs fa fa-close text-primary"></span>
        </button>
        <h3 id="myModalLabel" class="modal-title offset-top-10">Create new company</h3>
        <hr class="divider bg-darkers">
      </div>
      <div class="modal-body">


        <form method="POST" role="form" ng-submit="insertWorkerCont()">
          {{-- <form data-form-output="form-output-global" data-form-type="contact" method="post" class="text-left offset-top-10"> --}}
          {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
          <div class="range">
            <div class="cell-lg-12">
              <div class="form-group">
                <label for="resume-first-name" class="form-label form-label-outside">Company Name</label>
                <input id="resume-first-name" type="text" name="first-name" data-constraints="@Required" class="form-control" ng-model="newworker.name">
              </div>
            </div>
            
            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">E-mail</label>
                <input id="resume-email" type="email" name="email" data-constraints="@Required @Email" class="form-control" ng-model="newworker.email">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Password</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="newworker.password">
              </div>
            </div>


            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Address</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="newworker.address">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Phone 1</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="newworker.phone1">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Phone 2</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="newworker.phone2">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Fax number</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="newworker.phone1">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Email 2(Optional)</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="newworker.phone2">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">ABN</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="newworker.phone1">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Busniess name</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="newworker.phone2">
              </div>
            </div>
            



          </div>
          <div class="range range-xs-center offset-top-30">
           {{-- <input type="button" ng-click="insertWorkerCont1()" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new worker"> --}}
           <input type="submit" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new company">

           <div class="alert alert-success" ng-show="statusval=='success_newworker'">
            <strong>Success!</strong> New worker added
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
</div>

<div id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal modal-custom fade">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
          <!--span(aria-hidden='true') ×--><span aria-hidden="true" class="icon icon-xs fa fa-close text-primary"></span>
        </button>
        <h3 id="myModalLabel" class="modal-title offset-top-10">Edit the worker record</h3>
        <hr class="divider bg-darkers">
      </div>
      <div class="modal-body">


        <form method="POST" role="form" ng-submit="saveWorkerCont()">
          {{-- <form data-form-output="form-output-global" data-form-type="contact" method="post" class="text-left offset-top-10"> --}}
          {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
          <div class="range">
            <div class="cell-lg-6">
              <div class="form-group">
                <label for="resume-first-name" class="form-label form-label-outside">First Name</label>
                <input id="resume-first-name" type="text" name="first-name" data-constraints="@Required" class="form-control" ng-model="editworker.name">
              </div>
            </div>
            <div class="cell-lg-6 offset-top-20 offset-lg-top-0">
              <div class="form-group">
                <label for="resume-last-name" class="form-label form-label-outside">Last Name</label>
                <input id="resume-last-name" type="text" name="last-name" data-constraints="@Required" class="form-control" ng-model="editworker.worker_lname">
              </div>
            </div>
            
            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">E-mail</label>
                <input id="resume-email" type="email" name="email" data-constraints="@Required @Email" class="form-control" ng-model="editworker.email">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Password</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="editworker.password">
              </div>
            </div>


            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Address</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="editworker.address">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Phone 1</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="editworker.phone1">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Phone 2</label>
                <input id="resume-email" type="text" data-constraints="@Required" class="form-control" ng-model="editworker.phone2">
              </div>
            </div>

            
            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-me-message" class="form-label form-label-outside">Message</label>
                <textarea id="resume-me-message" name="message" data-constraints="@Required" style="height: 160px;" class="form-control"></textarea>
              </div>
            </div>
          </div>
          <div class="range range-xs-center offset-top-30">
           {{-- <input type="button" ng-click="insertWorkerCont1()" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new worker"> --}}
           <input type="submit" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new worker">

           <div class="alert alert-success" ng-show="statusval=='success_newworker'">
            <strong>Success!</strong> New worker added
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
</div>
</main>



@endsection