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
                            <a href="index.php"><i class="fa fa-user fa-fw"></i>
                                <?php
                                $fid=$_SESSION['fid'];
                                    $l=mysql_query("select name from faculty_details where fid='$fid'") or die(mysql_error());
                                    $r=mysql_fetch_assoc($l);
                                    
                                    echo $r["name"];
                        ?>       
                            </a>
                        </li>
                        <li>
                            <a href="datasheet.php"><i class="fa fa-table fa-fw"></i>View Feedback</a>
                           
                            <!-- /.nav-second-level -->
                        </li>
                       
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>