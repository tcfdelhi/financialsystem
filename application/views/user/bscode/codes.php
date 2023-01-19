<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <?= languagedata($this->session->userdata('session_language'), "Select Year"); ?>
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <?php if (isset($msg) || validation_errors() !== '') : ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                <?= validation_errors(); ?>
                                <?= isset($msg) ? $msg : ''; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php echo form_open(base_url('user/bscode/list/'), 'class="form-horizontal"');  ?>


                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password"><?= languagedata($this->session->userdata('session_language'), "Select Financial Year"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="year" required>
                                        <?php foreach ($years as $group) : ?>
                                            <option value="<?= $group['year']; ?>"><?= $group['year'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix col-md-12">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="submit" name="submit" value="<?= languagedata($this->session->userdata('session_language'), "View Bs Codes"); ?>" class="btn btn-primary m-t-15 waves-effect">
                            <input type="button" value="<?= languagedata($this->session->userdata('session_language'), 'Add New Financial Year'); ?>" class="btn btn-primary m-l-40 m-t-15 waves-effect add_new_year">
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                    <!-- Add New Financial Year -->
                    <?php echo form_open(base_url('user/bscode'), 'class="form-horizontal new_year"');  ?>
                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password"><?= languagedata($this->session->userdata('session_language'), "Add New Financial Year"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" value="" name="year">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix col-md-1">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="submit" name="submit" value="<?= languagedata($this->session->userdata('session_language'), 'Add'); ?>" class="btn btn-primary waves-effect">
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".add_new_year").click(function() {
        $(".new_year").toggle({
            duration: 100
        });
    });


    $(".new_year").hide();
    $("#bscodes").addClass('active');
</script>