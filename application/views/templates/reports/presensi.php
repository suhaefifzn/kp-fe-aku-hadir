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
		<div class="alert alert-info">
			<div class="d-flex flex-wrap gap-5 justify-content-center p-2">
				<!-- Check In -->
				<button class="card shadow-lg text-decoration-none text-reset align-items-center col-8 col-sm-6 col-md-6 col-lg-3 p-2 border border-dark" id="checkInButton" style="min-height: 150px;" data-category="<?= $checkIn->_id; ?>">
					<img src="<?= base_url('assets/img/check-in.png') ?>" class="card-img-top img-fluid" style="height: 150px; width: 150px" alt="Check in" id="checkInButton">
					<div class="card-body">
						<h3 class="card-title fs-6 text-center">Check In</h3>
					</div>
				</button>

				<!-- Izin -->
				<button class="card shadow-lg text-decoration-none text-reset align-items-center col-8 col-sm-6 col-md-6 col-lg-3 p-2 border border-dark" href="<?= base_url('presensi/izin'); ?>" style="min-height: 150px;" id="izinButton">
					<img src="<?= base_url('assets/img/permit.png') ?>" class="card-img-top img-fluid" style="height: 150px; width: 150px" alt="Check in">
					<div class="card-body">
						<h3 class="card-title fs-6 text-center">Izin</h3>
					</div>
				</button>

				<!-- Check Out -->
				<button class="card shadow-lg text-decoration-none text-reset align-items-center col-8 col-sm-6 col-md-6 col-lg-3 p-2 border border-dark" href="<?= base_url('presensi/kerja'); ?>" style="min-height: 150px;" id="checkOutButton">
					<img src="<?= base_url('assets/img/check-out.png') ?>" class="card-img-top img-fluid" style="height: 150px; width: 150px" alt="Check out">
					<div class="card-body">
						<h3 class="card-title fs-6 text-center">Check Out</h3>
					</div>
				</button>
			</div>
		</div>
	</section>
</main>

<script type="text/javascript">
	$('#checkInButton').on('click', function() {
		const url = '<?= base_url("checkin_kerja") ?>';
		const data = {
			'category_id': this.dataset.category,
			'time_start': new Date().toISOString(),
		};

		$.ajax({
			url,
			data,
			type: 'POST',
			dataType: 'json',
			beforeSend: function() {
				$.LoadingOverlay('show');
			},
			success: function(response) {
				if (response.success) {
					Swal.fire({
						toast: true,
						title: 'Sukses',
						text: 'Kehadiran berhasil direkam',
						icon: 'success',
						showConfirmButton: false,
						timerProgressBar: true,
						timer: 5000, // 5 detik
						position: 'top-right',
						background: '#343a40',
						color: '#fff'
					});
				} else {
					Swal.fire({
						toast: true,
						text: response.message,
						icon: 'info',
						showConfirmButton: false,
						timerProgressBar: true,
						timer: 5000, // 5 detik
						position: 'top-right',
						background: '#343a40',
						color: '#fff'
					});
				}
			},
			complete: function() {
				$.LoadingOverlay('hide');
			}
		})
	});

	$('#izinButton').on('click', function() {
		window.location.href = '<?= base_url('presensi/izin') ?>';
	});

	$('#checkOutButton').on('click', function() {
		window.location.href = '<?= base_url('presensi/kerja') ?>';
	})
</script>