<!-- /side nav -->
<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
                           <!-- <li class="sidebar-search">
                          <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                           /input-group 
                         </li>-->
                         <li>
                          <a href="details.php"><i class="fa fa-user fa-fw"></i><?php

                          $r=mysql_query("select name from stud_details where admissionno='$admissionno'");
                          while($d=mysql_fetch_array($r))
                          {
                            $sname=$d["name"];

                          }
                          echo $sname;
                          ?>       
                        </a>

                      </a>
                    </li>
                    <li>
                      <a href="empreg.php"><i class="fa fa-image fa-fw"></i>Upload Photo</a>

                    </li>
                    <li>
                      <a href="semregpostnew.php"><i class="fa fa-table fa-fw"></i> Semester Registration</a>

                      <!-- /.nav-second-level -->
                    </li>
                    <li>
                      <a href="current_semester.php"><i class="fa fa-info fa-fw"></i> Current Semester </a>
                    </li>
                    <li>
                      <a href="parent_monthly.php"><i class="fa fa-bar-chart-o fa-fw"></i> Attendance View </a>
                    </li>
                    <li>
                      <a href="sessionmark.php" style="text-transform: capitalize;"><i class="fa fa-bar-chart-o fa-fw"></i> series exam mark view</a>
                    </li>
                    <li>
                      <a href="sessional_marks.php" style="text-transform: capitalize;"><i class="fa fa-bar-chart-o fa-fw"></i> sessional marks view</a>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-edit fa-fw"></i>University mark<span class="fa arrow"</span></a>
                       <ul class="nav nav-second-level">
                         <li>
                         <!-- <a href="mark.php">Marks submission</a> -->
                            <a href="#">Marks submission</a>
                        </li>
                        <li>
                          <!-- <a href="markview.php">Marks view</a> -->
                         <a href="#">Marks view</a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-edit fa-fw"></i>Feedback<span class="fa arrow"</span></a>
                       <ul class="nav nav-second-level">
                         <li>
                           <a href="feedback.php">Give Feedback</a>
                         </li>
                       </ul>
                     </li>
                      
                    <li>
                     <!-- <a href="hostel_application.php"><i class="fa fa-table fa-fw"></i> Hostel Application</a> -->

                      <!-- /.nav-second-level -->
                    </li>
                     <li>
                      <a href="grievence.php"><i class="fa fa-table fa-fw"></i> RIT Grievance redressal Portal Login</a>

                      <!-- /.nav-second-level -->
                    </li>

                    
                   </ul>
                 </div>
                 <!-- /.sidebar-collapse -->
               </div>
               <!-- /.navbar-static-side -->
             </nav>