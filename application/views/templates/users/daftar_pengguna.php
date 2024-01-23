<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
	<symbol id="add-user-icon" viewBox="0 0 16 16">
		<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
		<path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
	</symbol>
</svg>

<main class="d-flex flex-column w-100 gap-4 m-5 pt-5 pt-md-0">
	<!-- Breadcrumb -->
	<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="border-bottom border-secondary">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url(); ?>">AKU HADIR</a></li>
			<li class="breadcrumb-item active" aria-current="page">
				<?= $title ? $title : ''; ?>
			</li>
		</ol>
	</nav>

	<div id="buttonWrapper" class="d-flex justify-content-end">
		<button class="btn btn-primary" type="button" id="buttonTambahUser">
			<svg class="bi pe-none me-2" width="16" height="16">
				<use xlink:href="#add-user-icon" />
			</svg>
			Tambah User
		</button>
	</div>

	<div id="table-wrapper">
	</div>

	<!-- Modal Tambah User -->
	<div class="modal" tabindex="-1" id="modalAddUser" data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah User</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="formAddNewUser" method="POST">
						<div class="mb-2 row">
							<label for="username" class="col-sm-4 col-form-label">Username</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="username">
							</div>
						</div>
						<div class="mb-2 row">
							<label for="fullname" class="col-sm-4 col-form-label">Fullname</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="fullname">
							</div>
						</div>
						<div class="mb-2 row">
							<label for="email" class="col-sm-4 col-form-label">Email</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="email">
							</div>
						</div>
						<div class="mb-2 row">
							<label for="phone" class="col-sm-4 col-form-label">HP</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="phone">
							</div>
						</div>
						<div class="mb-2 row">
							<label for="password" class="col-sm-4 col-form-label">Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="password">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
							<button type="submit" class="btn btn-primary" id="buttonSaveNewUser">SIMPAN</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Tambah Role User -->
	<div class="modal" tabindex="-1" id="modalAddRoleUser" data-bs-backdrop="static">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Role User</h5>
				</div>
				<div class="modal-body">
					<form id="formAddRoleUser" method="POST">
						<input type="text" id="newUserId" hidden>
						<div class="mb-2 row align-items-center">
							<label for="role" class="col-sm-2 col-form-label">Role</label>
							<div class="col-sm-10">
								<select name="role" id="role" class="form-select form-select-sm">
									<option value="">Pilih</option>
									<?php foreach ($roles as $role) : ?>
										<option value="<?= $role->_id; ?>"><?= $role->role; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" id="buttonRoleNewUser">SIMPAN</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>

<script type="text/javascript">
	$(document).ready(function() {
		$('#role').select2({
			dropdownParent: $('#modalAddRoleUser'),
			width: '100%',
		});
		loadTableDaftarPengguna();
	});

	function loadTableDaftarPengguna() {
		const url = `<?= base_url("load_data_table_daftar_pengguna"); ?>`;

		$.LoadingOverlay('show');
		$('#table-wrapper')
			.load(url, function(response, status, xhr) {
				if (status === 'success') {
					$.LoadingOverlay('hide');
				}
			});
	}

	$('#buttonTambahUser').on('click', function() {
		$('#modalAddUser').modal('show');
	});

	$('#formAddNewUser').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: '<?= base_url("add_new_user"); ?>',
			dataType: 'json',
			type: 'POST',
			data: {
				username: $('#username').val(),
				fullname: $('#fullname').val(),
				email: $('#email').val(),
				phone: $('#phone').val(),
				password: $('#password').val(),
			},
			beforeSend: function() {
				$.LoadingOverlay('show');
			},
			success: function(response) {
				const userId = response.data.userId;
				$('#newUserId').val(userId);
				if (response.success) {
					$('#modalAddUser').modal('hide');
					$('#modalAddRoleUser').modal('show');
				} else {
					Swal.fire({
						icon: 'warning',
						text: `${response.message}`,
					});
				}
			},
			complete: function() {
				$.LoadingOverlay('hide');
			},
			error: function(response) {
				console.log(response);
			}
		})
	});

	$('#formAddRoleUser').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: '<?= base_url("add_role_user"); ?>',
			dataType: 'json',
			type: 'POST',
			data: {
				userId: $('#newUserId').val(),
				roleId: $('#role').find(':selected').val(),
			},
			beforeSend: function() {
				$.LoadingOverlay('show');
			},
			success: function(response) {
				if (response.success) {
					$('#modalAddRoleUser').modal('hide');
					Swal.fire({
						icon: 'success',
						text: 'User berhasil ditambahkan',
						timer: 1500,
						toast: true,
						timerProgressBar: true,
						showConfirmButton: false,
						position: 'top-end'
					}).then(function() {
						location.reload();
					})
				} else {
					Swal.fire({
						icon: 'warning',
						text: `${response.message}`,
					});
				}
			},
			complete: function() {
				$.LoadingOverlay('hide');
			},
			error: function(response) {
				console.log(response);
			}
		})
	});
</script>