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
                    <?= languagedata($this->session->userdata('session_language'), "PL Code Reports"); ?>
                </h2>

                <a href="<?= base_url("admin/plamount/list/$year/$client_id"); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Back To Amount"); ?></a>

                <a href="<?= base_url("admin/plamount/gross_profit/3"); ?>" class="btn bg-indigo waves-effect pull-right m-r-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Gross Profit 3 Year Comparison"); ?></a>

                <a href="<?= base_url("admin/plamount/gross_profit/3"); ?>" class="btn bg-indigo waves-effect pull-right m-r-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Ordinary Profit 3 Year Comparison"); ?></a>

                <a href="<?= base_url("admin/plamount/gross_profit/3"); ?>" class="btn bg-indigo waves-effect pull-right m-r-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Annual Graph"); ?></a>

            </div>
            <!-- Dropdown for filters -->

            <div class="body">

                <?php echo form_open(base_url('admin/plcode/reports'), 'class="inline-form-reports  form-horizontal filter_record"');  ?>
                <div class="col-md-12">

                    <div class="row clearfix col-md-4">
                        <div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password"><?= languagedata($this->session->userdata('session_language'), "Select Bs Code"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick submit_form" name="pl_code">
                                        <?php foreach ($code_data as $group) : ?>
                                            <option value="<?= $group['code']; ?>" <?= ($pl_code == $group['code'] ? "selected" : "") ?>><?= $group['code'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix col-md-4">
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



                    <div class="row clearfix col-md-4">
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

                    <div id="chartContainer" class="col-md-12" style="height: 370px; width: 100%;"></div>

                </div>
                <?php echo form_close(); ?>



            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Annually Report"
            },
            axisY: {
                title: "Amount "
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
    $("#pl_code").addClass('active');
    $("#pl_reports").addClass('active');

    $(".submit_form").change(function() {
        $(".filter_record").submit();
    });
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>