<nav>
    <div class="nav toggle" style="width: auto; float: left; margin: 0; padding: 12px 0 12px 15px;">
        <a id="menu_toggle" style="cursor: pointer;"><i class="fa fa-bars" style="font-size: 18px;"></i></a>
    </div>

    <ul class="nav navbar-nav navbar-right" style="margin: 0; padding-right: 15px; float: right;">
        
        <li class="dropdown" style="float: right;">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="padding: 13px 10px; background: none !important;">
                @if(Auth::check() && Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover; margin-right: 8px; display: inline-block; vertical-align: middle;">
                @else
                    <img src="{{ asset('assets/images/default-avatar.png') }}" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover; margin-right: 8px; display: inline-block; vertical-align: middle;">
                @endif
                <span style="font-weight: 600; color: #555; display: inline-block; vertical-align: middle;">{{ Auth::user()->name ?? 'Guest' }}</span>
                <span class="fa fa-angle-down" style="margin-left: 5px; color: #555; display: inline-block; vertical-align: middle;"></span>
            </a>
            
            <ul class="dropdown-menu dropdown-usermenu pull-right" style="margin-top: 0; border-radius: 4px;">
                <li><a href="#"><i class="fa fa-user" style="margin-right: 5px;"></i> Profile</a></li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out" style="margin-right: 5px;"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>

        <li style="float: right; padding-top: 11px; padding-bottom: 11px; margin-right: 15px; list-style: none;">
            <form action="{{ route('global.search') }}" method="GET" style="margin: 0;">
                <div style="position: relative; width: 240px;">
                    <input type="text" 
                           class="form-control"
                           name="query" 
                           placeholder="Search..." 
                           value="{{ request('query') }}"
                           required
                           style="width: 100%; height: 34px; padding: 6px 12px 6px 35px; font-size: 13px; border-radius: 4px; border: 1px solid #ccd0d4; background-color: #ffffff; color: #555555; outline: none; box-shadow: inset 0 1px 1px rgba(0,0,0,.05);">
                    <i class="fa fa-search" style="position: absolute; left: 12px; top: 10px; color: #999999; font-size: 13px; pointer-events: none;"></i>
                </div>
            </form>
        </li>

    </ul>
</nav>

<style>
    .nav_menu {
        position: relative;
        height: 58px;
    }
    
    body.nav-sm .top_nav {
        margin-left: 70px !important;
    }
    body.nav-sm .container.body .right_col {
        margin-left: 70px !important;
    }
    body.nav-sm .left_col {
        width: 70px !important;
    }
</style>