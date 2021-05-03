<div class="sidebar" data-color="green" data-background-color="white" data-image="#">
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      Juntos Database
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li>
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li>
<!--Students-->
        <a class="nav-link" data-toggle="collapse" href="#studentList" aria-expanded="false">
          <p> <b class="caret"></b> Students
          </p>
        </a>
        <div class="collapse hide" id="studentList">
          <ul class="nav">
            <li>
              <a class="nav-link" href="{{ route('students.index') }}">
                <i  class="material-icons">list</i>
                  <span class="sidebar-normal">List Students</span>
              </a>
            </li>
            <li>
              <a class="nav-link" href="{{ route('students.create') }}">
{{--                <span class="sidebar-mini">NS</span>--}}
                  <i class="material-icons">perm_identity</i>
                 <span class="sidebar-normal">New Student</span>
              </a>
            </li>
          </ul>
        </div>
       <!--End Students-->
    <!--Parents-->
    <a class="nav-link" data-toggle="collapse" href="#parentList" aria-expanded="false">
        <p> <b class="caret"></b> Parents
        </p>
    </a>
    <div class="collapse hide" id="parentList">
        <ul class="nav">
            <li>
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="material-icons">perm_identity</i>
                    <span class="sidebar-normal">List Parents/Guardians</span>
                </a>
            </li>
        </ul>
    </div>
    <!--End Parents-->
    <!--Events-->
    <a class="nav-link" data-toggle="collapse" href="#eventList" aria-expanded="false">
        <p> <b class="caret"></b> Events
        </p>
    </a>
    <div class="collapse hide" id="eventList">
        <ul class="nav">
            <li>
                <a class="nav-link" href="{{ route('event.index') }}">
                    <i  class="material-icons">list</i>
                    <span class="sidebar-normal">List Events</span>
                </a>
            </li>
        </ul>
        <ul class="nav">
            <li>
                <a class="nav-link" href="{{ route('event.create') }}">
                    <i class="material-icons">event</i>
                    <span class="sidebar-normal">New Event</span>
                </a>
            </li>
        </ul>
    </div>
    <!--End Events-->
    <!--Coaching-->
    <a class="nav-link" data-toggle="collapse" href="#coachingList" aria-expanded="false">
        <p> <b class="caret"></b> Coaching
        </p>
    </a>
    <div class="collapse hide" id="coachingList">
        <ul class="nav">
            <li>
                <a class="nav-link" href="{{ route('coaching.index') }}">
                    <i class="material-icons">calendar_today</i>
                    <span class="sidebar-normal">List Coaching Appointments</span>
                </a>
            </li>
        </ul>
        <ul class="nav">
            <li>
                <a class="nav-link" href="{{ route('coaching.create') }}">
                    <i class="material-icons">today</i>
                    <span class="sidebar-normal">New Appointment</span>
                </a>
            </li>
        </ul>
    </div>
    <!--End Coaching-->
    <!--Reporting-->
    <a class="nav-link" data-toggle="collapse" href="#reportingList" aria-expanded="false">
        <p> <b class="caret"></b> Reporting
        </p>
    </a>
    <div class="collapse hide" id="reportingList">
        <ul class="nav">
            <li>
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="material-icons">analytics</i>
                    <span class="sidebar-normal">List Reports</span>
                </a>
            </li>
        </ul>
    </div>
    <!--End Reporting-->
 </li>


<li style="text-align: center">
    <a class="nav-link btn btn-primary" style="color:white; href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
</li>

<!--ADMIN BUTTON-->
<li style="margin-top:75px;">
        <a class="nav-link btn btn-secondary" href = "{{route('admin.backend.index')}}">ADMIN</a>
</li>
<!--END ADMIN BUTTON-->

    </ul>
  </div>
</div>
