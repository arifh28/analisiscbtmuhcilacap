<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Analisis</title>
	<link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" >
	
	<style type="text/css">
		header {
			padding:12px;
			margin: 10px 0;
		}
		.component {
			line-height: 1.5em;
			margin: 0 auto;
			padding: 2em 0 3em;
			width: 90%;
			max-width: 1000px;
			overflow: hidden;
	}
	.component .filler {
		font-family: "Blokk", Arial, sans-serif;
		color: #d3d3d3;
	}
	table {
		border-collapse: collapse;
		margin-bottom: 3em;
		width: 100%;
		background: #fff;
	}
	td, th {
		padding: 0.75em 1.5em;
		text-align: left;
	}
		td.err {
			background-color: #e992b9;
			color: #fff;
			font-size: 0.75em;
			text-align: center;
			line-height: 1;
		}
	th {
		background-color: #31bc86;
		font-weight: bold;
		color: #fff;
		white-space: nowrap;
	}
	tbody th {
		background-color: #2ea879;
	}
	tbody tr:nth-child(2n-1) {
		background-color: #f5f5f5;
		transition: all .125s ease-in-out;
	}
	tbody tr:hover {
		background-color: rgba(129,208,177,.3);
	}

	/* For appearance */
	.sticky-wrap {
		overflow-x: auto;
		overflow-y: hidden;
		position: relative;
		margin: 3em 0;
		width: 100%;
	}
	.sticky-wrap .sticky-thead,
	.sticky-wrap .sticky-col,
	.sticky-wrap .sticky-intersect {
		opacity: 0;
		position: absolute;
		top: 0;
		left: 0;
		transition: all .125s ease-in-out;
		z-index: 50;
		width: auto; /* Prevent table from stretching to full size */
	}
		.sticky-wrap .sticky-thead {
			box-shadow: 0 0.25em 0.1em -0.1em rgba(0,0,0,.125);
			z-index: 100;
			width: 100%; /* Force stretch */
		}
		.sticky-wrap .sticky-intersect {
			opacity: 1;
			z-index: 150;

		}
			.sticky-wrap .sticky-intersect th {
				background-color: #666;
				color: #eee;
			}
	.sticky-wrap td,
	.sticky-wrap th {
		box-sizing: border-box;
	}

	/* Not needed for sticky header/column functionality */
	td.user-name {
		text-transform: capitalize;
	}
	.sticky-wrap.overflow-y {
		overflow-y: auto;
		max-height: 80vh;
	}


	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo base_url()?>">ANALISIS <?php echo $nama_ujian ?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">      
      <li class="nav-item">
        <a class="nav-link" href="#"><strong><?php echo $kode ?> | <?php echo $mapel ?></strong></a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url()?>index.php/sekolah/action/<?php echo $kode ?>">Cetak Ke Microsoft Excel </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="#"><?php echo $jml_siswa ?> siswa.</a>
      </li>
    </ul>    
  </div>
</nav>
	
	
	<div class="container-fluid">
		<div class="row">
		<table class="overflow-y">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama</th>
					<th>Kelas</th>
					<?php
						$jss =$jml_soal + 1;
						for($i=1; $i<$jss; $i++)
						{
							echo '<th>'.$i.'</th>';
						}
					?>
					<th>Nilai</th>	
				</tr>
			</thead>
			<tbody>
			
			<?php
				
				$total_1 = $total_2 = $total_3 = $total_4 = $total_5 = $total_6 = $total_7 = $total_8 = $total_9 = $total_10 = $total_11 = $total_12 = $total_13 = $total_14 = $total_15 = $total_16 = $total_17 = $total_18 = $total_19 = $total_20 = $total_21 = $total_22 = $total_23 = $total_24 = $total_25 = $total_26 = $total_27 = $total_28 = $total_29 = $total_30 = $total_31 = $total_32 = $total_33 = $total_34 = $total_35 = $total_36 = $total_37 = $total_38 = $total_39 = $total_40 = $total_41 = $total_42 = $total_43 = $total_44 = $total_45 = $total_46 = $total_47 = $total_48 = $total_49 = $total_50 = 0;
				$o = 1;
				foreach ($analisis as $a) {				
			?>
				<tr>
					<th><?php echo $o++ ?></th>
					<th><?php echo $a['nama'] ?></th>	
					<th><?php echo $a['kelas'] ?></th>
					<td><?php echo $a['nomor_1'] ?></td>	
					<td><?php echo $a['nomor_2'] ?></td>
					<td><?php echo $a['nomor_3'] ?></td>
					<td><?php echo $a['nomor_4'] ?></td>
					<td><?php echo $a['nomor_5'] ?></td>
					<td><?php echo $a['nomor_6'] ?></td>	
					<td><?php echo $a['nomor_7'] ?></td>
					<td><?php echo $a['nomor_8'] ?></td>
					<td><?php echo $a['nomor_9'] ?></td>
					<td><?php echo $a['nomor_10'] ?></td>
					<td><?php echo $a['nomor_11'] ?></td>	
					<td><?php echo $a['nomor_12'] ?></td>
					<td><?php echo $a['nomor_13'] ?></td>
					<td><?php echo $a['nomor_14'] ?></td>
					<td><?php echo $a['nomor_15'] ?></td>
					<td><?php echo $a['nomor_16'] ?></td>	
					<td><?php echo $a['nomor_17'] ?></td>
					<td><?php echo $a['nomor_18'] ?></td>
					<td><?php echo $a['nomor_19'] ?></td>
					<td><?php echo $a['nomor_20'] ?></td>
					<td><?php echo $a['nomor_21'] ?></td>	
					<td><?php echo $a['nomor_22'] ?></td>
					<td><?php echo $a['nomor_23'] ?></td>
					<td><?php echo $a['nomor_24'] ?></td>
					<td><?php echo $a['nomor_25'] ?></td>
					<td><?php echo $a['nomor_26'] ?></td>	
					<td><?php echo $a['nomor_27'] ?></td>
					<td><?php echo $a['nomor_28'] ?></td>
					<td><?php echo $a['nomor_29'] ?></td>
					<td><?php echo $a['nomor_30'] ?></td>
					<td><?php echo $a['nomor_31'] ?></td>	
					<td><?php echo $a['nomor_32'] ?></td>
					<td><?php echo $a['nomor_33'] ?></td>
					<td><?php echo $a['nomor_34'] ?></td>
					<td><?php echo $a['nomor_35'] ?></td>
					<td><?php echo $a['nomor_36'] ?></td>	
					<td><?php echo $a['nomor_37'] ?></td>
					<td><?php echo $a['nomor_38'] ?></td>
					<td><?php echo $a['nomor_39'] ?></td>
					<td><?php echo $a['nomor_40'] ?></td>
					<?php
						if ($jml_soal == '50') { 
					?>
							
					<td><?php echo $a['nomor_41'] ?></td>	
					<td><?php echo $a['nomor_42'] ?></td>
					<td><?php echo $a['nomor_43'] ?></td>
					<td><?php echo $a['nomor_44'] ?></td>
					<td><?php echo $a['nomor_45'] ?></td>
					<td><?php echo $a['nomor_46'] ?></td>	
					<td><?php echo $a['nomor_47'] ?></td>
					<td><?php echo $a['nomor_48'] ?></td>
					<td><?php echo $a['nomor_49'] ?></td>
					<td><?php echo $a['nomor_50'] ?></td>
					
					<?php	
						} else {
						};
					?>
					
					
					
					<td>
					
					<?php					
					
					$nilai_asli = ( $a['nilai_siswa'] / $jml_soal) * 100;
					echo $nilai_asli;
					
					?>
					</td>
				</tr>									
			<?php
				$total_1 +=  $a['nomor_1'];	
				$total_2 +=  $a['nomor_2'];
				$total_3 +=  $a['nomor_3'];
				$total_4 +=  $a['nomor_4'];
				$total_5 +=  $a['nomor_5'];
				$total_6 +=  $a['nomor_6'];	
				$total_7 +=  $a['nomor_7'];
				$total_8 +=  $a['nomor_8'];
				$total_9 +=  $a['nomor_9'];
				$total_10	+=  $a['nomor_10'];
				$total_11	+=  $a['nomor_11'];	
				$total_12	+=  $a['nomor_12'];
				$total_13	+=  $a['nomor_13'];
				$total_14	+=  $a['nomor_14'];
				$total_15	+=  $a['nomor_15'];
				$total_16	+=  $a['nomor_16'];	
				$total_17	+=  $a['nomor_17'];
				$total_18	+=  $a['nomor_18'];
				$total_19	+=  $a['nomor_19'];
				$total_20	+=  $a['nomor_20'];
				$total_21	+=  $a['nomor_21'];	
				$total_22	+=  $a['nomor_22'];
				$total_23	+=  $a['nomor_23'];
				$total_24	+=  $a['nomor_24'];
				$total_25	+=  $a['nomor_25'];
				$total_26	+=  $a['nomor_26'];	
				$total_27	+=  $a['nomor_27'];
				$total_28	+=  $a['nomor_28'];
				$total_29	+=  $a['nomor_29'];
				$total_30	+=  $a['nomor_30'];
				$total_31	+=  $a['nomor_31'];	
				$total_32	+=  $a['nomor_32'];
				$total_33	+=  $a['nomor_33'];
				$total_34	+=  $a['nomor_34'];
				$total_35	+=  $a['nomor_35'];
				$total_36	+=  $a['nomor_36'];	
				$total_37	+=  $a['nomor_37'];
				$total_38	+=  $a['nomor_38'];
				$total_39	+=  $a['nomor_39'];
				$total_40	+=  $a['nomor_40'];
				$total_41	+=  $a['nomor_41'];	
				$total_42	+=  $a['nomor_42'];
				$total_43	+=  $a['nomor_43'];
				$total_44	+=  $a['nomor_44'];
				$total_45	+=  $a['nomor_45'];
				$total_46	+=  $a['nomor_46'];	
				$total_47	+=  $a['nomor_47'];
				$total_48	+=  $a['nomor_48'];
				$total_49	+=  $a['nomor_49'];
				$total_50	+=  $a['nomor_50'];
				
				}
			?>
			<tr>
				<td colspan="3">Jumlah</td>
				
				<?php				
					echo '<td>'.$total_1 .'</td>';
					echo '<td>'.$total_2 .'</td>';
					echo '<td>'.$total_3 .'</td>';
					echo '<td>'.$total_4 .'</td>';
					echo '<td>'.$total_5 .'</td>';
					echo '<td>'.$total_6 .'</td>';
					echo '<td>'.$total_7 .'</td>';
					echo '<td>'.$total_8 .'</td>';
					echo '<td>'.$total_9 .'</td>';
					echo '<td>'.$total_10.'</td>';
					echo '<td>'.$total_11.'</td>';
					echo '<td>'.$total_12.'</td>';
					echo '<td>'.$total_13.'</td>';
					echo '<td>'.$total_14.'</td>';
					echo '<td>'.$total_15.'</td>';
					echo '<td>'.$total_16.'</td>';
					echo '<td>'.$total_17.'</td>';
					echo '<td>'.$total_18.'</td>';
					echo '<td>'.$total_19.'</td>';
					echo '<td>'.$total_20.'</td>';
					echo '<td>'.$total_21.'</td>';
					echo '<td>'.$total_22.'</td>';
					echo '<td>'.$total_23.'</td>';
					echo '<td>'.$total_24.'</td>';
					echo '<td>'.$total_25.'</td>';
					echo '<td>'.$total_26.'</td>';
					echo '<td>'.$total_27.'</td>';
					echo '<td>'.$total_28.'</td>';
					echo '<td>'.$total_29.'</td>';
					echo '<td>'.$total_30.'</td>';
					echo '<td>'.$total_31.'</td>';
					echo '<td>'.$total_32.'</td>';
					echo '<td>'.$total_33.'</td>';
					echo '<td>'.$total_34.'</td>';
					echo '<td>'.$total_35.'</td>';
					echo '<td>'.$total_36.'</td>';
					echo '<td>'.$total_37.'</td>';
					echo '<td>'.$total_38.'</td>';
					echo '<td>'.$total_39.'</td>';
					echo '<td>'.$total_40.'</td>';
					
					if ($jml_soal == '50') {
						
					echo '<td>'.$total_41.'</td>';
					echo '<td>'.$total_42.'</td>';
					echo '<td>'.$total_43.'</td>';
					echo '<td>'.$total_44.'</td>';
					echo '<td>'.$total_45.'</td>';
					echo '<td>'.$total_46.'</td>';
					echo '<td>'.$total_47.'</td>';
					echo '<td>'.$total_48.'</td>';
					echo '<td>'.$total_49.'</td>';
					echo '<td>'.$total_50.'</td>';
					
					} else {
					};
						
				?>
				
			</tr>
				
			</tbody>
		</table>
		</div>	
		<?php  
		// $jss = $jml_soal + 1;
		// for($i=1; $i<$jss; $i++){
			// for($x = 'D'; $x != 'BB'; $x++) {
				// echo '$sheet->setCellValue(?'.$x.'5?, ?'.$i.'?);';
			// }
		// }
		// ?>
		
	</div>
	<footer>
		<div class="container">

			Copyright &copy; <?php echo date('Y'); ?> | TIM IT SMP MUHAMMADIYAH PLUS CIMANGGU | Versi Aplikasi 1.0.0
			
		</div>
	</footer>
		<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.ba-throttle-debounce.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.stickyheader.js"></script>
</body>
</html>