<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    EDIT USER
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <?php if (isset($msg) || validation_errors() !== '') : ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?= validation_errors(); ?>
                            <?= isset($msg) ? $msg : ''; ?>
                        </div>
                    <?php endif; ?>
                    <?php echo form_open(base_url('admin/clients/edit/' . $user['client_id']), 'class="form-horizontal"') ?>

                    <!-- <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="group">Group</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="group">
                                        <option value="">-- Please select --</option>
                                        <?php foreach ($user_groups as $group) : ?>
                                            <?php if ($group['id'] == $user['role']) : ?>
                                                <option value="<?= $group['id']; ?>" selected><?= $group['group_name']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $group['id']; ?>"><?= $group['group_name']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="country">Choose Country</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="country">
                                        <option value="">-- Please select --</option>
                                        <?php foreach ($country as $group) : ?>
                                            <option value="<?= $group['name']; ?>" <?= ($group['name'] == $client['country'] ? "selected" : "") ?>><?= $group['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="currency">Select Currency</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="currency">
                                        <option value="">-- Please select --</option>
                                        <option value="INR" <?= ($client['currency'] == "INR" ? "selected" : '') ?>>INR</option>
                                        <option value="USD" <?= ($client['currency'] == "USD" ? "selected" : '') ?>>USD</option>
                                        <option value="EURO" <?= ($client['currency'] == "EURO" ? "selected" : '') ?>>EURO</option>
                                        <option value="GBP" <?= ($client['currency'] == "GBP" ? "selected" : '') ?>>GBP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="unit">Select Unit</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="unit">
                                        <option value="">-- Please select --</option>
                                        <option value="1K" <?= ($client['unit'] == "1K" ? "selected" : '') ?>>1K</option>
                                        <option value="10K" <?= ($client['unit'] == "10K" ? "selected" : '') ?>>10K</option>
                                        <option value="100K" <?= ($client['unit'] == "100K" ? "selected" : '') ?>>100K</option>
                                        <option value="200K" <?= ($client['unit'] == "200K" ? "selected" : '') ?>>200K</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="name">Company Name</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="company_name" class="form-control" value="<?= $client['company_name'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="abbreviation">Company Abbreviation</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="company_abbreviation" class="form-control" value="<?= $client['company_abbreviation'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="term">Accounting Term</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="accounting_term" class="form-control" value="<?= $client['accounting_term'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="year">Start Year</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="start_year" class="form-control" value="<?= $client['start_year'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email">Register Id(Email Address)</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="email" class="form-control" value="<?= $client['email'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" name="password" class="form-control" value="<?= $client['password'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="status">User Status</label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="status">
                                        <option value="">-- Please select --</option>
                                        <option value="1" <?= ($user['is_active'] == 1) ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= ($user['is_active'] == 0) ? 'selected' : '' ?>>Deactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="submit" name="submit" value="UPDATE" class="btn btn-primary m-t-15 waves-effect">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Autosize Plugin Js -->
<!-- <script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script> -->
<!-- Custom Js -->
<!-- <script src="<?= base_url() ?>public/js/pages/forms/basic-form-elements.js"></script> -->

<script>
    $("#users").addClass('active');
    $("#user_list").addClass('active');
</script>