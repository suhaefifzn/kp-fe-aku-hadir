<main class="d-flex flex-column w-100 gap-4 m-5 pt-5 pt-md-0">
	<!-- Breadcrumb -->
	<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="border-bottom border-secondary">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url(); ?>">AKU HADIR</a></li>
			<li class="breadcrumb-item" aria-current="page">
				<?= $title ? $title : ''; ?>
			</li>
			<?php if (isset($secondary_title)) : ?>
				<li class="breadcrumb-item active" aria-current="page">
					<?= $secondary_title; ?>
				</li>
			<?php endif; ?>
		</ol>
	</nav>
	<!-- Content -->
	<section class="content">
		<div class="alert alert-info shadow-lg">
			<h2 class="fw-semibold fs-5 mb-3">Laporan:</h2>
			<form>

				<?php if ($this->uri->segment(2) === 'izin') : ?>
					<div class="mb-3">
						<span class="small text-danger" id="categoryReport-error"></span>
						<select class="form-select" id="categoryReport">
							<option value="" selected disabled hidden>Pilih Kategori Izin</option>
							<?php foreach ($categories as $category) : ?>
								<option value="<?= $category->_id; ?>"><?= $category->name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				<?php endif; ?>

				<div class="mb-3">
					<span class="small text-danger" id="laporan-error"></span>
					<textarea class="form-control" id="laporan" rows="8"></textarea>
				</div>
				<button class="btn btn-primary d-flex ms-auto" type="button" onclick="confirmReport()">
					KIRIM
				</button>
			</form>
		</div>
	</section>
</main>