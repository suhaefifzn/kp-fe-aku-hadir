<script>
	$('#formLogin').submit(function(e) {
		e.preventDefault();

		$.ajax({
			url: '<?= base_url("authenticate") ?>',
			method: 'POST',
			dataType: 'json',
			data: $(this).serialize(),
			success: function(response) {
				if (response.status === 401) {
					Swal.fire({
						timer: 3000,
						toast: true,
						icon: 'error',
						color: '#fff',
						width: '430px',
						title: 'Gagal!',
						position: 'top-end',
						background: '#e35454',
						timerProgressBar: true,
						showConfirmButton: false,
						text: 'Kredensial tidak ditemukan!',
					});
				}

				if (response.status === 201) {
					Swal.fire({
						timer: 1500,
						toast: true,
						icon: 'success',
						width: '430px',
						title: 'Sukses!',
						position: 'top-end',
						timerProgressBar: true,
						showConfirmButton: false,
						text: 'Login berhasil, selamat datang!',
					}).then(function() {
						window.location.href = '<?= base_url(); ?>';
					});
				}
			},
			error: function(xhr, status, error) {
				console.log(error);
			},
		});
	});
</script>