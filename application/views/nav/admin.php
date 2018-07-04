<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Health Care Hospital</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('dashboard/'); ?>">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <?php
          if (!$this->session->has_userdata('type')) {
            noPerm();
          }

          if (checkPerm($this->session->userdata('type'), 'u')) {
        ?>
        <li<?php if (isset($active) && $active === 'user') { echo ' class="active"'; } ?>>
          <a href="<?php echo base_url('user/'); ?>">Users<?php if (isset($active) && $active = 'user') { echo ' <span class="sr-only">(current)</span>'; } ?></a>
        </li>
        <?php
          }
          if (checkPerm($this->session->userdata('type'), 'p')) {
        ?>
        <li<?php if (isset($active) && $active === 'patient') { echo ' class="active"'; } ?>>
          <a href="<?php echo base_url('patient/'); ?>">Patients<?php if (isset($active) && $active = 'patient') { echo ' <span class="sr-only">(current)</span>'; } ?></a>
        </li>
        <?php
          }
          if (checkPerm($this->session->userdata('type'), 'a')) {
        ?>
        <li<?php if (isset($active) && $active === 'appointment') { echo ' class="active"'; } ?>>
          <a href="<?php echo base_url('appointment/'); ?>">Appointments<?php if (isset($active) && $active = 'appointment') { echo ' <span class="sr-only">(current)</span>'; } ?></a>
        </li>
        <?php } ?>

      </ul>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Sign Out</a></li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username ?>&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <!-- <li><a href="#">Profile</a></li>
            <li class="divider"></li> -->
            <li><a href="<?php echo base_url('login/out'); ?>">Sign Out</a></li>
            <li><a href="<?php echo base_url(''); ?>">Change Passwor</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
