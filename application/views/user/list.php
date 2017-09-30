<?php $this->load->view('nav/admin', array('active' => 'user')); ?>
<?php
$types = array("0" => "Admin", "1" => "Doctor", "2" => "Nurse", "3" => "Attendent");
?>
<script>
  window.showEdit = (id) => {
    const elems = $(`#users #u_${id} td`);
    const name = $(elems[1]).text();
    
    $($("#modal_edit .modal-title")[0]).text(`Edit user "${name}"`);
    $("#modal_edit").modal('show');
  }
</script>
<div class="row">
  <div class="col-md-offset-1 col-md-10">
    <!-- Table -->
    <table id="users" class="table table-striped table-hover ">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>NIC</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($list as $k => $u) { ?>
          <tr id="u_<?php echo $u->id ?>">
            <td><?php echo $u->id ?></td>
            <td><?php echo $u->fname . ' ' . $u->lname ?></td>
            <td><?php echo $u->nic ?></td>
            <td><?php echo $types[$u->type] ?></td>
            <td class="text-right">
              <button onclick="showEdit(<?php echo $u->id ?>)" type="button" class="btn btn-primary btn-xs">
                <i class="fa fa-pencil" aria-hidden="true"></i>
              </button>
              <button type="button" class="btn btn-danger btn-xs">
                <i class="fa fa-times" aria-hidden="true"></i>
              </button>
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
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item active">
          <a class="page-link" href="#"><?php if ($page * 10 > $count) { echo $page . ' - ' . $count; } else { echo $page . ' - ' . $page * 10; } ?></a>
        </li>
        <li class="page-item <?php if ($page * 10 > $count) { echo 'disabled'; } ?>">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <!-- Model - Edit -->
    <div id="modal_edit" class="modal show" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div class="d-flex justify-content-center">
              <i class="fa fa-circle-o-notch fa-spin"></i>
              <label>Please hold a moment!</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>