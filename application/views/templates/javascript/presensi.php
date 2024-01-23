<script>
	const secondSegmentURI = '<?= $this->uri->segment(2); ?>';

	$(document).ready(() => {
		CKEDITOR.replace('laporan');
	});

	function isBlank(str) {
		return (!str || /^\s*$/.test(str));
	}

	function removeTags(str) {
		return str.toString().replace(/(<\/?[^>]+(>|$)|&nbsp;|\s)/g, '');
	}

	function mandatoryCheck() {
		let flagCheck = false; // lolos validasi

		if (secondSegmentURI === 'izin') {
			const inputElements = ['categoryReport', 'laporan'];

			inputElements.forEach((element) => {
				if (element === 'laporan') {
					const statusValueLaporan = isBlank(
						removeTags(CKEDITOR.instances.laporan.getData())
					);

					if (statusValueLaporan) {
						flagCheck = true;
						$(`#${element}-error`).html('This field is required.');
					} else {
						$(`#${element}-error`).html('');
					}
				} else {
					const statusValue = isBlank($(`#${element}`).find(':selected').val());

					if (statusValue) {
						flagCheck = true;
						$(`#${element}-error`).html('This field is required.');
					} else {
						$(`#${element}-error`).html('');
					}
				}
			});
		} else {
			const inputElements = ['laporan'];

			inputElements.forEach((element) => {
				if (element === 'laporan') {
					const statusValueLaporan = isBlank(
						removeTags(CKEDITOR.instances.laporan.getData())
					);

					if (statusValueLaporan) {
						flagCheck = true;
						$(`#${element}-error`).html('This field is required.');
					} else {
						$(`#${element}-error`).html('');
					}
				}
			});
		}

		return flagCheck;
	}

	function confirmReport() {
		if (mandatoryCheck()) {
			return;
		} else {
			const data = {
				category_id: secondSegmentURI === 'kerja' ? null : $('#categoryReport').find(':selected').val(),
				time_end: new Date().toISOString(),
				report: CKEDITOR.instances.laporan.getData(),
			}

			Swal.fire({
				title: 'Apa kamu yakin?',
				text: "Laporan yang telah dikirim tidak bisa diubah lagi",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya',
				cancelButtonText: 'Batal',
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						data,
						url: '<?= base_url("checkout_kerja"); ?>',
						type: 'POST',
						dataType: 'json',
						beforeSend: function() {
							$.LoadingOverlay('show');
						},
						success: function(response) {
							if (response.success) {
								Swal.fire({
									title: 'Terkirim!',
									text: 'Laporan hari ini berhasil dikirim.',
									icon: 'success',
									confirmButtonColor: '#3085d6',
								}).then(() => {
									$.LoadingOverlay('hide');
									location.href = '<?= base_url(); ?>';
								});
							} else {
								Swal.fire({
									title: 'Peringatan!',
									text: response.message,
									icon: 'info',
									confirmButtonColor: '#3085d6',
								});
							}
						},
						complete: function(response) {
							$.LoadingOverlay('hide');
						},
					});
				}
			});
		}
	}
</script>