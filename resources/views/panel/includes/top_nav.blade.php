<nav>
    <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>

    <ul class="nav navbar-nav navbar-right">
        <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                @if(Auth::check() && Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover">
                @else
                    <img src="{{ asset('assets/images/default-avatar.png') }}" alt="Default Avatar" class="w-8 h-8 rounded-full object-cover">
                @endif
                
                {{ Auth::user()->name ?? 'Guest' }}
                <span class="fa fa-angle-down"></span>
            </a>
            
            <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profile</a></li>
                <li>
                    <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                    </a>
                </li>
                <li><a href="javascript:;">Help</a></li>
                
                <li>
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>