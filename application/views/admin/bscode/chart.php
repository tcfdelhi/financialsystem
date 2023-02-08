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
                    <?= languagedata($this->session->userdata('session_language'), "BS Code Reports"); ?>
                </h2>
            </div>
            <!-- Dropdown for filters -->

            <div class="body">

                <?php echo form_open(base_url('admin/bscode/reports'), 'class="form-inline inline-form-reports  form-horizontal filter_record"');  ?>
                <div class="col-md-12">


                    <!-- 
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
                    </div> -->

                    <!-- 
                    <div class="row clearfix col-md-4">
                        <div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password"><?= languagedata($this->session->userdata('session_language'), "Select Financial Year"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick submit_form" name="year1">
                                        <?php foreach ($years as $group) : ?>
                                            <option value="<?= $group['year']; ?>" <?= ($year == $group['year'] ? "selected" : "") ?>><?= $group['year'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="table-responsive">
                        <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th><?= languagedata($this->session->userdata('session_language'), "Item"); ?></th>
                                    <th>F.Y. 2021 (Fund Operation, Fund Procurement)</th>
                                    <th>F.Y. 2022 (Fund Operation, Fund Procurement)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cash & Cash Equivalent</td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="cash1" value="3">
                                        <input type="text" class="form-control" id="cash2" value="3">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="cash3" value="3">
                                        <input type="text" class="form-control" id="cash4" value="3">
                                    </td>

                                </tr>
                                <tr>
                                    <td>Account Receivable Trade</td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="acc1">
                                        <input type="text" class="form-control" value="" id="acc2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="acc3">
                                        <input type="text" class="form-control" value="" id="acc4">
                                    </td>

                                </tr>
                                <tr>
                                    <td>Inventory</td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="inv1">
                                        <input type="text" class="form-control" id="inv2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="inv3">
                                        <input type="text" class="form-control" id="inv4">
                                    </td>

                                </tr>
                                <tr>
                                    <td>Other Current Asset</td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="oth1">
                                        <input type="text" class="form-control" id="oth2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="oth3">
                                        <input type="text" class="form-control" id="oth4">
                                    </td>

                                </tr>
                                <tr>
                                    <td>Fixed Asset</td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="fix1">
                                        <input type="text" class="form-control" id="fix2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="fix3">
                                        <input type="text" class="form-control" id="fix4">
                                    </td>

                                </tr>
                                <tr>
                                    <td>Account Payable Trade</td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="ap1">
                                        <input type="text" class="form-control" id="ap2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control m-r-50" id="ap3">
                                        <input type="text" class="form-control" id="ap4">
                                    </td>

                                </tr>
                                <!-- <tr>
                                    <td>Current Libality</td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>

                                </tr>
                                <tr>
                                    <td>Short Term Loan Payable</td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>

                                </tr> -->
                                <!-- <tr>
                                    <td>Fixed Libality(Other)</td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>

                                </tr>
                                <tr>
                                    <td>Long Term Loan Payable</td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>

                                </tr>
                                <tr>
                                    <td>Equity</td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>

                                </tr> -->
                                <tr>
                                    <td>Total</td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control m-r-50"><input type="text" class="form-control"></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-primary generate_chart">Generate Chart</button>

                    <canvas id="chartContainer" width="100%" height="29px"></canvas>

                </div>
                <?php echo form_close(); ?>


            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {

        var mychart;
        function generate_chart() {

            mychart = new Chart(document.getElementById("chartContainer"), {
                type: 'bar',
                data: {
                    labels: ["F.Y. 2021", "F.Y. 2022"],
                    datasets: [{
                            label: "Cash & Cash Equivalent",
                            type: "bar",
                            stack: "Base",
                            backgroundColor: "#eece01",
                            data: [$("#cash1").val(), $("#cash3").val()],
                        },
                        {
                            label: "Account Receivable Trade",
                            type: "bar",
                            stack: "Base",
                            backgroundColor: "#87d84d",
                            data: [$("#acc1").val(), $("#acc3").val()],
                        },
                        {
                            label: "Inventory",
                            type: "bar",
                            stack: "Base",
                            backgroundColor: "#3F51B5",
                            data: [$("#inv1").val(), $("#inv3").val()],
                        },
                        {
                            label: "Other Current Asset",
                            type: "bar",
                            stack: "Base",
                            backgroundColor: "#1f91f3",
                            data: [$("#oth1").val(), $("#oth3").val()],
                        },
                        {
                            label: "Fixed Asset",
                            type: "bar",
                            stack: "Base",
                            backgroundColor: "#FF5733",
                            data: [$("#fix1").val(), $("#fix3").val()],
                        },
                        {
                            label: "Account Payable Trade",
                            type: "bar",
                            stack: "Base",
                            backgroundColor: "#692415",
                            data: [$("#ap1").val(), $("#ap3").val()],
                        },

                        {
                            label: "Cash & Cash Equivalent",
                            type: "bar",
                            stack: "Sensitivity",
                            backgroundColor: "#f8981f",
                            data: [$("#cash2").val(), $("#cash4").val()],
                        },
                        {
                            label: "Account Receivable Trade",
                            type: "bar",
                            stack: "Sensitivity",
                            backgroundColor: "#00b300",
                            backgroundColorHover: "#3e95cd",
                            data: [$("#acc2").val(), $("#acc4").val()],
                        },
                        {
                            label: "Inventory",
                            type: "bar",
                            stack: "Sensitivity",
                            backgroundColor: "#3F51B5",
                            backgroundColorHover: "#3e95cd",
                            data: [$("#inv2").val(), $("#inv4").val()],
                        },
                        {
                            label: "Other Current Asset",
                            type: "bar",
                            stack: "Sensitivity",
                            backgroundColor: "#1f91f3",
                            data: [$("#oth2").val(), $("#oth4").val()],
                        },
                        {
                            label: "Fixed Asset",
                            type: "bar",
                            stack: "Sensitivity",
                            backgroundColor: "#FF5733",
                            data: [$("#fix2").val(), $("#fix4").val()],
                        },
                        {
                            label: "Account Payable Trade",
                            type: "bar",
                            stack: "Sensitivity",
                            backgroundColor: "#692415",
                            data: [$("#ap2").val(), $("#ap4").val()],
                        },
                    ]
                },
                options: {
                    scales: {
                        xAxes: [{
                            //stacked: true,
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                maxRotation: 0,
                                minRotation: 0
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                        }]
                    },
                }
            });
        }

        generate_chart()
        $(".generate_chart").click(function() {
            mychart.destroy();
            generate_chart();
        });

    }
    $("#bs_code").addClass('active');
    $("#bs_chart").addClass('active');

    $(".submit_form").change(function() {
        $(".filter_record").submit();
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>