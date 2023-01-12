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
                    <?= languagedata($this->session->userdata('session_language'), "BS Code Lists"); ?>
                </h2>


                <button type="button" class="btn bg-indigo waves-effect pull-right" data-toggle="modal" data-target="#importModal" style="margin-left:10px"><i class="material-icons">person_add</i>Import Excel</button>

                <a href="<?= base_url('user/bscode/add_code'); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Add New BS Code"); ?></a>
            </div>
            <!-- Dropdown for filters -->
            <?php echo form_open(base_url('user/bscode/list'), 'class="form-horizontal filter_record"');  ?>
            <div class="pull-right col-md-8 m-t-20">
                <div class="row clearfix col-md-6">
                    <div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="password"><?= languagedata($this->session->userdata('session_language'), "Select Financial Year"); ?><span class="red"> *</span></label>
                    </div>
                    <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select class="form-control show-tick submit_form" name="year">
                                    <option value="2019" <?= ($year == '2019' ? "selected" : "") ?>>2019</option>
                                    <option value="2020" <?= ($year == '2020' ? "selected" : "") ?>>2020</option>
                                    <option value="2021" <?= ($year == '2021' ? "selected" : "") ?>>2021</option>
                                    <option value="2022" <?= ($year == '2022' ? "selected" : "") ?>>2022</option>
                                    <option value="2023" <?= ($year == '2023' ? "selected" : "") ?>>2023</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <div class="body">
                <div class="table-responsive">
                    <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Financial Year</th>
                                <th>Accounting Code</th>
                                <th>Title (Accounting Name)</th>
                                <th>Major items of BS</th>
                                <th>Medium item of BS</th>
                                <th>Cash Flow category</th>
                                <th>Increase and Decrease in Cash Flow</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
<!-- Import Excel Modal -->
<div class="modal fade" id="importModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Excel file</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('user/bscode/import_excel'); ?>" method="POST" enctype="multipart/form-data">

                <div class="row clearfix col-md-6">
                        <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5">
                            <label for="term"><?= languagedata($this->session->userdata('session_language'), "Select Year"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-12 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="year" required>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="file" name="uploadFile" class="filestyle" data-icon="false" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Upload file" name="submit" style="margin-bottom: 10px;">
                    </div>
                </form>
                <div class="col-md-12">
                    <a href="<?= base_url('uploads/bscode/BS_Import_Acc_code_Form.xlsx') ?>">Download Sample File</a>

                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>

    </div>
</div>
<!-- Modal -->
<div id="confirm-delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">
                <p>As you sure you want to delete.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url() ?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    //---------------------------------------------------
    var table = $('#na_datatable').DataTable({
        "processing": true,
        "serverSide": true,
        // "ajax": "<?= base_url('user/bscode/get_codes') ?>",
        "ajax": {
            "url": "<?= base_url('user/bscode/get_codes') ?>",
            "data": {
                "year": "<?= $year ?>"
            }
        },
        "order": [
            [0, 'desc']
        ],
        "columnDefs": [{
                "targets": 0,
                "name": "id",
                'searchable': false,
                'orderable': true
            },
            {
                "targets": 1,
                "name": "username",
                'searchable': true,
                'orderable': true
            },
            {
                "targets": 2,
                "name": "email",
                'searchable': true,
                'orderable': true
            },
            {
                "targets": 3,
                "name": "id",
                'searchable': true,
                'orderable': false
            }
        ]
    });
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
    $("#bscodes").addClass('active');
    $(".submit_form").change(function() {
        // alert('h');
        $(".filter_record").submit();
    });
</script>