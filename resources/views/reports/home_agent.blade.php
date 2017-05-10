@extends('layouts.app')
@section('content')

<main class="page-content">
  <section class="section-98 section-sm-50">
    <div class="shell-wide">
      <div class="range range-xs-center">

        <div class="cell-lg-8">
          <form method="POST" action="{{url('/generatedreport')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="range range-xs-center">
              <div class="cell-sm-9 cell-md-12">
                <!-- Post Modern-->
                <article class="post post-modern">
                  <!-- Post media-->
                  <!-- Post content-->
                  <section class="post-content text-left">


                    <!-- Post Title-->
                    <div class="post-title">
                      <h6 class="offset-top-24">Report page</h6>
                    </div>
                    <!-- Post Body-->
                    <div class="post-body offset-top-20">
                     <div class="range">
                      <div class="cell-lg-6">
                        <div class="form-group">
                          <label for="resume-last-name" class="form-label-outside">Start Date <span class="text-muted">(YYYY-MM-DD)</span></label>
                          <input id="start_date" type="text" name="start_date"  class="form-control" readonly>
                        </div>
                      </div>
                      <div class="cell-lg-6">
                        <div class="form-group">
                          <label for="resume-last-name" class="form-label-outside">Finish Date <span class="text-muted">(YYYY-MM-DD)</span></label>
                          <input id="finish_date" type="text" name="finish_date"  class="form-control" readonly>
                        </div>
                      </div>

                      <div class="cell-lg-12 offset-top-20">

                       <div class="text-subline"></div>
                     </div>

                     <div class="cell-lg-6 offset-top-20">
                      <div class="form-group radio">
                       <label><input type="radio" name="optradio" value = "1" checked>Report by Worker</label>

                     </div>
                   </div>
                   <div class="cell-lg-6 offset-top-20">
                    <div class="form-group">
                      <select name="worker_id">
                        @foreach ($workers as $worker)
                        <option value="{{$worker->id}}">{{$worker->name}} {{$worker->worker_lname}} </option>  
                        @endforeach
                        <option value="summary">Summary</option>
                      </select>
                    </div>
                  </div>
                 {{--  <div class="cell-lg-6 offset-top-20">
                    <div class="form-group radio">
                     <label><input type="radio" name="optradio" value = "2">Report by Request</label>

                   </div>
                 </div>
                 <div class="cell-lg-6 offset-top-20">
                  <div class="form-group">
                    <select>
                      @foreach ($requests as $request)
                      <option>{{$request->request_id}}  </option>
                      @endforeach

                    </select>
                  </div>
                </div>
                <div class="cell-lg-6 offset-top-20">
                  <div class="form-group radio">
                   <label><input type="radio" name="optradio" value = "3">Report by Job</label>

                 </div>
               </div>
               <div class="cell-lg-6 offset-top-20">
                <div class="form-group">
                  <select>
                    @foreach ($jobs as $job)
                    <option>{{$job->jobs_name}}</option>
                    @endforeach

                  </select>
                </div>
              </div> --}}
              <div class="cell-lg-6 offset-top-20">
                <div class="form-group radio">
                 <label><input type="radio" name="optradio" value = "4">Report by Company</label>

               </div>
             </div>
             <div class="cell-lg-6 offset-top-20">
              <div class="form-group">
                <select name="company_id">
                  @foreach ($companies as $company)
                  <option value="{{$company->id}}">{{$company->name}}</option>
                  @endforeach
                   <option value="summary">Summary</option>
                </select>
              </div>
            </div>

        {{--     <div class="cell-lg-6 offset-top-20">
              <div class="form-group radio">
               <label><input type="radio" name="optradio" value = "5">Summary</label>

             </div>
           </div>
           <div class="cell-lg-6 offset-top-20">
            <div class="form-group">
            </div>
          </div> --}}
        </div>
      </div>
    </section>
  </article>
</div>
<div class="range range-xs-center offset-top-66">
  <div class="cell-xs-7 cell-sm-5 cell-md-4 cell-lg-5 cell-xl-3">
    <div class="inset-lg-left-20 inset-lg-right-20"><input type="submit" class="btn btn-primary reveal-xs-block" value="Generate report">

    </div>
  </div>
</div>
</div>
</form>
</div>


<div class="cell-sm-9 cell-lg-3 offset-top-66 offset-lg-top-0">
  <div class="inset-xl-left-100">
    <!-- Sidebar-->
    <aside class="text-left">
      <!-- Search Form-->
      <h6 class="text-uppercase text-spacing-60">Search</h6>
      <div class="text-subline"></div>
      <div class="offset-top-34">
        <!-- RD Search Form-->
        <form action="search-results.html" method="GET" class="form-search rd-search">
          <div class="form-group">
            <label for="blog-sidebar-2-form-search-widget" class="form-label form-search-label form-label-sm">Search</label>
            <input id="blog-sidebar-2-form-search-widget" type="text" name="s" autocomplete="off" class="form-search-input input-sm form-control input-sm"/>
          </div>
          <button type="submit" class="form-search-submit"><span class="mdi mdi-magnify"></span></button>
        </form>
      </div>
      <!-- Twitter Feed-->

      <div class="range offset-top-41">
        <div class="cell-xs-6 cell-md-12">
          <!-- Category-->
          <h6 class="text-uppercase text-spacing-60">Categories</h6>
          <div class="text-subline"></div>
          <ul class="list list-marked offset-top-30">
            <li><a href="#">Job <span class="text-dark">(37)</span></a></li>
            <li><a href="#">Employers <span class="text-dark">(211)</span></a></li>
            <li><a href="#">Resume <span class="text-dark">(12)</span></a></li>
            <li><a href="#">Finance <span class="text-dark">(7)</span></a></li>
            <li><a href="#">Vacancy <span class="text-dark">(15)</span></a></li>
          </ul>
        </div>
      
      </div>
      <!-- Tags-->
      <h6 class="offset-top-41 text-uppercase text-spacing-60">Tags</h6>
      <div class="text-subline"></div>
      <div class="offset-top-34">
        <div class="group-xs"><a href="#" class="btn btn-xs btn-default">resume</a><a href="#" class="btn btn-xs btn-default">employers</a><a href="#" class="btn btn-xs btn-default">Job</a><a href="#" class="btn btn-xs btn-default">Vacancy</a><a href="#" class="btn btn-xs btn-default">Finance</a>
        </div>
      </div>
    </aside>
  </div>
</div>
</div>
</div>
</section>
</main>
@endsection