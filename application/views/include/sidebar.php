<?php $cur_tab = $this->uri->segment(2) == '' ? 'dashboard' : $this->uri->segment(2); ?>
<?php $sub_tab = $this->uri->segment(3) == '' ? 'dashboard' : $this->uri->segment(3); ?>

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
	<!-- User Info -->
	<div class="user-info bg-indigo">
		<div class="image">
			<img src="<?= base_url() ?>public/images/user.png" width="48" height="48" alt="User" />
		</div>
		<div class="info-container">
			<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= strtoupper($this->session->userdata('name')); ?></div>
			<div class="email"><?= $this->session->userdata('email'); ?></div>
			<!-- <div class="btn-group user-helper-dropdown">
				<i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
				<ul class="dropdown-menu pull-right">
					<li id=""><a href="<?= base_url('admin/profile'); ?>"><i class="material-icons">person</i>Profile</a></li>
					<li role="seperator" class="divider"></li>
					<li id=""><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
					<li id=""><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
					<li id=""><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
					<li role="seperator" class="divider"></li>
					<li id=""><a href="<?= base_url('auth/logout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
				</ul>
			</div> -->
		</div>
	</div>
	<!-- #User Info -->
	<!-- Menu -->
	<div class="menu">
		<ul class="list">
			<li class="header"><?= languagedata($this->session->userdata('session_language'), "Main Navigation"); ?></li>
			<li id="dashboard">
				<a href="<?= base_url('admin/dashboard'); ?>">
					<i class="material-icons">home</i>
					<span><?= languagedata($this->session->userdata('session_language'), "Home"); ?></span>
				</a>
			</li>
			<li id="users">
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">person</i>
					<span><?= languagedata($this->session->userdata('session_language'), "Clients"); ?></span>
				</a>
				<ul class="ml-menu">
					<li id="user_list">
						<a href="<?= base_url('admin/clients'); ?>"><?= languagedata($this->session->userdata('session_language'), "Manage Clients"); ?></a>
					</li>
					<li id="add">
						<a href="<?= base_url('admin/clients/terminated_client'); ?>"><?= languagedata($this->session->userdata('session_language'), "Manage Terminated Clients"); ?></a>
					</li>
					<!-- <li id="group">
            <a href="<?= base_url('admin/group'); ?>">User Group</a>
          </li> -->
					<!-- <li id="profile">
            <a href="<?= base_url('admin/profile'); ?>">User Profile</a>
          </li> -->
				</ul>
			</li>


			<!-- BS Code tab -->
			<li id="bs_code">
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">code</i>
					<span><?= languagedata($this->session->userdata('session_language'), "BS Codes"); ?></span>
				</a>
				<ul class="ml-menu">
					<li id="codes">
						<a href="<?= base_url('admin/bscode'); ?>"><?= languagedata($this->session->userdata('session_language'), "Manage Codes"); ?></a>
					</li>
					<li id="major_item">
						<a href="<?= base_url('admin/bscode/major_item'); ?>"><?= languagedata($this->session->userdata('session_language'), "Major items of BS"); ?></a>
					</li>
					<li id="medium_item">
						<a href="<?= base_url('admin/bscode/medium_item'); ?>"><?= languagedata($this->session->userdata('session_language'), "Medium item of BS"); ?></a>
					</li>
					<li id="cash_flow">
						<a href="<?= base_url('admin/bscode/cash_flow'); ?>"><?= languagedata($this->session->userdata('session_language'), "Cash Flow category"); ?></a>
					</li>

					<li id="bs_import_amount">
						<a href="<?= base_url('admin/bscode/import_amount'); ?>"><?= languagedata($this->session->userdata('session_language'), "Import Amount"); ?></a>
					</li>

					<li id="bs_amount_sheet">
						<a href="<?= base_url('admin/bsamount/list/'.date("Y")); ?>"><?= languagedata($this->session->userdata('session_language'), "Amount Sheet"); ?></a>
					</li>

					<li id="bs_reports">
						<a href="<?= base_url('admin/bscode/reports'); ?>"><?= languagedata($this->session->userdata('session_language'), "Reports"); ?></a>
					</li>

					<li id="bs_chart">
						<a href="<?= base_url('admin/bscode/charts'); ?>"><?= languagedata($this->session->userdata('session_language'), "BS Chart"); ?></a>
					</li>

					<li id="list_view">
						<a href="<?= base_url('admin/bscode/list_view'); ?>"><?= languagedata($this->session->userdata('session_language'), "List View BS Codes"); ?></a>
					</li>
					<!-- <li id="signout">
						<a href="<?= base_url('auth/logout'); ?>">Sign Out</a>
					</li> -->
				</ul>
			</li>

			<!-- <li id="bs_import_amount">
				<a href="<?= base_url('admin/bsamount'); ?>">
					<i class="material-icons">layers</i>
					<span><?= languagedata($this->session->userdata('session_language'), "BS Import Amount"); ?></span>
				</a>
			</li> -->

			<!-- BS Code tab -->
			<li id="pl_code">
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">code</i>
					<span><?= languagedata($this->session->userdata('session_language'), "PL Codes"); ?></span>
				</a>
				<ul class="ml-menu">
					<li id="pl_codes">
						<a href="<?= base_url('admin/plcode'); ?>"><?= languagedata($this->session->userdata('session_language'), "Manage PL Codes"); ?></a>
					</li>
					<li id="pl_major_item">
						<a href="<?= base_url('admin/plcode/major_item'); ?>"><?= languagedata($this->session->userdata('session_language'), "Major items of PL"); ?></a>
					</li>
					<li id="pl_medium_item">
						<a href="<?= base_url('admin/plcode/medium_item'); ?>"><?= languagedata($this->session->userdata('session_language'), "Medium item of PL"); ?></a>
					</li>
					<li id="pl_breakdown_cat">
						<a href="<?= base_url('admin/plcode/breakdown_cat'); ?>"><?= languagedata($this->session->userdata('session_language'), "Breakdown Category"); ?></a>
					</li>
					<li id="pl_cash_flow_category">
						<a href="<?= base_url('admin/plcode/cash_flow'); ?>"><?= languagedata($this->session->userdata('session_language'), "Cash Flow category"); ?></a>
					</li>


					<li id="pl_import_amount">
						<a href="<?= base_url('admin/plcode/import_amount'); ?>"><?= languagedata($this->session->userdata('session_language'), "Import Amount"); ?></a>
					</li>

					<li id="pl_breakdown_sheet">
						<a href="<?= base_url('admin/plamount'); ?>">
							<?= languagedata($this->session->userdata('session_language'), "Breakdown Sheet"); ?>
						</a>
					</li>

					<li id="pl_reports">
						<a href="<?= base_url('admin/plcode/reports'); ?>"><?= languagedata($this->session->userdata('session_language'), "Reports"); ?></a>
					</li>

					<li id="pl_list_view">
						<a href="<?= base_url('admin/plcode/list_view'); ?>"><?= languagedata($this->session->userdata('session_language'), "List View PL Codes"); ?></a>
					</li>
					<!-- <li id="signout">
						<a href="<?= base_url('auth/logout'); ?>">Sign Out</a>
					</li> -->
				</ul>
			</li>

			<!-- <li id="pl_import_amount">
				<a href="<?= base_url('admin/plamount'); ?>">
					<i class="material-icons">layers</i>
					<span><?= languagedata($this->session->userdata('session_language'), "Pl View Amount"); ?></span>
				</a>
			</li> -->

			<li id="ci_examples">
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">settings</i>
					<span><?= languagedata($this->session->userdata('session_language'), "Settings"); ?></span>
				</a>
				<ul class="ml-menu">
					<li id="admins">
						<a href="<?= base_url('admin/settings'); ?>"><?= languagedata($this->session->userdata('session_language'), "Manage Users"); ?></a>
					</li>
					<li id="ajax_datatable">
						<a href="<?= base_url('admin/settings/currency'); ?>"><?= languagedata($this->session->userdata('session_language'), "Manage Currency"); ?></a>
					</li>
					<li id="pagination">
						<a href="<?= base_url('admin/settings/languages'); ?>"><?= languagedata($this->session->userdata('session_language'), "Manage Languages"); ?></a>
					</li>
					<li id="change_password">
						<a href="<?= base_url('admin/settings/password'); ?>"><?= languagedata($this->session->userdata('session_language'), "Change Password"); ?></a>
					</li>
					<!-- <li id="signout">
						<a href="<?= base_url('auth/logout'); ?>">Sign Out</a>
					</li> -->
				</ul>
			</li>


			<li id="signout">
				<a href="<?= base_url('auth/logout'); ?>"><i class="material-icons">input</i><span><?= languagedata($this->session->userdata('session_language'), "Sign Out"); ?></span></a>
			</li>
			<!-- <li id="ci_examples">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">code</i>
          <span>CI Examples</span>
        </a>
        <ul class="ml-menu">
          <li id="simple_datatable">
            <a href="<?= base_url('admin/ci_examples/simple_datatable'); ?>">Simple Datatable</a>
          </li>
          <li id="ajax_datatable">
            <a href="<?= base_url('admin/ci_examples/ajax_datatable'); ?>">Ajax Datatable</a>
          </li>
          <li id="pagination">
            <a href="<?= base_url('admin/ci_examples/pagination'); ?>">Pagination Examples</a>
          </li>
          <li id="file_upload">
            <a href="<?= base_url('admin/ci_examples/file_upload'); ?>">File Upload</a>
          </li>
          <li id="multi_file_upload">
            <a href="<?= base_url('admin/ci_examples/multi_file_upload'); ?>">Multiple Files Upload</a>
          </li>
          <li id="location">
            <a href="<?= base_url('admin/ci_examples/location'); ?>">Locations</a>
          </li>
          <li id="charts">
            <a href="<?= base_url('admin/ci_examples/charts'); ?>">Dynamic Charts</a>
          </li>
          <li id="advance_search">
            <a href="<?= base_url('admin/ci_examples/advance_search'); ?>">Advance Search</a>
          </li>
        </ul>
      </li> -->
			<!-- <li id="location">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">my_location</i>
          <span>Locations</span>
        </a>
        <ul class="ml-menu">
          <li id="country">
            <a href="<?= base_url('admin/location/country'); ?>">Country</a>
          </li>
          <li id="state">
            <a href="<?= base_url('admin/location/state'); ?>">State</a>
          </li>
          <li id="city">
            <a href="<?= base_url('admin/location/city'); ?>">City</a>
          </li>
        </ul>
      </li>
      <li id="activity">
        <a href="<?= base_url('admin/activity'); ?>">
          <i class="material-icons">flag</i>
          <span>Users Activity</span>
        </a>
      </li>
      <li id="export">
        <a href="<?= base_url('admin/export'); ?>">
          <i class="material-icons">backup</i>
          <span>Backup & Export</span>
        </a>
      </li>
       <li id="general_settings">
        <a href="<?= base_url('admin/general_settings'); ?>">
          <i class="material-icons">settings</i>
          <span>Settings</span>
        </a>
      </li>
      <li id="typography">
        <a href="<?= base_url('admin/typography'); ?>">
          <i class="material-icons">text_fields</i>
          <span>Typography</span>
        </a>
      </li>
      <li id="helper">
        <a href="<?= base_url('admin/helper'); ?>">
          <i class="material-icons">layers</i>
          <span>Helper Classes</span>
        </a>
      </li>
      <li id="widgets">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">widgets</i>
          <span>Widgets</span>
        </a>
        <ul class="ml-menu">
          <li id="cards">
            <a href="javascript:void(0);" class="menu-toggle">
              <span>Cards</span>
            </a>
            <ul class="ml-menu">
              <li id="">
                <a href="<?= base_url('admin/widgets/basic'); ?>">Basic</a>
              </li>
              <li id="">
                <a href="<?= base_url('admin/widgets/colored'); ?>">Colored</a>
              </li>
              <li id="">
                <a href="<?= base_url('admin/widgets/no_header'); ?>">No Header</a>
              </li>
            </ul>
          </li>
          <li id="infobox">
            <a href="javascript:void(0);" class="menu-toggle">
              <span>Infobox</span>
            </a>
            <ul class="ml-menu">
              <li id="">
                <a href="<?= base_url('admin/widgets/infobox_1'); ?>">Infobox-1</a>
              </li>
              <li id="">
                <a href="<?= base_url('admin/widgets/infobox_2'); ?>">Infobox-2</a>
              </li>
              <li id="">
                <a href="<?= base_url('admin/widgets/infobox_3'); ?>">Infobox-3</a>
              </li>
              <li id="">
                <a href="<?= base_url('admin/widgets/infobox_4'); ?>">Infobox-4</a>
              </li>
              <li id="">
                <a href="<?= base_url('admin/widgets/infobox_5'); ?>">Infobox-5</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li id="ui">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">swap_calls</i>
          <span>User Interface (UI)</span>
        </a>
        <ul class="ml-menu">
          <li id="alerts">
            <a href="<?= base_url('admin/ui/alerts'); ?>">Alerts</a>
          </li>
          <li id="animations">
            <a href="<?= base_url('admin/ui/animations'); ?>">Animations</a>
          </li>
          <li id="badges">
            <a href="<?= base_url('admin/ui/badges'); ?>">Badges</a>
          </li>

          <li id="breadcrumbs">
            <a href="<?= base_url('admin/ui/breadcrumbs'); ?>">Breadcrumbs</a>
          </li>
          <li id="buttons">
            <a href="<?= base_url('admin/ui/buttons'); ?>">Buttons</a>
          </li>
          <li id="collapse">
            <a href="<?= base_url('admin/ui/collapse'); ?>">Collapse</a>
          </li>
          <li id="colors">
            <a href="<?= base_url('admin/ui/colors'); ?>">Colors</a>
          </li>
          <li id="dialogs">
            <a href="<?= base_url('admin/ui/dialogs'); ?>">Dialogs</a>
          </li>
          <li id="icons">
            <a href="<?= base_url('admin/ui/icons'); ?>">Icons</a>
          </li>
          <li id="labels">
            <a href="<?= base_url('admin/ui/labels'); ?>">Labels</a>
          </li>
          <li id="list_group">
            <a href="<?= base_url('admin/ui/list_group'); ?>">List Group</a>
          </li>
          <li id="media_object">
            <a href="<?= base_url('admin/ui/media_object'); ?>">Media Object</a>
          </li>
          <li id="modals">
            <a href="<?= base_url('admin/ui/modals'); ?>">Modals</a>
          </li>
          <li id="notifications">
            <a href="<?= base_url('admin/ui/notifications'); ?>">Notifications</a>
          </li>
          <li id="pagination">
            <a href="<?= base_url('admin/ui/pagination'); ?>">Pagination</a>
          </li>
          <li id="preloaders">
            <a href="<?= base_url('admin/ui/preloaders'); ?>">Preloaders</a>
          </li>
          <li id="progressbars">
            <a href="<?= base_url('admin/ui/progressbars'); ?>">Progress Bars</a>
          </li>
          <li id="range_sliders">
            <a href="<?= base_url('admin/ui/range_sliders'); ?>">Range Sliders</a>
          </li>
          <li id="sortable_nestable">
            <a href="<?= base_url('admin/ui/sortable_nestable'); ?>">Sortable & Nestable</a>
          </li>
          <li id="sortable_nestable">
            <a href="<?= base_url('admin/ui/sortable_nestable'); ?>">Tabs</a>
          </li>
          <li id="thumbnails">
            <a href="<?= base_url('admin/ui/thumbnails'); ?>">Thumbnails</a>
          </li>
          <li id="tooltips_popovers">
            <a href="<?= base_url('admin/ui/tooltips_popovers'); ?>">Tooltips & Popovers</a>
          </li>
          <li id="waves">
            <a href="<?= base_url('admin/ui/waves'); ?>">Waves</a>
          </li>
        </ul>
      </li>
      <li id="forms">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">assignment</i>
          <span>Forms</span>
        </a>
        <ul class="ml-menu">
          <li id="basic">
            <a href="<?= base_url('admin/forms/basic'); ?>">Basic Form Elements</a>
          </li>
          <li id="advanced">
            <a href="<?= base_url('admin/forms/advanced'); ?>">Advanced Form Elements</a>
          </li>
          <li id="examples">
            <a href="<?= base_url('admin/forms/examples'); ?>">Form Examples</a>
          </li>
          <li id="validation">
            <a href="<?= base_url('admin/forms/validation'); ?>">Form Validation</a>
          </li>
          <li id="wizard">
            <a href="<?= base_url('admin/forms/wizard'); ?>">Form Wizard</a>
          </li>
          <li id="editors">
            <a href="<?= base_url('admin/forms/editors'); ?>">Editors</a>
          </li>
        </ul>
      </li>
      <li id="tables">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">view_list</i>
          <span>Tables</span>
        </a>
        <ul class="ml-menu">
          <li id="normal">
            <a href="<?= base_url('admin/tables/normal'); ?>">Normal Tables</a>
          </li>
          <li id="jquery">
            <a href="<?= base_url('admin/tables/jquery'); ?>">Jquery Datatables</a>
          </li>
          <li id="editable">
            <a href="<?= base_url('admin/tables/editable'); ?>">Editable Tables</a>
          </li>
        </ul>
      </li>
      <li id="medias">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">perm_media</i>
          <span>Medias</span>
        </a>
        <ul class="ml-menu">
          <li id="gallery">
            <a href="<?= base_url('admin/medias/gallery'); ?>">Image Gallery</a>
          </li>
          <li id="carousel">
            <a href="<?= base_url('admin/medias/carousel'); ?>">Carousel</a>
          </li>
        </ul>
      </li>
      <li id="charts">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">pie_chart</i>
          <span>Charts</span>
        </a>
        <ul class="ml-menu">
          <li id="morris">
            <a href="<?= base_url('admin/charts/morris'); ?>">Morris</a>
          </li>
          <li id="flot">
            <a href="<?= base_url('admin/charts/flot'); ?>">Flot</a>
          </li>
          <li id="chartjs">
            <a href="<?= base_url('admin/charts/chartjs'); ?>">ChartJS</a>
          </li>
          <li id="sparkline">
            <a href="<?= base_url('admin/charts/sparkline'); ?>">Sparkline</a>
          </li>
          <li id="jquery_knob">
            <a href="<?= base_url('admin/charts/jquery_knob'); ?>">Jquery Knob</a>
          </li>
        </ul>
      </li>
      <li id="examples">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">content_copy</i>
          <span>Example Pages</span>
        </a>
        <ul class="ml-menu">
          <li id="signin">
            <a href="<?= base_url('admin/examples/signin'); ?>">Sign In</a>
          </li>
          <li id="signup">
            <a href="<?= base_url('admin/examples/signup'); ?>">Sign Up</a>
          </li>
          <li id="forgot_password">
            <a href="<?= base_url('admin/examples/forgot_password'); ?>">Forgot Password</a>
          </li>
          <li id="blank">
            <a href="<?= base_url('admin/examples/blank'); ?>">Blank Page</a>
          </li>
          <li id="page_404">
            <a href="<?= base_url('admin/examples/page_404'); ?>">404 - Not Found</a>
          </li>
          <li id="page_500">
            <a href="<?= base_url('admin/examples/page_500'); ?>">500 - Server Error</a>
          </li>
        </ul>
      </li>
      <li id="maps">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">map</i>
          <span>Maps</span>
        </a>
        <ul class="ml-menu">
          <li id="google">
            <a href="<?= base_url('admin/maps/google'); ?>">Google Map</a>
          </li>
          <li id="yandex">
            <a href="<?= base_url('admin/maps/yandex'); ?>">YandexMap</a>
          </li>
          <li id="jvector">
            <a href="<?= base_url('admin/maps/jvector'); ?>">jVectorMap</a>
          </li>
        </ul>
      </li>
      
      <li id="">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">trending_down</i>
          <span>Multi Level Menu</span>
        </a>
        <ul class="ml-menu">
          <li id="">
            <a href="javascript:void(0);">
              <span>Menu Item</span>
            </a>
          </li>
          <li id="">
            <a href="javascript:void(0);">
              <span>Menu Item - 2</span>
            </a>
          </li>
          <li id="">
            <a href="javascript:void(0);" class="menu-toggle">
              <span>Level - 2</span>
            </a>
            <ul class="ml-menu">
              <li id="">
                <a href="javascript:void(0);">
                  <span>Menu Item</span>
                </a>
              </li>
              <li id="">
                <a href="javascript:void(0);" class="menu-toggle">
                  <span>Level - 3</span>
                </a>
                <ul class="ml-menu">
                  <li id="">
                    <a href="javascript:void(0);">
                      <span>Level - 4</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li id="changelogs">
        <a href="<?= base_url('admin/changelogs'); ?>">
          <i class="material-icons">update</i>
          <span>Changelogs</span>
        </a>
      </li>
      <li class="header">LABELS</li>
      <li id="">
        <a href="javascript:void(0);">
          <i class="material-icons col-red">donut_large</i>
          <span>Important</span>
        </a>
      </li>
      <li id="">
        <a href="javascript:void(0);">
          <i class="material-icons col-amber">donut_large</i>
          <span>Warning</span>
        </a>
      </li>
      <li id="">
        <a href="javascript:void(0);">
          <i class="material-icons col-light-blue">donut_large</i>
          <span>Information</span>
        </a>
      </li> -->
		</ul>
	</div>
	<!-- #Menu -->
	<!-- Footer -->
	<!-- <div class="legal">
    <div class="copyright">
      <a href="javascript:void(0);"><?= $this->general_settings['copyright'] ?></a>.
    </div>
  </div> -->
	<!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->

<script>
	$("#<?= $cur_tab; ?>").addClass('active');
	$("#<?= $sub_tab; ?>").addClass('active');
</script>