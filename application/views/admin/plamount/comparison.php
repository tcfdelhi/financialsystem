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

                <?php //echo "<pre>"; print_r($graph); die; 
                ?>


                <!-- 
                <div class="row clearfix col-md-6">
                    <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="term"><?= languagedata($this->session->userdata('session_language'), "Select Years"); ?><span class="red"> *</span></label>
                    </div>
                    <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <select id="client_id" class="form-control show-tick change_year" name="client_id">
                                    <option value="1" <?= $yearCount == 1 ? 'selected' : '' ?>>1 Year</option>
                                    <option value="2" <?= $yearCount == 2 ? 'selected' : '' ?>>2 Years</option>
                                    <option value="3" <?= $yearCount == 3 ? 'selected' : '' ?>>3 Years</option>
                                    <option value="4" <?= $yearCount == 4 ? 'selected' : '' ?>>4 Year</option>
                                    <option value="5" <?= $yearCount == 5 ? 'selected' : '' ?>>5 Year</option>
                                    <option value="6" <?= $yearCount == 6 ? 'selected' : '' ?>>6 Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> -->


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
                        <h4 for="term"><?= languagedata($this->session->userdata('session_language'), $categoryName." 3 Years Comparison Data"); ?></h4>
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
                                <td>F.Y.2022</td>
                                <td><?= $amount_data['2022']['Jan'] ?></td>
                                <td><?= $amount_data['2022']['Feb'] ?></td>
                                <td><?= $amount_data['2022']['Mar'] ?></td>
                                <td><?= $amount_data['2022']['Apr'] ?></td>
                                <td><?= $amount_data['2022']['May'] ?></td>
                                <td><?= $amount_data['2022']['Jun'] ?></td>
                                <td><?= $amount_data['2022']['Jul'] ?></td>
                                <td><?= $amount_data['2022']['Aug'] ?></td>
                                <td><?= $amount_data['2022']['Sep'] ?></td>
                                <td><?= $amount_data['2022']['Oct'] ?></td>
                                <td><?= $amount_data['2022']['Nov'] ?></td>
                                <td><?= $amount_data['2022']['Dec'] ?></td>
                            </tr>

                            <tr>
                                <td>Year-on-Year-rate</td>
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
                                <td>F.Y.2021</td>
                                <td><?= $amount_data['2021']['Jan'] ?></td>
                                <td><?= $amount_data['2021']['Feb'] ?></td>
                                <td><?= $amount_data['2021']['Mar'] ?></td>
                                <td><?= $amount_data['2021']['Apr'] ?></td>
                                <td><?= $amount_data['2021']['May'] ?></td>
                                <td><?= $amount_data['2021']['Jun'] ?></td>
                                <td><?= $amount_data['2021']['Jul'] ?></td>
                                <td><?= $amount_data['2021']['Aug'] ?></td>
                                <td><?= $amount_data['2021']['Sep'] ?></td>
                                <td><?= $amount_data['2021']['Oct'] ?></td>
                                <td><?= $amount_data['2021']['Nov'] ?></td>
                                <td><?= $amount_data['2021']['Dec'] ?></td>
                            </tr>

                            <tr>
                                <td>Year-on-Year-rate</td>
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
                                <td>F.Y.2020</td>
                                <td><?= $amount_data['2020']['Jan'] ?></td>
                                <td><?= $amount_data['2020']['Feb'] ?></td>
                                <td><?= $amount_data['2020']['Mar'] ?></td>
                                <td><?= $amount_data['2020']['Apr'] ?></td>
                                <td><?= $amount_data['2020']['May'] ?></td>
                                <td><?= $amount_data['2020']['Jun'] ?></td>
                                <td><?= $amount_data['2020']['Jul'] ?></td>
                                <td><?= $amount_data['2020']['Aug'] ?></td>
                                <td><?= $amount_data['2020']['Sep'] ?></td>
                                <td><?= $amount_data['2020']['Oct'] ?></td>
                                <td><?= $amount_data['2020']['Nov'] ?></td>
                                <td><?= $amount_data['2020']['Dec'] ?></td>
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

        new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));

    });

    function getChartJs(type) {
        var config = null;


        if (type === 'bar') {
            config = {
                type: 'bar',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                            label: "2022",
                            data: [<?= $amount_data['2022']['Jan'] . ',' . $amount_data['2022']['Feb'] . ',' . $amount_data['2022']['Mar'] . ',' . $amount_data['2022']['Apr'] . ',' . $amount_data['2022']['May'] . ',' . $amount_data['2022']['Jun'] . ',' . $amount_data['2022']['Jul'] . ',' . $amount_data['2022']['Aug'] . ',' . $amount_data['2022']['Sep'] . ',' . $amount_data['2022']['Oct'] . ',' . $amount_data['2022']['Nov'] . ',' . $amount_data['2022']['Dec'] ?>],
                            backgroundColor: 'rgb(255, 248, 220)'
                        },
                        {
                            label: "2021",
                            data: [<?= $amount_data['2021']['Jan'] . ',' . $amount_data['2021']['Feb'] . ',' . $amount_data['2021']['Mar'] . ',' . $amount_data['2021']['Apr'] . ',' . $amount_data['2021']['May'] . ',' . $amount_data['2021']['Jun'] . ',' . $amount_data['2021']['Jul'] . ',' . $amount_data['2021']['Aug'] . ',' . $amount_data['2021']['Sep'] . ',' . $amount_data['2021']['Oct'] . ',' . $amount_data['2021']['Nov'] . ',' . $amount_data['2021']['Dec'] ?>],
                            backgroundColor: 'rgb(201, 204, 63)'
                        },

                        {
                            label: "2020",
                            data: [<?= $amount_data['2020']['Jan'] . ',' . $amount_data['2020']['Feb'] . ',' . $amount_data['2020']['Mar'] . ',' . $amount_data['2020']['Apr'] . ',' . $amount_data['2020']['May'] . ',' . $amount_data['2020']['Jun'] . ',' . $amount_data['2020']['Jul'] . ',' . $amount_data['2020']['Aug'] . ',' . $amount_data['2020']['Sep'] . ',' . $amount_data['2020']['Oct'] . ',' . $amount_data['2020']['Nov'] . ',' . $amount_data['2020']['Dec'] ?>],
                            backgroundColor: 'rgb(0, 255, 255)'
                        }
                    ]
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