<?php
session_start();
$nama = $_SESSION['nama'];
if($_SESSION['status']!="login"){
	header("location:index.php?pesan=belum_login");
}
?>
<html>
<head>
	<meta charshet="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!- - Boostrap CSS - ->
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
	<!- - My CSS - ->
	<link rel="stylesheet" type="text/css" href="asset/css/style1.css">
	<!- - Boostrap ICON - ->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="shortcut icon" href="asset/img/logo/logo.png">
	 <!-- leaflet css -->
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
 integrity="sha512-
xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4Ps
ZChSR7A=="
 crossorigin="" />
 
 <!-- bootstrap cdn -->
 <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
 integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
crossorigin="anonymous">
 <style>
 /* ukuran peta */
 #mapid {
 height: 100%;
 }
 .jumbotron{
 height: 100%;
 border-radius: 0;
 }
 body{
 background-color: #ebe7e1;
 }
 </style>

	<title>Lokasi</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row flex-nowrap">
			<div class="col-auto col-x1-2 px-sm-2 px-0 navigasi">
				<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
					<a href="index.php" class="d-flex align-items-center pb-3 md-mb-0 me-md-auto text-white text-decoration-none">
						<span class="fs-5 d-none d-sm-inline">Peduli Kesehatan</span>
					</a>
					<ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
						<li class="nav-item">
							<a href="beranda.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bibi bi-house"></i> <span class="ms-1 d-none d-sm-inline">Beranda</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="historyperjalanan.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Catatan Perjalanan</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="perjalanan.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bi bi-book"></i> <span class="ms-1 d-none d-sm-inline">Isi Data Perjalanan</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="catatan_lokasi.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bi-compass-fill"></i> <span class="ms-1 d-none d-sm-inline">catatan lokasi</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="lokasi.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bi-plus-square"></i> <span class="ms-1 d-none d-sm-inline">Lokasi</span>
							</a>
						</li>
								
								</ul>
							</li>
						</ul>
						<hr>
						<div class="dropdown pb-4">
							<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="asset/img/dashboard/smile.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
								<span class="d-none d-sm-inline mx-1"><?php
									include "koneksi.php";
									$nama = $_SESSION['nama'];
									$data = mysqli_query($koneksi,"select * from login where nama = 'nama'");
									$d = mysqli_fetch_array($data);
									echo $d['nama'];
								?>
								</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-dark text-small shadow">
								<li><a class="dropdown-item" href="profile.php">Profile</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li>
									<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tombolkeluar">Keluar</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="modal fade" id="tombolkeluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-fw-bold" id="exampleModalLabel">KELUAR</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								Apakah anda yakin untuk keluar?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-primary fw-bold" data-bs-dismiss="modal">Batal"</button>
								<a href="logout.php" type="button" class="btn btn-outline-danger fw-bold">Keluar</a>
							</div>
						</div>
					</div>
				</div>
			<div class="row beranda">
			<div class="col-4"> <!-- ukuruan layar dengan bootstrap adalah 12 kolom, bagian kiri dibuat
sebesar 4 kolom-->
 <div class="jumbotron"> <!-- untuk membuat semacam container berwarna abu -->
 <h1>Add Location</h1>
 <hr>
 <form action="proses.php" method="post">
 <div class="form-group">
 <label for="exampleFormControlInput1">Latitude, Longitude</label>
 <input type="text" class="form-control" id="lat_long" name="lat_long">
 </div>
 <div class="form-group">
 <label for="exampleFormControlInput1">Nama Tempat</label>
 <input type="text" class="form-control" name="nama_tempat">
 </div>
 <div class="form-group">
 <label for="exampleFormControlInput1">Kategori Tempat</label>
 <select class="form-control" name="kategori" id="">
 <option value="">--Kategori Tempat--</option>
 <option value="rumah makan">Rumah Makan</option>
 <option value="pom bensin">Pom Bensin</option>
 <option value="Fasilitas Umum">Fasilitas Umum</option>
 <option value="Pasar/Mall">Pasar/Mall</option>
 <option value="rumah sakit">Rumah Sakit</option>
 <option value="Sekolah">Sekolah</option>
 </select>
 </div>
 <div class="form-group">
 <label for="exampleFormControlInput1">Keterangan</label>
 <textarea class="form-control" name="keterangan" cols="30" rows="5"></textarea>
 </div>
 <div class="form-group">
 <button type="submit" class="btn btn-info">Add</button>
 <a href="beranda.php" type="button" class="btn btn-danger fw-bold">Keluar</a>
 </div>
 </form>
 </div>
 </div>
 <div class="col-8"> <!-- ukuruan layar dengan bootstrap adalah 12 kolom, bagian kiri dibuat
sebesar 4 kolom-->
 <!-- peta akan ditampilkan dengan id = mapid -->
 <div id="mapid"></div>
 </div>
</div>	
		</div>
	</div>
	<!- - Boostrap JS - ->
	<script type="text/module/javascript" herf="asset/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" intergrity="sha384-ka75k0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0lRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>	