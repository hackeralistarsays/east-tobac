{{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav> --}}


<div class="navbar-custom">
    <ul class="list-unstyled topbar-right-menu float-left mb-0">
        <li class="py-2" style="font-size:26px;"><b>TOBACCO LEAF MANAGEMENT SYSTEM</b></li>
    </ul>
    <ul class="list-unstyled topbar-right-menu float-right mb-0">        
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar"> 
                    <img src="{{ asset('images/avatar-1.jpg') }}" alt="user-image" class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">{{ Auth::user()->name }}</span>
                    <span class="account-position">@if (Auth::user()->role == 1)
                        Administrator
                        @else
                            User                        
                    @endif</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                @if (Auth::user()->role == 1)
                        
                        <div class=" dropdown-header noti-title">
                           <a href="{{route('users.index')}}"> <h6 class="text-overflow m-0"><i class="mdi mdi-account-search-outline"></i> MANAGE USERS !</h6></a>
                        </div>
                        @else
                                         
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                    @endif
                
                <!-- item-->
                @php
                    $id = Auth()->user()->id;
                @endphp
                    <a href="{{'/users/'.$id.'/show'}}" class="dropdown-item notify-item">
                        <i class="mdi mdi-cog mr-1"></i>
                        <span>Profile</span>
                    </a>            
                <a href="{{'/users/'.$id.'/edit'}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-user mr-1"></i>
                    <span>Settings</span>
                </a>            
                        
                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout mr-1"></i>
                    <span>Logout</span>
                </a>            

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>

    </ul>
</div>