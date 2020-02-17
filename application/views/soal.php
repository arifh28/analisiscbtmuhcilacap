<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Analisis</title>
	<link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" >
	
	<style type="text/css">

		.garis_bawah {
			margin-bottom: 60px;
		}

	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-center">SOAL <?php echo $nama_ujian ?> UNBK</h3>
			<h3 class="text-center"><?php echo $nama_sekolah ?></h3>
		</div>
		
		<div class="col-md-3">
			
		</div>
		<div class="col-md-6">
		<hr>
			<p class="text-center">
			Mata Pelajaran : <?php echo $mapel ?></br>
			Waktu Mulai : <?php echo $waktu_mulai ?></br>
			Waktu Akhir : <?php echo $waktu_akhir ?></p>
		<hr class="garis_bawah">
		</div>
		<div class="col-md-3">
			
		</div>
	</div>
</div>
	
	
	<div class="container">
		<div class="row">
		
			
			<?php
				
				$o = 1;
				foreach ($soal as $a) {					
			?>
				
				<div class="col-md-12">
					<p><?php echo $o; ?>. 
						<?php if($a['gambar'] == TRUE ){ 
						echo "<img src='http://localhost/tryout2/login/".$a['gambar']."'/>"; 
						} else { 
						echo ""; 
						} ?> 
						
					<?php echo strip_tags($a['pertanyaan']); ?></p>
					 
					<p>A. 
					<?php echo strip_tags($a['A']); ?>
					<?php if($a['gambarA'] == TRUE ){ 
						echo "<img src='http://localhost/tryout2/login/".$a['gambarA']."'/>"; 
						} else { 
						echo ""; 
						} ?>
					<br>
					
					B. 
					<?php if($a['gambarB'] == TRUE ){ 
						echo "<img src='http://localhost/tryout2/login/".$a['gambarB']."'/>"; 
						} else { 
						echo ""; 
						} ?>
						<?php echo strip_tags($a['B']); ?>
					<br>
					
					C. 
					<?php if($a['gambarC'] == TRUE ){ 
						echo "<img src='http://localhost/tryout2/login/".$a['gambarC']."'/>"; 
						} else { 
						echo ""; 
						} ?>
						<?php echo strip_tags($a['C']); ?>
					<br>

					D. 
					<?php echo strip_tags($a['D']); ?>
					<?php if($a['gambarD'] == TRUE ){ 
						echo "<img src='http://localhost/tryout2/login/".$a['gambarD']."'/>"; 
						} else { 
						echo ""; 
						} ?>
					</p>
				</div>
				
			<?php
			$o++;
				}
				
			?>
		
	</div>
	<footer>
		<div class="container">

			
			
		</div>
	</footer>
		<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.ba-throttle-debounce.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.stickyheader.js"></script>
</body>
</html>