<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
      <li><a href="{{ route('general.events.index') }}"><i class="fa fa-calendar"></i> Events List</a></li>
    </ul>
  </div>

<<<<<<< Updated upstream
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="chartjs.html">Admin Dashboard</a></li>
                           <li><a href="chartjs.html">Alumni Dashboard</a></li>
                              <li><a href="chartjs.html">Account_officer Dashboard</a></li>
                    </ul>
                  </li>
                <li><a><i class="fa fa-desktop"></i> Donation Management<span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu">
          <li><a href="/admin/donations">Donation Dashboard</a></li>
                                  <li><a href="/admin/donations/history">My Donations/History</a></li>
                           <li><a href="/admin/donation-projects">Donation Projects</a></li>
                            <li><a href="/admin/donations/report">Donations report</a></li>
   
    </ul>
</li>
                  <li><a><i class="fa fa-table"></i>Events & Programs  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Upcoming Events</a></li>
                           <li><a href="chartjs.html">Past Events</a></li>
                              <li><a href="chartjs.html">Registration History</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i>My Membership/Profile  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Profile Information</a></li>
                           <li><a href="chartjs.html">Membership Details</a><li>
                              <li><a href="chartjs.html">Change Password</a></li>
                               <li><a href="chartjs.html">Update Documents</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Notice Board<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Latest Notices</a></li>
                           <li><a href="chartjs.html">Archived Notices</a></li>
                              <li><a href="chartjs.html">Important Documents</a></li>
                    </ul>
                  </li>
                       </li>
                  <li><a><i class="fa fa-clone"></i> Settings / Logout <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu"></ul>
                    <li><a href="chartjs.html">System Settings</a></li>
                           <li><a href="chartjs.html">Privacy & Security</a></li>
                              <li><a href="chartjs.html">Logout</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
                     </div>
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
             </div>
        </div>
=======

  @if(Auth::user()->role === 'admin')
  <div class="menu_section">
    <h3>Administration</h3>
    <ul class="nav side-menu">
      <li>
        <a href="{{ route('admin.events.index') }}"><i class="fa fa-calendar"></i> Events Management</a>
      </li>
        <li><a><i class="fa fa-donate"></i> Donation Management <span class="fa fa-chevron-down"></span></a>
           <ul class="nav child_menu">
             <li><a href="{{ route('admin.donations-projects') }}">Donation Projects</a></li>
               <li><a href="{{ route('admin.donations.history') }}">Donation History</a></li>
           </ul>
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
      <li><a><i class="{{ route('admin.donations.reports') }}"></i> Donation Records <span class="fa fa-chevron-down"></span></a>
         <ul class="nav child_menu">
           <li><a href="{{ route('admin.donations.dashboards') }}">Donation Dashboards</a></li>
            </ul>
              </li>
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
     <li>
       <a href="{{ route('alumni.donations.projects') }}"><i class="fa fa-heart"></i> Donate Now</a>
       </li>
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
>>>>>>> Stashed changes
