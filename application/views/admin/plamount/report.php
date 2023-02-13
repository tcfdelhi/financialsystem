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
                                <th><?= languagedata($this->session->userdata('session_language'), "Before Previous "); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Previous "); ?></th>
                                <th><?= languagedata($this->session->userdata('session_language'), "Current "); ?></th>
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
                                <th><?= languagedata($this->session->userdata('session_language'), "Actual<br>(Accumulated)"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($breakdown_cat as $key => $value) {

                                $january = $february = $march = $april = $may1 = $june = $july = $august = $september = $october = $november = $december = $total_amount = $total_prev_year_amount = $total_before_prev_year_amount = $current_year_amount = 0;

                                $row = "<tr class='categories' >";

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
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";
                                $row .= "<td></td>";


                                $row .= "</tr>";
                                echo $row;

                                // Generate Extra 10 rows for accouting codes
                                // $counter = 0;
                                $category = $value['id'];
                                $sql = "SELECT * FROM ci_pl_amount where category='$category' and year='$year' and client_id='$client_id' and data <> '' ";
                                $query = $this->db->query($sql);
                                $counter = 1;
                                foreach ($query->result_array() as $key => $result) {


                                    $prevoius_year = $year - 1;
                                    // Get prevoius year data here
                                    $sql = "SELECT * FROM ci_pl_amount where category='$category' and year='$prevoius_year' and client_id='$client_id' LIMIT $counter OFFSET $key ";
                                    $prevoius_year = $this->db->query($sql);
                                    $prevoius_year = $prevoius_year->row_array($sql);
                                    if (!empty($prevoius_year['data'])) {
                                        $prev = json_decode($prevoius_year['data'], true);
                                        $prevoius_year_amount =
                                            (int)str_replace(",", "", $prev['jan'])  +
                                            (int)str_replace(",", "", $prev['feb']) +
                                            (int)str_replace(",", "", $prev['mar']) +
                                            (int)str_replace(",", "", $prev['apr']) +
                                            (int)str_replace(",", "", $prev['may']) +
                                            (int)str_replace(",", "", $prev['jun']) +
                                            (int)str_replace(",", "", $prev['jul']) +
                                            (int)str_replace(",", "", $prev['aug']) +
                                            (int)str_replace(",", "", $prev['sep']) +
                                            (int)str_replace(",", "", $prev['oct']) +
                                            (int)str_replace(",", "", $prev['nov']) +
                                            (int)str_replace(",", "", $prev['dec']);
                                        $total_prev_year_amount = $total_prev_year_amount + $prevoius_year_amount;
                                    }

                                    $before_previous_year = $year - 2;
                                    // Get before prevoius year data here
                                    $sql = "SELECT * FROM ci_pl_amount where category='$category' and year='$before_previous_year' and client_id='$client_id' LIMIT $counter OFFSET $key ";
                                    $before_prevoius_year = $this->db->query($sql);
                                    $before_prevoius_year = $before_prevoius_year->row_array($sql);
                                    if (!empty($before_prevoius_year['data'])) {
                                        $prev = json_decode($before_prevoius_year['data'], true);
                                        $before_prevoius_year_amount =
                                            (int)str_replace(",", "", $prev['jan'])  +
                                            (int)str_replace(",", "", $prev['feb']) +
                                            (int)str_replace(",", "", $prev['mar']) +
                                            (int)str_replace(",", "", $prev['apr']) +
                                            (int)str_replace(",", "", $prev['may']) +
                                            (int)str_replace(",", "", $prev['jun']) +
                                            (int)str_replace(",", "", $prev['jul']) +
                                            (int)str_replace(",", "", $prev['aug']) +
                                            (int)str_replace(",", "", $prev['sep']) +
                                            (int)str_replace(",", "", $prev['oct']) +
                                            (int)str_replace(",", "", $prev['nov']) +
                                            (int)str_replace(",", "", $prev['dec']);

                                        $total_before_prev_year_amount = $total_before_prev_year_amount + $before_prevoius_year_amount;
                                    }

                                    $counter++;
                                    $data = !empty($result['data']) ? json_decode($result['data'], true) : 0;

                                    $jan = str_replace(",", "", $data['jan']);
                                    $january = str_replace(",", "", (int)$january) + (int)$jan;

                                    $feb = str_replace(",", "", $data['feb']);
                                    $february = str_replace(",", "", (int)$february) + (int)$feb;

                                    $mar = str_replace(",", "", $data['mar']);
                                    $march = str_replace(",", "", (int)$march) + (int)$mar;

                                    $apr = str_replace(",", "", $data['apr']);
                                    $april = str_replace(",", "", (int)$april) + (int)$apr;

                                    $may1 = str_replace(",", "", $data['may']);
                                    $may = str_replace(",", "", (int)$may) + (int)$may1;

                                    $jun = str_replace(",", "", $data['jun']);
                                    $june = str_replace(",", "", (int)$june) + (int)$jun;


                                    $jul = str_replace(",", "", $data['jul']);
                                    $july = str_replace(",", "", (int)$july) + (int)$jul;

                                    $aug = str_replace(",", "", $data['aug']);
                                    $august = str_replace(",", "", (int)$august) + (int)$aug;

                                    $sep = str_replace(",", "", $data['sep']);
                                    $september = str_replace(",", "", (int)$september) + (int)$sep;

                                    $oct = str_replace(",", "", $data['oct']);
                                    $october = str_replace(",", "", (int)$october) + (int)$oct;

                                    $nov = str_replace(",", "", $data['nov']);
                                    $november = str_replace(",", "", (int)$november) + (int)$nov;

                                    $dec = str_replace(",", "", $data['dec']);
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

                                    $current_year_amount = $current_year_amount + $total_amount;
                                    // echo "<pre>"; print_r($row['code']); die;
                                    $id = $result['id'];
                                    $row = "<tr>";

                                    $options = '<option value="">Select PL Code</option>';
                                    $code = $result['code'];

                                    foreach ($pl_codes as $key1 => $value1) {
                                        $options .= "<option value='" . $value1['code'] . "' 
                                        " . ($code == $value1['code'] ? "selected" : "") .
                                            ">" . $value1['code'] . ' (' . $value1['title'] . ")</option>";
                                    }

                                    $row .= "<td>$code</td>";

                                    $row .= "<td>" . number_format($before_prevoius_year_amount) . "</td>";

                                    $row .= "<td>" . number_format($prevoius_year_amount) . "</td>";

                                    $row .= "<td>" . number_format($total_amount) . "</td>";

                                    $row .= "<td>" . $data['jan'] . "</td>";

                                    $row .= "<td>" . $data['feb'] . "</td>";

                                    $row .= "<td>" . $data['mar'] . "</td>";

                                    $row .= "<td>" . $data['apr'] . "</td>";

                                    $row .= "<td>" . $data['may'] . "</td>";

                                    $row .= "<td>" . $data['jun'] . "</td>";

                                    $row .= "<td>" . $data['jul'] . "</td>";

                                    $row .= "<td>" . $data['aug'] . "</td>";

                                    $row .= "<td>" . $data['sep'] . "</td>";

                                    $row .= "<td>" . $data['oct'] . "</td>";

                                    $row .= "<td>" . $data['nov'] . "</td>";

                                    $row .= "<td>" . $data['dec'] . "</td>";

                                    // // Show total amount row bise
                                    $row .= "<td>" . number_format($total_amount) . "</td>";

                                    $row .= "</tr>";
                                    echo $row;
                                }
                                // Two extra rows for total

                                $row = "<tr>";

                                $row .= "<td>Total  " . $value['name'] . "</td>";

                                $row .= "<td>$total_before_prev_year_amount</td>";

                                $row .= "<td>$total_prev_year_amount</td>";

                                $row .= "<td>$current_year_amount</td>";

                                $row .= "<td>$january</td>";

                                $row .= "<td>$february</td>";

                                $row .= "<td>$march</td>";

                                $row .= "<td>$april</td>";

                                $row .= "<td>$may1</td>";

                                $row .= "<td>$june</td>";

                                $row .= "<td>$july </td>";

                                $row .= "<td>$august</td>";

                                $row .= "<td>$september</td>";

                                $row .= "<td>$october</td>";

                                $row .= "<td>$november</td>";

                                $row .= "<td> $december </td>";

                                // // Show total amount row bise
                                $row .= "<td>" . number_format($total_amount) . "</td>";
                                // $row .= "<td>" . number_format($total_amount) . "</td>";

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
</script>