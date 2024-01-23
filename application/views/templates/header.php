<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta
		name="description" 
		content="AKU HADIR - Aplikasi Rekam Kehadiran dan Laporan Harian Pegawai BTI UNPAR"
	>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">

	<!-- Sweet Alert 2 -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/sweetalert2/sweetalert2.min.css'); ?>">

	<!-- JQuery UI -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/jquery/ui/jquery-ui.min.css'); ?>">

	<!-- JQuery DataTables -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/jquery/datatables/datatables.min.css'); ?>">

	<!-- Main -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/main.css') ?>">

	<!-- Main -->
	<script src="<?= base_url('assets/main.js') ?>"></script>

	<!-- Bootstrap -->
	<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

	<!-- CKEditor -->
	<script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>

	<!-- Sweeet Alert 2 -->
	<script src="<?= base_url('assets/sweetalert2/sweetalert2.min.js'); ?>"></script>

	<!-- JQuery -->
	<script src="<?= base_url('assets/jquery/jquery-3.6.4.min.js'); ?>"></script>
	<script src="<?= base_url('assets/jquery/ui/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('assets/jquery/datatables/datatables.min.js') ?>"></script>
	<script src="<?= base_url('assets/jquery/loading-overlay/dist/loadingoverlay.min.js') ?>"></script>

	<!-- Select2 -->
	<link href="<?= base_url('assets/select2/select2.min.css'); ?>" rel="stylesheet" />
	<script src="<?= base_url('assets/select2/select2.min.js'); ?>"></script>

	<title>AKU HADIR <?= $title ? '- ' . $title : ''; ?></title>

	<?php

	if ($this->uri->segment(1) !== 'login') : ?>
		<style>
			.card:hover {
				transform: translateY(-8px);
				transition: 0.25s ease-in-out;
			}
		</style>
	<?php endif; ?>
</head>

<body>