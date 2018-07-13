<?php
$this->load->view('nav/admin', array('active' => 'user', 'username' => $username));
?>
<?php
$types = array("0" => "Admin", "1" => "Doctor", "2" => "Nurse", "3" => "Attendent");
$genders = array("0" => "Female", "1" => "Male");
?>
  <script>
  window.showDelete = (id) => {
      const elems = $(`#onlineappointments #u_${id} td`);
      const name = $(elems[1]).text();

      $("#modal_del .error").html('');
      $($("#modal_del .modal-title")[0]).text(`Are you sure to delete onlineappointment '${id}'?`);
      $($("#modal_del #id")[0]).val(id);
      $($("#modal_del #loader")[0]).addClass("hidden");
      $($("#modal_del #content")[0]).removeClass("hidden");
      $("#modal_del").modal('show');
    }
    window.confirmDelete = () => {
      $($("#modal_del #loader")[0]).removeClass("hidden");
      $($("#modal_del #content")[0]).addClass("hidden");
      fetch('<?php echo base_url('onlineappointment/delete'); ?>', {
        credentials: 'same-origin',
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: $($("#modal_del #id")[0]).val() })
      })
      .then((response) => response.json())
      .then(d => {
        if (!d.success) {
          $("#modal_del .error").html(window.errorAlert.replace("{$ERR$}", d.message));
          $($("#modal_del #loader")[0]).addClass("hidden");
          $($("#modal_del #content")[0]).removeClass("hidden");
        } else {
          location.reload();
        }
      })
      .catch(e => console.error(e));
    }
  //View
  window.showView = (id) => {
    $($("#modal_edit .modal-footer .btn-primary")[0]).addClass("hidden");
    $($("#modal_edit #id")[0]).prop("disabled", true);
    $($("#modal_edit #fname")[0]).prop("disabled", true);
    $($("#modal_edit #lname")[0]).prop("disabled", true);
    $($("#modal_edit #nic")[0]).prop("disabled", true);
    $($("#modal_edit #age")[0]).prop("disabled", true);
    $($("#modal_edit #add")[0]).prop("disabled", true);
    $($("#modal_edit #gen")[0]).prop("disabled", true);
    const elems = $(`#onlineappointment #o_${id} td`);
    const name = $(elems[1]).text();

    $("#modal_edit .error").html('');
    $($("#modal_edit .modal-title")[0]).text(`View Online Appointment "${id}"`);
    $("#modal_edit").modal('show');
    $($("#modal_edit #loader")[0]).removeClass("hidden");
    $($("#modal_edit #content")[0]).addClass("hidden");
    fetch('<?php echo base_url('onlineappointment/get'); ?>', {
      credentials: 'same-origin',
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id })
    })
    .then((response) => response.json())
    .then(d => {
      if (!d.success) {
        $("#modal_edit .error").html(window.errorAlert.replace("{$ERR$}", d.message));
      } else {
        $($("#modal_edit #id")[0]).val(d.data.id);
        $($("#modal_edit #fname")[0]).val(d.data.fname);
        $($("#modal_edit #lname")[0]).val(d.data.lname);
        $($("#modal_edit #nic")[0]).val(d.data.nic);
        $($("#modal_edit #age")[0]).val(d.data.age);
        $($("#modal_edit #add")[0]).val(d.data.address);
        $($("#modal_edit #gen")[0]).val(d.data.gender);
      }
      $($("#modal_edit #loader")[0]).addClass("hidden");
      $($("#modal_edit #content")[0]).removeClass("hidden");
    })
    .catch(e => console.error(e));
  }

  window.showEdit = (id) => {
    $($("#modal_edit .modal-footer .btn-primary")[0]).addClass('');

    $($("#modal_edit #id")[0]).prop("disabled", false);
    $($("#modal_edit #fname")[0]).prop("disabled", false);
    $($("#modal_edit #lname")[0]).prop("disabled", false);
    $($("#modal_edit #nic")[0]).prop("disabled", false);
    $($("#modal_edit #age")[0]).prop("disabled", false);
    $($("#modal_edit #add")[0]).prop("disabled", false);
    $($("#modal_edit #gen")[0]).prop("disabled", false);
    const elems = $(`#onlineappointment #o_${id} td`);
    const name = $(elems[1]).text();

    $("#modal_edit .error").html('');
    $($("#modal_edit .modal-title")[0]).text(`View Online Appointment "${id}"`);
    $("#modal_edit").modal('show');
    $($("#modal_edit #loader")[0]).removeClass("hidden");
    $($("#modal_edit #content")[0]).addClass("hidden");
    fetch('<?php echo base_url('onlineappointment/get'); ?>', {
      credentials: 'same-origin',
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id })
    })
    .then((response) => response.json())
    .then(d => {
      if (!d.success) {
        $("#modal_edit .error").html(window.errorAlert.replace("{$ERR$}", d.message));
      } else {
        $($("#modal_edit #id")[0]).val(d.data.id);
        $($("#modal_edit #fname")[0]).val(d.data.fname);
        $($("#modal_edit #lname")[0]).val(d.data.lname);
        $($("#modal_edit #nic")[0]).val(d.data.nic);
        $($("#modal_edit #age")[0]).val(d.data.age);
        $($("#modal_edit #add")[0]).val(d.data.address);
        $($("#modal_edit #gen")[0]).val(d.data.gender);
      }
      $($("#modal_edit #loader")[0]).addClass("hidden");
      $($("#modal_edit #content")[0]).removeClass("hidden");
    })
    .catch(e => console.error(e));
  }

  window.saveEdit = () => {
    $($("#modal_edit .modal-footer .btn-primary")[0]).addClass('');
    $($("#modal_edit #loader")[0]).removeClass("hidden");
    $($("#modal_edit #content")[0]).addClass("hidden");
    const data = {
      id: $($("#modal_edit #id")[0]).val() === '' ? undefined : $($("#modal_edit #id")[0]).val(),
      fname: $($("#modal_edit #fname")[0]).val(),
      lname: $($("#modal_edit #lname")[0]).val(),
      nic: $($("#modal_edit #nic")[0]).val(),
      age: $($("#modal_edit #age")[0]).val(),
      add: $($("#modal_edit #add")[0]).val(),
      gen: $($("#modal_edit #gen")[0]).val()
    };
    console.log(data, !data.id ? '<?php echo base_url('onlineappointment/insert'); ?>' : '<?php echo base_url('onlineappointment/update'); ?>');
    fetch(!data.id ? '<?php echo base_url('onlineappointment/insert'); ?>' : '<?php echo base_url('onlineappointment/update'); ?>', {
      credentials: 'same-origin',
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data)
    })
    .then((response) => response.json())
    .then(d => {
      if (!d.success) {
        $("#modal_edit .error").html(window.errorAlert.replace("{$ERR$}", d.message));
        $($("#modal_edit #loader")[0]).addClass("hidden");
        $($("#modal_edit #content")[0]).removeClass("hidden");
      } else {
        location.reload();
      }
    })
    .catch(e => console.error(e));
  }

  </script>
  <div class="row">
    <div class="col-md-offset-1 col-md-10">
      <!-- Controllers -->
      <div class="row">
        <div class="col-xs-12">
          <div class="input-group">
            <?php if (checkPerm($this->session->userdata('type'), 'o', 'v')) { ?>
            <input value="<?php echo $kwd ?>" type="search" id="search" class="form-control">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default pull-right" onclick="doSearch()">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </span>
            <?php
              }
             ?>
          </div>

        </div>
      </div>
      <br />
      <br />
      <!-- Table -->
      <?php if (checkPerm($this->session->userdata('type'), 'o', 'v')) { ?>
      <table id="onleneappointments" class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Age</th>
            <th>Address</th>
            <th>Gender</th>
            <th>NIC No</th>
            <th>Contact No</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($list as $k => $u) { ?>
            <tr id="o_<?php echo $u->id ?>">
              <td><?php echo $u->id ?></td>
              <td><?php echo $u->fname ?> <?php echo $u->lname?></td>
              <td><?php echo $u->age?></td>
              <td><?php echo $u->address?></td>
              <td><?php echo $genders[$u->gender] ?></td>
              <td><?php echo $u->nic ?></td>
              <td><?php echo $u->contact ?></td>
              <td class="text-right">
                <?php if (checkPerm($this->session->userdata('type'), 'o', 'v')) { ?>
                <button onclick="showView(<?php echo $u->id ?>)" type="button" class="btn btn-success btn-xs">
                  <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View
                </button>
                <?php
                  }
                  if (checkPerm($this->session->userdata('type'), 'o', 'u')) {
                ?>
                <button onclick="showEdit(<?php echo $u->id ?>)" type="button" class="btn btn-primary btn-xs">
                  <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit
                </button>
                <?php
                  }
                  if (checkPerm($this->session->userdata('type'), 'o', 'd')) {
                ?>
                <button onclick="showDelete(<?php echo $u->id ?>)" type="button" class="btn btn-danger btn-xs">
                  <i class="fa fa-times" aria-hidden="true"></i>&nbsp;Delete
                </button>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php if ($count > 10) { ?>
      <!-- Pagination -->
      <nav class="pull-right" aria-label="...">
        <ul class="pagination">
          <li class="page-item <?php if ($page === '1') { echo 'disabled'; } ?>">
            <a class="page-link" href="<?php echo base_url('onliappointment/index/' . ($page - 1)); ?>" tabindex="-1">Previous</a>
          </li>
          <li class="page-item active">
            <a class="page-link" href="#"><?php if ($page * 10 > $count) { echo ($page - 1) * 10 . ' - ' . $count . ' of ' . $count; } else { echo ($page - 1) * 10 . ' - ' . $page * 10 . ' of ' . $count; } ?></a>
          </li>
          <li class="page-item <?php if ($page * 10 > $count) { echo 'disabled'; } ?>">
            <a class="page-link" href="<?php echo base_url('onlineappointment/index/' . ($page + 1)); ?>">Next</a>
          </li>
        </ul>
      </nav>
      <?php } ?>
      <?php } ?>
      <!-- Model - Edit -->
      <div id="modal_edit" class="modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body all-center form">
              <div id="loader" class="">
                <i class="fa fa-circle-o-notch fa-spin"></i>
                <label>Please hold a moment!</label>
              </div>
              <div id="content" class="hidden col-xs-12">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'signin')); ?>
                  <?php echo form_input(array('type' => 'hidden', 'id' => 'id', 'autocomplete' => 'off')); ?>
                  <fieldset>
                    <div class="form-group error"></div>
                    <div class="form-group">
                      <label for="patient" class="col-md-2 control-label">Patient First Name</label>
                      <div class="col-md-10">
                        <?php echo form_input(array('type' => 'text', 'required' => TRUE, 'class' => 'form-control', 'id' => 'fname', 'placeholder' => 'Patient Name', 'autocomplete' => 'off')); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="patient" class="col-md-2 control-label">Patient Last Name</label>
                      <div class="col-md-10">
                        <?php echo form_input(array('type' => 'text', 'required' => TRUE, 'class' => 'form-control', 'id' => 'lname', 'placeholder' => 'Patient Name', 'autocomplete' => 'off')); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="age" class="col-md-2 control-label">Age</label>
                      <div class="col-md-10">
                        <?php echo form_input(array('type' => 'number', 'class' => 'form-control', 'required' => TRUE, 'id' => 'age', 'placeholder' => 'Age', 'autocomplete' => 'off')); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nic" class="col-md-2 control-label">NIC</label>
                      <div class="col-md-10">
                        <?php echo form_input(array('class' => 'form-control', 'required' => TRUE, 'id' => 'nic', 'placeholder' => 'NIC', 'autocomplete' => 'off')); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="gen" class="col-md-2 control-label">Gender</label>
                      <div class="col-md-10">
                        <?php echo form_dropdown('User Type', array("-1"=>"--Select--","0" => "Female", "1" => "Male"), "--Select--", array('class' => 'form-control', 'required' => TRUE, 'id' => 'gen')); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="add" class="col-md-2 control-label">Address</label>
                      <div class="col-md-10">
                        <?php echo form_textarea(array('class' => 'form-control', 'rows' => '1', 'required' => TRUE, 'id' => 'add', 'placeholder' => 'Address', 'autocomplete' => 'off')); ?>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="saveEdit()">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Model - Delete Confirm -->
      <div id="modal_del" class="modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Are you sure to delete appointment ###?</h4>
            </div>
            <div class="modal-body all-center">
              <div id="loader" class="">
                <i class="fa fa-circle-o-notch fa-spin"></i>
                <label>Please hold a moment!</label>
              </div>
              <div id="content" class="hidden col-xs-12">
                <?php echo form_input(array('type' => 'hidden', 'id' => 'id', 'autocomplete' => 'off')); ?>
                <div class="form-group error"></div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button onclick="confirmDelete()" type="button" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
