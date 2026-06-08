
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  

  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li>
        <a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a>
      </li>
      <li>
        <a href="{{ route('general.events.index') }}"><i class="fa fa-calendar"></i> Events List</a>
      </li>
    </ul>
  </div>


  @if(Auth::user()->role === 'admin')
  <div class="menu_section">
    <h3>Administration</h3>
    <ul class="nav side-menu">
      <li>
        <a href="{{ route('admin.events.index') }}"><i class="fa fa-calendar"></i> Events Management</a>
      </li>
      <li><a><i class="fa fa-users"></i> Alumni Control <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Pending Approvals</a></li>

          <li><a href="#">All Members Registry</a></li>
        </ul>
      </li>
      <!-- <li><a><i class="fa fa-cogs"></i> System Settings <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Configuration</a></li>
          <li><a href="#">Backup Logs</a></li>
        </ul>
      </li> --> 
    </ul>
  </div>
  @endif


  @if(Auth::user()->role === 'account_officer')
  <div class="menu_section">
    <h3>Financial Control</h3>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-money"></i> Invoice Management <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">All Invoices</a></li>
          <li><a href="#">Create New Bill</a></li>
          <li><a href="#">Payment Approvals</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-bar-chart"></i> Accounts Reports <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Collection Logs</a></li>
          <li><a href="#">Donation Summary</a></li>
        </ul>
      </li>
    </ul>
  </div>
  @endif


  @if(Auth::user()->role === 'alumni')
  <div class="menu_section">
    <h3>Alumni Desk</h3>
    <ul class="nav side-menu">
      <li>
        <a href="{{ route('alumni.events.index') }}"><i class="fa fa-ticket"></i> Join Events / RSVP</a>
      </li>
      <li>
        <a href="#"><i class="fa fa-credit-card"></i> My Bills & Fees</a>
      </li>
      <li><a><i class="fa fa-briefcase"></i> Career Hub <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Job Openings</a></li>
          <li><a href="#">Post a Job</a></li>
        </ul>
      </li>
      <li>
        <a href="#"><i class="fa fa-user"></i> Profile Settings</a>
      </li>
    </ul>
  </div>
  @endif

</div>
<!-- /sidebar menu -->

