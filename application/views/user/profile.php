<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                <?= languagedata($this->session->userdata('session_language'), "User Profile"); ?>
                </h2>
            </div>
            <div class="body">
            <?php 
              if($validation_check == 0):
              if (validation_errors() !== '') : ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?= validation_errors(); ?>
                    </div>
                <?php endif;
                endif; ?>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <?php echo form_open(base_url('user/profile'), 'class="form-horizontal"') ?>


                        <div class="row clearfix col-md-6">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="name"><?= languagedata($this->session->userdata('session_language'), "Company Name"); ?><span class="red"> *</span></label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="company_name" class="form-control" value="<?= $user['company_name'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix col-md-6">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="abbreviation"><?= languagedata($this->session->userdata('session_language'), "Company Abbreviation"); ?><span class="red"> *</span></label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="company_abbreviation" class="form-control" value="<?= $user['company_abbreviation'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix col-md-6">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="term"><?= languagedata($this->session->userdata('session_language'), "Accounting Term"); ?><span class="red"> *</span></label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="accounting_term" class="form-control" value="<?= $user['accounting_term'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix col-md-6">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="year"><?= languagedata($this->session->userdata('session_language'), "Start Year"); ?><span class="red"> *</span></label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="start_year" class="form-control" value="<?=  $user['start_year'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix col-md-6">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email"><?= languagedata($this->session->userdata('session_language'), "Register Id(Email Address)"); ?><span class="red"> *</span></label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix col-md-6">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="country"><?= languagedata($this->session->userdata('session_language'), "Choose Country"); ?><span class="red"> *</span></label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="country">
                                            <option value="">-- Please select --</option>
                                            <?php foreach ($country as $group) : ?>
                                                <option value="<?= $group['name']; ?>" <?= ($group['name']==$user['country']?"selected":"") ?> ><?= $group['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix col-md-6">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="currency"><?= languagedata($this->session->userdata('session_language'), "Select Currency"); ?><span class="red"> *</span></label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="currency">
                                            <option value="">-- Please select --</option>
                                            <?php foreach ($currency as $group) : ?>
                                                <option value="<?= $group['short_name']; ?>"  <?= ($group['short_name']==$user['currency']?"selected":"") ?> ><?= $group['name'] . '  (' . $group['short_name']; ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix col-md-6">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="unit"><?= languagedata($this->session->userdata('session_language'), "Select Unit"); ?><span class="red"> *</span></label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="" name="unit">
                                            <option value="">-- Please select --</option>
                                            <option value="1K" <?= ('1K'==$user['unit']?"selected":"") ?> >1K</option>
                                            <option value="10K" <?= ('10K'==$user['unit']?"selected":"") ?> >10K</option>
                                            <option value="100K" <?= ('100K'==$user['unit']?"selected":"") ?> >100K</option>
                                            <option value="200K" <?= ('200K'==$user['unit']?"selected":"") ?> >200K</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix col-md-12">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <input type="submit" name="submit" value="<?= languagedata($this->session->userdata('session_language'), 'Update'); ?>" class="btn btn-primary m-t-15 waves-effect">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                <?= languagedata($this->session->userdata('session_language'), "Change Password"); ?>
                </h2>
            </div>
            <div class="body">
            <?php 
            if($validation_check == 1):
            if (validation_errors() !== '') : ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?= validation_errors(); ?>
                    </div>
                <?php endif;
                endif; ?>

                <?php echo form_open(base_url('user/profile/change_pwd'), 'class="form-horizontal"');  ?>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="password"><?= languagedata($this->session->userdata('session_language'), "Password"); ?></label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="password" class="form-control" placeholder="Enter your Password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                        <label for="confirm_pwd"><?= languagedata($this->session->userdata('session_language'), "Confirm Pwd"); ?></label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="confirm_pwd" class="form-control" placeholder="Enter your confirm_pwd">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                        <input type="submit" name="submit" value="<?= languagedata($this->session->userdata('session_language'), 'Change Password'); ?>" class="btn btn-primary m-t-15 waves-effect">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $("#users").addClass('active');
</script>