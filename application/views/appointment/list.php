<?php
$this->load->view('nav/admin', array('active' => 'appointment', 'username' => $username));
?>
<?php

?>
<script>
  window.errorAlert = "<div class=\"alert alert-dismissible alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><p>{$ERR$}</p></div>";
  window.showDelete = (id) => {
    // const elems = $(`#users #u_${id} td`);
    // const name = $(elems[0]).text();
    $("#modal_del .error").html('');
    $($("#modal_del .modal-title")[0]).text(`Are you sure to delete appointment #${id}?`);
    $($("#modal_del #id")[0]).val(id);
    $($("#modal_del #loader")[0]).addClass("hidden");
    $($("#modal_del #content")[0]).removeClass("hidden");
    $("#modal_del").modal('show');
  }
  window.confirmDelete = () => {
    $($("#modal_del #loader")[0]).removeClass("hidden");
    $($("#modal_del #content")[0]).addClass("hidden");
    fetch('<?php echo base_url('appointment/delete'); ?>', {
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
  window.showView = (id) => {
    const elems = $(`#appointments #u_${id} td`);
    const name = $(elems[0]).text();

    $("#modal_edit .error").html('');
    $($("#modal_edit .modal-title")[0]).text(`View appointment #${name}`);
    $($("#modal_edit .modal-footer .btn-primary")[0]).addClass("hidden");
    window.selectPatient[0].selectize.disable();
    window.selectDoc[0].selectize.disable();
    $($("#modal_edit #room")[0]).prop("disabled", true);
    $($("#modal_edit #pre")[0]).prop("disabled", true);
    $($("#modal_edit #time")[0]).addClass("disabled");
    $("#modal_edit").modal('show');
    $($("#modal_edit #loader")[0]).removeClass("hidden");
    $($("#modal_edit #content")[0]).addClass("hidden");
    fetch('<?php echo base_url('appointment/get'); ?>', {
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
        console.log();
        $($("#modal_edit #id")[0]).val(d.data.id);
        window.selectPatient[0].selectize.addOption({ id: d.data.patient_id, name: d.data.patient, nic: d.data.patient_nic });
        window.selectPatient[0].selectize.setValue(d.data.patient_id, true);
        window.selectDoc[0].selectize.addOption({ id: d.data.doc_id, name: d.data.doc, spec: d.data.doc_spec });
        window.selectDoc[0].selectize.setValue(d.data.doc_id, true);
        $($("#modal_edit #room")[0]).val(d.data.room);
        $($("#modal_edit #pre")[0]).val(d.data.meds);
        $($("#modal_edit #time")[0]).data("DateTimePicker").date(new Date(d.data.time));
      }
      $($("#modal_edit #loader")[0]).addClass("hidden");
      $($("#modal_edit #content")[0]).removeClass("hidden");
    })
    .catch(e => console.error(e));
  }
  window.showAdd = () => {
    $($("#modal_edit .modal-footer .btn-primary")[0]).removeClass("hidden");
    window.selectPatient[0].selectize.enable();
    window.selectDoc[0].selectize.enable();
    $($("#modal_edit #room")[0]).prop("disabled", false);
    $($("#modal_edit #pre")[0]).prop("disabled", false);
    $($("#modal_edit #time")[0]).removeClass("disabled");
    $("#modal_edit .error").html('');
    $($("#modal_edit .modal-title")[0]).text(`Add new appointment`);
    $($("#modal_edit #id")[0]).val('');
    $($("#modal_edit #u")[0]).val('');
    $($("#modal_edit #p")[0]).val('');
    $($("#modal_edit #p")[0]).parent().parent().removeClass("hidden");
    $($("#modal_edit #fnm")[0]).val('');
    $($("#modal_edit #lnm")[0]).val('');
    $($("#modal_edit #typ")[0]).val('1');
    $($("#modal_edit #nic")[0]).val('');
    $($("#modal_edit #age")[0]).val('');
    $($("#modal_edit #add")[0]).val('');
    $($("#modal_edit #gen")[0]).val('1');
    $($("#modal_edit #loader")[0]).addClass("hidden");
    $($("#modal_edit #content")[0]).removeClass("hidden");
    $("#modal_edit").modal('show');
  }
  window.showEdit = (id) => {
    $($("#modal_edit .modal-footer .btn-primary")[0]).removeClass("hidden");
    window.selectPatient[0].selectize.enable();
    window.selectDoc[0].selectize.enable();
    $($("#modal_edit #room")[0]).prop("disabled", false);
    $($("#modal_edit #pre")[0]).prop("disabled", false);
    $($("#modal_edit #time")[0]).removeClass("disabled");
    const elems = $(`#appointments #u_${id} td`);
    const name = $(elems[0]).text();

    $("#modal_edit .error").html('');
    $($("#modal_edit .modal-title")[0]).text(`Edit appointment #${name}`);
    $("#modal_edit").modal('show');
    $($("#modal_edit #loader")[0]).removeClass("hidden");
    $($("#modal_edit #content")[0]).addClass("hidden");
    fetch('<?php echo base_url('appointment/get'); ?>', {
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
        console.log();
        $($("#modal_edit #id")[0]).val(d.data.id);
        window.selectPatient[0].selectize.addOption({ id: d.data.patient_id, name: d.data.patient, nic: d.data.patient_nic });
        window.selectPatient[0].selectize.setValue(d.data.patient_id, true);
        window.selectDoc[0].selectize.addOption({ id: d.data.doc_id, name: d.data.doc, spec: d.data.doc_spec });
        window.selectDoc[0].selectize.setValue(d.data.doc_id, true);
        $($("#modal_edit #room")[0]).val(d.data.room);
        $($("#modal_edit #pre")[0]).val(d.data.meds);
        $($("#modal_edit #time")[0]).data("DateTimePicker").date(new Date(d.data.time));
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
      patient: $($("#modal_edit #select-patient")[0]).val(),
      doc: $($("#modal_edit #select-doc")[0]).val(),
      rmn: $($("#modal_edit #room")[0]).val(),
      time: $($("#modal_edit #time")[0]).data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss"),
      meds: $($("#modal_edit #pre")[0]).val()
    };
    fetch(!data.id ? '<?php echo base_url('appointment/insert'); ?>' : '<?php echo base_url('appointment/update'); ?>', {
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
    const path = '<?php echo base_url('appointment/index/' . $page . '/'); ?>';
    window.location.href = path + kwd;
  }
  $(document).ready(() => {
    $("#search").keypress((e) => {
      if(e.which == 13) {
        doSearch();
      }
    });
    window.selectPatient = $('#select-patient').selectize({
      valueField: 'id',
      labelField: 'name',
      searchField: 'name',
      create: false,
      render: {
          option: function(item, escape) {
              return '<div>' +
                '<span class="title">' +
                  '<span class="name">' + escape(item.name) + '</span>' +
                '</span>' +
                '<span class="description"><strong>NIC:</strong> ' + escape(item.nic) + '</span>' +
              '</div>';
          }
      },
      load: function(query, callback) {
          if (!query.length) return callback();
          $.ajax({
            url: '<?php echo base_url('appointment/patients/'); ?>' + encodeURIComponent(query),
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
          });
      }
    });
    window.selectDoc = $('#select-doc').selectize({
      valueField: 'id',
      labelField: 'name',
      searchField: 'name',
      create: false,
      render: {
          option: function(item, escape) {
              return '<div>' +
                '<span class="title">' +
                  '<span class="name">' + escape(item.name) + '</span>' +
                '</span>' +
                '<span class="description">' + escape(item.spec) + '</span>' +
              '</div>';
          }
      },
      load: function(query, callback) {
          if (!query.length) return callback();
          $.ajax({
            url: '<?php echo base_url('appointment/doctors/'); ?>' + encodeURIComponent(query),
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
          });
      }
    });
    $($("#modal_edit #time")[0]).datetimepicker({
      inline: true,
      sideBySide: true,
      minDate: new Date()
    });
  });
</script>
<div class="row">
  <div class="col-md-offset-1 col-md-10">
    <!-- Controllers -->
    <div class="row">
      <div class="col-xs-12">
        <div class="input-group">
          <?php if (checkPerm($this->session->userdata('type'), 'a', 'v')) { ?>
          <input value="<?php echo $kwd ?>" type="search" id="search" class="form-control">
          <span class="input-group-btn">
            <button type="button" class="btn btn-default pull-right" onclick="doSearch()">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </span>
          <?php
            }
            if (checkPerm($this->session->userdata('type'), 'a', 'i')) {
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
    <?php if (checkPerm($this->session->userdata('type'), 'a', 'v')) { ?>
    <table id="appointments" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Patient</th>
          <th>Doctor</th>
          <th>Room</th>
          <th>Date</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($list as $k => $u) { ?>
          <tr id="u_<?php echo $u->id ?>">
            <td><?php echo $u->id ?></td>
            <td><?php echo $u->patient ?></td>
            <td><?php echo $u->doc ?></td>
            <td><?php echo $u->room ?></td>
            <td><?php echo $u->time ?></td>
            <td class="text-right">
              <?php if (checkPerm($this->session->userdata('type'), 'a', 'v')) { ?>
              <button onclick="showView(<?php echo $u->id ?>)" type="button" class="btn btn-success btn-xs">
                <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View
              </button>
              <?php
                }
                if (checkPerm($this->session->userdata('type'), 'a', 'u')) {
              ?>
              <button onclick="showEdit(<?php echo $u->id ?>)" type="button" class="btn btn-primary btn-xs">
                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit
              </button>
              <?php
                }
                if (checkPerm($this->session->userdata('type'), 'a', 'd')) {
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
          <a class="page-link" href="<?php echo base_url('appointment/index/' . ($page - 1)); ?>" tabindex="-1">Previous</a>
        </li>
        <li class="page-item active">
          <a class="page-link" href="#"><?php if ($page * 10 > $count) { echo ($page - 1) * 10 . ' - ' . $count . ' of ' . $count; } else { echo ($page - 1) * 10 . ' - ' . $page * 10 . ' of ' . $count; } ?></a>
        </li>
        <li class="page-item <?php if ($page * 10 > $count) { echo 'disabled'; } ?>">
          <a class="page-link" href="<?php echo base_url('appointment/index/' . ($page + 1)); ?>">Next</a>
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
                    <label for="patient" class="col-md-2 control-label">Patient</label>
                    <div class="col-md-10">
                    <select id="select-patient" placeholder="Select a patient...">
                    </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="doc" class="col-md-2 control-label">Doctor</label>
                    <div class="col-md-10">
                    <select id="select-doc" placeholder="Select a doctor...">
                    </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="age" class="col-md-2 control-label">Room</label>
                    <div class="col-md-10">
                      <?php echo form_input(array('type' => 'number', 'class' => 'form-control', 'required' => TRUE, 'id' => 'room', 'placeholder' => 'Room', 'autocomplete' => 'off')); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="age" class="col-md-2 control-label">Date Time</label>
                    <div class="col-md-10">
                      <div id="time"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="add" class="col-md-2 control-label">Prescription</label>
                    <div class="col-md-10">
                      <?php echo form_textarea(array('class' => 'form-control', 'rows' => '3', 'id' => 'pre', 'placeholder' => 'Prescription', 'autocomplete' => 'off')); ?>
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
