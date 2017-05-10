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
    width: 140px;
  }
  .outer {
    position: relative
  }
  .inner {
    overflow-x: auto;
    overflow-y: visible;
    margin-left: 140px;
  }


</style>
<style>
  .full button span {
    background-color: limegreen;
    border-radius: 32px;
    color: black;
  }
  .partially button span {
    background-color: orange;
    border-radius: 32px;
    color: black;
  }
</style>




<main class="page-content" ng-app="myApp" ng-controller="myJobsController">
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

                  <ul class="list-inline offset-top-14 offset-sm-top-0">
                    <li class="text-middle">
                      <div class="post-tags group-xs"> <button class="btn btn-success" data-toggle="modal" data-target="#myModalCreate">Post a Job in Minutes</button>
                      </div>
                    </li>
                    <li class="text-middle">
                      <div class="icon icon-xxs text-dark mdi mdi-pen"></div>
                    </li>
                  </ul>
                  <!-- Post Title-->
                  <div class="post-title">
                    <h6 class="offset-top-24">Jobs administration page.</h6>
                  </div>
                  <!-- Post Body-->
                  <div class="post-body offset-top-20">
                    <p>In this page you can create, edit, update and delete company records.</p>
                  </div>
                  
  <div class="offset-top-10">
            <span class="input-group">
              <input id="blog-sidebar-2-form-search-widget" type="text" name="s" ng-model="namefilter_workreq" autocomplete="off" class="form-search-input input-sm form-control input-sm" placeholder="search..." />
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
                         <td  class="text-nowrap" ng-click="sort('name')">Job name <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                         <td class="text-nowrap" ng-click="sort('too')" >Requests <span class="glyphicon sort-icon" ng-show="sortkey=='too'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                         <td class="text-nowrap" ng-click="sort('jobs_start_date')" >Start date <span class="glyphicon sort-icon" ng-show="sortkey=='jobs_start_date'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                         <td  class="text-nowrap" ng-click="sort('jobs_finish_date')" >Finish date<span class="glyphicon sort-icon" ng-show="sortkey=='jobs_finish_date'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                         <td  class="text-nowrap" ng-click="sort('jobs_location')" >Location<span class="glyphicon sort-icon" ng-show="sortkey=='jobs_location'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>
                       </tr>

                       <tr dir-paginate="job in jobs | filter:namefilter | orderBy: sortkey : reverse |itemsPerPage:itemsPerPageVal" >

                        <th class="text-nowrap">

                          <span class="icon icon-xs fa fa-eye text-info"></span>&nbsp;&nbsp;
                          <a href="{{url('/requests')}}?jobid=@{{job.jobs_id}}"><span class="icon icon-xs fa fa-list-alt text-default"></span></a>&nbsp;&nbsp;
                          <span class="icon icon-xs fa fa-bolt text-warning" data-toggle="modal" data-target="#myModalRequest" style="cursor:pointer" ng-click="createRequestCont(job)"></span>&nbsp;&nbsp;

                          <span class="icon icon-xs fa fa-pencil-square-o text-primary" data-toggle="modal" data-target="#myModalEdit" style="cursor:pointer" ng-click="editWorkerCont(worker)"></span>&nbsp;&nbsp;
                          <span class="icon icon-xs fa fa-times text-danger" ng-click="deleteJobCont(job)" style="cursor:pointer"></span>
                        </th>
                        <td>@{{job.jobs_name}}</td>
                        <td>@{{job.too ? job.too : 0 }}</td>
                        <td>@{{job.jobs_start_date}}</td>
                        <td>@{{job.jobs_finish_date}}</td>
                        <td>@{{job.jobs_location}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <dir-pagination-controls
                max-size="10"
                direction-links="true"
                boundary-links="true" >
              </dir-pagination-controls>

            </section>
          </article>


        </div>
        <div class="range range-xs-center offset-top-66">
          <div class="cell-xs-7 cell-sm-5 cell-md-4 cell-lg-5 cell-xl-3">
            <div class="inset-lg-left-20 inset-lg-right-20">
              
              <input ng-click="refreshContentJobsCont()" type="button" class="btn btn-primary reveal-xs-block" value="Refresh the contents">
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </div>
</div>
</section>

<div id="myModalRequestInfoForCompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal modal-custom fade">
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
           <div class="cell-lg-3"><b>Company</b> : @{{modal_company_info}}</div> 
            <div class="cell-lg-3"><b>Attendance</b> : @{{workertimes.length}} / @{{modal_worker_count}}</div> 


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
                  <th  class="text-nowrap" ng-click="sort('name')">First name <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th  class="text-nowrap" ng-click="sort('name')">Last name <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  
                  <th  class="text-nowrap" ng-click="sort('name')">Start time <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th  class="text-nowrap" ng-click="sort('name')">Finish time <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th  class="text-nowrap" ng-click="sort('name')">Lunch time <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th  class="text-nowrap" ng-click="sort('name')">Summary <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                </tr>
              </thead>

              <tr dir-paginate="workertime in workertimes | filter:namefilter | orderBy: sortkey : reverse |itemsPerPage:itemsPerPageVal" >

               <td>@{{workertime.f_name}}</td>
                <td>@{{workertime.l_name}}</td>
               <td>@{{workertime.action_start_time}}</td>
               <td>@{{workertime.action_finish_time}}</td>
               <td>@{{workertime.action_break_time}}</td>
               <td>@{{workertime.action_total_time}}</td>
             </tr>
           </table>
         </div>
         <dir-pagination-controls
         max-size="10"
         direction-links="true"
         boundary-links="true" >
       </dir-pagination-controls>
     </div>
   </div>
 </div>
</div>
</div>
</div>
</div>

<div id="myModalRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal modal-custom fade">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
          <!--span(aria-hidden='true') ×--><span aria-hidden="true" class="icon icon-xs fa fa-close text-primary"></span>
        </button>
        <h3 id="myModalLabel" class="modal-title offset-top-10">Create new request</h3>
        <hr class="divider bg-darkers">
      </div>
      <div class="modal-body" style="overflow-y:visible";>


        <form method="POST" role="form" ng-submit="insertRequestCont()">
         <input type="hidden" ng-value="request_job_id">
         <div class="range">
          <div class="cell-lg-6">
            <div class="form-group">
              <label for="foreman-name" class="form-label form-label-outside">Foreman name</label>
              <input id="foreman-name" type="text" name="foreman-name" data-constraints="@Required" class="form-control" ng-model="newrequest.request_foreman">
            </div>
          </div>
          <div class="cell-lg-6">
            <div class="form-group">
              <label for="foreman-contact" class="form-label form-label-outside">Foreman contact</label>
              <input id="foreman-contact" type="text" name="foreman-contact" data-constraints="@Required" class="form-control" ng-model="newrequest.request_foreman_contact">
            </div>
          </div>

          <div class="cell-lg-4 offset-top-20">
            <div class="form-group">
              <label for="request-date" class="form-label form-label-outside">Date</label>
              <input id="request-date" type="text" name="request-date" data-constraints="@Required" class="form-control" ng-model="newrequest.request_start_date">
            </div>
          </div>
          <div class="cell-lg-4 offset-top-20">
            <div class="form-group">
              <label for="request-time" class="form-label form-label-outside">Start time</label>
              <input id="request-time" type="text" name="request-time" data-constraints="@Required" class="form-control" ng-model="newrequest.request_start_time">
            </div>
          </div>
          <div class="cell-lg-4 offset-top-20">
            <div class="form-group" >
              <label for="worker-count" class="form-label form-label-outside">Worker count</label>
              <select id="worker-count" name="worker-count" data-constraints="@Required" class="form-control" ng-model="newrequest.request_worker_count" style="position: relative; z-index: -1;">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
              </select>
            </div>
          </div>

          <div class="cell-lg-12 offset-top-20">
            <div class="form-group">
              <label for="request-location" class="form-label form-label-outside">Location</label>
              <input id="request-location" type="text" name="request-location" data-constraints="@Required" class="form-control" ng-value="newlocation">
            </div>
          </div>
          
        </div>
        <div class="range range-xs-center offset-top-30">
         {{-- <input type="button" ng-click="insertWorkerCont1()" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new worker"> --}}
         <input type="submit" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Send request">

         <div class="alert alert-success" ng-show="statusval=='success_newrequest'">
          <strong>Success!</strong> Request sent
        </div>

      </div>
    </form>
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
        <h3 id="myModalLabel" class="modal-title offset-top-10">Post a Job in Minutes</h3>
        <hr class="divider bg-darkers">
      </div>
      <div class="modal-body">


        <form method="POST" role="form" ng-submit="insertJobCont()">

          <div class="range">

            <div class="cell-lg-12">
              <div class="form-group">
                <label for="job-name" class="form-label form-label-outside">Job name</label>
                <input id="job-name" type="text" data-constraints="@Required" class="form-control" ng-model="newjob.jobs_name">
              </div>
            </div>
            
            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-me-message" class="form-label form-label-outside">Job description</label>
                <textarea id="resume-me-message" ng-model="newjob.jobs_desc" name="message" data-constraints="@Required" style="height: 80px;" class="form-control"></textarea>
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-first-name" class="form-label form-label-outside">Start Date <span class="text-muted">(YYYY-MM-DD)</span></label>

              {{--   <input id="resume-first-name" type="text" name="start_day" data-constraints="@Required" class="form-control" ng-model="newjob.jobs_start_date">
              --}}

              <span class="input-group">
              <input type="text" class="form-control" uib-datepicker-popup="@{{format}}" ng-model="newjob.jobs_start_date" is-open="popup1.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" readonly />
                <span class="input-group-addon" ng-click="open1()" style="cursor:pointer">
                  <i class="glyphicon glyphicon-calendar"></i>
                </span>
              </span>

            </div>
          </div>
          <div class="cell-lg-6 offset-top-20">
            <div class="form-group">
              <label for="resume-last-name" class="form-label form-label-outside">Finish Date <span class="text-muted">(YYYY-MM-DD)</span></label>
              {{-- <input id="resume-last-name" type="text" name="last-name" data-constraints="@Required" class="form-control" ng-model="newjob.jobs_finish_date"> --}}
     <span class="input-group">
              <input type="text" class="form-control" uib-datepicker-popup="@{{format}}" ng-model="newjob.jobs_finish_date" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" readonly />
                <span class="input-group-addon" ng-click="open2()" style="cursor:pointer">
                  <i class="glyphicon glyphicon-calendar"></i>
                </span>
              </span>

            </div>
          </div>


          <div class="cell-lg-12 offset-top-20">
            <div class="form-group">
              <label for="location" class="form-label form-label-outside">Location</label>
              <input id="location" type="text" data-constraints="@Required" class="form-control" ng-model="newjob.jobs_location">
            </div>
          </div>
          
        </div>
        <div class="range range-xs-center offset-top-30">
         {{-- <input type="button" ng-click="insertWorkerCont1()" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new worker"> --}}
         <input type="submit" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Post a New Job">

         <div class="alert alert-success" ng-show="statusval=='success_newjob'">
          <strong>Success!</strong> New job added
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