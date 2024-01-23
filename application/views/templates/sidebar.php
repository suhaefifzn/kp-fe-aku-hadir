<?php if ($this->uri->segment(1) !== 'login') : ?>
	<style>
		body {
			display: flex !important;
		}

		hr {
			color: #fff;
		}

		.bi {
			vertical-align: -.125em;
			fill: currentColor;
		}
	</style>
<?php endif; ?>

<?php if (empty($this->uri->segment(1)) or $this->uri->segment(1) === 'presensi') : ?>
	<style>
		a.card:hover {
			transform: translateY(-8px);
			transition: 0.25s ease-in-out;
		}
	</style>
<?php endif; ?>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
	<symbol id="home" viewBox="0 0 16 16">
		<path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
	</symbol>
	<symbol id="table" viewBox="0 0 16 16">
		<path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
	</symbol>
	<symbol id="people-circle" viewBox="0 0 16 16">
		<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
		<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
	</symbol>
	<symbol id="grid" viewBox="0 0 16 16">
		<path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
	</symbol>
	<symbol id="chevron-right" viewBox="0 0 16 16">
		<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
	</symbol>
	<symbol id="person-workspace" viewBox="0 0 16 16">
		<path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
		<path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z" />
	</symbol>
	<symbol id="user-list" viewBox="0 0 16 16">
		<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
	</symbol>
</svg>

<div class="d-flex align-items-end flex-column flex-shrink-0 p-3 bg-dark sidebar-wrapper d-none d-md-block sticky-top" style="z-index: 999;">
	<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-light text-decoration-none">
		<span class="fs-4">AKU HADIR</span>
	</a>
	<hr>
	<ul class="nav nav-pills flex-column mb-auto">
		<?php if ($this->session->userdata('userInfo')) :
			$userInfo = $this->session->userdata('userInfo');
		?>
			<li>
				<a href="<?= base_url() ?>" class="nav-link link-light <?= empty($this->uri->segment(1)) ? 'active' : ''; ?>">
					<svg class="bi pe-none me-2" width="16" height="16">
						<use xlink:href="#home" />
					</svg>
					Beranda
				</a>
			</li>
			<li>
				<a href="<?= base_url('presensi'); ?>" class="nav-link link-light <?= $this->uri->segment(1) === 'presensi' ? 'active' : ''; ?>">
					<svg class="bi pe-none me-2" width="16" height="16">
						<use xlink:href="#grid" />
					</svg>
					Presensi
				</a>
			</li>

			<li>
				<a href="<?= base_url('rekap'); ?>" class="nav-link link-light <?= $this->uri->segment(1) === 'rekap' ? 'active' : ''; ?>">
					<svg class="bi pe-none me-2" width="16" height="16">
						<use xlink:href="#table" />
					</svg>
					<?= $userInfo['role'] === 'Pimpinan' ? 'Rekap Presensiku' : 'Rekap'; ?>
				</a>
			</li>

			<?php if ($userInfo['role'] === 'Pimpinan') : ?>
				<li>
					<a href="<?= base_url('rekap_presensi_pegawai'); ?>" class="nav-link link-light <?= $this->uri->segment(1) === 'rekap_presensi_pegawai' ? 'active' : ''; ?>">
						<svg class="bi pe-none me-2" width="16" height="16">
							<use xlink:href="#person-workspace" />
						</svg>
						Rekap Presensi Pegawai
					</a>
				</li>
			<?php endif; ?>

			<?php if ($userInfo['role'] === 'Admin') : ?>
				<li>
					<a href="<?= base_url('daftar_pengguna'); ?>" class="nav-link link-light <?= $this->uri->segment(1) === 'daftar_pengguna' ? 'active' : ''; ?>">
						<svg class="bi pe-none me-2" width="16" height="16">
							<use xlink:href="#user-list" />
						</svg>
						Daftar Pengguna
					</a>
				</li>
			<?php endif; ?>

			<li>
				<a href="<?= base_url('pengaturan'); ?>" class="nav-link link-light <?= $this->uri->segment(1) === 'pengaturan' ? 'active' : ''; ?>">
					<svg class="bi pe-none me-2" width="16" height="16">
						<use xlink:href="#people-circle" />
					</svg>
					Pengaturan Akun
				</a>
			</li>
		<?php else : ?>
			<script>
				window.location.href = '<?= base_url("logout"); ?>';
			</script>
		<?php endif; ?>
	</ul>
	<hr>
	<div class="d-flex mt-auto">
		<button class="btn btn-secondary w-100 align-self-end" id="logoutButton">
			Logout
		</button>
	</div>
</div>

<!-- Mobile Navigation -->
<div class="fixed-top">
	<nav class="navbar p-3 navbar-dark w-100 position-absolute navbar-expand-lg bg-dark d-sm-block d-md-none">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?= base_url(''); ?>">AKU HADIR</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<?php if ($this->session->userdata('userInfo')) :
					$userInfo = $this->session->userdata('userInfo');
				?>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link <?= empty($this->uri->segment(1)) ? 'active' : ''; ?>" href="<?= base_url(''); ?>">Beranda</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $this->uri->segment(1) === 'presensi' ? 'active' : ''; ?>" href="<?= base_url('presensi'); ?>">Presensi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $this->uri->segment(1) === 'rekap' ? 'active' : ''; ?>" href="<?= base_url('rekap'); ?>">
								<?= $userInfo['role'] === 'Pimpinan' ? 'Rekap Presensiku' : 'Rekap'; ?></a>
						</li>

						<?php if ($userInfo['role'] === 'Pimpinan') : ?>
							<li class="nav-item">
								<a class="nav-link <?= $this->uri->segment(1) === 'rekap_presensi_pegawai' ? 'active' : ''; ?>" href="<?= base_url('rekap_presensi_pegawai'); ?>">
									Rekap Presensi Pegawai</a>
							</li>
						<?php endif; ?>

						<li class="nav-item">
							<a class="nav-link <?= $this->uri->segment(1) === 'pengaturan' ? 'active' : ''; ?>" href="<?= base_url('pengaturan'); ?>">Pengaturan Akun</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('logout'); ?>">Logout</a>
						</li>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</nav>
</div>