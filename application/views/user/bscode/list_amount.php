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

    .table-bordered tbody tr td,
    .table-bordered tbody tr th {
        padding: 1px;
        border: 1px solid #eee;
    }

    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 1px 1px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
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

                <!-- <a href="<?= base_url('user/bsamount/add_code'); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Add New PL Amount"); ?></a> -->

                <a href="<?= base_url("user/bscode/reports/$year/$client_id"); ?>" class="btn bg-indigo waves-effect pull-right m-l-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Reports"); ?></a>

                <a href="<?= base_url("user/bscode/list/$year/$client_id"); ?>" class="btn bg-indigo waves-effect pull-right m-l-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Back To PL Codes"); ?></a>


                <a target="_blank" href="<?= base_url("user/bsamount/report/$client_id/$year"); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Approve Sheet"); ?></a>

            </div>
            <!-- Dropdown for filters -->

            <div class="body">

                <?php echo form_open(base_url('user/bscode/amount'), 'class="inline-form-view form-horizontal filter_record"');  ?>
                <div class="col-md-12">
                    
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
      
                    
                </div>
                <?php echo form_close(); ?>
                <div class="table-responsive">
                    <?php echo form_open(base_url('user/bsamount/save_data'), 'class="save_data"');  ?>

                    <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                            <tr>
                                <th><?= languagedata($this->session->userdata('session_language'), "Accounting Code"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Accounting Title"); ?></th>
                                
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
                            foreach ($breakdown_cat as $key => $value) {

                                $january = $february = $march = $april = $may1 = $june = $july = $august = $september = $october = $november = $december = 0;

                                $row = "<tr class='categories' colspan='10' >";

                                $row .= "<td></td>";
                                $row .= "<td>" . $value['name'] . "</td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";                                  
                                $row .= "<td></td>"; 

                                $row .= "</tr>";
                                echo $row;

                                // Generate Extra 10 rows for accouting codes
                                // $counter = 0;
                                $category = $value['id'];
                                $sql = "SELECT * FROM ci_bs_amount_data_new where category='$category' and year='$year' and client_id='$client_id' ";
                                $query = $this->db->query($sql);
                                $counter = 1;
                                foreach ($query->result_array() as $key => $result) {

                                    $data = !empty($result['data']) ? json_decode($result['data'], true) : 0;

                                    $jan = str_replace(",", "", $data['Jan']);
                                    $january = str_replace(",", "", (int)$january) + (int)$jan;

                                    $feb = str_replace(",", "", $data['Feb']);
                                    $february = str_replace(",", "", (int)$february) + (int)$feb;

                                    $mar = str_replace(",", "", $data['Mar']);
                                    $march = str_replace(",", "", (int)$march) + (int)$mar;

                                    $apr = str_replace(",", "", $data['Apr']);
                                    $april = str_replace(",", "", (int)$april) + (int)$apr;

                                    $may1 = str_replace(",", "", $data['May']);
                                    $may = str_replace(",", "", (int)$may) + (int)$may1;

                                    $jun = str_replace(",", "", $data['Jun']);
                                    $june = str_replace(",", "", (int)$june) + (int)$jun;


                                    $jul = str_replace(",", "", $data['Jul']);
                                    $july = str_replace(",", "", (int)$july) + (int)$jul;

                                    $aug = str_replace(",", "", $data['Aug']);
                                    $august = str_replace(",", "", (int)$august) + (int)$aug;

                                    $sep = str_replace(",", "", $data['Sep']);
                                    $september = str_replace(",", "", (int)$september) + (int)$sep;

                                    $oct = str_replace(",", "", $data['Oct']);
                                    $october = str_replace(",", "", (int)$october) + (int)$oct;

                                    $nov = str_replace(",", "", $data['Nov']);
                                    $november = str_replace(",", "", (int)$november) + (int)$nov;

                                    $dec = str_replace(",", "", $data['Dec']);
                                    $december = str_replace(",", "", (int)$december) + (int)$dec;

                                    $total_amount =
                                        (int)str_replace(",", "", $data['jan'])  +
                                        (int)str_replace(",", "", $data['feb']) +
                                        (int)str_replace(",", "", $data['mar']) +
                                        (int)str_replace(",", "", $data['apr']) +
                                        (int)str_replace(",", "", $data['may']) +
                                        (int)str_replace(",", "", $data['jun']) +
                                        (int)str_replace(",", "", $data['jul']) +
                                        (int)str_replace(",", "", $data['aug']) +
                                        (int)str_replace(",", "", $data['sep']) +
                                        (int)str_replace(",", "", $data['oct']) +
                                        (int)str_replace(",", "", $data['nov']) +
                                        (int)str_replace(",", "", $data['dec']);
                                    // echo "<pre>"; print_r($row['code']); die;
                                    $id = $result['id'];
                                    $row = "<tr data-row_id=$id>";

                                    $row .= "<td>".$result['code']."</td>";
                                    $row .= "<td>".$result['title']."</td>";

                                
                                    $row .= "<td><input type='text' class='loop_month jan form-control' name='Jan' value=" . $data['Jan'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month feb form-control' name='Feb' value=" . $data['Feb'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month mar form-control' name='Mar' value=" . $data['Mar'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month apr form-control' name='Apr' value=" . $data['Apr'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month may form-control' name='May' value=" . $data['May'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month jun form-control' name='Jun' value=" . $data['Jun'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month jul form-control' name='Jul' value=" . $data['Jul'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month aug form-control' name='Aug' value=" . $data['Aug'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month sep form-control' name='Sep' value=" . $data['Sep'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month oct form-control' name='Oct' value=" . $data['Oct'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month nov form-control' name='Nov' value=" . $data['Nov'] . "></td>";

                                    $row .= "<td><input type='text' class='loop_month dec form-control' name='Dec' value=" . $data['Dec'] . "></td>";


                                    $row .= "</tr>";
                                    echo $row;
                                }
                                // Two extra rows for total

                                $row = "<tr>";

                                $row .= "<td>Total  " . $value['name'] . "</td>";


                                $row .= "<td></td>";


                                $row .= "<td><input type='text' readonly class='jan form-control' name='jan' value=" . number_format($january) . "></td>";

                                $row .= "<td><input type='text' readonly class='feb form-control' name='feb' value=" . number_format($february) . "></td>";

                                $row .= "<td><input type='text' readonly class='mar form-control' name='mar' value=" . number_format($march) . "></td>";

                                $row .= "<td><input type='text' readonly class='apr form-control' name='apr' value=" . number_format($april) . "></td>";

                                $row .= "<td><input type='text' readonly class='may form-control' name='may' value=" . number_format($may) . "></td>";

                                $row .= "<td><input type='text' readonly class='jun form-control' name='jun' value=" . number_format($june) . "></td>";

                                $row .= "<td><input type='text' readonly class='jul form-control' name='jul' value=" . number_format($july) . "></td>";

                                $row .= "<td><input type='text' readonly class='aug form-control' name='aug' value=" . number_format($august) . "></td>";

                                $row .= "<td><input type='text' readonly class='sep form-control' name='sep' value=" . number_format($september) . "></td>";

                                $row .= "<td><input type='text' readonly class='oct form-control' name='oct' value=" . number_format($october) . "></td>";

                                $row .= "<td><input type='text' readonly class='nov form-control' name='nov' value=" . number_format($november) . "></td>";

                                $row .= "<td><input type='text' readonly class='dec form-control' name='dec' value=" . number_format($december) . "></td>";

                             

                                $row .= "</tr>";
                                echo $row;
                                $row = "<tr>";

                                $row .= "<td>Total " . $value['name'] . " (Last Year)</td>";

                                $row .= "<td><input readonly type='text' class='form-control'></td>";

                                $row .= "<td><input readonly type='text' class='form-control'></td>";

                                $row .= "<td><input readonly type='text' class='form-control'></td>";

                                $row .= "<td><input type='number' readonly class='jan form-control' name='jan' value=" . $data['jan'] . "></td>";

                                $row .= "<td><input type='number' readonly class='feb form-control' name='feb' value=" . $data['feb'] . "></td>";

                                $row .= "<td><input type='number' readonly class='mar form-control' name='mar' value=" . $data['mar'] . "></td>";

                                $row .= "<td><input type='number' readonly class='apr form-control' name='apr' value=" . $data['apr'] . "></td>";

                                $row .= "<td><input type='number' readonly class='may form-control' name='may' value=" . $data['may'] . "></td>";

                                $row .= "<td><input type='number' readonly class='jun form-control' name='jun' value=" . $data['jun'] . "></td>";

                                $row .= "<td><input type='number' readonly class='jul form-control' name='jul' value=" . $data['jul'] . "></td>";

                                $row .= "<td><input type='number' readonly class='aug form-control' name='aug' value=" . $data['aug'] . "></td>";

                                $row .= "<td><input type='number' readonly class='sep form-control' name='sep' value=" . $data['sep'] . "></td>";

                                $row .= "<td><input type='number' readonly class='oct form-control' name='oct' value=" . $data['oct'] . "></td>";

                                $row .= "<td><input type='number' readonly class='nov form-control' name='nov' value=" . $data['nov'] . "></td>";

                                $row .= "<td><input type='number' readonly class='dec form-control' name='dec' value=" . $data['dec'] . "></td>";

                                // // Show total amount row bise
                                $row .= "<td><input readonly class='form-control' type='text' class='total_amount' value=$total_amount></td>";

                                $row .= "</tr>";
                                // echo $row;
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
                <form action="<?php echo base_url('user/bsamount/import_excel'); ?>" method="POST" enctype="multipart/form-data">

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
                    <a href="<?= base_url('uploads/bscode/BS_Import_Acc_code_Form.xlsx') ?>"><?= languagedata($this->session->userdata('session_language'), "Download Sample File"); ?></a>

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
        var id = $(this).closest('tr').data('row_id');
        if (code != '') {
            var url = "<?= base_url('user/bsamount/get_data') ?>";
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

                    // Save Data also
                    $.post("<?= base_url('user/bsamount/save_data') ?>", {
                        row_id: 'onChange',
                        id: id,
                        form_data: resultData,
                        csrf_test_name: $('input[name="csrf_test_name"]:first').val()
                    });


                    // console.log(resultData)
                    var myObject = JSON.parse(resultData);
                    var res = JSON.parse(myObject.data);
                    // console.log(res)
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
        $(this).closest('tr').find("input.loop_month").each(function(i) {
            if ($(this).attr("name") == "total_amount") return false;
            data[$(this).attr("name")] = $(this).val();

            // total_amount = parseInt(total_amount) + (parseInt($(this).val()) || 0);

        });

        // $(this).closest('tr').find('.total_amount').val(total_amount);
        var id = $(this).closest('tr').data('row_id');

        // // get code title and name here
        // var selected_code = $(this).closest('tr').find('.get_amount_data :selected').val();
        // var selected_title = $(this).closest('tr').find('.get_amount_data :selected').text();



        var url = "<?= base_url('user/bsamount/save_data') ?>";
        var year = $('#year').val();
        var client_id = $('#client_id').val();
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'id': id,
                'form_data': data,
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