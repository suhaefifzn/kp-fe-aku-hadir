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
	<!-- Content -->
	<section class="content">
		<div class="col-lg-6 alert alert-info">
			<form class="form">
				<div class="mb-3 row">
					<label for="username" class="col-sm-3 col-form-label">Username</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="username" value="<?= $user->username ? $user->username : ''; ?>">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="fullname" class="col-sm-3 col-form-label">Fullname</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="fullname" value="<?= $user->fullname ? $user->fullname : ''; ?>">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="email" class="col-sm-3 col-form-label">Email</label>
					<div class="col-sm-9">
						<input type="email" class="form-control" id="email" value="<?= $user->email ? $user->email : ''; ?>">
					</div>
				</div>
				<div class="mb-3 row">
					<label for="phone" class="col-sm-3 col-form-label">HP</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="phone" value="<?= $user->phone ? $user->phone : ''; ?>">
					</div>
				</div>
				<div class="d-flex justify-content-end gap-2">
					<button class="btn btn-warning justify-content-center" type="button" onclick="changeUserPassword()">
						UBAH PASSWORD
					</button>
					<button class="btn btn-primary justify-content-center" type="button" onclick="confirmUserChanges()">
						SIMPAN
					</button>
				</div>
			</form>
		</div>
	</section>

	<!-- Modal Ubah Password -->
	<div class="modal" tabindex="-1" id="modalChangePassword" data-bs-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ubah Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-2 row">
							<label for="newPassword" class="col-sm-4 col-form-label">New Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="newPassword">
							</div>
						</div>
						<div class="mb-2 row">
							<label for="oldPassword" class="col-sm-4 col-form-label">Old Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="oldPassword">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
					<button type="button" class="btn btn-primary" id="buttonSaveNewPassword">SIMPAN</button>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
	function changeUserPassword() {
		$('#newPassword').val('');
		$('#oldPassword').val('');
		$('#modalChangePassword').modal('show');
		$('#buttonSaveNewPassword').on('click', function() {
			$.ajax({
				url: '<?= base_url("update_user_password"); ?>',
				type: 'POST',
				dataType: 'json',
				data: {
					newPassword: $('#newPassword').val(),
					oldPassword: $('#oldPassword').val(),
				},
				beforeSend: function() {
					$.LoadingOverlay('show');
				},
				success: function(response) {
					if (!response.success) {
						Swal.fire({
							icon: 'warning',
							text: response.message,
						});
					} else {
						window.location.href = '<?= base_url("logout"); ?>';
					}
				},
				complete: function(response) {
					$.LoadingOverlay('hide');
				}
			})
		});
	}

	function confirmUserChanges() {
		Swal.fire({
			title: 'Simpan Perubahan?',
			text: 'Jika berhasil kamu akan diarahkan ke halaman login.',
			input: 'password',
			inputPlaceholder: 'Masukkan password...',
			inputAttributes: {
				autocapitalize: 'off'
			},
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Simpan',
			cancelButtonText: 'Batal',
			showLoaderOnConfirm: true,
			preConfirm: (password) => {
				$.ajax({
					url: `<?= base_url('update_user') ?>`,
					type: 'POST',
					dataType: 'json',
					data: {
						username: $('#username').val(),
						fullname: $('#fullname').val(),
						email: $('#email').val(),
						phone: $('#phone').val(),
						password,
					},
					beforeSend: function() {
						$.LoadingOverlay('show');
					},
					success: function(response) {
						if (!response.success) {
							Swal.fire({
								icon: 'warning',
								text: response.message,
							});
						} else {
							window.location.href = '<?= base_url("logout"); ?>';
						}
					},
					complete: function(response) {
						$.LoadingOverlay('hide');
					}
				});
			},
			allowOutsideClick: () => !Swal.isLoading()
		});
	}
</script>