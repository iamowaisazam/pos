<nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{URL::to('/admin/dashboard')}}"><b>
             <img src="{{asset('admin/assets/images/logo-icon.png')}}" class="dark-logo" />
             <img src="{{asset('admin/assets/images/logo-light-icon.png')}}" class="light-logo" />
            </b><span>
             <img src="{{asset('admin/assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
             <img src="{{asset('admin/assets/images/logo-light-text.png')}}" class="light-logo" />
            </span> 
        </a>
    </div>
    <div class="navbar-collapse">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
            <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
        </ul>

        <ul class="navbar-nav my-lg-0">
            <li class="nav-item dropdown u-pro">
                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  @if(auth()->user()->image && auth()->user()->image->filename)
                        <img src="/public/filemanager/{{ auth()->user()->image->filename }}" alt="user" class=""> 
                    @else
                        <img src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user" class=""> 
                    @endif
                  <span class="hidden-md-down">{{ Auth::user()->name }} &nbsp;<i class="fa fa-angle-down"></i></span> 
                </a>
                <div class="dropdown-menu dropdown-menu-end animated flipInY">
                    {{-- @if(Auth::user()->permission('users.profile-view')) --}}
                    <a href="{{URL::to("admin/profile")}}" class="dropdown-item">
                        <i class="ti-user"></i> My Profile
                    </a>
                    {{-- @endif --}}
                    {{-- <a href="javascript:void(0)" class="right-side-toggle dropdown-item"><i class="ti-settings"></i> Settings</a> --}}
                    <a href="{{URL::to('/admin/logout')}}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>