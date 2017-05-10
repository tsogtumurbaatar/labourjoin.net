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
    width: 150px;
  }
  .outer {
    position: relative
  }
  .inner {
    overflow-x: auto;
    overflow-y: visible;
    margin-left: 150px;
  }


</style>



<main class="page-content" ng-app="myApp" ng-controller="myCompaniesController">
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
                      <div class="post-tags group-xs"> <button class="btn btn-success" data-toggle="modal" data-target="#myModalCreate" ng-click="createCompanyCont()">Create New</button>
                      </div>
                    </li>
                    <li class="text-middle">
                      <div class="icon icon-xxs text-dark mdi mdi-pen"></div>
                    </li>
                  </ul>
                  <!-- Post Title-->
                  <div class="post-title">
                    <h6 class="offset-top-24">Companies administration page.</h6>
                  </div>
                  <!-- Post Body-->
                  <div class="post-body offset-top-20">
                    <p>In this page you can create, edit, update and delete company records.</p>
                  </div>
                  
                  <div class="offset-top-10">
                    <span class="input-group">   
                      <input id="blog-sidebar-2-form-search-widget" type="text" name="s" ng-model="namefilter_company" autocomplete="off" class="form-search-input input-sm form-control input-sm" placeholder="search..." />
                      <span class="input-group-addon">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </span>  
                  </div>

                  <div class="table-responsive" style="overflow-x:auto;">
                    <table class="table table-condensed offset-top-20">

                      <tr class="success" style="color:white;">

                        <td  class="text-nowrap" ng-click="sort('name')">Company name <span class="glyphicon sort-icon" ng-show="sortkey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>

                        <td  class="text-nowrap" ng-click="sort('company_busname')" >Buniness name<span class="glyphicon sort-icon" ng-show="sortkey=='company_busname'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>


                        <td  class="text-nowrap" ng-click="sort('phone1')" >Phone<span class="glyphicon sort-icon" ng-show="sortkey=='phone1'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>
                        

                        <td  class="text-nowrap" ng-click="sort('address')" >Address<span class="glyphicon sort-icon" ng-show="sortkey=='address'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>
                        <th >Action</th>


                      </tr>

                      <tr dir-paginate="company in companies | filter:namefilter_company | orderBy: sortkey : reverse |itemsPerPage:itemsPerPageVal" >


                        <td>@{{company.name}}</td>
                        <td>@{{company.company_busname}}</td>
                        <td>@{{company.phone1}}</td>
                        <td>@{{company.address}}</td>

                        <td class="text-nowrap">

                          <span ng-show="@{{company.active}}" class="icon icon-xs fa fa-eye text-info" style="cursor:pointer" ng-click="changeCompanyCont(company, $index)"></span>
                          <span ng-hide="@{{company.active}}" class="icon icon-xs fa fa-eye-slash text-muted" style="cursor:pointer" ng-click="changeCompanyCont(company, $index)"></span>&nbsp;&nbsp;

                          <span class="icon icon-xs fa fa-pencil-square-o text-primary" data-toggle="modal" data-target="#myModalEdit" style="cursor:pointer" ng-click="editCompanyCont(company, $index)"></span>&nbsp;&nbsp;
                          <span class="icon icon-xs fa fa-times text-danger" ng-click="deleteCompanyCont(company)" style="cursor:pointer"></span>


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
        <h3 id="myModalLabel" class="modal-title offset-top-10">Create new company</h3>
        <hr class="divider bg-darkers">
      </div>
      <div class="modal-body">


        <form method="POST" role="form" ng-submit="insertCompanyCont()">        
          <div class="range">
            <div class="cell-lg-12">
              <div class="form-group">
                <label for="resume-first-name" class="form-label-outside">Company Name</label>
                <input id="company_name" type="text" name="first-name" data-constraints="@Required" class="form-control" ng-model="newcompany.name">
              </div>
            </div>
            
            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">E-mail</label>
                <input id="resume-email" type="email" name="email" data-constraints="@Required @Email" class="form-control" ng-model="newcompany.email">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Password</label>
                <input id="company_password" type="text" data-constraints="@Required" class="form-control" ng-model="newcompany.password">
              </div>
            </div>


            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Address</label>
                <input id="company_address" type="text" data-constraints="@Required" class="form-control" ng-model="newcompany.address">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Phone 1</label>
                <input id="company_phone1" type="text" data-constraints="@Required" class="form-control" ng-model="newcompany.phone1">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Phone 2</label>
                <input id="company_phone2" type="text" data-constraints="@Required" class="form-control" ng-model="newcompany.phone2">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Fax number</label>
                <input id="company_fax" type="text" data-constraints="@Required" class="form-control" ng-model="newcompany.company_fax">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Email 2(Optional)</label>
                <input id="company_email2" type="text" data-constraints="@Required" class="form-control" ng-model="newcompany.company_email2">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">ABN</label>
                <input id="company_abn" type="text" data-constraints="@Required" class="form-control" ng-model="newcompany.company_abn">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="resume-email" class="form-label form-label-outside">Busniess name</label>
                <input id="company_busname" type="text" data-constraints="@Required" class="form-control" ng-model="newcompany.company_busname">
              </div>
            </div>
            
            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-me-message" class="form-label form-label-outside">Additional information</label>
                <textarea id="resume-me-message" ng-model="newcompany.user_info" data-constraints="@Required" style="height: 80px;" class="form-control" maxlength="450"></textarea>
              </div>
            </div>


          </div>
          <div class="range range-xs-center offset-top-30">
           {{-- <input type="button" ng-click="insertWorkerCont1()" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new worker"> --}}
           <input type="submit" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new company">

           <div class="alert alert-success" ng-show="statusval=='success_newworker'">
            <strong>Success!</strong> New company added
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
        <h3 id="myModalLabel" class="modal-title offset-top-10">Edit the company record</h3>
        <hr class="divider bg-darkers">
      </div>
      <div class="modal-body">


        <form method="POST" role="form" ng-submit="saveCompanyCont(row_index)">        
          <div class="range">
            <div class="cell-lg-12">
              <div class="form-group">
                <label for="company_name" class="form-label-outside">Company Name</label>
                <input id="company_name1" type="text" name="first-name" data-constraints="@Required" class="form-control" ng-model="editcompany.name">
              </div>
            </div>
             
            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="company_email" class="form-label-outside">E-mail</label>
                <input type="email" id="email1" data-constraints="@Required @Email" class="form-control" ng-model="editcompany.email">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="company_password" class="form-label form-label-outside">Password</label>
                <input id="company_password1" type="text" data-constraints="@Required" class="form-control" ng-model="editcompany.password">
              </div>
            </div>


            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="company_address" class="form-label form-label-outside">Address</label>
                <input id="company_address1" type="text" data-constraints="@Required" class="form-control" ng-model="editcompany.address">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="company_phone1" class="form-label form-label-outside">Phone 1</label>
                <input id="company_phone11" type="text" data-constraints="@Required" class="form-control" ng-model="editcompany.phone1">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="company_phone2" class="form-label form-label-outside">Phone 2</label>
                <input id="company_phone21" type="text" data-constraints="@Required" class="form-control" ng-model="editcompany.phone2">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="company_fax" class="form-label form-label-outside">Fax number</label>
                <input id="company_fax1" type="text" data-constraints="@Required" class="form-control" ng-model="editcompany.company_fax">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="company-new" class="form-label-outside">Email 2(Optional)</label>
                <input id="company_email21" type="text" data-constraints="@Required" class="form-control" ng-model="editcompany.company_email2">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="company_abn" class="form-label form-label-outside">ABN</label>
                <input id="company_abn1" type="text" data-constraints="@Required" class="form-control" ng-model="editcompany.company_abn">
              </div>
            </div>

            <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <label for="company_busname" class="form-label form-label-outside">Busniess name</label>
                <input id="company_busname1" type="text" class="form-control" data-constraints="@Required"ng-model="editcompany.company_busname" name="company_busname">
              </div>
            </div>
            
            <div class="cell-lg-12 offset-top-20">
              <div class="form-group">
                <label for="resume-me-message" class="form-label form-label-outside">Additional information</label>
                <textarea id="resume-me-message1" ng-model="editcompany.user_info" data-constraints="@Required" style="height: 80px;" class="form-control" maxlength="450"></textarea>
              </div>
            </div>
 

          </div>
          <div class="range range-xs-center offset-top-30">
           {{-- <input type="button" ng-click="insertWorkerCont1()" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Add new worker"> --}}
           <input type="submit" style="max-width: 268px;" class="btn btn-block btn-primary center-block" value="Save company info">

           <div class="alert alert-success" ng-show="statusval=='success_editworker'">
            <strong>Success!</strong> Company info saved
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
</div>



</main>



@endsection