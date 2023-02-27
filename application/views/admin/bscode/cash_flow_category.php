<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="display: inline-block;">
                    <?= languagedata($this->session->userdata('session_language'), "Cash Flow Categories"); ?>
                </h2>

                <a href="<?= base_url('admin/bscode/add_cash_flow/'.$id); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i><?= languagedata($this->session->userdata('session_language'), " Add New Cash Flow Category items"); ?></a>

                <a href="<?= base_url('admin/bsamount/list/'.date('Y')); ?>" class="btn bg-indigo waves-effect pull-right m-r-25"><i class="material-icons">person_add</i><?= languagedata($this->session->userdata('session_language'), "Proceed To Amount"); ?></a>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Name"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Action"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0;
                            foreach ($cash_flow_categories as $row) : ?>
                                <tr>
                                    <td><?= ++$count; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td>
                                        <a title="Edit" class="update btn btn-sm btn-primary" href="<?= base_url('admin/bscode/add_cash_flow/' . $row['id']) ?>"><i class="material-icons">edit</i></a>
                                        <a title="Delete" class="delete btn btn-sm btn-danger" data-href="<?= base_url('admin/bscode/delete_cash_flow/' . $row['id']); ?>" data-toggle="modal" data-target="#confirm-delete"><i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->

<!-- Modal -->
<div id="confirm-delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= languagedata($this->session->userdata('session_language'), "Delete"); ?></h4>
            </div>
            <div class="modal-body">
                <p><?= languagedata($this->session->userdata('session_language'), "Are you sure you want to delete"); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= languagedata($this->session->userdata('session_language'), "Close"); ?></button>
                <a class="btn btn-danger btn-ok"><?= languagedata($this->session->userdata('session_language'), "Delete"); ?></a>
            </div>
        </div>
    </div>
</div>


<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url() ?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    //---------------------------------------------------
    var table = $('#na_datatable').DataTable();
</script>
<!-- Autosize Plugin Js -->
<script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script>
<!-- Custom Js -->
<script src="<?= base_url() ?>public/js/pages/tables/jquery-datatable.js"></script>
<script>
    //Textare auto growth
    autosize($('textarea.auto-growth'));

    //Delete Dialogue
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    $("#bs_code").addClass('active');
</script>