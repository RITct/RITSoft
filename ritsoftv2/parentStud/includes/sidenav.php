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
                            <a href="../parent/dash_home.php"><i class="fa fa-user fa-fw"></i>
                                <?php
                                $query="select name_guard from parent where parentid=".$_SESSION["parentid"]." limit 1";
                                $res=mysqli_query($conn,$query);
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    echo $row["name_guard"];
                                }
                                 //$_SESSION['admissionno']=$_SESSION["parentid"];
                        ?>       
                            </a>
                        </li>
                        <li>
                            <a href="consolidated.php"><i class="fa fa-table fa-fw"></i> Consolidated attendance</a>
                           
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="monthly.php"><i class=" fa fa-edit fa-fw"></i> Monthly attendance</a>
                        </li>
                        <li>
                            <a href="mark.php"><i class="fa fa-bar-chart-o fa-fw"></i> Sessional Marks</a>
                        </li>
                       <li>
                            <a href="contact.php"><i class="fa fa-bar-chart-o fa-fw"></i> contact information</a>
                        </li>
                        <li>
                            <a href="grievances.php"><i class="fa fa-bar-chart-o fa-fw"></i> Grievances</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>