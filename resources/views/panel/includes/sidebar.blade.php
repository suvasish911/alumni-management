<<<<<<< HEAD
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
      <li><a href="{{ route('general.events.index') }}"><i class="fa fa-calendar"></i> Events List</a></li>
    </ul>
  </div>

            <div class="clearfix"></div>
=======
<style>
    .main_menu_side {
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        background: #0f172a !important; /* Clean matching dark slate background */
        padding: 5px 10px;
    }
    
    .menu_section h3 {
        font-size: 0.7rem !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b !important;
        font-weight: 700;
        margin-bottom: 10px;
        margin-top: 15px;
        padding-left: 12px;
    }
    
    .side-menu {
        padding-left: 0;
        list-style: none;
        margin: 0;
    }
    
    .side-menu > li {
        margin-bottom: 4px;
        position: relative;
    }
    
    .side-menu > li > a {
        color: #94a3b8 !important;
        font-weight: 500;
        font-size: 0.88rem;
        padding: 12px 15px !important;
        display: flex;
        align-items: center;
        border-radius: 8px;
        transition: all 0.25s ease;
        text-decoration: none;
        background: transparent !important;
    }
    
    .side-menu > li > a:hover {
        background: rgba(255, 255, 255, 0.04) !important;
        color: #f8fafc !important;
    }
    
    /* Modern Route Highlighting Indicator */
    .side-menu > li.active > a,
    .side-menu > li > a:focus {
        background: rgba(255, 255, 255, 0.06) !important;
        color: #ffffff !important;
        font-weight: 600;
        border-left: 3px solid #cbd5e1 !important;
    }
    
    .side-menu i {
        font-size: 1rem;
        width: 24px;
        color: #475569;
        transition: color 0.25s ease;
    }
    
    .side-menu > li > a:hover i,
    .side-menu > li.active i {
        color: #cbd5e1;
    }
    
    .child_menu {
        background: rgba(0, 0, 0, 0.2) !important;
        border-radius: 8px;
        margin-top: 4px;
        padding: 5px 0 5px 10px !important;
        list-style: none;
    }
    
    .child_menu li a {
        color: #64748b !important;
        font-size: 0.85rem;
        padding: 8px 12px !important;
        display: block;
        text-decoration: none;
        transition: all 0.2s ease;
        border-radius: 4px;
    }
    
    .child_menu li a:hover {
        color: #f8fafc !important;
        padding-left: 16px !important;
    }
    
    .fa-chevron-down {
        margin-left: auto;
        font-size: 0.7rem !important;
        width: auto !important;
    }
    
    .role-indicator-badge {
        font-size: 0.6rem;
        font-weight: 700;
        background: rgba(148, 163, 184, 0.1);
        color: #94a3b8;
        padding: 2px 6px;
        border-radius: 4px;
        letter-spacing: 0.5px;
        margin-left: 6px;
        display: inline-block;
        vertical-align: middle;
    }
</style>
>>>>>>> origin/dev_shabnam

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
      </li>
      <li class="{{ Request::routeIs('general.events.index') ? 'active' : '' }}">
        <a href="{{ route('general.events.index') }}"><i class="fa fa-calendar"></i> Events List</a>
      </li>
    </ul>

  @if(Auth::user()->role === 'admin')
  </div>

  @if(Auth::user()?->role === 'admin')
  <div class="menu_section">
    <h3>Administration <span class="role-indicator-badge">ADMIN</span></h3>
    <ul class="nav side-menu">

      <li class="{{ Request::routeIs('admin.manage_admins') ? 'active' : '' }}">
        <a href="{{ route('admin.manage_admins') }}"><i class="fa fa-user-shield"></i> Manage Admins</a>
      </li>


      <li class="{{ Request::routeIs('admin.events.index') ? 'active' : '' }}">
        <a href="{{ route('admin.events.index') }}"><i class="fa fa-calendar"></i> Events Management</a>
      </li>
      

      <li class="{{ Request::routeIs('admin.projects.index') ? 'active' : '' }}">
      <a href="{{ route('admin.projects.index') }}"><i class="fa fa-hand-holding-usd"></i> Donation Projects</a>
      </li>



     <li class="{{ request()->is('admin/approvals*') ? 'active' : '' }}">
        <a><i class="fa fa-users"></i> Alumni Control <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('admin.approvals.index') }}"><i class="fa fa-check-square-o"></i> Pending Approvals</a></li>
          <li><a href="{{ route('admin.alumni.registry') }}">All Members Registry</a></li>
        </ul>
      </li>
    </ul>
  </div>
  @endif

  @if(Auth::user()?->role === 'alumni')
  <div class="menu_section">
    <h3>Alumni Desk <span class="role-indicator-badge">MEMBER</span></h3>
    <ul class="nav side-menu">
      <li class="{{ Request::routeIs('alumni.events.index') ? 'active' : '' }}">
        <a href="{{ route('alumni.events.index') }}"><i class="fa fa-ticket"></i> Join Events / RSVP</a>
      </li>

      <li class="{{ Request::routeIs('alumni.events.my_events') ? 'active' : '' }}">
        <a href="{{ route('alumni.events.my_events') }}"><i class="fa fa-calendar-check-o"></i> My Registered Events</a>
      </li>

      <li class="{{ Request::routeIs('alumni.donations.index') ? 'active' : '' }}">
        <a href="{{ route('alumni.donations.index') }}"><i class="fa fa-heart"></i> Donations and Giving</a>
      </li>

      <li class="{{ Request::routeIs('alumni.contributions') ? 'active' : '' }}">
        <a href="{{ route('alumni.contributions') }}"><i class="fa-solid fa-history"></i> My Contributions</a>
      </li>

      <li class="{{ Request::routeIs('alumni.profile.edit') ? 'active' : '' }}">
        <a href="{{ route('alumni.profile.edit') }}"><i class="fa fa-user"></i> Profile Settings</a>
      </li>
    </ul>
  </div>
  @endif

</div>