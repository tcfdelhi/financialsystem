<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- Exportable Table -->
<div class="container-fluid">
    <div class="block-header">
        <h3 class="text-center"><?= languagedata($this->session->userdata('session_language'), "Name List"); ?></h3>
    </div>
    <!-- Basic Card -->
    <div class="row clearfix">

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <?= languagedata($this->session->userdata('session_language'), "Major items of BS"); ?>
                    </h2>
                </div>
                <div class="body">
                    <?php
                    foreach ($major_items as $key => $value) {
                        echo "<p>" . $value['name'] . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <?= languagedata($this->session->userdata('session_language'), "Medium item of BS"); ?>
                    </h2>
                </div>
                <div class="body">
                    <?php
                    foreach ($medium_items as $key => $value) {
                        echo "<p>" . $value['name'] . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <?= languagedata($this->session->userdata('session_language'), "Cash Flow category"); ?>
                    </h2>
                </div>
                <div class="body">
                <?php
                    foreach ($cash_flow_categories as $key => $value) {
                        echo "<p>" . $value['name'] . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <?= languagedata($this->session->userdata('session_language'), "Increase and Decrease in Cash Flow"); ?>
                    </h2>
                </div>
                <div class="body">
                <?php
                    foreach ($cashflow as $key => $value) {
                        echo "<p>" . $value['cash_flow'] . "</p>";
                    }
                    ?>
                </div>
                </div>
            </div>
        </div>

    </div>
    <!-- #END# Basic Card -->
    <!-- Basic Card - With Loading -->


    <!-- #END# Basic Card - With Loading -->
</div>

<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url() ?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    //---------------------------------------------------
</script>
<!-- Autosize Plugin Js -->
<script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script>
<!-- Custom Js -->
<script src="<?= base_url() ?>public/js/pages/tables/jquery-datatable.js"></script>
<script>
    //Textare auto growth
    autosize($('textarea.auto-growth'));
    $("#pl_code").addClass('active');
    $("#pl_list_view").addClass('active');
</script>