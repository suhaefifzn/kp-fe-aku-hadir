<!-- JS Global -->
<script>
	$('#logoutButton').on('click', function() {
		const baseURL = '<?= base_url() ?>';
		window.location.href = `${baseURL}logout`;
	});

	$(document).on('select2:open', () => {
		document.querySelector('.select2-search__field').focus();
	});
</script>

<?php if ($this->uri->segment(1) === 'login') : ?>
	<!-- JS Halaman Presensi -->
	<?php
	require APPPATH . 'views\templates\javascript\login.php';
	?>
<?php endif; ?>

<?php if (($this->uri->segment(1) === 'presensi')
	and (($this->uri->segment(2) === 'izin')
		or ($this->uri->segment(2) === 'kerja')
	)
) :
?>
	<!-- JS Halaman Presensi -->
	<?php
	require APPPATH . 'views\templates\javascript\presensi.php';
	?>
<?php endif; ?>

</body>

</html>