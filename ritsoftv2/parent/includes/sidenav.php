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
                        <?php 
                         $query1="select admissionno,name from stud_details where admissionno in (select admissionno from parent_student where parentid='".$_SESSION["parentid"]."')";
                        $res1=mysqli_query($conn,$query1);
                        $i=0;
                        while($row1 =mysqli_fetch_assoc($res1))
                        {   
                           $i++;
                           $_SESSION['admissionno']=$row1['admissionno']; 
                            echo '<a href="../parentStud/dash_home.php?id='.$row1['admissionno'].'"><i class=" fa fa-edit fa-fw"></i>'.$row1['name'].'</a>';
                        }             
                        ?>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
							<a href="edit.php"><i class=" fa fa-edit fa-fw"></i>Edit email & phone no</a>;
                               
                           <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>