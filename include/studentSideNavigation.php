<aside id="sidebar" class="sidebar">
   <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
         <a class="nav-link 
            <?php
            if ($page != "home") {
               echo " collapsed";
            }
            ?>" href="home.php">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link 
            <?php
            if ($page != "attendance_student") {
               echo " collapsed";
            }
            ?>" href="attendance_student.php">
            <i class='bx bxs-folder-open'></i>
            <span>My Attendance</span>
         </a>
      </li>

      <li class="nav-item"> <a class="nav-link collapsed dev" href="pages-blank.html"> <i class="ri-code-s-slash-line"></i> <span>About Developer</span> </a></li>
   </ul>
</aside>