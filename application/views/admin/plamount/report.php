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
                    - <?= $year ?>
                </h2>

                <a href="<?= base_url("admin/plamount/list/$year/$client_id"); ?>" class="btn bg-indigo waves-effect pull-right m-r-25"><i class="material-icons">person_add</i> <?= languagedata($this->session->userdata('session_language'), "Back To Breakdown Sheet"); ?></a>
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
                                $sql = "SELECT * FROM ci_pl_amount_data_new where category='$category' and year='$year' and client_id='$client_id' and data <> '' ";
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

            <?php //echo "<pre>"; print_r($graph); die; 
            ?>



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


            <!-- <div id="chartContainer1" style="width: 45%; height: 300px;display: inline-block;"></div> -->
            <!-- <div id="chartContainer2" style="width: 45%; height: 300px;display: inline-block;"></div><br /> -->
            <div id="chartContainer3" style="width: 100%; height: 300px;display: inline-block;"></div>
            <!-- <div id="chartContainer4" style="width: 45%; height: 300px;display: inline-block;"></div> -->
            <!-- <div id="chartContainer5" style="width: 45%; height: 300px;display: inline-block;"></div> -->
            <!-- <div id="chartContainer6" style="width: 45%; height: 300px;display: inline-block;"></div> -->
            <!-- <div id="chartContainer7" style="width: 45%; height: 300px;display: inline-block;"></div> -->
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


        // var chart = new CanvasJS.Chart("chartContainer1", {
        //     animationEnabled: true,
        //     title: {
        //         text: "Annual Reports"
        //     },
        //     axisX: {
        //         interval: 10,
        //     },
        //     data: [{
        //         type: "splineArea",
        //         color: "rgba(255,12,32,.3)",
        //         dataPoints: [{
        //                 x: new Date(1992, 0),
        //                 y: 2506000
        //             },
        //             {
        //                 x: new Date(1993, 0),
        //                 y: 2798000
        //             },
        //             {
        //                 x: new Date(1994, 0),
        //                 y: 3386000
        //             },
        //             {
        //                 x: new Date(1995, 0),
        //                 y: 6944000
        //             },
        //             {
        //                 x: new Date(1996, 0),
        //                 y: 6026000
        //             },
        //             {
        //                 x: new Date(1997, 0),
        //                 y: 2394000
        //             },
        //             {
        //                 x: new Date(1998, 0),
        //                 y: 1872000
        //             },
        //             {
        //                 x: new Date(1999, 0),
        //                 y: 2140000
        //             },
        //             {
        //                 x: new Date(2000, 0),
        //                 y: 7289000
        //             },
        //             {
        //                 x: new Date(2001, 0),
        //                 y: 4830000
        //             },
        //             {
        //                 x: new Date(2002, 0),
        //                 y: 2009000
        //             },
        //             {
        //                 x: new Date(2003, 0),
        //                 y: 2840000
        //             },
        //             {
        //                 x: new Date(2004, 0),
        //                 y: 2396000
        //             },
        //             {
        //                 x: new Date(2005, 0),
        //                 y: 1613000
        //             },
        //             {
        //                 x: new Date(2006, 0),
        //                 y: 2821000
        //             }
        //         ]
        //     }, ]
        // });
        // chart.render();

        // var chart = new CanvasJS.Chart("chartContainer2", {
        //     animationEnabled: true,
        //     title: {
        //         text: "Annual Reports",
        //     },
        //     data: [{
        //         type: "pie",
        //         showInLegend: true,
        //         dataPoints: [{
        //                 y: 4181563,
        //                 legendText: "PS 3",
        //                 indexLabel: "PlayStation 3"
        //             },
        //             {
        //                 y: 2175498,
        //                 legendText: "Wii",
        //                 indexLabel: "Wii"
        //             },
        //             {
        //                 y: 3125844,
        //                 legendText: "360",
        //                 indexLabel: "Xbox 360"
        //             },
        //             {
        //                 y: 1176121,
        //                 legendText: "DS",
        //                 indexLabel: "Nintendo DS"
        //             },
        //             {
        //                 y: 1727161,
        //                 legendText: "PSP",
        //                 indexLabel: "PSP"
        //             },
        //             {
        //                 y: 4303364,
        //                 legendText: "3DS",
        //                 indexLabel: "Nintendo 3DS"
        //             },
        //             {
        //                 y: 1717786,
        //                 legendText: "Vita",
        //                 indexLabel: "PS Vita"
        //             }
        //         ]
        //     }, ]
        // });
        // chart.render();


        // var chart = new CanvasJS.Chart("chartContainer4", {
        //     animationEnabled: true,
        //     title: {
        //         text: "Annual Reports",
        //     },
        //     axisX: {
        //         interval: 10,
        //     },
        //     data: [{
        //         type: "column",
        //         legendMarkerType: "triangle",
        //         legendMarkerColor: "green",
        //         color: "rgba(255,12,32,.3)",
        //         showInLegend: true,
        //         legendText: "Country wise population",
        //         dataPoints: [{
        //                 x: 10,
        //                 y: 297571,
        //                 label: "India"
        //             },
        //             {
        //                 x: 20,
        //                 y: 267017,
        //                 label: "Saudi"
        //             },
        //             {
        //                 x: 30,
        //                 y: 175200,
        //                 label: "Canada"
        //             },
        //             {
        //                 x: 40,
        //                 y: 154580,
        //                 label: "Iran"
        //             },
        //             {
        //                 x: 50,
        //                 y: 116000,
        //                 label: "Russia"
        //             },
        //             {
        //                 x: 60,
        //                 y: 97800,
        //                 label: "UAE"
        //             },
        //             {
        //                 x: 70,
        //                 y: 20682,
        //                 label: "US"
        //             },
        //             {
        //                 x: 80,
        //                 y: 20350,
        //                 label: "China"
        //             }
        //         ]
        //     }, ]
        // });
        // chart.render();

        // var chart = new CanvasJS.Chart("chartContainer5", {
        //     title: {
        //         text: "Annual Reports",
        //     },
        //     axisY: {
        //         title: "Coal (bn tonnes)",
        //         valueFormatString: "#0.#,.",
        //     },
        //     data: [{
        //         type: "stackedColumn",
        //         legendText: "Anthracite & Bituminous",
        //         showInLegend: "true",
        //         dataPoints: [{
        //                 y: 111338,
        //                 label: "USA"
        //             },
        //             {
        //                 y: 49088,
        //                 label: "Russia"
        //             },
        //             {
        //                 y: 62200,
        //                 label: "China"
        //             },
        //             {
        //                 y: 90085,
        //                 label: "India"
        //             },
        //             {
        //                 y: 38600,
        //                 label: "Australia"
        //             },
        //             {
        //                 y: 48750,
        //                 label: "SA"
        //             }
        //         ]
        //     }, {
        //         type: "stackedColumn",
        //         legendText: "SubBituminous & Lignite",
        //         showInLegend: "true",
        //         indexLabel: "#total bn",
        //         yValueFormatString: "#0.#,.",
        //         indexLabelPlacement: "outside",
        //         dataPoints: [{
        //                 y: 135305,
        //                 label: "USA"
        //             },
        //             {
        //                 y: 107922,
        //                 label: "Russia"
        //             },
        //             {
        //                 y: 52300,
        //                 label: "China"
        //             },
        //             {
        //                 y: 3360,
        //                 label: "India"
        //             },
        //             {
        //                 y: 39900,
        //                 label: "Australia"
        //             },
        //             {
        //                 y: 0,
        //                 label: "SA"
        //             }
        //         ]
        //     }]
        // });
        // chart.render();

        // var chart = new CanvasJS.Chart("chartContainer6", {
        //     title: {
        //         text: "Annual Reports",

        //     },
        //     data: [{
        //         type: "stackedArea", //or stackedColumn
        //         dataPoints: [{
        //                 x: 10,
        //                 y: 171
        //             },
        //             {
        //                 x: 20,
        //                 y: 155
        //             },
        //             {
        //                 x: 30,
        //                 y: 150
        //             },
        //             {
        //                 x: 40,
        //                 y: 165
        //             },
        //             {
        //                 x: 50,
        //                 y: 195
        //             },
        //             {
        //                 x: 60,
        //                 y: 168
        //             },
        //             {
        //                 x: 70,
        //                 y: 128
        //             },
        //             {
        //                 x: 80,
        //                 y: 134
        //             },
        //             {
        //                 x: 90,
        //                 y: 114
        //             }
        //         ]
        //     }, {
        //         type: "stackedArea", //or stackedColumn
        //         dataPoints: [{
        //                 x: 10,
        //                 y: 101
        //             },
        //             {
        //                 x: 20,
        //                 y: 105
        //             },
        //             {
        //                 x: 30,
        //                 y: 100
        //             },
        //             {
        //                 x: 40,
        //                 y: 105
        //             },
        //             {
        //                 x: 50,
        //                 y: 105
        //             },
        //             {
        //                 x: 60,
        //                 y: 108
        //             },
        //             {
        //                 x: 70,
        //                 y: 108
        //             },
        //             {
        //                 x: 80,
        //                 y: 104
        //             },
        //             {
        //                 x: 90,
        //                 y: 104
        //             }
        //         ]
        //     }]
        // });

        // chart.render();



        // var chart = new CanvasJS.Chart("chartContainer7", {
        //     animationEnabled: true,

        //     title: {
        //         text: "Annual Reports"
        //     },
        //     axisX: {
        //         interval: 1
        //     },
        //     axisY2: {
        //         interlacedColor: "rgba(1,77,101,.2)",
        //         gridColor: "rgba(1,77,101,.1)",
        //     },
        //     data: [{
        //         type: "bar",
        //         name: "companies",
        //         axisYType: "secondary",
        //         color: "#014D65",
        //         dataPoints: [{
        //                 y: 3,
        //                 label: "January"
        //             },
        //             {
        //                 y: 7,
        //                 label: "February"
        //             },
        //             {
        //                 y: 5,
        //                 label: "March"
        //             },
        //             {
        //                 y: 9,
        //                 label: "April"
        //             },
        //             {
        //                 y: 7,
        //                 label: "May"
        //             },
        //             {
        //                 y: 7,
        //                 label: "June"
        //             },
        //             {
        //                 y: 9,
        //                 label: "July"
        //             },
        //             {
        //                 y: 8,
        //                 label: "August"
        //             },
        //             {
        //                 y: 11,
        //                 label: "September"
        //             },
        //             {
        //                 y: 15,
        //                 label: "October"
        //             },
        //             {
        //                 y: 12,
        //                 label: "November"
        //             },
        //             {
        //                 y: 15,
        //                 label: "December"
        //             }
        //         ]
        //     }]
        // });
        // chart.render();
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