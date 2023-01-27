<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <?= languagedata($this->session->userdata('session_language'), $title); ?>
                </h2>
                <a href="<?= base_url('admin/plcode/'); ?>" class="btn bg-indigo waves-effect pull-right"> <?= languagedata($this->session->userdata('session_language'), "Codes List"); ?></a>
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

                    <?php echo form_open(base_url('admin/bsamount/add_code/' . $id), 'class="form-horizontal"');  ?>


                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="term"><?= languagedata($this->session->userdata('session_language'), "Select Accounting Code"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick get_pl_name" name="code">
                                        <option value="">-- Please select --</option>
                                        <?php foreach ($accounting_code as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($code_data['code'] == $group['code'] ? "selected" : "") ?>><?= $group['code'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="name"><?= languagedata($this->session->userdata('session_language'), "Accounting Name"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" class="form-control code_name" value="<?= $code_data['title']  ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="term"><?= languagedata($this->session->userdata('session_language'), "Select Client"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="client_id">
                                        <option value="">-- Please select --</option>
                                        <?php foreach ($clients as $group) : ?>
                                            <option value="<?= $group['id']; ?>" <?= ($code_data['client_id'] == $group['id'] ? "selected" : "") ?>><?= $group['company_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password"><?= languagedata($this->session->userdata('session_language'), "Select Financial Year"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="year">
                                        <?php foreach ($years as $group) : ?>
                                            <option value="<?= $group['year']; ?>" <?= ($code_data['year'] == $group['year'] ? "selected" : "") ?>><?= $group['year'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password"><?= languagedata($this->session->userdata('session_language'), "Select Month"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="month">
                                        <?php foreach ($month as $key => $group) : ?>
                                            <option value="<?= $key ?>" <?= ($code_data['month'] == $key ? "selected" : "") ?>><?= $group ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="abbreviation"><?= languagedata($this->session->userdata('session_language'), "Enter Amount"); ?><span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="amount" class="form-control" value="<?= $code_data['amount'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-12">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="submit" name="submit" value="<?= languagedata($this->session->userdata('session_language'), $button); ?>" class="btn btn-primary m-t-15 waves-effect">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".get_pl_name").change(function() {
        var pl_code_id = $(this).val();
        var url = '<?= base_url('/admin/bsamount/get_bs_name') ?>';
        $.get(url, {
                id: pl_code_id
            })
            .done(function(data) {
                $(".code_name").val(data)
            });
    });
    $("#bs_import_amount").addClass('active');
</script>