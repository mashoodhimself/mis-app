<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }} ( {{ Str::ucfirst(auth()->user()->role) }} )</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if(auth()->user()->role === 'admin')

            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Users
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/teachers" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Teachers</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/students" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Students</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Courses
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/courses" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Courses</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                  Students
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/student/attendance" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/UI/icons.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marks</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/UI/buttons.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Results</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tools"></i>
                <p>
                  Other
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/forms/general.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pending Requests</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/forms/advanced.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Complaints</p>
                  </a>
                </li>
              </ul>
            </li>

          @endif

          @if(auth()->user()->role === 'teacher')
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user-graduate"></i>
                  <p>
                    Attendance
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/attendance/upload" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Upload Attendance</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/attendance/view" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>View Attendance</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user-graduate"></i>
                  <p>
                    Student Marks
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/UI/general.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Upload Marks</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/UI/icons.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>View Marks</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-meh"></i>
                  <p>
                    Student Results
                  </p>
                </a>
            </li>
          @endif

          @if (auth()->user()->role === 'student')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-meh"></i>
                <p>
                  Attendance
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-meh"></i>
                <p>
                  Marks
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-meh"></i>
                <p>
                  Results
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-meh"></i>
                <p>
                  Complaint
                </p>
              </a>
            </li>
          @endif

          @if (auth()->user()->role === 'chairman')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-meh"></i>
                <p>
                  Student Complaints
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-meh"></i>
                <p>
                  Class Performance
                </p>
              </a>
            </li>

          @endif

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-meh"></i>
              <p>
                My Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>