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
                        <a href="home.php"><i class="fa fa-user fa-fw"></i>
                            <?php

                            $r=mysql_query("select name from faculty_details where fid='$fid'");
                            while($d=mysql_fetch_array($r))
                            {
                                $fname=$d["name"];
                                
                            }
                            echo $fname;
                            ?>       
                        </a>
                    </li>
                    <li>
                       <!-- <a href="student_details.php"><i class="fa fa-table fa-fw"></i>Setting Parent Login </a> -->
                       <a href="student_details.php"><i class="fa fa-table fa-fw"></i>Setting Parent Login </a>

                       <!-- /.nav-second-level -->
                   </li>
                   <li>
                    <a href="search-form.php"><i class="fa fa-search fa-fw"></i> Student Search</a>
                </li>
                 <li>
                    <a href="edit_student_details.php"><i class="fa fa-braille fa-fw"></i> Edit Student/Parent Details</a>
                </li>


                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Attendance<span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a href="staff_advisor_view.php">View</a>
                        </li>
                       <!-- <li>
                            <a href="single_sub_staff_viewnew.php">Subject Wise View</a>
                        </li> --> 
                         <li>
                            <a href="staff_advisor_att_sms.php">SMS Parents - Atten. Report</a>
                        </li>

                       <!-- <li>
                            <a href="staff_advisor_update.php">Update</a>
                        </li> -->
                    </ul>


                </li>

                <li>
                    <a href="lab-batch.php"><i class="fa fa-braille fa-fw"></i> Lab Batch</a>
                </li>
                <li>
                    <a href="duty_leave.php"><i class="fa fa-calendar-check-o fa-fw"></i>Duty Leave</a>
                </li>
                <li>
                    <a href="elective.php"><i class="fa fa-bar-chart-o fa-fw"></i> Elective Allocation</a>
                </li>
                <li>
                    <a href="electiveview.php"><i class="fa fa-bar-chart-o fa-fw"></i> Elective VIEW</a>
                </li>
                <li>
                    <a href="sem_verificationnew.php"><i class=" fa fa-edit fa-fw"></i> Sem Verification</a>
                </li>
                <li>
                    <a href="roll_number_update.php" class="text-capitalize"><i class=" fa fa-list fa-fw"></i> roll number update</a>
                </li>

<!-- 
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Sessional Marks<span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level">

                        <li>
                           <a href="sessionalmark_verification.php"><i class="fa fa-bar-chart-o fa-fw"></i>View Sessional Marks</a>
                       </li>
                       <li>
                         <a href="sessionalmark_verification.php"><i class="fa fa-bar-chart-o fa-fw"></i>verify Sessional Marks</a>

                     </li>
                 </ul>


             </li> -->

             <li>
                <a href="sessional_verification.php"><i class="fa fa-bar-chart-o fa-fw"></i> Sessional Marks</a>
            </li>
<!-- 
             <li>
                <a href="sessionalmark_verification.php"><i class="fa fa-bar-chart-o fa-fw"></i> Sessional Marks</a>
            </li> -->
            <li>
                <a href="series_mark.php"><i class="fa fa-bar-chart-o fa-fw"></i> Series Marks</a>
            </li>
            <li>
                <a href="photo_verification.php"><i class="fa fa-user fa-fw"></i> Image Verification</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Feedback<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    <li>
                        <a href="staff_feedback.php">View Feedback</a>
                    </li>
                    <li>
                        <a href="feedback_count.php">View Feedback count</a>
                    </li>
                </ul>


            </li>


            <li>
                <a href="response.php"><i class="fa fa-chart fa-fw"></i>Parent Grievance</a>
            </li>
        </ul>
<a href="#"><i class="fa fa-wrench fa-fw"></i> Send SMS<span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a href="sms_stud.php">SMS to Students</a>
                        </li>
                        <li>
                            <a href="sms_parent.php">SMS to Parents</a>
                        </li>
                        </ul>




    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
