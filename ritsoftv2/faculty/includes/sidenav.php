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
                          <a href="dash_home.php"><i class="fa fa-user fa-fw"></i>                                <?php
                          include("includes/connection.php");
                          $fid=$_SESSION["fid"];

                          $r=mysql_query("select name, deptname from faculty_details where fid='$fid'",$con);  
                          while($d=mysql_fetch_array($r))
                          {
                           $fname=$d["name"];
                           $dname=$d["deptname"];

                         }
                         echo $fname;
                         ?>       
                       </a>
                     </li>
                     <li> 
                      <!-- <a href="home1.php"><i class="fa fa-table fa-fw"></i>SESSIONAL MARKS</a> -->
                      <a href="#"><i class="fa fa-table fa-fw"></i>SESSIONAL MARKS<span class="fa arrow"></span></a>

                      <!-- /.nav-second-level -->

                      <ul class="nav nav-second-level">

                       <li>
                        <!-- <a href="hos.php">Enter Final</a> -->
                        <a href="hos.php">Enter</a>
                      </li>
                      <li>
                        <a href="new1.php">View</a>
                      </li>
                      <li>
                        <a href="hos11.php">Edit</a>
                      </li>


                    </ul>

                  </li>
                  <li> 
                    <!-- <a href="home1.php"><i class="fa fa-table fa-fw"></i>SESSIONAL MARKS</a> -->
                    <a href="#" style="text-transform: uppercase;"><i class="fa fa-table fa-fw"></i>series MARKS<span class="fa arrow"></span></a>

                    <!-- /.nav-second-level -->

                    <ul class="nav nav-second-level">
                     <li>
                      <a href="each_series_mark.php">Enter Mark</a>
                    </li> 
                    <li>
                      <a href="each_series_mark_view.php">View</a>
                    </li> 

                  </ul>






                </li>
                <li>
                  <a href="search-form.php"><i class="fa fa-edit fa-fw"></i> STUDENT SEARCH</a>
                </li>
                <li>
                  <a href="datasheet.php"><i class="fa fa-align-justify"></i>VIEW FEEDBACK</a>
                </li>



                <li>
                  <a href="#"><i class="fa fa-align-justify"></i> ATTENDANCE<span class="fa arrow"></span></a>

                  <ul class="nav nav-second-level">
                   <li>
                    <a href="hos_att.php">Enter Attendance</a>
                  </li>
                  <li>
                    <a href="hos_update.php">Edit Attendance</a>
                  </li>
                  <li>
                   <!-- <a href="hos_update_hour.php">Edit Hour</a> -->
                  </li>

                  <li>
                   <!-- <a href="hos_update_date.php">Edit date</a> -->
                  </li>


                  <li>
                    <a href="single_sub_staff_view.php">View</a>
                  </li>
                  <li>
                    <a href="hos_delete_hour.php">Delete</a>
                  </li>

                  <li>
                    <a href="export_duty_leave.php">Duty Leave</a>
                  </li>

                   <li>
                    <a href="attendance_status.php">Attendance Status</a>
                  </li>
                  <li>
                   <a href="view_attendance_report.php">Attendance Report</a> 
                  </li

                   

                </ul>

              </li>
              <!--<li><a target="_blank"  href="../ritstaffmngt.php"> <i class="fa fa-sign-out fa-fw"></i>RIT Staff Management Portal</a></li> -->


            </ul>

            <?php  
             
                if($fname == 'SONUPRIYA P S') {?>

            
                <li> 
                     
                      <a href="#"><i class="fa fa-table fa-fw"></i>CO Management<span class="fa arrow"></span></a>

                    

                      <ul class="nav nav-second-level">

                       <li>
                      
                        <a href="accreditation_faculty/course_outcome.php">CO View</a>
                      </li>
                     
                      <li>
                        <a href="accreditation_faculty/co_po_correlation.php">CO PO Correlations</a>
                      </li>


                    </ul>

                  </li>  

    <?php } ?>


          </div>
          <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
      </nav>
