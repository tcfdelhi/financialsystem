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
					languages List
				</h2>

				<button type="button" class="btn bg-indigo waves-effect pull-right" data-toggle="modal" data-target="#importModal" style="margin-left:10px"><i class="material-icons">person_add</i>Import Excel</button>


				<a href="<?= base_url('admin/settings/add_language'); ?>" class="btn bg-indigo waves-effect pull-right"><i class="material-icons">person_add</i> ADD NEW LANGUAGE</a>
			</div>
			<div class="body">
				<div class="table-responsive">
					<table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
						<thead>
							<tr>
								<th>#ID</th>
								<th>English</th>
								<th>Japanese</th>
								<th>Vietnamese</th>
								<th>Thai</th>
								<th>Indonesian</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 0;
							foreach ($currency as $row) : ?>
								<tr>
									<td><?= ++$count; ?></td>
									<td><?= $row['english']; ?></td>
									<td><?= $row['japanese']; ?></td>
									<td><?= $row['vietnamese']; ?></td>
									<td><?= $row['thai']; ?></td>
									<td><?= $row['indonesian']; ?></td>
									<td>
										<a title="Edit" class="update btn btn-sm btn-primary" href="<?= base_url('admin/settings/add_language/' . $row['id']) ?>"><i class="material-icons">edit</i></a>
										<a title="Delete" class="delete btn btn-sm btn-danger" data-href="<?= base_url('admin/settings/delete_language/' . $row['id']); ?>" data-toggle="modal" data-target="#confirm-delete"><i class="material-icons">delete</i>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
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
				<h4 class="modal-title">Delete</h4>
			</div>
			<div class="modal-body">
				<p>As you sure you want to delete.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a class="btn btn-danger btn-ok">Delete</a>
			</div>
		</div>
	</div>
</div>

<!-- Import Excel Modal -->
<div class="modal fade" id="importModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload Excel file</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('admin/settings/import_excel'); ?>" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div class="col-lg-12">
						<div class="form-group">
							<input type="file" name="uploadFile" class="filestyle" data-icon="false">
						</div>
					</div>
					<div class="col-lg-12">
						<input type="submit" value="Upload file" name="submit">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>

	<!-- Jquery DataTable Plugin Js -->
	<script src="<?= base_url() ?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
	<script src="<?= base_url() ?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
	<script type="text/javascript">
		//---------------------------------------------------
		var table = $('#na_datatable').DataTable();
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
		$("#ci_examples").addClass('active');
		$("#pagination").addClass('active');
	</script>