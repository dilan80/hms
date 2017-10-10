<?php
$this->load->view('nav/admin', array('active' => 'user', 'username' => $username));
?>
<?php
$types = array("0" => "Admin", "1" => "Doctor", "2" => "Nurse", "3" => "Attendent");
$genders = array("0" => "Female", "1" => "Male");
?>
<script>
  window.errorAlert = "<div class=\"alert alert-dismissible alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><p>{$ERR$}</p></div>";
  window.showDelete = (id) => {
    const elems = $(`#users #u_${id} td`);
    const name = $(elems[1]).text();

    $("#modal_del .error").html('');
    $($("#modal_del .modal-title")[0]).text(`Are you sure to delete user '${name}'?`);
    $($("#modal_del #id")[0]).val(id);
    $($("#modal_del #loader")[0]).addClass("hidden");
    $($("#modal_del #content")[0]).removeClass("hidden");
    $("#modal_del").modal('show');
  }
  window.confirmDelete = () => {
    $($("#modal_del #loader")[0]).removeClass("hidden");
    $($("#modal_del #content")[0]).addClass("hidden");
    fetch('<?php echo base_url('user/delete'); ?>', {
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
  window.showAdd = () => {
    $($("#modal_edit .modal-footer .btn-primary")[0]).removeClass("hidden");
    $($("#modal_edit #id")[0]).prop("disabled", false);
    $($("#modal_edit #u")[0]).prop("disabled", false);
    $($("#modal_edit #p")[0]).prop("disabled", false);
    $($("#modal_edit #fnm")[0]).prop("disabled", false);
    $($("#modal_edit #lnm")[0]).prop("disabled", false);
    $($("#modal_edit #typ")[0]).prop("disabled", false);
    $($("#modal_edit #spec")[0]).prop("disabled", false);
    $($("#modal_edit #nic")[0]).prop("disabled", false);
    $($("#modal_edit #age")[0]).prop("disabled", false);
    $($("#modal_edit #add")[0]).prop("disabled", false);
    $($("#modal_edit #gen")[0]).prop("disabled", false);
    $("#modal_edit .error").html('');
    $($("#modal_edit .modal-title")[0]).text(`Add new user`);
    $($("#modal_edit #id")[0]).val('');
    $($("#modal_edit #u")[0]).val('');
    $($("#modal_edit #p")[0]).val('');
    $($("#modal_edit #p")[0]).parent().parent().removeClass("hidden");
    $($("#modal_edit #fnm")[0]).val('');
    $($("#modal_edit #lnm")[0]).val('');
    $($("#modal_edit #typ")[0]).val('0');
    $($("#modal_edit #spec")[0]).val('');
    $($("#modal_edit #nic")[0]).val('');
    $($("#modal_edit #age")[0]).val('');
    $($("#modal_edit #add")[0]).val('');
    $($("#modal_edit #gen")[0]).val('1');
    $($("#modal_edit #loader")[0]).addClass("hidden");
    $($("#modal_edit #content")[0]).removeClass("hidden");
    $("#modal_edit").modal('show');
  }
  window.showView = (id) => {
    $($("#modal_edit .modal-footer .btn-primary")[0]).addClass("hidden");
    $($("#modal_edit #id")[0]).prop("disabled", true);
    $($("#modal_edit #u")[0]).prop("disabled", true);
    $($("#modal_edit #p")[0]).prop("disabled", true);
    $($("#modal_edit #fnm")[0]).prop("disabled", true);
    $($("#modal_edit #lnm")[0]).prop("disabled", true);
    $($("#modal_edit #typ")[0]).prop("disabled", true);
    $($("#modal_edit #spec")[0]).prop("disabled", true);
    $($("#modal_edit #nic")[0]).prop("disabled", true);
    $($("#modal_edit #age")[0]).prop("disabled", true);
    $($("#modal_edit #add")[0]).prop("disabled", true);
    $($("#modal_edit #gen")[0]).prop("disabled", true);
    const elems = $(`#users #u_${id} td`);
    const name = $(elems[1]).text();
    
    $("#modal_edit .error").html('');
    $($("#modal_edit .modal-title")[0]).text(`View user "${name}"`);
    $("#modal_edit").modal('show');
    $($("#modal_edit #loader")[0]).removeClass("hidden");
    $($("#modal_edit #content")[0]).addClass("hidden");
    fetch('<?php echo base_url('user/get'); ?>', {
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
        $($("#modal_edit #u")[0]).val(d.data.username);
        $($("#modal_edit #p")[0]).val('');
        $($("#modal_edit #p")[0]).parent().parent().addClass("hidden");
        $($("#modal_edit #fnm")[0]).val(d.data.fname);
        $($("#modal_edit #lnm")[0]).val(d.data.lname);
        $($("#modal_edit #typ")[0]).val(d.data.type);
        $($("#modal_edit #spec")[0]).val(d.data.spec);
        if (d.data.type === '1') {
          $($("#modal_edit .spec")[0]).show();
        } else {
          $($("#modal_edit .spec")[0]).hide();
        }
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
    $($("#modal_edit .modal-footer .btn-primary")[0]).removeClass("hidden");
    $($("#modal_edit #id")[0]).prop("disabled", false);
    $($("#modal_edit #u")[0]).prop("disabled", false);
    $($("#modal_edit #p")[0]).prop("disabled", false);
    $($("#modal_edit #fnm")[0]).prop("disabled", false);
    $($("#modal_edit #lnm")[0]).prop("disabled", false);
    $($("#modal_edit #typ")[0]).prop("disabled", false);
    $($("#modal_edit #spec")[0]).prop("disabled", false);
    $($("#modal_edit #nic")[0]).prop("disabled", false);
    $($("#modal_edit #age")[0]).prop("disabled", false);
    $($("#modal_edit #add")[0]).prop("disabled", false);
    $($("#modal_edit #gen")[0]).prop("disabled", false);
    const elems = $(`#users #u_${id} td`);
    const name = $(elems[1]).text();
    
    $("#modal_edit .error").html('');
    $($("#modal_edit .modal-title")[0]).text(`Edit user "${name}"`);
    $("#modal_edit").modal('show');
    $($("#modal_edit #loader")[0]).removeClass("hidden");
    $($("#modal_edit #content")[0]).addClass("hidden");
    fetch('<?php echo base_url('user/get'); ?>', {
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
        $($("#modal_edit #u")[0]).val(d.data.username);
        $($("#modal_edit #p")[0]).val('');
        $($("#modal_edit #p")[0]).parent().parent().addClass("hidden");
        $($("#modal_edit #fnm")[0]).val(d.data.fname);
        $($("#modal_edit #lnm")[0]).val(d.data.lname);
        $($("#modal_edit #typ")[0]).val(d.data.type);
        $($("#modal_edit #spec")[0]).val(d.data.spec);
        if (d.data.type === '1') {
          $($("#modal_edit .spec")[0]).show();
        } else {
          $($("#modal_edit .spec")[0]).hide();
        }
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
    $($("#modal_edit #loader")[0]).removeClass("hidden");
    $($("#modal_edit #content")[0]).addClass("hidden");
    const data = {
      id: $($("#modal_edit #id")[0]).val() === '' ? undefined : $($("#modal_edit #id")[0]).val(),
      u: $($("#modal_edit #u")[0]).val(),
      p: $($("#modal_edit #id")[0]).val() === '' ? $($("#modal_edit #p")[0]).val() : undefined,
      fnm: $($("#modal_edit #fnm")[0]).val(),
      lnm: $($("#modal_edit #lnm")[0]).val(),
      typ: $($("#modal_edit #typ")[0]).val(),
      spec: $($("#modal_edit #spec")[0]).val(),
      nic: $($("#modal_edit #nic")[0]).val(),
      age: $($("#modal_edit #age")[0]).val(),
      add: $($("#modal_edit #add")[0]).val(),
      gen: $($("#modal_edit #gen")[0]).val()
    };
    fetch(!data.id ? '<?php echo base_url('user/insert'); ?>' : '<?php echo base_url('user/update'); ?>', {
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
  window.doSearch = () => {
    const kwd = $("#search").val();
    const path = '<?php echo base_url('user/index/' . $page . '/'); ?>';
    window.location.href = path + kwd;
  }
  $(document).ready(() => {
    $("#search").keypress((e) => {
      if(e.which == 13) {
        doSearch();
      }
    });
    $("#modal_edit #typ").change(function () {
      var end = this.value;
      if (end === '1') {
        $($("#modal_edit .spec")[0]).show();
      } else {
        $($("#modal_edit .spec")[0]).hide();
      }
    });
  });
</script>
<div class="row">
  <div class="col-md-offset-1 col-md-10">
    <!-- Controllers -->
    <div class="row">
      <div class="col-xs-12">
        <div class="input-group">
          <?php if (checkPerm($this->session->userdata('type'), 'u', 'v')) { ?>
          <input value="<?php echo $kwd ?>" type="search" id="search" class="form-control">
          <span class="input-group-btn">
            <button type="button" class="btn btn-default pull-right" onclick="doSearch()">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </span>
          <?php
            }
            if (checkPerm($this->session->userdata('type'), 'u', 'i')) {
          ?>
          <span class="input-group-btn">
            <button type="button" class="btn btn-success pull-right" onclick="showAdd()">
              <i class="fa fa-plus" aria-hidden="true"></i>
              Add
            </button>
          </span>
          <?php } ?>
        </div>
        
      </div>
    </div>
    <br />
    <br />
    <!-- Table -->
    <?php if (checkPerm($this->session->userdata('type'), 'u', 'v')) { ?>
    <table id="users" class="table table-striped table-hover ">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>NIC</th>
          <th>Type</th>
          <th>Age</th>
          <th>Gender</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($list as $k => $u) { ?>
          <tr id="u_<?php echo $u->id ?>">
            <td><?php echo $u->id ?></td>
            <td><?php echo $u->fname . ' ' . $u->lname ?></td>
            <td><?php echo $u->nic ?></td>
            <td><?php echo $types[$u->type] ?></td>
            <td><?php echo $u->age ?></td>
            <td><?php echo $genders[$u->gender] ?></td>
            <td class="text-right">
              <?php if (checkPerm($this->session->userdata('type'), 'u', 'v')) { ?>
              <button onclick="showView(<?php echo $u->id ?>)" type="button" class="btn btn-success btn-xs">
                <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View
              </button>
              <?php
                }
                if (checkPerm($this->session->userdata('type'), 'u', 'u')) {
              ?>
              <button onclick="showEdit(<?php echo $u->id ?>)" type="button" class="btn btn-primary btn-xs">
                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit
              </button>
              <?php
                }
                if (checkPerm($this->session->userdata('type'), 'u', 'd')) {
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
          <a class="page-link" href="<?php echo base_url('user/index/' . ($page - 1)); ?>" tabindex="-1">Previous</a>
        </li>
        <li class="page-item active">
          <a class="page-link" href="#"><?php if ($page * 10 > $count) { echo ($page - 1) * 10 . ' - ' . $count . ' of ' . $count; } else { echo ($page - 1) * 10 . ' - ' . $page * 10 . ' of ' . $count; } ?></a>
        </li>
        <li class="page-item <?php if ($page * 10 > $count) { echo 'disabled'; } ?>">
          <a class="page-link" href="<?php echo base_url('user/index/' . ($page + 1)); ?>">Next</a>
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
                    <label for="u" class="col-md-2 control-label">Username</label>
                    <div class="col-md-10">
                      <?php echo form_input(array('type' => 'text', 'required' => TRUE, 'class' => 'form-control', 'id' => 'u', 'placeholder' => 'Username', 'autocomplete' => 'off')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="p" class="col-md-2 control-label">Password</label>
                    <div class="col-md-10">
                      <?php echo form_password(array('class' => 'form-control', 'required' => TRUE, 'id' => 'p','placeholder' => 'Password', 'autocomplete' => 'off')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fnm" class="col-md-2 control-label">First Name</label>
                    <div class="col-md-10">
                      <?php echo form_input(array('class' => 'form-control', 'required' => TRUE, 'id' => 'fnm', 'placeholder' => 'First Name', 'autocomplete' => 'off')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lnm" class="col-md-2 control-label">Last Name</label>
                    <div class="col-md-10">
                      <?php echo form_input(array('class' => 'form-control', 'required' => TRUE, 'id' => 'lnm', 'placeholder' => 'Last Name', 'autocomplete' => 'off')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="typ" class="col-md-2 control-label">User Type</label>
                    <div class="col-md-10">
                      <?php echo form_dropdown('User Type', $types, NULL, array('class' => 'form-control', 'required' => TRUE, 'id' => 'typ')); ?>
                    </div>
                  </div>
                  <div class="form-group spec">
                    <label for="nic" class="col-md-2 control-label">Doctor Specialty</label>
                    <div class="col-md-10">
                      <?php echo form_input(array('class' => 'form-control', 'required' => TRUE, 'id' => 'spec', 'placeholder' => 'Specialty', 'autocomplete' => 'off')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nic" class="col-md-2 control-label">NIC</label>
                    <div class="col-md-10">
                      <?php echo form_input(array('class' => 'form-control', 'required' => TRUE, 'id' => 'nic', 'placeholder' => 'NIC', 'autocomplete' => 'off')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="age" class="col-md-2 control-label">Age</label>
                    <div class="col-md-10">
                      <?php echo form_input(array('type' => 'number', 'class' => 'form-control', 'required' => TRUE, 'id' => 'age', 'placeholder' => 'Age', 'autocomplete' => 'off')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="add" class="col-md-2 control-label">Address</label>
                    <div class="col-md-10">
                      <?php echo form_textarea(array('class' => 'form-control', 'rows' => '3', 'required' => TRUE, 'id' => 'add', 'placeholder' => 'Address', 'autocomplete' => 'off')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gen" class="col-md-2 control-label">Gender</label>
                    <div class="col-md-10">
                      <?php echo form_dropdown('User Type', array("0" => "Female", "1" => "Male"), "male", array('class' => 'form-control', 'required' => TRUE, 'id' => 'gen')); ?>
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
            <h4 class="modal-title">Are you sure to delete user ###?</h4>
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