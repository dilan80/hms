<?php
$this->load->view('nav/admin', array('active' => 'user', 'username' => $username));
?>


<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-md-3 col-lg-2 sidebar-offcanvas bg-light pl-0" id="sidebar" role="navigation">
            <ul class="nav flex-column sticky-top pl-0 pt-5 mt-3">
                <h1 class="text-uppercase"style="font-size: 15px;padding-left:10px">Dashboard</h1>
                <li class="nav-item">
                    <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Reports▾</a>
                    <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
                       <li class="nav-item"><a class="nav-link" href="">Report 1</a></li>
                       <li class="nav-item"><a class="nav-link" href="">Report 2</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Export</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Snippets</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Flexbox</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Layouts</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Templates</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Themes</a></li>
            </ul>
        </div>

            <div class="row mb-3">
                <div class="col-xl-3 col-sm-4 py-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <i class="fa fa-user fa-4x"style="padding-left:10px"></i>
                            </div>
                            <h6 class="text-uppercase"style="padding-left:10px">Users</h6>
                            <h1 class="display-4"style="padding-left:10px"><?php echo $ucount?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 py-3">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <i class="fa fa-list fa-4x"style="padding-left:10px"></i>
                            </div>
                            <h6 class="text-uppercase"style="padding-left:10px">Patients</h6>
                            <h1 class="display-4"style="padding-left:10px"><?php echo $pcount?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 py-3">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fa fa-twitter fa-4x"style="padding-left:10px"></i>
                            </div>
                            <h6 class="text-uppercase"style="padding-left:10px">Appintment</h6>
                            <h1 class="display-4"style="padding-left:10px"><?php echo $acount?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-4 py-3">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fa fa-share fa-4x"style="padding-left:10px"></i>
                            </div>
                            <h6 class="text-uppercase"style="padding-left:10px">Shares</h6>
                            <h1 class="display-4"style="padding-left:10px">36</h1>
                        </div>
                    </div>
                </div>
            </div>
