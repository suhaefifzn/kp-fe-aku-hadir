<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
	<symbol id="search-icon" viewBox="0 0 16 16">
		<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
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

	<div id="formFilterPegawaiWrapper" class="col-md-8">
		<form method="POST" id="formFilterPegawai">
			<div class="row mb-3">
				<label for="selectPegawai" class="form-control-label col-sm-4">Nama Pegawai</label>
				<div class="col-sm-8">
					<select name="selectPegawai" id="selectPegawai" class="form-control form-select" required>
						<option value="">Pilih</option>
						<?php if (!empty($users)) : ?>
							<?php foreach ($users as $user) : ?>
								<?php if (($user->role === 'Admin') || ($user->role === 'Pimpinan')) : ?>
									<!-- TODO: Nothing -->
								<?php else : ?>
									<option value="<?= $user->user_id; ?>"><?= $user->fullname; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>
			</div>
			<div class="row mb-3">
				<label class="form-control-label col-sm-4">Tanggal</label>
				<div class="col-sm-8">
					<div class="input-group">
						<input type="text" name="fromDate" id="startDate" class="form-control form-control-sm text-center">
						<span class="input-group-text">s.d</span>
						<input type="text" name="toDate" id="endDate" class="form-control form-control-sm text-center">
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-end">
				<button type="submit" class="btn btn-sm btn-primary px-4">
					Cari
				</button>
			</div>
		</form>
	</div>

	<div id="table-wrapper">
	</div>
</main>

<script type="text/javascript">
	$(document).ready(function() {
		$('#selectPegawai').select2();

		setDateOfCurrentMonth();
		setDatePicker();
	});

	function setDatePicker() {
		$(`#endDate`).datepicker({
			dateFormat: 'dd-mm-yy',
			onSelect: function(selectedDate) {
				const firstDate = selectedDate.split('-');
				$('#startDate').datepicker('option', 'maxDate', new Date(firstDate[2], firstDate[1] - 1, firstDate[0]));
			},
		});

		$(`#startDate`).datepicker({
			dateFormat: 'dd-mm-yy',
			onSelect: function(selectedDate) {
				const endDate = selectedDate.split('-');
				$('#endDate').datepicker('option', 'minDate', new Date(endDate[2], endDate[1] - 1, endDate[0]))
			},
		});
	}

	function setDateOfCurrentMonth() {
		const date = new Date();
		const firstDate = new Date(date.getFullYear(), date.getMonth(), 1);
		const lastDate = new Date(date.getFullYear(), date.getMonth() + 1, 0);

		const formattedFirstDate = `${String(firstDate.getDate()).padStart(2, '0')}-${String(firstDate.getMonth() + 1).padStart(2, '0')}-${firstDate.getFullYear()}`;
		const formattedLastDate = `${String(lastDate.getDate()).padStart(2, '0')}-${String(lastDate.getMonth() + 1).padStart(2, '0')}-${lastDate.getFullYear()}`;

		$('#startDate').val(formattedFirstDate);
		$('#endDate').val(formattedLastDate);
	}

	function loadPart() {
		$.LoadingOverlay('show');
		const userId = $('#selectPegawai').val();
		const fromDate = $('#startDate').val();
		const endDate = $('#endDate').val();
		const url = `<?= base_url(); ?>load_data_table_presensi_pegawai/${userId}/${fromDate}/${endDate}`;

		$('#table-wrapper').load(url, function(response, status, xhr) {
			if (status === 'success') {
				$.LoadingOverlay('hide');
			}
		});
	}

	$('#formFilterPegawai').on('submit', function(e) {
		e.preventDefault();
		loadPart();
	});
</script>