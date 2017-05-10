	    <header class="page-head slider-menu-position">
        <!-- - RD Navbar-->
        <!-- RD Navbar Transparent-->
        <div class="rd-navbar-wrap">
          <nav data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" class="rd-navbar container rd-navbar-floated rd-navbar-dark rd-navbar-dark-transparent" data-lg-auto-height="true" data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-stick-up="true">
            <div class="rd-navbar-inner">
              <!-- RD Navbar Panel -->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap" class="rd-navbar-toggle"><span></span></button>
                <!-- RD Navbar Top Panel Toggle-->
                <button data-rd-navbar-toggle=".rd-navbar, .rd-navbar-right-buttons" class="rd-navbar-right-buttons-toggle"><span></span></button>
                <!--Navbar Brand-->
                <div class="rd-navbar-brand"><a href="{{url('/home')}}"><img width='218' height='35' src='images/logo.png' alt=''/></a></div>
              </div>
              <div class="rd-navbar-menu-wrap">
                <div class="rd-navbar-nav-wrap">
                  <div class="rd-navbar-mobile-scroll">
                    <!--Navbar Brand Mobile-->
                    <div class="rd-navbar-mobile-brand"><a href="{{url('/home')}}"><img width='218' height='35' src='images/logo.png' alt=''/></a></div>
                    <!-- RD Navbar Nav-->
                    <ul class="rd-navbar-nav">
                      <li class="active"><a href="{{url('/home')}}"><span>Home</span></a>
                      </li>

                    </li>
                    <li><a href="#"><span>Pages</span></a>
                      <ul class="rd-navbar-dropdown">
                        <li><a href="about-us.html"><span class="text-middle">About Us</span></a>
                        </li>
                        <li><a href="your-career-starts-here.html"><span class="text-middle">Your Career Starts Here</span></a>
                        </li>
                        <li><a href="resume-page.html"><span class="text-middle">Resume Page</span></a>
                        </li>
                        <li><a href="project-managers.html"><span class="text-middle">Project Managers</span></a>
                        </li>
                        <li><a href="faq.html"><span class="text-middle">FAQ</span></a>
                        </li>
                        <li><a href="contact-us.html"><span class="text-middle">Contact Us</span></a>
                        </li>
                      </ul>
                    </li>
                    @if (!Auth::guest())                                
                          {{--      1 - worker
                                    2 - company
                                    3 - work hire company  --}}

                                    @if(Auth::user()->user_type === 1)
                                    <li><a href="{{url('/home')}}"><span>{{Auth::user()->name}}'s account(Worker)</span></a>
                                      <ul class="rd-navbar-dropdown">
                                        <li><a href="{{url('/home')}}"><span class="text-middle">Dashboard</span></a>
                                        </li>
                                      </ul>
                                    </li>                                
                                    @endif
                                    @if(Auth::user()->user_type === 2)
                                    <li><a href="{{url('/home')}}"><span>{{Auth::user()->name}}'s account(Company)</span></a>
                                      <ul class="rd-navbar-dropdown">
                                        <li><a href="{{url('/home')}}"><span class="text-middle">Dashboard</span></a>
                                        </li>
                                        <li><a href="{{url('/home')}}"><span class="text-middle">Reports</span></a>
                                        </li>
                                      </li>
                                      <li><a href="{{url('/jobs')}}"><span class="text-middle">Job settings</span></a>
                                      </li>
                                      <li><a href="{{url('/requests')}}"><span class="text-middle">Requests</span></a>
                                      </li>

                                    </ul>
                                  </li>
                                  @endif      
                                  @if(Auth::user()->user_type === 3)
                                  
                                  <li><a href="{{url('/home')}}"><span>{{Auth::user()->name}}'s account(Agent)</span></a>
                                    <ul class="rd-navbar-dropdown">
                                      <li><a href="{{url('/home')}}"><span class="text-middle">Dashboard</span></a>
                                      </li>
                                      <li><a href="{{url('/workers')}}"><span class="text-middle">Worker settings</span></a>
                                      </li>
                                      <li><a href="{{url('/companies')}}"><span class="text-middle">Company settings</span></a>
                                      </li>
                                   {{--     <li><a href="{{url('/jobs')}}"><span class="text-middle">Job settings</span></a>
                                 </li> --}}

                                 <li><a href="{{url('/reportsagent')}}"><span class="text-middle">Reports</span></a>
                                 </li>
                                 <li><a href="{{url('/')}}"><span class="text-middle">Invoices</span></a>
                                 </li>
                               </ul>
                             </li>
                             <li><a href="#"><span>Requests</span></a>
                              <ul class="rd-navbar-dropdown">
                                <li><a href="{{url('/requestsforagenta')}}"><span class="text-middle">New requests</span></a>
                                </li>
                                <li><a href="{{url('/requestsforagentb')}}"><span class="text-middle">Completed requests</span></a>
                                </li>

                              </ul>
                            </li>

                            @endif      
                            @endif

                          </ul>
                        </div>
                      </div>
                      <!--RD Navbar Search-->
                      <div class="rd-navbar-right-buttons group reveal-inline-block">
                        @if (Auth::guest())
                        <a href="{{ url('/login') }}" style="max-height: 40px; line-height: 22px;" class="btn btn-primary"><span class="big">Login</span></a>
                        <div class="text-middle reveal-lg-inline-block"><p class="big text-muted text-bold">or</p></div>
                        <a href="{{ url('/register') }}" style="max-height: 40px; line-height: 22px;" class="btn btn-primary text-middle"><span class="big">Register</span></a>

                        @else                                                                    

                        <a href="{{ url('/logout') }}" style="max-height: 40px; line-height: 22px;" target="_blank" class="btn btn-primary"  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" ><span class="big">Logout</span></a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                        </form>
                        @endif  
                      </div>
                    </div>
                  </div>
                </nav>
              </div>

              <div class="context-dark">
                <!-- Modern Breadcrumbs-->
                <section class="breadcrumb-modern rd-parallax bg-gray-darkest">
                  <div data-speed="0.2" data-type="media" data-url="images/background-02-1920x870.jpg" class="rd-parallax-layer"></div>
                  <div data-speed="0" data-type="html" class="rd-parallax-layer">
                    <div class="bg-overlay-gray-darkest">
                      <div class="shell section-top-98 section-bottom-34 section-md-bottom-66 section-md-98 section-lg-top-155 section-lg-bottom-66">

                      </div>
                    </div>
                  </div>
                </section>
              </div>      
            </header>