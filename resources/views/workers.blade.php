@extends('layouts.app')
@section('content')

<main class="page-content" ng-app="myApp" ng-controller="myWorkersController">
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
                      <div class="post-tags group-xs"> <button class="btn btn-success" data-toggle="modal" data-target="#myModalCreate" ng-click="createWorkerCont()">Create New</button>
                      </div>
                    </li>
                    <li class="text-middle">
                      <div class="icon icon-xxs text-dark mdi mdi-pen"></div>
                    </li>
                  </ul>
                  <!-- Post Title-->
                  <div class="post-title">
                    <h6 class="offset-top-24">Workers administration page.</h6>
                  </div>
                  <!-- Post Body-->
                  <div class="post-body offset-top-20">
                    <p>In this page you can create, edit, update and delete workers records.</p>
                  </div>
 <div class="offset-top-10">
          <span class="input-group">   
              <input id="blog-sidebar-2-form-search-widget" type="text" name="s" ng-model="namefilter_worker" autocomplete="off" class="form-search-input input-sm form-control input-sm" placeholder="search..." />
                <span class="input-group-addon">
                  <i class="mdi mdi-magnify"></i>
                </span>
           </span>  
        </div>
                  


                  <div class="table-responsive" style="overflow-x:auto;">
                  <table class="table table-condensed offset-top-20">
                   <thead>
                    <tr class="success" style="color:white;">
                      <th  class="text-nowrap" ng-click="sort('name')">First name <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                      <th  class="text-nowrap" ng-click="sort('worker_lname')">Last name <span class="glyphicon sort-icon" ng-show="sortkey=='worker_lname'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                      
                      <th class="text-nowrap" ng-click="sort('email')" >Email <span class="glyphicon sort-icon" ng-show="sortkey=='email'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                      <th  class="text-nowrap" ng-click="sort('phone1')" >Phone 1<span class="glyphicon sort-icon" ng-show="sortkey=='phone1'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                     
                        <th  class="text-nowrap" ng-click="sort('phone2')" >Phone 2<span class="glyphicon sort-icon" ng-show="sortkey=='phone2'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tr dir-paginate="worker in workers | filter:namefilter_worker | orderBy: sortkey : reverse |itemsPerPage:itemsPerPageVal" >

                   <td>@{{worker.name}}</td>
                   <td>@{{worker.worker_lname}}</td>
                   <td>@{{worker.email}}</td>
                   <td>@{{worker.phone1}}</td>
                   <td>@{{worker.phone2}}</td>
                   <td class="text-nowrap">
                    
                  
                    
                    <span ng-show="@{{worker.active}}" class="icon icon-xs fa fa-eye text-info" style="cursor:pointer" ng-click="changeWorkerCont(worker, $index)"></span>
                    <span ng-hide="@{{worker.active}}" class="icon icon-xs fa fa-eye-slash text-muted" style="cursor:pointer" ng-click="changeWorkerCont(worker, $index)"></span>&nbsp;&nbsp;

                    {{-- <span class="icon icon-xs fa fa-list-alt text-default"></span>&nbsp;&nbsp; --}}
                    {{-- <span class="icon icon-xs fa fa-eye-slash text-muted"></span></a> --}}
                    {{-- <span class="icon icon-xs fa fa-key text-warning"></span>&nbsp;&nbsp; --}}
                    <span class="icon icon-xs fa fa-pencil-square-o text-primary" data-toggle="modal" data-target="#myModalEdit" style="cursor:pointer" ng-click="editWorkerCont(worker, $index)"></span>&nbsp;&nbsp;
                    <span class="icon icon-xs fa fa-times text-danger" ng-click="deleteWorkerCont(worker)" style="cursor:pointer"></span>
                    
                  </td>
                </tr>
              </table>
              </div>
              <br>
              <dir-pagination-controls
              max-size="10"
              direction-links="true"
              boundary-links="true" >
            </dir-pagination-controls>

          </section>
        </article>


      </div>
     
    </div>
  </div>

</div>
</div>
</section>


<div id="myModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal modal-custom fade">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
          <!--span(aria-hidden='true') ×--><span aria-hidden="true" class="icon icon-xs fa fa-close text-primary"></span>
        </button>
        <h3 id="myModalLabel" class="modal-title offset-top-10">Create a new worker</h3>
        <hr class="divider bg-darkers">
      </div>
      <div class="modal-body">

       
        <form method="POST" role="form" ng-submit="insertWorkerCont()">
        {{-- <form data-form-output="form-output-global" data-form-type="contact" method="post" class="text-left offset-top-10"> --}}
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
          <div class="range">
            <div class="cell-lg-6">
              <div class="form-group">
                <label for="resume-first-name" class="form-label form-label-outside">First Name</label>
                <input id="resume-first-name" type="text" name="first-name" data-constraints="@Required" class="form-control" ng-model="newworker.name">
              </div>
            </div>
            <div class="cell-lg-6 offset-top-20 offset-lg-top-0">
              <div class="form-group">
                <label for="resume-last-name" class="form-label form-label-outside">Last Name</label>
                <input id="resume-last-name" type="text" name="last-name" data-constraints="@Required" class="form-control" ng-model="newworker.worker_lname">
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

            
            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-me-message" class="form-label form-label-outside">Additional information</label>
                <textarea id="resume-me-message" ng-model="newworker.user_info" data-constraints="@Required" style="height: 80px;" class="form-control" maxlength="450"></textarea>
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

       
        <form method="POST" role="form" ng-submit="saveWorkerCont(row_index)">
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
                <input id="workerlnae" type="text" name="workerlname" data-constraints="@Required" class="form-control" ng-model="editworker.worker_lname">
              </div>
            </div>

             <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">E-mail</label>
                <input id="resume-email" type="email" name="email" class="form-control" ng-model="editworker.email" readonly>
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Password</label>
                <input id="userpassword" type="text" data-constraints="@Required" class="form-control" ng-model="editworker.password">
              </div>
            </div>
            
            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Address</label>
                <input id="address" type="text" data-constraints="@Required" class="form-control" ng-model="editworker.address">
              </div>
            </div>

          <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Phone 1</label>
                <input id="phone1" type="text" data-constraints="@Required" class="form-control" ng-model="editworker.phone1">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Phone 2</label>
                <input id="phone2" type="text" data-constraints="@Required" class="form-control" ng-model="editworker.phone2">
              </div>
            </div>

            
            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-me-message" class="form-label form-label-outside">Additional information</label>
                <textarea id="info" ng-model="editworker.user_info" data-constraints="@Required" style="height: 160px;" class="form-control"></textarea>
              </div>
            </div>
          </div>
          <div class="range range-xs-center offset-top-30">
           {{-- <input type="button" ng-click="insertWorkerCont1()" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new worker"> --}}
          <input type="submit" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Save worker">
          
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