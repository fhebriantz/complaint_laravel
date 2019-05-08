        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="{{url('/cms/about')}}" class="navbar-brand"> 
                 <b>Azha Teknologi Pratama</b>
                </a>
           
              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name" style="margin-right: 0px"><span><a href="{{url('/')}}" target="_blank">View Web Azha |</a></span></li>
                <li class="user-name"><span>{{ session()->get('session_name') }}</span>
                </li>
                <li class="avatar-dropdown" style="margin-right: 15px">
                  <a href="{{url('/cms/logout')}}">
                   <img src="{{ asset('asset/img/logout.png')}}" class="img-circle avatar" />
                   </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>