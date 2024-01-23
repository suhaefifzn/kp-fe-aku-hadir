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

	<form class="row alert alert-info border border-dark">
		<div class="col-12 col-sm-10 col-md-10 col-lg-6">
			<span><b>Filter:</b></span>
			<div class="input-group">
				<input type="text" name="fromDate" id="startDate" class="form-control form-control-sm text-center">
				<span class="input-group-text">s.d</span>
				<input type="text" name="toDate" id="endDate" class="form-control form-control-sm text-center">
				<button class="btn btn-primary px-3" type="button" id="buttonFilterTanggal">Cari</button>
			</div>
		</div>
	</form>

	<div id="table-wrapper">
	</div>

	<!-- Content -->
	<section class="content"></section>
</main>

<script>
	$(document).ready(() => {
		setDateOfCurrentMonth();
		setDatePicker();

		loadDataTable();
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

	function loadDataTable() {
		const firstDate = $('#startDate').val();
		const lastDate = $('#endDate').val();
		const url = `<?= base_url("load_data_table_reports"); ?>/${firstDate}/${lastDate}`;

		$.LoadingOverlay('show');
		$('#table-wrapper')
			.load(url, function(response, status, xhr) {
				if (status === 'success') {
					$.LoadingOverlay('hide');
				}
			});
	}

	$('#buttonFilterTanggal').on('click', function() {
		loadDataTable();
	});
</script>