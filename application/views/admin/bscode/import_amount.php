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
                    <?= languagedata($this->session->userdata('session_language'), "Import Amount"); ?>
                </h2>

                <button type="button" class="m-l-15 btn bg-indigo waves-effect pull-right" data-toggle="modal" data-target="#importModal"><i class="material-icons">person_add</i><?= languagedata($this->session->userdata('session_language'), "Import Excel"); ?></button>

                <a href="<?= base_url("admin/plamount/list/$year/$client_id"); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "View Amount"); ?></a>

            </div>
            <div class="body">

            <?php echo form_open(base_url('admin/bscode/import_amount'), 'class="inline-form-view form-horizontal filter_record"');  ?>
                <div class="col-md-12">
                    <div class="row clearfix col-md-6">
                        <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="term"><?= languagedata($this->session->userdata('session_language'), "Select Client"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick submit_form" name="client_id">
                                        <?php foreach ($clients as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($client_id == $group['id'] ? "selected" : "") ?>><?= $group['company_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row clearfix col-md-6">
                        <div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password"><?= languagedata($this->session->userdata('session_language'), "Select Financial Year"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick submit_form" name="year">
                                        <?php foreach ($years as $group) : ?>
                                            <option value="<?= $group['year']; ?>" <?= ($year == $group['year'] ? "selected" : "") ?>><?= $group['year'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>


                <div class="table-responsive">
                    <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                            <tr>
                            <th>#ID</th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Accounting Code"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Title (Accounting Name)"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "January"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "February"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "March"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "April"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "May"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "June"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "July"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "August"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "September"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "October"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "November"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "December"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0;
                            foreach ($imported_data as $row) : 
                            $monthData = json_decode($row['data'],true);
                            ?>
                                <tr>
                                    <td><?= ++$count; ?></td>
                                    <td><?= $row['code']?></td>
                                    <td><?= $row['title']?></td>
                                    <td><?= $monthData['Jan']?></td>
                                    <td><?= $monthData['Feb']?></td>
                                    <td><?= $monthData['Mar']?></td>
                                    <td><?= $monthData['Apr']?></td>
                                    <td><?= $monthData['May']?></td>
                                    <td><?= $monthData['Jun']?></td>
                                    <td><?= $monthData['Jul']?></td>
                                    <td><?= $monthData['Aug']?></td>
                                    <td><?= $monthData['Sep']?></td>
                                    <td><?= $monthData['Oct']?></td>
                                    <td><?= $monthData['Nov']?></td>
                                    <td><?= $monthData['Dec']?></td>
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

<!-- Import Excel Modal -->
<div class="modal fade" id="importModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= languagedata($this->session->userdata('session_language'), "Upload Excel file"); ?></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/plamount/import_excel_new'); ?>" method="POST" enctype="multipart/form-data">

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-12 col-md-2 col-sm-4 col-xs-5">
                            <label for="term"><?= languagedata($this->session->userdata('session_language'), "Select Client"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-12 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="client_id" required>
                                        <?php foreach ($clients as $group) : ?>
                                            <option value="<?= $group['id']; ?>"><?= $group['company_name'] ?></option>
                                        <?php endforeach; ?>
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
                    <a href="<?= base_url('uploads/plcode/BS_Import_Acc_code_Form.xlsx') ?>"><?= languagedata($this->session->userdata('session_language'), "Download Sample File"); ?></a>

                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>

    </div>
</div>
<!-- Modal -->


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
    $("#bs_import_amount").addClass('active');

    
    $(".submit_form").change(function() {
        // alert('h');
        $(".filter_record").submit();
    });
</script>