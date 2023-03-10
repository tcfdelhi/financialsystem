<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="<?= base_url('admin/dashboard'); ?>"><?= languagedata($this->session->userdata('session_language'), "Financial System"); ?></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                <!-- #END# Call Search -->
                <!-- Notifications -->
                <!-- <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                        <span class="label-count">2</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Languages</li>
                        <li class="body">
                            <ul class="menu">
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">person_add</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>English</h4>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">person_add</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>Japanese</h4>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <!-- #END# Notifications -->
                <!-- Tasks -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">language</i>
                        <!-- <span class="label-count">5</span> -->
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Languages</li>
                        <li class="body">
                            <ul class="menu tasks">
                                <?php
                                // $sql = "DESCRIBE  ci_languages";
                                // $query = $this->db->query($sql);

                                // foreach ($query->result() as $row) { print_r($row); die; 
                                // print_r($this->session->userdata()); die;
                                // Change Languages URL for user and admin
                                if ($this->session->userdata('is_admin_login') == 1)  $status = TRUE;
                                else $status = FALSE;
                                ?>
                                <li>
                                    <?php
                                    if ($status) echo "<a href=" . base_url() . "admin/dashboard/set_session_language/english>";
                                    else echo "<a href=" . base_url() . "user/profile/set_session_language/english>";
                                    ?>

                                    <h4>
                                        <img height="25" width="25" src="<?= base_url('uploads/Flags/english.png') ?>" style="margin-right: 3px;">English
                                    </h4>
                                    </a>
                                </li>
                                <li>
                                    <?php
                                    if ($status) echo "<a href=" . base_url() . "admin/dashboard/set_session_language/japanese>";
                                    else echo "<a href=" . base_url() . "user/profile/set_session_language/japanese>";
                                    ?>
                                    <h4>
                                        <img height="25" width="25" src="<?= base_url('uploads/Flags/japan.png') ?>" style="margin-right: 3px;">
                                        Japanese
                                    </h4>
                                    </a>
                                </li>
                                <li>
                                    <?php
                                    if ($status) echo "<a href=" . base_url() . "admin/dashboard/set_session_language/vietnamese>";
                                    else echo "<a href=" . base_url() . "user/profile/set_session_language/vietnamese>";
                                    ?>

                                    <h4><img height="25" width="25" src="<?= base_url('uploads/Flags/vietnam.png') ?>" style="margin-right: 3px;">Vietnamese
                                    </h4>
                                    </a>
                                </li>
                                <li>
                                    <?php
                                    if ($status) echo "<a href=" . base_url() . "admin/dashboard/set_session_language/thai>";
                                    else echo "<a href=" . base_url() . "user/profile/set_session_language/thai>";
                                    ?>

                                    <h4><img height="25" width="25" src="<?= base_url('uploads/Flags/thailand.png') ?>" style="margin-right: 3px;">Thai
                                    </h4>
                                    </a>
                                </li>
                                <li>

                                    <?php
                                    if ($status) echo "<a href=" . base_url() . "admin/dashboard/set_session_language/indonesian>";
                                    else echo "<a href=" . base_url() . "user/profile/set_session_language/indonesian>";
                                    ?>

                                    <h4><img height="25" width="25" src="<?= base_url('uploads/Flags/indonesia.png') ?>" style="margin-right: 3px;">Indonesian
                                    </h4>
                                    </a>
                                </li>
                                <?php //}
                                ?>
                            </ul>
                        </li>
                        <li class="footer">
                            <!-- <a href="javascript:void(0);">View All Tasks</a> -->
                        </li>
                    </ul>
                </li>
                <!-- #END# Tasks -->
                <!-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->