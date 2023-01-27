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
                    <?= languagedata($this->session->userdata('session_language'), "BS Code Amount"); ?>
                </h2>



                <button type="button" class="btn bg-indigo waves-effect pull-right" data-toggle="modal" data-target="#importModal" style="margin-left:10px"><i class="material-icons">person_add</i><?= languagedata($this->session->userdata('session_language'), "Import Excel"); ?></button>

                <a href="<?= base_url('admin/bsamount/add_code'); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Add New BS Amount"); ?></a>
            </div>
            <!-- Dropdown for filters -->

            <div class="body">

                <?php echo form_open(base_url('admin/bsamount/list'), 'class="inline-form-view form-horizontal filter_record"');  ?>
                <div class="col-md-12">
                    <div class="row clearfix col-md-6">
                        <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="term"><?= languagedata($this->session->userdata('session_language'), "Select Client"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick submit_form" name="client_id" id="client_id">
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
                                    <select class="form-control show-tick submit_form" id="year" name="year">
                                        <?php foreach ($years as $group) : ?>
                                            <option value="<?= $group['year']; ?>" <?= ($year == $group['year'] ? "selected" : "") ?>><?= $group['year'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <a href="<?= base_url('admin/plcode/export_excel/' . $year . '/' . $client_id); ?>" class="export_excel_button btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Export Data"); ?></a> -->
                </div>
                <?php echo form_close(); ?>
                <div class="table-responsive">

                    <?php echo form_open(base_url('admin/bsamount/save_data'), 'class="save_data"');  ?>

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
                            <?php
                            $counter = 0;
                            $amount_data = json_decode($bs_amount_data['data'],true);
                            foreach ($bs_codes as $key => $value) :
                                $bsId = $value['id'];
                                $row = "<tr>";
                                $row .= "<td>" . ++$counter . "</td>";
                                $row .= "<td>" . $value['code'] . "</td>";
                                $row .= "<td>" . $value['title'] . "</td>";
                                $row .= "<td><input type='text' class='form-control' name='jan_" . $value['id'] . "' value=".$amount_data['jan_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='feb_" . $value['id'] . "' value=".$amount_data['feb_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='mar_" . $value['id'] . "' value=".$amount_data['mar_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='apr_" . $value['id'] . "' value=".$amount_data['apr_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='may_" . $value['id'] . "' value=".$amount_data['may_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='jun_" . $value['id'] . "' value=".$amount_data['jun_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='jul_" . $value['id'] . "' value=".$amount_data['jul_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='aug_" . $value['id'] . "' value=".$amount_data['aug_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='sep_" . $value['id'] . "' value=".$amount_data['sep_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='oct_" . $value['id'] . "' value=".$amount_data['oct_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='nov_" . $value['id'] . "' value=".$amount_data['nov_'.$bsId]."></td>";

                                $row .= "<td><input type='text' class='form-control' name='dec_" . $value['id'] . "' value=".$amount_data['dec_'.$bsId]."></td>";

                                $row .= "</tr>";
                                echo $row;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <?php echo form_close(); ?>

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
                <form action="<?php echo base_url('admin/bsamount/import_excel'); ?>" method="POST" enctype="multipart/form-data">

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

<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url() ?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

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
    $("#bs_import_amount").addClass('active');

    $(".submit_form").change(function() {
        // alert('h');
        $(".filter_record").submit();
    });


    $(".save_data").change(function() {
        var form_data = $(".save_data").serializeArray();
        var url = "<?= base_url('admin/bsamount/save_data') ?>";
        var year = $('#year').val();
        var client_id = $('#client_id').val();
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'form_data': form_data,
                'year': year,
                'client_id': client_id,
                'csrf_test_name': $('input[name="csrf_test_name"]:first').val()
            },
            success: function(resultData) {
                flash('Default Flash Message');
                alert('Data Saved Successfully.')
            },
            error: function(xhr, status, error) {
                console.log(error);
            },
        });
    });
</script>