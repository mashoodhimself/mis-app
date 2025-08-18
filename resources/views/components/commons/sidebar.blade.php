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

          <li class="nav-item">
              <a href="{{ route('feed.view') }}" wire:navigate class="nav-link">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Annoucements
                </p>
              </a>
          </li>

          @if(auth()->user()->role === 'admin')

            <li class="nav-item">
              <a href="{{ route('admin.users') }}" wire:navigate class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.courses') }}" wire:navigate class="nav-link">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Courses
                </p>
              </a>
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
                  <a href="{{ route('admin.student.attendance.view') }}" wire:navigate class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.student.marks.view') }}" wire:navigate class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Marks</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.student.results.view') }}" wire:navigate class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Results</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif

          @if(auth()->user()->role === 'teacher')
              <li class="nav-item">
                <a href="/attendance/teacher" class="nav-link">
                  <i class="nav-icon far fa-meh"></i>
                  <p>
                    Attendance
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/teacher/course" class="nav-link">
                  <i class="nav-icon far fa-meh"></i>
                  <p>
                    Courses
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