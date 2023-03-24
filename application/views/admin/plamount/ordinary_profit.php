<link href="https://tcg-zaimu-yakusha.com/staging/public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="https://tcg-zaimu-yakusha.com/staging/public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">
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
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2 style="display: inline-block;">
                        <?= languagedata($this->session->userdata('session_language'), "PL Code Amount"); ?>
                        - <?= $year ?>
                    </h2>

                    <a href="<?= base_url("admin/plamount/list/$year/$client_id"); ?>" class="btn bg-indigo waves-effect pull-right m-r-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Back To Breakdown Sheet"); ?></a>
                </div>
                <!-- Dropdown for filters -->

                <div class="body">


                    <div class="table-responsive">
                        <?php echo form_open(base_url('admin/bsamount/save_data'), 'class="save_data"');  ?>


                        <?php echo form_close(); ?>

                    </div>
                </div>

                <div class="row clearfix col-md-4">
                    <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="term"><?= languagedata($this->session->userdata('session_language'), "Select Category"); ?><span class="red"> *</span></label>
                    </div>
                    <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select id="client_id" class="form-control show-tick change_cat" name="client_id">
                                    <?php foreach ($breakdown_cat as $group) : ?>
                                        <option value="<?= $group['id']; ?>" <?= ($categoryId == $group['id'] ? "selected" : "") ?>><?= $group['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix col-md-8">
                    <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <h4 for="term"><?= languagedata($this->session->userdata('session_language'), "Gross Profit 3 Year Comparison Graph"); ?></h4>
                    </div>
                </div>
                <canvas id="bar_chart" height="150"></canvas>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?= languagedata($this->session->userdata('session_language'), "Year"); ?></th>
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
                            <tr>
                                <td>Budget</td>
                                <td><input class="form-control budget b_jan" type="number" value=""></td>
                                <td><input class="form-control budget b_feb" type="number" value=""></td>
                                <td><input class="form-control budget b_mar" type="number" value=""></td>
                                <td><input class="form-control budget b_apr" type="number" value=""></td>
                                <td><input class="form-control budget b_may" type="number" value=""></td>
                                <td><input class="form-control budget b_jun" type="number" value=""></td>
                                <td><input class="form-control budget b_jul" type="number" value=""></td>
                                <td><input class="form-control budget b_aug" type="number" value=""></td>
                                <td><input class="form-control budget b_sep" type="number" value=""></td>
                                <td><input class="form-control budget b_oct" type="number" value=""></td>
                                <td><input class="form-control budget b_nov" type="number" value=""></td>
                                <td><input class="form-control budget b_dec" type="number" value=""></td>
                            </tr>
                            <tr>
                                <td>Achievement rate</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>

                                <td>F.Y.<?= $dataPoints[0]['label'] ?></td>
                                <?php foreach ($dataPoints[0]['data'] as $key => $value) {
                                    echo "<td>$value</td>";
                                } ?>
                            </tr>

                            <tr>
                                <td>Year-on-Year-rate</td>

                                <?php foreach ($dataPoints[0]['data'] as $key => $value) {
                                    echo  "<td>" . ($value != 0 ? round($dataPoints[1]['data'][$key] / $value * 100, 2) : 0) . "%</td>";
                                } ?>
                            </tr>
                            <tr>
                                <td>F.Y.<?= $dataPoints[1]['label'] ?></td>
                                <?php foreach ($dataPoints[1]['data'] as $key => $value) {
                                    echo "<td>$value</td>";
                                } ?>
                            </tr>

                            <tr>
                                <td>Year-on-Year-rate</td>
                                <?php foreach ($dataPoints[1]['data'] as $key => $value) {
                                    echo  "<td>" . ($value != 0 ? round($dataPoints[2]['data'][$key] / $value * 100, 2) : 0) . "%</td>";
                                } ?>
                            </tr>

                            <tr>
                                <td>F.Y.<?= $dataPoints[2]['label'] ?></td>
                                <?php foreach ($dataPoints[2]['data'] as $key => $value) {
                                    echo "<td>$value</td>";
                                } ?>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- #END# Bar Chart -->
</div>

</div>


<!-- ======================= Scripts for this page ============================== -->
<!-- Chart Plugins Js -->
<script src="<?= base_url() ?>public/plugins/chartjs/Chart.bundle.js"></script>
<script>
    $(function() {

        var data = new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));


        $('.budget').focusout(function() {
            console.log(data)
            // You create the new dataset `Vendas` with new data and color to differentiate
            var newDataset = {
                label: "Budget",
                backgroundColor: 'rgba(99, 255, 132, 0.2)',
                borderColor: 'rgba(99, 255, 132, 1)',
                borderWidth: 1,
                data: [$(".b_jan").val(), $(".b_feb").val(), $(".b_mar").val(), $(".b_apr").val(), $(".b_may").val(), $(".b_jun").val(), $(".b_jul").val(), $(".b_aug").val(), $(".b_sep").val(), $(".b_oct").val(), $(".b_nov").val(), $(".b_dec").val()],
            }

            // You add the newly created dataset to the list of `data`
            data.config.data.datasets.splice(3);
            data.config.data.datasets.push(newDataset);

            // You update the chart to take into account the new dataset
            data.update();
        });

    });

    function getChartJs(type) {
        var config = null;


        console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>)
        if (type === 'bar') {
            config = {
                type: 'bar',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                },
                options: {
                    responsive: true,
                    legend: false
                }
            }
        }

        return config;
    }

    $(".change_cat").change(function() {
        var ImageSrcUrl = window.location.href;
        var NewFileName = $(this).val();

        var parts = ImageSrcUrl.split('/');

        parts[parts.length - 1] = NewFileName;
        // alert(parts.join('/'));
        window.location.href = parts.join('/');

    });
</script>