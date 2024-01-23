<?php if ($this->uri->segment(1) === 'login') : ?>
	<style>
		body {
			height: 100vh !important;
			background-color: rgb(33, 37, 41);
		}

		.container-fluid {
			height: 100% !important;
		}
	</style>
<?php endif; ?>

<div class="container-fluid d-flex justify-content-center align-items-center">
	<div class="card p-4 col-10 col-sm-8 col-md-4 col-lg-4 shadow-lg">
		<div class="card-header">
			<h1 class="card-title text-center">AKU HADIR</h1>
		</div>
		<div class="card-body">
			<form class="my-4 p-2" id="formLogin" method="POST">
				<div class="mb-3">
					<label for="username" class="form-label">Username</label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				<button type="submit" class="btn btn-primary d-flex w-100 justify-content-center">
					LOGIN
				</button>
			</form>
		</div>
	</div>
</div>