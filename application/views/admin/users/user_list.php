<!-- JQuery DataTable Css -->
<link href="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- Exportable Table -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2 style="display: inline-block;">
					<?= languagedata($this->session->userdata('session_language'), "Clients List"); ?>
				</h2>
				<a href="<?= base_url('admin/clients/add'); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i><?= languagedata($this->session->userdata('session_language'), " Add New Client"); ?></a>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
						<thead>
							<tr>
								<th>#ID</th>
								<th><?= languagedata($this->session->userdata('session_language'), "Company Name"); ?></th>
								<th><?= languagedata($this->session->userdata('session_language'), "Company Abbreviation"); ?></th>
								<th><?= languagedata($this->session->userdata('session_language'), "Accounting Term"); ?></th>
								<th><?= languagedata($this->session->userdata('session_language'), "Country"); ?></th>

								<th><?= languagedata($this->session->userdata('session_language'), "Unit"); ?></th>
								<th><?= languagedata($this->session->userdata('session_language'), "Start Year"); ?></th>
								<!-- <th>Email</th> -->
								<th><?= languagedata($this->session->userdata('session_language'), "Created Date"); ?></th>
								<th><?= languagedata($this->session->userdata('session_language'), "Action"); ?></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Exportable Table -->

<!-- Modal -->
<div id="confirm-delete" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?= languagedata($this->session->userdata('session_language'), "Terminate"); ?></h4>
			</div>
			<div class="modal-body">
				<p><?= languagedata($this->session->userdata('session_language'), "Are you sure you want to terminate."); ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?= languagedata($this->session->userdata('session_language'), "Close"); ?></button>
				<a class="btn btn-danger btn-ok"><?= languagedata($this->session->userdata('session_language'), "Terminate"); ?></a>
			</div>
		</div>
	</div>
</div>


<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
  <script src="<?= base_url()?>public/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
  <!-- Custom Js -->
  <script src="<?= base_url()?>public/js/pages/tables/jquery-datatable.js"></script>

<script type="text/javascript">
	//---------------------------------------------------
	var table = $('#na_datatable').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "<?= base_url('admin/clients/datatable_json') ?>",
		"order": [
			[5, 'desc']
		],
		dom: 'Bfrtip',
		buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		"columnDefs": [{
				"targets": 0,
				"name": "ci_users.id",
				'searchable': false,
				'orderable': true
			},
			{
				"targets": 1,
				"name": "country",
				'searchable': true,
				'orderable': true
			},
			{
				"targets": 2,
				"name": "unit",
				'searchable': false,
				'orderable': false
			},
			{
				"targets": 3,
				"name": "company_name",
				'searchable': true,
				'orderable': true
			},
			{
				"targets": 4,
				"name": "company_abbreviation",
				'searchable': true,
				'orderable': true
			},
			{
				"targets": 5,
				"name": "accounting_term",
				'searchable': false,
				'orderable': false,
				// 'width': '100px'
			},
			{
				"targets": 6,
				"name": "start_year",
				'searchable': true,
				'orderable': true
			},
			{
				"targets": 7,
				"name": "ci_users.email",
				'searchable': true,
				'orderable': true
			},
			{
				"targets": 8,
				"name": "ci_users.created_at",
				'searchable': false,
				'orderable': true
			}
		]
	});
</script>
<!-- Autosize Plugin Js -->
<script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script>
<!-- Custom Js -->
<script src="<?= base_url() ?>public/js/pages/tables/jquery-datatable.js"></script>
<script>
	//Textare auto growth
	autosize($('textarea.auto-growth'));

	//Delete Dialogue
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	$("#users").addClass('active');
	$("#user_list").addClass('active');
</script>