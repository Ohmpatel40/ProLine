<div class="min-height-300 bg-primary position-absolute w-100 pattern"></div>
<aside class="sidenav h-75 bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 sidebar" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="m-4" href="index.php">
        <img src="assets/img/logo.svg" class="h-100" alt="main_logo">
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

      <!-- STUDENT MENU -->
        <li class="nav-item has-submenu">
          <a class="nav-link">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user-graduate text-info text-lg opacity-10 mb-2"></i>
              </div>
              <span class="nav-link-text ms-1">Student</span>
          </a>
          <ul class="submenu collapse">
              <li>
                <a class="nav-link" href="registerStudent.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-circle-plus text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Register</span>
                </a>
              </li>
              <li>
                <a class="nav-link" href="manageStudent.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fas fa-list text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Manage Student</span>
                </a>
              </li>
              <li>
                <a class="nav-link" href="allstudents.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-calendar-days text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Attendance</span>
                </a>
              </li>
          </ul>
        </li>

        <!-- TEACHER'S MENU -->
        <li class="nav-item has-submenu">
          <a class="nav-link ">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-users text-danger text-lg opacity-10 mb-2"></i>
            </div>
            <span class="nav-link-text ms-1">Teacher's</span>
          </a>
          <ul class="submenu collapse">
              <li>
                <a class="nav-link" href="registerStaff.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-circle-plus text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Register</span>
                </a>
              </li>
              <li>
                <a class="nav-link" href="manageStaff.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fas fa-list text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Manage Teacher's</span>
                </a>
              </li>
              <li>
                <a class="nav-link" href="allstudents.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-calendar-days text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Attendance</span>
                </a>
              </li>
          </ul>
        </li>

        <!-- RESULT  -->
        <li class="nav-item has-submenu">
          <a class="nav-link">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-poll text-primary text-lg opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">Result</span>
          </a>
          <ul class="submenu collapse">
              <li>
                <a class="nav-link" href="createResult.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-circle-plus text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Create Result</span>
                </a>
              </li>
              <li>
                <a class="nav-link" href="manageResult.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fas fa-list text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Manage Result's</span>
                </a>
              </li>
          </ul>
        </li>

        <!-- ACADEMIC SETTINGS  -->
        <li class="nav-item has-submenu">
          <a class="nav-link ">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-sliders text-warning text-lg opacity-10 mb-2"></i>
            </div>
            <span class="nav-link-text ms-1">Academic Settings</span>
          </a>
          <ul class="submenu collapse">
              <li>
                <a class="nav-link" href="semester.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-chalkboard-user text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Semester's</span>
                </a>
              </li>
              <li>
                <a class="nav-link" href="course.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-book-bookmark text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Courses</span>
                </a>
              </li>
              <li>
                <a class="nav-link" href="subject.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fas fa-book text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Subject's</span>
                </a>
              </li>
              <li>
                <a class="nav-link" href="subject.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-calendar-day text-dark text-lg opacity-10 mb-2"></i>
                </div>
                <span class="nav-link-text ms-1">Time Table</span>
                </a>
              </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="exportDocs.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-file-export text-success text-lg opacity-10 mb-2"></i>
            </div>
            <span class="nav-link-text ms-1">Export</span>
          </a>
        </li>

      </ul>
    </div>
  </aside>