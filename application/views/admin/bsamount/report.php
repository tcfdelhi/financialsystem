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

            </div>
            <!-- Dropdown for filters -->

            <div class="body">


                <div class="table-responsive">
                    <?php echo form_open(base_url('admin/bsamount/save_data'), 'class="save_data"');  ?>

                    <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                            <tr>
                                <th><?= languagedata($this->session->userdata('session_language'), "Accounting Title"); ?></th>
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

                                $january = $february = $march = $april = $may1 = $may = $june = $july = $august = $september = $october = $november = $december = $total_amount = $total_prev_year_amount = $total_before_prev_year_amount = $current_year_amount = 0;

                                $row = "<tr class='categories' >";

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
                                $sql = "SELECT * FROM ci_bs_amount_data_new where category='$category' and year='$year' and client_id='$client_id' and data <> '' ";
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


                                    $id = $result['id'];
                                    $row = "<tr>";

                                    $row .= "<td>" . $result['code'] . "</td>";
                                    $row .= "<td>" . $result['title'] . "</td>";



                                    $row .= "<td>" . $data['Jan'] . "</td>";

                                    $row .= "<td>" . $data['Feb'] . "</td>";

                                    $row .= "<td>" . $data['Mar'] . "</td>";

                                    $row .= "<td>" . $data['Apr'] . "</td>";

                                    $row .= "<td>" . $data['May'] . "</td>";

                                    $row .= "<td>" . $data['Jun'] . "</td>";

                                    $row .= "<td>" . $data['Jul'] . "</td>";

                                    $row .= "<td>" . $data['Aug'] . "</td>";

                                    $row .= "<td>" . $data['Sep'] . "</td>";

                                    $row .= "<td>" . $data['Oct'] . "</td>";

                                    $row .= "<td>" . $data['Nov'] . "</td>";

                                    $row .= "<td>" . $data['Dec'] . "</td>";


                                    $row .= "</tr>";
                                    echo $row;
                                }
                                // Two extra rows for total

                                $row = "<tr>";

                                $row .= "<td>Total  " . $value['name'] . "</td>";
                                $row .= "<td></td>";


                                $row .= "<td>" . number_format($january) . "</td>";

                                $row .= "<td>" . number_format($february) . "</td>";

                                $row .= "<td>" . number_format($march) . "</td>";

                                $row .= "<td>" . number_format($april) . "</td>";

                                $row .= "<td>" . number_format($may) . "</td>";

                                $row .= "<td>" . number_format($june) . "</td>";

                                $row .= "<td>" . number_format($july) . "</td>";

                                $row .= "<td>" . number_format($august) . "</td>";

                                $row .= "<td>" . number_format($september) . "</td>";

                                $row .= "<td>" . number_format($october) . "</td>";

                                $row .= "<td>" . number_format($november) . "</td>";

                                $row .= "<td>" . number_format($december) . " </td>";
                                // $row .= "<td></td>";

                                $row .= "</tr>";
                                echo $row;
                                // Store Data Here For Graph
                                $graph[$value['name']] = [$january, $february, $march, $april, $may, $june, $july, $august, $september, $october, $november, $december];
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php echo form_close(); ?>

                </div>
            </div>

            <div class="row clearfix col-md-6">
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
            <div id="chartContainer3" style="width: 100%; height: 300px;display: inline-block;"></div>

        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
<!-- Import Excel Modal -->

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
    var table = $('#na_datatable').DataTable({
        "bPaginate": false,
        dom: 'Bfrtip',
        "ordering": false,
        buttons: [
            'csv', 'excel'
        ]
    });

    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer3", {
            animationEnabled: true,
            title: {
                text: "<?= $categoryName ?>",
            },
            axisX: {
                valueFormatString: "MMM",
                interval: 1,
                intervalType: "month"
            },
            axisY: {
                includeZero: false
            },
            data: [{
                type: "line",
                dataPoints: [{
                        x: new Date(2012, 00, 1),
                        y: <?= $graph[$categoryName][0] ?>
                    },
                    {
                        x: new Date(2012, 01, 1),
                        y: <?= $graph[$categoryName][1] ?>
                    },
                    {
                        x: new Date(2012, 02, 1),
                        y: <?= $graph[$categoryName][2] ?>
                        // indexLabel: "highest",
                        // markerColor: "red",
                        // markerType: "triangle"
                    },
                    {
                        x: new Date(2012, 03, 1),
                        y: <?= $graph[$categoryName][3] ?>
                    },
                    {
                        x: new Date(2012, 04, 1),
                        y: <?= $graph[$categoryName][4] ?>
                    },
                    {
                        x: new Date(2012, 05, 1),
                        y: <?= $graph[$categoryName][5] ?>
                    },
                    {
                        x: new Date(2012, 06, 1),
                        y: <?= $graph[$categoryName][6] ?>
                    },
                    {
                        x: new Date(2012, 07, 1),
                        y: <?= $graph[$categoryName][7] ?>
                    },
                    {
                        x: new Date(2012, 08, 1),
                        y: <?= $graph[$categoryName][8] ?>
                        // indexLabel: "lowest",
                        // markerColor: "DarkSlateGrey",
                        // markerType: "cross"
                    },
                    {
                        x: new Date(2012, 09, 1),
                        y: <?= $graph[$categoryName][9] ?>
                    },
                    {
                        x: new Date(2012, 10, 1),
                        y: <?= $graph[$categoryName][10] ?>
                    },
                    {
                        x: new Date(2012, 11, 1),
                        y: <?= $graph[$categoryName][11] ?>
                    }
                ]
            }]
        });
        chart.render();
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
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>