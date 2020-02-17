<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sekolah extends CI_Controller {


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('SekolahModel');
		$sekolah = $this->SekolahModel->GetSekolah()->row();
		$data['nama_sekolah'] = $sekolah->nama;
		$data['nama_ujian'] = $sekolah->nama_ujian;
		
		$data['mapel'] = $this->SekolahModel->GetMapel();
		$data['ls'] = $this->SekolahModel->GetLembarSoal();
        
		
		$this->load->view('welcome_message', $data );
	}
	
	public function analisis($id_lembar = null)
	{
		$this->load->model('SekolahModel');
		$detail_lembar_soal = $this->SekolahModel->GetWhereLembar(array('kode' => $id_lembar))->row();		
		$data['kode'] = $detail_lembar_soal->kode;	
		$sekolah = $this->SekolahModel->GetSekolah()->row();		
		$data['nama_ujian'] = $sekolah->nama_ujian;		
		
		$data['jml_soal'] = $this->SekolahModel->GetWhereSoalPG(array('id_lembar' => $id_lembar))->num_rows();
		$data['analisis'] = $this->SekolahModel->GetAnalisis($detail_lembar_soal->kode)->result_array();
		$kode_mapel = $detail_lembar_soal->mapel;
		if($kode_mapel == '001') {
			$data['mapel'] = "BAHASA INDONESIA";
		}elseif($kode_mapel == '002'){
			$data['mapel'] = "MATEMATIKA";
		}elseif($kode_mapel == '003'){
			$data['mapel'] = "BAHASA INGGRIS";
		}elseif($kode_mapel == '004'){
			$data['mapel'] = "IPA";
		};
		
		$data['jml_siswa'] = $this->SekolahModel->GetAnalisis($detail_lembar_soal->kode)->num_rows();
		
		$data['siswa'] = $this->SekolahModel->GetSiswa();
		$data['tj'] = $this->SekolahModel->GetTesJawab();
		
		$this->load->view('analisis', $data);
	}
	
	public function action($id_lembar = null){

		$this->load->model('SekolahModel');
		$detail_lembar_soal = $this->SekolahModel->GetWhereLembar(array('kode' => $id_lembar))->row();		
		$kode = $detail_lembar_soal->kode;
		$kode_mapel = $detail_lembar_soal->mapel;
		if($kode_mapel == '001') {
			$mapel = "BAHASA INDONESIA";
		}elseif($kode_mapel == '002'){
			$mapel = "MATEMATIKA";
		}elseif($kode_mapel == '003'){
			$mapel = "BAHASA INGGRIS";
		}elseif($kode_mapel == '004'){
			$mapel = "IPA";
		};
		
		$jml_soal = $this->SekolahModel->GetWhereSoalPG(array('id_lembar' => $id_lembar))->num_rows();
		$analisis = $this->SekolahModel->GetAnalisis($detail_lembar_soal->kode)->result_array();
		$jml_siswa = $this->SekolahModel->GetAnalisis($detail_lembar_soal->kode)->num_rows();
		
		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();
				
		$sheet->freezePaneByColumnAndRow(4, 6);
	 
		for($x = 'A'; $x != 'BC'; $x++) {
			$sheet->getStyle($x)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getColumnDimension($x)->setAutoSize(true);
			$sheet->getStyle($x)->getFont()->setName('Times New Roman');
		}		
		
		if ($jml_soal == '50') { 
			$sheet->mergeCells('A1:BB1');
			$sheet->mergeCells('A2:BB2');
			$sheet->mergeCells('A3:BB3');
		}else{
			$sheet->mergeCells('A1:AR1');
			$sheet->mergeCells('A2:AR2');
			$sheet->mergeCells('A3:AR3');			
		};
		
		
		$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
		$sheet->setCellValue('A1', 'ANALISIS JAWABAN SISWA KELAS IX');
		
		
		$sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
		$sheet->setCellValue('A2', 'TRYOUT UNBK KEDUA MAPEL '.$mapel);
		
		
		$sheet->getStyle('A3')->getFont()->setBold(true)->setSize(14);
		$sheet->setCellValue('A3', 'TAHUN PELAJARAN 2019/2020');
		
		if ($jml_soal == '50') { 
			$sheet->getStyle('A5:BB5')
					->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);		
			$sheet->getStyle('A5:BB5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('5d5d5d');		
		} else {
			$sheet->getStyle('A5:AR5')
				->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);		
			$sheet->getStyle('A5:AR5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('5d5d5d');
		};
		
		$sheet->setCellValue('A5', 'No.');
		$sheet->setCellValue('B5', 'Nama');
		$sheet->setCellValue('C5', 'Kelas');
		
		$sheet->setCellValue('D5', '1');
		$sheet->setCellValue('E5', '2');
		$sheet->setCellValue('F5', '3');
		$sheet->setCellValue('G5', '4');
		$sheet->setCellValue('H5', '5');
		$sheet->setCellValue('I5', '6');
		$sheet->setCellValue('J5', '7');
		$sheet->setCellValue('K5', '8');
		$sheet->setCellValue('L5', '9');
		$sheet->setCellValue('M5', '10');
		$sheet->setCellValue('N5', '11');
		$sheet->setCellValue('O5', '12');
		$sheet->setCellValue('P5', '13');
		$sheet->setCellValue('Q5', '14');
		$sheet->setCellValue('R5', '15');
		$sheet->setCellValue('S5', '16');
		$sheet->setCellValue('T5', '17');
		$sheet->setCellValue('U5', '18');
		$sheet->setCellValue('V5', '19');
		$sheet->setCellValue('W5', '20');
		$sheet->setCellValue('X5', '21');
		$sheet->setCellValue('Y5', '22');
		$sheet->setCellValue('Z5', '23');
		$sheet->setCellValue('AA5', '24');
		$sheet->setCellValue('AB5', '25');
		$sheet->setCellValue('AC5', '26');
		$sheet->setCellValue('AD5', '27');
		$sheet->setCellValue('AE5', '28');
		$sheet->setCellValue('AF5', '29');
		$sheet->setCellValue('AG5', '30');
		$sheet->setCellValue('AH5', '31');
		$sheet->setCellValue('AI5', '32');
		$sheet->setCellValue('AJ5', '33');
		$sheet->setCellValue('AK5', '34');
		$sheet->setCellValue('AL5', '35');
		$sheet->setCellValue('AM5', '36');
		$sheet->setCellValue('AN5', '37');
		$sheet->setCellValue('AO5', '38');
		$sheet->setCellValue('AP5', '39');
		$sheet->setCellValue('AQ5', '40');
		if ($jml_soal == '50') { 
			$sheet->setCellValue('AR5', '41');
			$sheet->setCellValue('AS5', '42');
			$sheet->setCellValue('AT5', '43');
			$sheet->setCellValue('AU5', '44');
			$sheet->setCellValue('AV5', '45');
			$sheet->setCellValue('AW5', '46');
			$sheet->setCellValue('AX5', '47');
			$sheet->setCellValue('AY5', '48');
			$sheet->setCellValue('AZ5', '49');
			$sheet->setCellValue('BA5', '50');
			$sheet->setCellValue('BB5', 'Nilai');			
		} else {
			$sheet->setCellValue('AR5', 'Nilai');
		};	
		
		$total_1 = $total_2 = $total_3 = $total_4 = $total_5 = $total_6 = $total_7 = $total_8 = $total_9 = $total_10 = $total_11 = $total_12 = $total_13 = $total_14 = $total_15 = $total_16 = $total_17 = $total_18 = $total_19 = $total_20 = $total_21 = $total_22 = $total_23 = $total_24 = $total_25 = $total_26 = $total_27 = $total_28 = $total_29 = $total_30 = $total_31 = $total_32 = $total_33 = $total_34 = $total_35 = $total_36 = $total_37 = $total_38 = $total_39 = $total_40 = $total_41 = $total_42 = $total_43 = $total_44 = $total_45 = $total_46 = $total_47 = $total_48 = $total_49 = $total_50 = 0;
		$o = 6;
		$no = 1;
		foreach ($analisis as $a) {	
			// manually set table data value
					$sheet->setCellValue('A'.$o, $no );
					$sheet->setCellValue('B'.$o, $a['nama'] );	
					$sheet->setCellValue('C'.$o, $a['kelas'] );
					$sheet->setCellValue('D'.$o,'=IF('.$a['nomor_1'].'=1,"B","S")');
					$sheet->setCellValue('E'.$o, '=IF('.$a['nomor_2'].'=1,"B","S")');
					$sheet->setCellValue('F'.$o, '=IF('.$a['nomor_3'].'=1,"B","S")');
					$sheet->setCellValue('G'.$o, '=IF('.$a['nomor_4'].'=1,"B","S")');
					$sheet->setCellValue('H'.$o, '=IF('.$a['nomor_5'].'=1,"B","S")');
					$sheet->setCellValue('I'.$o, '=IF('.$a['nomor_6'].'=1,"B","S")');	
					$sheet->setCellValue('J'.$o, '=IF('.$a['nomor_7'].'=1,"B","S")');
					$sheet->setCellValue('K'.$o, '=IF('.$a['nomor_8'].'=1,"B","S")');
					$sheet->setCellValue('L'.$o, '=IF('.$a['nomor_9'].'=1,"B","S")');
					$sheet->setCellValue('M'.$o, '=IF('.$a['nomor_10'].'=1,"B","S")');
					$sheet->setCellValue('N'.$o, '=IF('.$a['nomor_11'].'=1,"B","S")');	
					$sheet->setCellValue('O'.$o, '=IF('.$a['nomor_12'].'=1,"B","S")');
					$sheet->setCellValue('P'.$o, '=IF('.$a['nomor_13'].'=1,"B","S")');
					$sheet->setCellValue('Q'.$o, '=IF('.$a['nomor_14'].'=1,"B","S")');
					$sheet->setCellValue('R'.$o, '=IF('.$a['nomor_15'].'=1,"B","S")');
					$sheet->setCellValue('S'.$o, '=IF('.$a['nomor_16'].'=1,"B","S")');	
					$sheet->setCellValue('T'.$o, '=IF('.$a['nomor_17'].'=1,"B","S")');
					$sheet->setCellValue('U'.$o, '=IF('.$a['nomor_18'].'=1,"B","S")');
					$sheet->setCellValue('V'.$o, '=IF('.$a['nomor_19'].'=1,"B","S")');
					$sheet->setCellValue('W'.$o, '=IF('.$a['nomor_20'].'=1,"B","S")');
					$sheet->setCellValue('X'.$o, '=IF('.$a['nomor_21'].'=1,"B","S")');	
					$sheet->setCellValue('Y'.$o, '=IF('.$a['nomor_22'].'=1,"B","S")');
					$sheet->setCellValue('Z'.$o, '=IF('.$a['nomor_23'].'=1,"B","S")');
					$sheet->setCellValue('AA'.$o, '=IF('.$a['nomor_24'].'=1,"B","S")');
					$sheet->setCellValue('AB'.$o, '=IF('.$a['nomor_25'].'=1,"B","S")');
					$sheet->setCellValue('AC'.$o, '=IF('.$a['nomor_26'].'=1,"B","S")');	
					$sheet->setCellValue('AD'.$o, '=IF('.$a['nomor_27'].'=1,"B","S")');
					$sheet->setCellValue('AE'.$o, '=IF('.$a['nomor_28'].'=1,"B","S")');
					$sheet->setCellValue('AF'.$o, '=IF('.$a['nomor_29'].'=1,"B","S")');
					$sheet->setCellValue('AG'.$o, '=IF('.$a['nomor_30'].'=1,"B","S")');
					$sheet->setCellValue('AH'.$o, '=IF('.$a['nomor_31'].'=1,"B","S")');	
					$sheet->setCellValue('AI'.$o, '=IF('.$a['nomor_32'].'=1,"B","S")');
					$sheet->setCellValue('AJ'.$o, '=IF('.$a['nomor_33'].'=1,"B","S")');
					$sheet->setCellValue('AK'.$o, '=IF('.$a['nomor_34'].'=1,"B","S")');
					$sheet->setCellValue('AL'.$o, '=IF('.$a['nomor_35'].'=1,"B","S")');
					$sheet->setCellValue('AM'.$o, '=IF('.$a['nomor_36'].'=1,"B","S")');	
					$sheet->setCellValue('AN'.$o, '=IF('.$a['nomor_37'].'=1,"B","S")');
					$sheet->setCellValue('AO'.$o, '=IF('.$a['nomor_38'].'=1,"B","S")');
					$sheet->setCellValue('AP'.$o, '=IF('.$a['nomor_39'].'=1,"B","S")');
					$sheet->setCellValue('AQ'.$o, '=IF('.$a['nomor_40'].'=1,"B","S")');
					
					if ($jml_soal == '50') { 
					
					$sheet->setCellValue('AR'.$o, '=IF('.$a['nomor_41'].'=1,"B","S")');	
					$sheet->setCellValue('AS'.$o, '=IF('.$a['nomor_42'].'=1,"B","S")');
					$sheet->setCellValue('AT'.$o, '=IF('.$a['nomor_43'].'=1,"B","S")');
					$sheet->setCellValue('AU'.$o, '=IF('.$a['nomor_44'].'=1,"B","S")');
					$sheet->setCellValue('AV'.$o, '=IF('.$a['nomor_45'].'=1,"B","S")');
					$sheet->setCellValue('AW'.$o, '=IF('.$a['nomor_46'].'=1,"B","S")');	
					$sheet->setCellValue('AX'.$o, '=IF('.$a['nomor_47'].'=1,"B","S")');
					$sheet->setCellValue('AY'.$o, '=IF('.$a['nomor_48'].'=1,"B","S")');
					$sheet->setCellValue('AZ'.$o, '=IF('.$a['nomor_49'].'=1,"B","S")');
					$sheet->setCellValue('BA'.$o, '=IF('.$a['nomor_50'].'=1,"B","S")');
					$sheet->setCellValue('BB'.$o, $a['nilai_siswa']);
					}else {
						
						$sheet->setCellValue('AR'.$o, $a['nilai_siswa']);
						
					};
					// manually set style table
					$sheet->getStyle('A'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('B'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
					$sheet->getStyle('C'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('D'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('E'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('F'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('G'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('H'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('I'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
					$sheet->getStyle('J'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('K'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('L'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('M'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('N'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
					$sheet->getStyle('O'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('P'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('Q'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('R'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('S'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
					$sheet->getStyle('T'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('U'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('V'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('W'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('X'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
					$sheet->getStyle('Y'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('Z'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AA'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AB'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AC'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
					$sheet->getStyle('AD'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AE'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AF'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AG'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AH'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
					$sheet->getStyle('AI'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AJ'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AK'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AL'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AM'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
					$sheet->getStyle('AN'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AO'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AP'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					$sheet->getStyle('AQ'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					
					if ($jml_soal == '50') { 
					
						$sheet->getStyle('AR'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
						$sheet->getStyle('AS'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$sheet->getStyle('AT'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$sheet->getStyle('AU'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$sheet->getStyle('AV'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$sheet->getStyle('AW'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	
						$sheet->getStyle('AX'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$sheet->getStyle('AY'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$sheet->getStyle('AZ'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$sheet->getStyle('BA'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
						$sheet->getStyle('BB'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
					
					} else {
						
						$sheet->getStyle('AR'.$o)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);							
					};
					
			$o++;
			$no++;
			
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
		
		$jml_siswa_asli = $jml_siswa + 6;
	
		if ($jml_soal == '50') { 
			$sheet->getStyle('A'.$jml_siswa_asli.':BB'.$jml_siswa_asli)
					->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);		
			
		} else {
			$sheet->getStyle('A'.$jml_siswa_asli.':AR'.$jml_siswa_asli)
				->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);		
			
		};
		
		$sheet->setCellValue('A'.$jml_siswa_asli, '' );
					$sheet->setCellValue('B'.$jml_siswa_asli, 'JUMLAH BENAR' );	
					$sheet->setCellValue('C'.$jml_siswa_asli, '' );
					$sheet->setCellValue('D'.$jml_siswa_asli, $total_1);
					$sheet->setCellValue('E'.$jml_siswa_asli, $total_2);
					$sheet->setCellValue('F'.$jml_siswa_asli, $total_3);
					$sheet->setCellValue('G'.$jml_siswa_asli, $total_4);
					$sheet->setCellValue('H'.$jml_siswa_asli, $total_5);
					$sheet->setCellValue('I'.$jml_siswa_asli, $total_6);	
					$sheet->setCellValue('J'.$jml_siswa_asli, $total_7);
					$sheet->setCellValue('K'.$jml_siswa_asli, $total_8);
					$sheet->setCellValue('L'.$jml_siswa_asli, $total_9);
					$sheet->setCellValue('M'.$jml_siswa_asli, $total_10);
					$sheet->setCellValue('N'.$jml_siswa_asli, $total_11);	
					$sheet->setCellValue('O'.$jml_siswa_asli, $total_12);
					$sheet->setCellValue('P'.$jml_siswa_asli, $total_13);
					$sheet->setCellValue('Q'.$jml_siswa_asli, $total_14);
					$sheet->setCellValue('R'.$jml_siswa_asli, $total_15);
					$sheet->setCellValue('S'.$jml_siswa_asli, $total_16);	
					$sheet->setCellValue('T'.$jml_siswa_asli, $total_17);
					$sheet->setCellValue('U'.$jml_siswa_asli, $total_18);
					$sheet->setCellValue('V'.$jml_siswa_asli, $total_19);
					$sheet->setCellValue('W'.$jml_siswa_asli, $total_20);
					$sheet->setCellValue('X'.$jml_siswa_asli, $total_21);	
					$sheet->setCellValue('Y'.$jml_siswa_asli, $total_22);
					$sheet->setCellValue('Z'.$jml_siswa_asli, $total_23);
					$sheet->setCellValue('AA'.$jml_siswa_asli, $total_24);
					$sheet->setCellValue('AB'.$jml_siswa_asli, $total_25);
					$sheet->setCellValue('AC'.$jml_siswa_asli, $total_26);	
					$sheet->setCellValue('AD'.$jml_siswa_asli, $total_27);
					$sheet->setCellValue('AE'.$jml_siswa_asli, $total_28);
					$sheet->setCellValue('AF'.$jml_siswa_asli, $total_29);
					$sheet->setCellValue('AG'.$jml_siswa_asli, $total_30);
					$sheet->setCellValue('AH'.$jml_siswa_asli, $total_31);	
					$sheet->setCellValue('AI'.$jml_siswa_asli, $total_32);
					$sheet->setCellValue('AJ'.$jml_siswa_asli, $total_33);
					$sheet->setCellValue('AK'.$jml_siswa_asli, $total_34);
					$sheet->setCellValue('AL'.$jml_siswa_asli, $total_35);
					$sheet->setCellValue('AM'.$jml_siswa_asli, $total_36);	
					$sheet->setCellValue('AN'.$jml_siswa_asli, $total_37);
					$sheet->setCellValue('AO'.$jml_siswa_asli, $total_38);
					$sheet->setCellValue('AP'.$jml_siswa_asli, $total_39);
					$sheet->setCellValue('AQ'.$jml_siswa_asli, $total_40);
					
					if ($jml_soal == '50') { 
					
					$sheet->setCellValue('AR'.$jml_siswa_asli, $total_41);	
					$sheet->setCellValue('AS'.$jml_siswa_asli, $total_42);
					$sheet->setCellValue('AT'.$jml_siswa_asli, $total_43);
					$sheet->setCellValue('AU'.$jml_siswa_asli, $total_44);
					$sheet->setCellValue('AV'.$jml_siswa_asli, $total_45);
					$sheet->setCellValue('AW'.$jml_siswa_asli, $total_46);	
					$sheet->setCellValue('AX'.$jml_siswa_asli, $total_47);
					$sheet->setCellValue('AY'.$jml_siswa_asli, $total_48);
					$sheet->setCellValue('AZ'.$jml_siswa_asli, $total_49);
					$sheet->setCellValue('BA'.$jml_siswa_asli, $total_50);
					
					}else {
						
						
						
					};			
		
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = $mapel." - ".date('d/m/Y - G:i:s:'); // set filename for excel file to be exported
		$spreadsheet->getProperties()
				->setCreator("SMP Muhammadiyah Plus Cimanggu")
				->setLastModifiedBy("SMP Muhammadiyah Plus Cimanggu")
				->setTitle("Analisis Tryout Kedua")
				->setSubject("Analisis Tryout Kedua")
				->setDescription(
					"Analisis Tryout Kedua menggunakan PHP Spreadsheet."
				)
				->setKeywords("office 2019 openxml php")
				->setCategory("Analisis Tryout Kedua");
		$spreadsheet->getActiveSheet()->getPageSetup()
					->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		$spreadsheet->getActiveSheet()->getPageSetup()
					->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_FOLIO);
		$spreadsheet->getActiveSheet()->getPageSetup()->setFitToPage(FALSE)->setScale(60);
		$spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.15);
		$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.1);
		$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.1);
		$spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.1);
		$spreadsheet->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
		$spreadsheet->getActiveSheet()->setShowGridlines(true);
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 

    }
	
	public function soal($id_lembar = null){
		$this->load->model('SekolahModel');
		$data['soal'] = $this->SekolahModel->GetSoal(array('id_lembar' => $id_lembar));		

		$sekolah = $this->SekolahModel->GetSekolah()->row();
		$data['nama_sekolah'] = $sekolah->nama;
		$data['nama_ujian'] = $sekolah->nama_ujian;
		
		$detail_lembar_soal = $this->SekolahModel->GetWhereLembar(array('kode' => $id_lembar))->row();		
		$kode = $detail_lembar_soal->kode;
		$kode_mapel = $detail_lembar_soal->mapel;
		
		$data['waktu_mulai'] = $detail_lembar_soal->waktu_mulai;
		$data['waktu_akhir'] = $detail_lembar_soal->waktu_akhir;
		
		if($kode_mapel == '001') {
			$data['mapel'] = "BAHASA INDONESIA";
		}elseif($kode_mapel == '002'){
			$data['mapel'] = "MATEMATIKA";
		}elseif($kode_mapel == '003'){
			$data['mapel'] = "BAHASA INGGRIS";
		}elseif($kode_mapel == '004'){
			$data['mapel'] = "IPA";
		};
		
		$this->load->view('soal', $data);
	}
}
