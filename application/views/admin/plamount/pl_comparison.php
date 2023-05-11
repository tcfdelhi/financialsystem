<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- Exportable Table -->
<style>
    section.content {
        margin: 71px 0 0 0px !important;
    }

    #leftsidebar {
        display: none !important;
    }

    table td {
        border: 1px solid #000000;
    }

    table thead {
        background-color: #9bc2e6;
    }

    table tbody p {
        color: #000;
        margin: 0;
    }

    table {
        margin-top: 50px;
        background-color: #ccc;
    }

    table thead td,
    table thead td strong {
        text-align: center;
        vertical-align: middle;
    }


    th,
    td {
        padding: 15px;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="header" style="display: flex;">
                <h2 style="text-align:center;margin:auto">
                    <?= languagedata($this->session->userdata('session_language'), "Pl Comparison"); ?>
                </h2>


            </div>
            <div class="body">


                <div class="table-responsive">
                    <!-- <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable"> -->
                    <table class="col-md-5" style="width:49%">
                        <thead>
                            <tr>
                                <td rowspan="2" colspan="3">
                                    <p><strong>Accounting Title</strong></p>
                                </td>
                                <td colspan="2">
                                    <p><strong>Previous</strong></p>
                                </td>
                                <td colspan="2">
                                    <p><strong>Current</strong></p>
                                </td>
                                <td colspan="2">
                                    <p><strong>Difference</strong></p>
                                </td>
                            </tr>
                            <tr rowspan="">

                                <td colspan="">
                                    <p><strong>Amount</strong></p>
                                </td>
                                <td>%</td>
                                <td>
                                    <p><strong>Amount</strong></p>
                                </td>
                                <td>%</td>
                                <td>
                                    <p><strong>Amount</strong></p>
                                </td>
                                <td>%</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            for ($i = 0; $i < 6; $i++) :
                            ?>
                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td>
                                        <?php if ($i == 0) echo "Sales";
                                        else if ($i == 1) echo "Beginning balance of finished goods";
                                        else echo "Marketable securities (Other)";
                                        ?>
                                    </td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>

                                </tr>
                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td>

                                        <?php if ($i == 0) echo "A02Deposit";
                                        else if ($i == 1) echo "A03A/R(OCPS";
                                        else echo "Marketable securities (Other)";
                                        ?>
                                    </td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>

                                </tr>

                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td>
                                        <?php if ($i == 0) echo "Sales Other";
                                        else if ($i == 1) echo "Ending balance of finished goods";
                                        else echo "P21Salary";
                                        ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                            <?php endfor; ?>

                        </tbody>

                    </table>

                    <div class="col-md-2" style="width:2%"></div>
                    <table class="col-md-5" style="width:49%">
                        <thead>
                            <tr>
                                <td rowspan="2" colspan="3">
                                    <p><strong>Accounting Title</strong></p>
                                </td>
                                <td colspan="2">
                                    <p><strong>Previous</strong></p>
                                </td>
                                <td colspan="2">
                                    <p><strong>Current</strong></p>
                                </td>
                                <td colspan="2">
                                    <p><strong>Difference</strong></p>
                                </td>
                            </tr>
                            <tr rowspan="">

                                <td colspan="">
                                    <p><strong>Amount</strong></p>
                                </td>
                                <td>%</td>
                                <td>
                                    <p><strong>Amount</strong></p>
                                </td>
                                <td>%</td>
                                <td>
                                    <p><strong>Amount</strong></p>
                                </td>
                                <td>%</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            for ($i = 0; $i < 6; $i++) :
                            ?>
                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td>
                                        <?php if ($i == 0) echo "Sales";
                                        else if ($i == 1) echo "Beginning balance of finished goods";
                                        else echo "Marketable securities (Other)";
                                        ?>
                                    </td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>

                                </tr>
                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td>

                                        <?php if ($i == 0) echo "A02Deposit";
                                        else if ($i == 1) echo "A03A/R(OCPS";
                                        else echo "Marketable securities (Other)";
                                        ?>
                                    </td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>
                                    <td><?= (number_format(rand(1000000, 1009900))); ?></td>
                                    <td><?= (number_format(rand(1, 100))); ?></td>

                                </tr>

                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <td colspan="1" style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td style="width: 20px; border-width: 0px 0px 0px 1px;"></td>
                                    <td>
                                        <?php if ($i == 0) echo "Sales Other";
                                        else if ($i == 1) echo "Ending balance of finished goods";
                                        else echo "P21Salary";
                                        ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                            <?php endfor; ?>

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
                <form action="<?php echo base_url('admin/bsamount/import_excel_new'); ?>" method="POST" enctype="multipart/form-data">

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