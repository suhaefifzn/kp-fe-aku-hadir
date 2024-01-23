<table id="tableRekap" class="table">
	<thead>
		<tr class="bg-dark text-light text-center">
			<th style="width: 10%;">No.</th>
			<th style="width: 30%;">Waktu</th>
			<th style="width: 15%;">Jenis</th>
			<th>Laporan</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($reports as $row) :
			$timeStart = date('H:i', strtotime($row->time_start));

			$timeEnd = '';
			if (!empty($row->time_end)) {
				$timeEnd = date('H:i', strtotime($row->time_end));
			}

			$dateStart = date('d-m-Y', strtotime($row->time_start));
			$dayName = setDayNameID(date('l', strtotime($row->time_start)));
			$totalTime = "$timeStart - $timeEnd<br/>$dayName, $dateStart";
			$type = $row->category_name;
			$report = !empty($row->report) ? $row->report : '-';
		?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $totalTime; ?> </td>
				<td><?= $type; ?></td>
				<td><?= $report; ?></td>
			</tr>
		<?php $no++;
		endforeach; ?>
	</tbody>
</table>

<script>
	$(document).ready(() => {
		dataTable();
	});

	function dataTable() {
		$('#tableRekap').DataTable({
			// 'ordering': false,
			'columnDefs': [{
				'orderable': false,
				'targets': [2, 3],
			}],
		});
		$('#tableRekap').addClass('pt-3');
		$('#tableRekap_length').addClass('d-none d-md-block');
		$('#tableRekap_filter').addClass('d-none d-md-block');
	}
</script>