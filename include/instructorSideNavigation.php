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
         if ($page == "manage_student" || $page == "manage_teacher" || $page == "rfid_card" || $page == "manage_department") {
            echo "";
         } else {
            echo " collapsed";
         }
         ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="ri-group-line"></i>
            <span>Manage</span>
            <i class="bi bi-chevron-down ms-auto"></i>
         </a>
         <ul id="components-nav" class="nav-content<?php
                                                   if ($page == "manage_student" || $page == "manage_teacher" || $page == "rfid_card" || $page == "manage_department") {
                                                      echo "";
                                                   } else {
                                                      echo " collapse";
                                                   }
                                                   ?> " data-bs-parent="#sidebar-nav">
            <li class="nav-heading">Users</li>
            <li> <a class="<?= $page == 'manage_student' ? 'active' : '' ?>" href="manage_student.php"><i class='bx bxs-right-arrow'></i><span>Students</span> </a></li>
            <li> <a class="<?= $page == 'manage_teacher' ? 'active' : '' ?>" href="manage_teacher.php"><i class='bx bxs-right-arrow'></i><span>Instructors</span></a></li>
            <li class="nav-heading">Device</li>
            <li> <a href="components-alerts.html"><i class='bx bxs-right-arrow'></i><span>RFID Card</span> </a></li>
            <li> <a href="components-accordion.html"><i class='bx bxs-right-arrow'></i><span>Department</span></a></li>
         </ul>
      </li>
      <li class="nav-item">
         <a class="nav-link 
         <?php
         if ($page == "attendance_student" || $page == "attendance_instructor") {
            echo "";
         } else {
            echo " collapsed";
         }
         ?>
         " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#"><i class='bx bxs-folder-open'></i><span>Attendance</span><i class="bi bi-chevron-down ms-auto"></i> </a>
         <ul id="forms-nav" class="nav-content
         <?php
         if ($page == "attendance_student" || $page == "attendance_instructor") {
            echo "";
         } else {
            echo " collapse";
         }
         ?> " data-bs-parent="#sidebar-nav">
            <li> <a class="<?= $page == 'attendance_student' ? 'active' : '' ?>" href="attendance_student.php"><i class='bx bxs-right-arrow'></i><span>Students</span> </a></li>
            <li> <a class="<?= $page == 'attendance_instructor' ? 'active' : '' ?>" href="attendance_instructor.php"><i class='bx bxs-right-arrow'></i></i><span>Instructor</span> </a></li>
         </ul>
      </li>
      <li class="nav-item"> <a class="nav-link collapsed dev" href="pages-blank.html"> <i class="ri-code-s-slash-line"></i> <span>About Developer</span> </a></li>
   </ul>
</aside>