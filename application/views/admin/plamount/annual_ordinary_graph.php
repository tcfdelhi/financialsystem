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

    #bar_chart {
        width: 1850px !important;
        height: 650px !important;
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

                    <a href="<?= base_url("admin/plamount/ordinary_profit/3"); ?>" class="btn bg-indigo waves-effect pull-right m-r-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Ordinary Profit 3 Year Comparison"); ?></a>

                    <a href="<?= base_url("admin/plamount/gross_profit/3"); ?>" class="btn bg-indigo waves-effect pull-right m-r-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Gross Profit 3 Year Comparison"); ?></a>

                    <a href="<?= base_url("admin/plamount/annual_graph/3"); ?>" class="btn bg-indigo waves-effect pull-right m-r-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Annual Graph"); ?></a>

                </div>
                <!-- Dropdown for filters -->

                <div class="body">


                    <div class="table-responsive" style="overflow:auto;">
                        <?php echo form_open(base_url('admin/bsamount/save_data'), 'class="save_data"');  ?>


                        <?php echo form_close(); ?>

                    </div>
                </div>

                <div class=" row clearfix col-md-4">
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
                        <h4 for="term"><?= languagedata($this->session->userdata('session_language'), "Annual ordinary Profit 3 Year Comparison Graph"); ?></h4>
                    </div>
                </div>
                <canvas id="bar_chart"></canvas>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?= languagedata($this->session->userdata('session_language'), "Year"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "January-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "February-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "March-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "April-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "May-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "June-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "July-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "August-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "September-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "October-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "November-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "December-2019"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "January-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "February-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "March-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "April-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "May-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "June-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "July-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "August-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "September-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "October-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "November-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "December-2020"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "January-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "February-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "March-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "April-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "May-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "June-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "July-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "August-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "September-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "October-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "November-2021"); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "December-2021"); ?></th>
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
                                <td><input class="form-control budget c_jan" type="number" value=""></td>
                                <td><input class="form-control budget c_feb" type="number" value=""></td>
                                <td><input class="form-control budget c_mar" type="number" value=""></td>
                                <td><input class="form-control budget c_apr" type="number" value=""></td>
                                <td><input class="form-control budget c_may" type="number" value=""></td>
                                <td><input class="form-control budget c_jun" type="number" value=""></td>
                                <td><input class="form-control budget c_jul" type="number" value=""></td>
                                <td><input class="form-control budget c_aug" type="number" value=""></td>
                                <td><input class="form-control budget c_sep" type="number" value=""></td>
                                <td><input class="form-control budget c_oct" type="number" value=""></td>
                                <td><input class="form-control budget c_nov" type="number" value=""></td>
                                <td><input class="form-control budget c_dec" type="number" value=""></td>
                                <td><input class="form-control budget d_jan" type="number" value=""></td>
                                <td><input class="form-control budget d_feb" type="number" value=""></td>
                                <td><input class="form-control budget d_mar" type="number" value=""></td>
                                <td><input class="form-control budget d_apr" type="number" value=""></td>
                                <td><input class="form-control budget d_may" type="number" value=""></td>
                                <td><input class="form-control budget d_jun" type="number" value=""></td>
                                <td><input class="form-control budget d_jul" type="number" value=""></td>
                                <td><input class="form-control budget d_aug" type="number" value=""></td>
                                <td><input class="form-control budget d_sep" type="number" value=""></td>
                                <td><input class="form-control budget d_oct" type="number" value=""></td>
                                <td><input class="form-control budget d_nov" type="number" value=""></td>
                                <td><input class="form-control budget d_dec" type="number" value=""></td>
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

        var data = new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('line'));


        $('.budget').focusout(function() {

            var newDataset = {
                label: "Budget",
                backgroundColor: 'rgba(99, 255, 132, 0.2)',
                borderColor: 'rgba(99, 255, 132, 1)',
                borderWidth: 1,
                data: [$(".b_jan").val(), $(".b_feb").val(), $(".b_mar").val(), $(".b_apr").val(), $(".b_may").val(), $(".b_jun").val(), $(".b_jul").val(), $(".b_aug").val(), $(".b_sep").val(), $(".b_oct").val(), $(".b_nov").val(), $(".b_dec").val(), $(".c_jan").val(), $(".c_feb").val(), $(".c_mar").val(), $(".c_apr").val(), $(".c_may").val(), $(".c_jun").val(), $(".c_jul").val(), $(".c_aug").val(), $(".c_sep").val(), $(".c_oct").val(), $(".c_nov").val(), $(".c_dec").val(), $(".d_jan").val(), $(".d_feb").val(), $(".d_mar").val(), $(".d_apr").val(), $(".d_may").val(), $(".d_jun").val(), $(".d_jul").val(), $(".d_aug").val(), $(".d_sep").val(), $(".d_oct").val(), $(".d_nov").val(), $(".d_dec").val()],
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
        if (type === 'line') {
            config = {
                type: 'line',
                data: {
                    labels: ["January-2019", "February-2019", "March-2019", "April-2019", "May-2019", "June-2019", "July-2019", "August-2019", "September-2019", "October-2019", "November-2019", "December-2019", "January-2020", "February-2020", "March-2020", "April-2020", "May-2020", "June-2020", "July-2020", "August-2020", "September-2020", "October-2020", "November-2020", "December-2020", "January-2021", "February-2021", "March-2021", "April-2021", "May-2021", "June-2021", "July-2021", "August-2021", "September-2021", "October-2021", "November-2021", "December-2021"],
                    datasets: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                },
                options: {
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    responsive: true
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