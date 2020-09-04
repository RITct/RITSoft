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
                            <a href="dash_home.php"><i class="fa fa-user fa-fw"></i>
                                 <?php
                                $fid=$_SESSION['adminid'];
                                    $l=mysql_query("select name from faculty_details where fid='$fid'") or die(mysql_error());
                                    $r=mysql_fetch_assoc($l);
                                    
                                    echo $r["name"];
                        ?>       
                            </a>
                        </li>
                        <li>
                          <!--  <a href="home1.php"><i class="fa fa-table fa-fw"></i>SESSIONAL MARKS</a> -->
                           
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                          <!--  <a href="search-form.php"><i class="fa fa-edit fa-fw"></i> STUDENT SEARCH</a> -->
                        </li>
						<li>
                         <!--   <a href="datasheet.php"><i class="fa fa-align-justify"></i>FEEDBACK</a> -->
                        </li>
						
                        <li>
                       <!--     <a href="tc_form.php"><i class="fa fa-align-justify"></i> ATTENDANCE</a> -->
                        </li>
						
						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>