<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Analisis</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<style type="text/css">
		header {
			padding:20px;
			margin: 35px 0;
		}

	</style>
</head>
<body>
	<div class="container">
		<header>
			<h1>ANALISIS <?php echo $nama_ujian ?></h1>
			<h3><?php echo $nama_sekolah ?></h3>
		</header>
	</div>
	<div class="container">
		<h3>Mata pelajaran</h3>
		<div class="row">			
			<?php 
			foreach ($mapel as $mahasiswa) {
						echo "
						<div class='col-md-3'>
							<div class='card'>
							  <img class='card-img-top' src='".base_url()."assets/image/buku.jpg' alt='Card image cap'>
							  <div class='card-body'>
								<h5 class='card-title'>".$mahasiswa['nama']."</h5>
								<p class='card-text'>Kode Mapel ".$mahasiswa['kode']."</p>								
							  </div>
							</div>
						</div>";
					}
			?>
		</div>
	</div>

	<div class="container">
	<h3>Lembar Soal</h3>
		<div class="row">
			<?php 
			foreach ($ls as $ls1) {
						echo "
							<div class='col-md-3'>
								<div class='card'>
								  <img class='card-img-top' src='".base_url()."assets/image/buku2.jpg' alt='Card image cap'>
								  <div class='card-body'>
									<h5 class='card-title'>".$ls1['kode']."</h5>
									<p class='card-text'>Mapel : ".$ls1['nama']."</br>
									Waktu : ".$ls1['waktu']." menit</br>
									Waktu Mulai : ".$ls1['waktu_mulai']."</br>
									Waktu Akhir : ".$ls1['waktu_akhir']."</p>
									<a href='".base_url()."index.php/sekolah/analisis/".$ls1['kode']."' class='btn btn-primary'>Lihat Analisis</a>									
								  </div>
								</div>
							</div>";
					}
			?>
		</div>
	</div>
	<div class="container">
		<footer>
			<p>Copyright &copy; <?php echo date('Y'); ?> TIM IT SMP MUHAMMADIYAH PLUS CIMANGGU | Versi Aplikasi 1.0.0</p>			
		</footer>
	</div>
</body>
</html>