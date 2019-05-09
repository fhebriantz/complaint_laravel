            <div id="left-menu">
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                    <!--<li><div class="left-bg"></div></li>-->
                    <li class="time">
                      <h1 class="animated fadeInLeft">21:00</h1>
                      <p class="animated fadeInRight">Sat,October 1st 2029</p>
                    </li>
                    <li class="ripple">
                      <a href="{{url('/cmsuser')}}"> Master CMS User
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    <li class="ripple">
                      <a href="{{url('/department')}}"> Master Department
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    @if(session()->get('session_superadmin') == 1)
                    <li class="ripple">
                      <a href="{{url('/country')}}"> Master Country
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    @else
                    @endif

                    <li class="ripple">
                      <a href="{{url('/slider')}}"> Master Slider
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>

                    <li class="ripple">
                      <a href="{{url('/emailtemplate')}}"> Master Email Template
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header"></span> Master User
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="{{url('/userinternal')}}">User Internal</a></li>
                        <li><a href="{{url('/mgmtuser')}}">Management User</a></li>
                        <li><a href="{{url('/mgmtuserdept')}}">Management User Dept</a></li>
                      </ul>
                    </li>

                  </ul>
                </div>
            </div>