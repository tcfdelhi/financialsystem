<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<style>
    .form-control {
        width: 100% !important;
    }

    .input-sm {
        width: auto !important;
    }

    .categories {
        background-color: #f0b9d4 !important;
    }

    section.content {
        margin: 71px 0 0 0px !important;
    }

    #leftsidebar {
        display: none !important;
    }
</style>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="display: inline-block;">
                    <?= languagedata($this->session->userdata('session_language'), "PL Code Amount"); ?>
                </h2>



                <!-- <button type="button" class="btn bg-indigo waves-effect pull-right" data-toggle="modal" data-target="#importModal" style="margin-left:10px"><i class="material-icons">person_add</i><?= languagedata($this->session->userdata('session_language'), "Import Excel"); ?></button> -->

                <!-- <a href="<?= base_url('admin/plamount/add_code'); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Add New PL Amount"); ?></a> -->

                <a href="<?= base_url('admin/plcode/reports'); ?>" class="btn bg-indigo waves-effect pull-right m-l-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Reports"); ?></a>

                <a href="<?= base_url('admin/plamount'); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Back To PL Codes"); ?></a>

            </div>
            <!-- Dropdown for filters -->

            <div class="body">

                <?php echo form_open(base_url('admin/plamount/list'), 'class="inline-form-view form-horizontal filter_record"');  ?>
                <div class="col-md-12">
                    <div class="row clearfix col-md-6">
                        <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="term"><?= languagedata($this->session->userdata('session_language'), "Select Client"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select id="client_id" class="form-control show-tick submit_form" name="client_id">
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
                                    <select id="year" class="form-control show-tick submit_form" name="year">
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
                                <th><?= languagedata($this->session->userdata('session_language'), "Accounting Title"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Before Previous "); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Previous "); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Current "); ?></th>
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
                                <th><?= languagedata($this->session->userdata('session_language'), "Actual<br>(Accumulated)"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($breakdown_cat as $key => $value) {
                                $row = "<tr class='categories' colspan='10' >";

                                $row .= "<td>" . $value['name'] . "</td>";

                                $row .= "</tr>";
                                echo $row;

                                // Generate Extra 10 rows for accouting codes
                                // $counter = 0;
                                $category = $value['id'];
                                $sql = "SELECT * FROM ci_pl_amount where category='$category' and year='$year' and client_id='$client_id' ";
                                $query = $this->db->query($sql);
                                foreach ($query->result_array() as $row) {


                                    $data = !empty($row['data']) ? json_decode($row['data'], true) : 0;

                                    $total_amount = (int) $data['jan']  + (int)$data['feb'] + (int)$data['mar'] + (int)$data['apr'] + (int)$data['may'] + (int)$data['jun'] + (int)$data['jul'] + (int)$data['aug'] + (int)$data['sep'] + (int)$data['oct'] + (int)$data['nov'] + (int)$data['dec'];
                                    // echo "<pre>"; print_r($row['code']); die;
                                    $id = $row['id'];
                                    $row = "<tr data-row_id=$id>";

                                    $options = '';
                                    // $code = $row['code'];

                                    foreach ($pl_codes as $key1 => $value1) {
                                        $options .= "<option value='" . $value1['id'] . "' 
                                        " . ($code == $value1['id'] ? "selected" : "") .
                                            ">" . $value1['title'] . "</option>";
                                    }

                                    $row .= "<td><select class='form-control get_amount_data'>" . $options . "</select></td>";

                                    $row .= "<td><input readonly type='text' class='form-control'></td>";

                                    $row .= "<td><input readonly type='text' class='form-control'></td>";

                                    $row .= "<td><input readonly type='text' class='form-control'></td>";

                                    $row .= "<td><input type='number' class='jan form-control' name='jan' value=" . $data['jan'] . "></td>";

                                    $row .= "<td><input type='number' class='feb form-control' name='feb' value=" . $data['feb'] . "></td>";

                                    $row .= "<td><input type='number' class='mar form-control' name='mar' value=" . $data['mar'] . "></td>";

                                    $row .= "<td><input type='number' class='apr form-control' name='apr' value=" . $data['apr'] . "></td>";

                                    $row .= "<td><input type='number' class='may form-control' name='may' value=" . $data['may'] . "></td>";

                                    $row .= "<td><input type='number' class='jun form-control' name='jun' value=" . $data['jun'] . "></td>";

                                    $row .= "<td><input type='number' class='jul form-control' name='jul' value=" . $data['jul'] . "></td>";

                                    $row .= "<td><input type='number' class='aug form-control' name='aug' value=" . $data['aug'] . "></td>";

                                    $row .= "<td><input type='number' class='sep form-control' name='sep' value=" . $data['sep'] . "></td>";

                                    $row .= "<td><input type='number' class='oct form-control' name='oct' value=" . $data['oct'] . "></td>";

                                    $row .= "<td><input type='number' class='nov form-control' name='nov' value=" . $data['nov'] . "></td>";

                                    $row .= "<td><input type='number' class='dec form-control' name='dec' value=" . $data['dec'] . "></td>";

                                    // // Show total amount row bise
                                    $row .= "<td><input readonly class='form-control' type='text' class='total_amount' value=$total_amount></td>";

                                    $row .= "</tr>";
                                    echo $row;
                                }
                            }
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
                <form action="<?php echo base_url('admin/plamount/import_excel'); ?>" method="POST" enctype="multipart/form-data">

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

<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>



<!-- Autosize Plugin Js -->
<script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script>
<!-- Custom Js -->
<script src="<?= base_url() ?>public/js/pages/tables/jquery-datatable.js"></script>
<script>
    // $("#na_datatable").DataTable({
    //     "bPaginate": false,
    //     dom: 'Bfrtip',
    //     buttons: [{
    //             extend: 'excel',
    //             title: 'PL Report Monthly',
    //             exportOptions: {
    //                 format: {
    //                     body: function(inner, rowidx, colidx, node) {
    //                         if ($(node).children("input").length > 0) {
    //                             return $(node).children("input").first().val();
    //                         } else {
    //                             return inner;
    //                         }
    //                     }
    //                 }
    //             }
    //         },
    //         {
    //             extend: 'pdf',
    //             title: 'PL Report Monthly',
    //             exportOptions: {
    //                 format: {
    //                     body: function(inner, rowidx, colidx, node) {
    //                         if ($(node).children("input").length > 0) {
    //                             return $(node).children("input").first().val();
    //                         } else {
    //                             return inner;
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     ]
    // });

    //Textare auto growth
    autosize($('textarea.auto-growth'));

    //Delete Dialogue
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    $("#pl_import_amount").addClass('active');

    $(".submit_form").change(function() {
        // alert('h');
        $(".filter_record").submit();
    });


    $(document).on("change", ".get_amount_data", function() {
        var element = $(this);
        var code = $(this).val();
        if (code != '') {
            var url = "<?= base_url('admin/plamount/get_data') ?>";
            var year = $('#year').val();
            var client_id = $('#client_id').val();
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    'code': code,
                    'year': year,
                    'client_id': client_id,
                    'csrf_test_name': $('input[name="csrf_test_name"]:first').val()
                },
                success: function(resultData) {
                    var myObject = JSON.parse(resultData);
                    var res = JSON.parse(myObject.data);
                    console.log(res)
                    $.each(res, function(key, value) {

                        element.closest("tr").find("." + key.substr(0, 3)).val(value);
                    });

                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
            });
        }
    });

    $(document).on("focusout", "td input", function() {

        // Update Value On Right and bottom
        var total_amount = 0;
        var data = {};
        $(this).closest('tr').find("input[type='number']").each(function(i) {
            if ($(this).attr("name") == "total_amount") return false;
            data[$(this).attr("name")] = $(this).val();

            total_amount = parseInt(total_amount) + (parseInt($(this).val()) || 0);

        });

        $(this).closest('tr').find('.total_amount').val(total_amount);
        var id = $(this).closest('tr').data('row_id');

        // get code title and name here
        var selected_code = $(this).closest('tr').find('.get_amount_data :selected').val();
        var selected_title = $(this).closest('tr').find('.get_amount_data :selected').text();



        var url = "<?= base_url('admin/plamount/save_data') ?>";
        var year = $('#year').val();
        var client_id = $('#client_id').val();
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'id': id,
                'form_data': data,
                'code': selected_code,
                'title': selected_title,
                'csrf_test_name': $('input[name="csrf_test_name"]:first').val()
            },
            success: function(resultData) {
                // alert('Data Saved Successfully.')
            },
            error: function(xhr, status, error) {
                console.log(error);
            },
        });

    });
</script>