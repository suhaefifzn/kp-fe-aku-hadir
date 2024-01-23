<table id="tableDaftarPengguna" class="table">
	<thead>
		<tr class="bg-dark text-light text-center">
			<th>No.</th>
			<th>Username</th>
			<th>Fullname</th>
			<th>Role</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($users as $user) :
		?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $user->username ? $user->username : '-'; ?> </td>
				<td><?= $user->fullname ? $user->fullname : '-'; ?></td>
				<td><?= $user->role ?  $user->role : '-'; ?></td>
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
		$('#tableDaftarPengguna').DataTable({
			'columnDefs': [{
				'orderable': false,
				'targets': [1, 2, 3],
			}],
		});
		$('#tableDaftarPengguna').addClass('pt-3');
		$('#tableDaftarPengguna_length').addClass('d-none d-md-block');
		$('#tableDaftarPengguna_filter').addClass('d-none d-md-block');
	}
</script>