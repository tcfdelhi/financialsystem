<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    ADD NEW ADMIN
                </h2>
                <a href="<?= base_url('admin/settings/'); ?>" class="btn bg-indigo waves-effect pull-right">Admin List</a>
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

                    <?php echo form_open(base_url('admin/settings/add/' . $id), 'class="form-horizontal"');  ?>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="name">First Name<span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="first_name" class="form-control" value="<?= (isset($admin['firstname']) ? $admin['firstname'] : set_value('first_name')) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="name">Last name<span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="last_name" class="form-control" value="<?= (isset($admin['lastname']) ? $admin['lastname'] : set_value('last_name')) ?>">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="abbreviation">Email<span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="email" class="form-control" value="<?= (isset($admin['email']) ? $admin['email'] : set_value('email')) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="term">Password<span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" name="password" class="form-control" value="<?= (isset($admin['password']) ? $admin['password'] : set_value('password')) ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-6">
                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="year">Country<span class="red"> *</span></label>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <!-- <input type="text" name="country" class="form-control" value="<?= (isset($admin['country']) ? $admin['country'] : set_value('country')) ?>" > -->
                                    <select class="form-control show-tick" name="country">
                                        <option value="">-- Please select --</option>
                                        <?php foreach ($country as $group) : ?>
                                            <option value="<?= $group['name']; ?>" <?= ($group['name']==$admin['country']?"selected":'') ?>><?= $group['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix col-md-12">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="submit" name="submit" value="ADD" class="btn btn-primary m-t-15 waves-effect">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#ci_examples").addClass('active');
    $("#admins").addClass('active');
</script>