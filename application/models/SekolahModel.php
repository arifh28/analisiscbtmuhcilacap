<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SekolahModel extends CI_Model{
    public function GetMapel(){
        $data = $this->db->query("SELECT * FROM mapel");
        return $data->result_array();
    }
	
	public function GetLembarSoal(){
        $data = $this->db->query("SELECT a.kode, a.mapel, a.waktu, a.random, a.kelas, a.waktu_mulai, a.waktu_akhir, b.nama FROM lembar_soal a LEFT JOIN mapel b on a.mapel=b.kode");
        return $data->result_array();
    }
	
	public function GetWhereLembar($where)
    {

      // $query = $this->db->query("SELECT a.kode, a.mapel, a.waktu, a.random, a.kelas, a.waktu_mulai, a.waktu_akhir, b.nama FROM lembar_soal a LEFT JOIN mapel b on a.mapel=b.kode where '".$where."' ");

      // Jalankan query
      $query = $this->db
      ->where($where)	

      ->get('lembar_soal');

      // Return hasil query
      return $query;
    }
	
	public function GetTesJawab()
    {
		
	$data = $this->db->query("SELECT a.id_pst, a.id_lembar, a.benar, a.nilai, a.no_soal, b.nama FROM tes_jawab a LEFT JOIN siswa b on a.id_pst=b.id_osn WHERE a.id_pst = 'P030902430001' ");
	
	// Return hasil query
      return $data->result_array();
    }
	
	public function GetSiswa(){
        $data = $this->db->query("SELECT * FROM siswa");
        return $data->result_array();
    }
	
	public function GetWhereSoalPG($where){

      // $query = $this->db->query("SELECT a.kode, a.mapel, a.waktu, a.random, a.kelas, a.waktu_mulai, a.waktu_akhir, b.nama FROM lembar_soal a LEFT JOIN mapel b on a.mapel=b.kode where '".$where."' ");

      // Jalankan query
      $query = $this->db
      ->where($where)		
      ->get('soal_pg');
		
      // Return hasil query
      return $query;
    }
	
	public function GetTesJawabPG($where) {
		
	// $data = $this->db->query("SELECT a.id_pst, a.id_lembar, a.benar, a.nilai, a.no_soal, b.nama FROM tes_jawab a LEFT JOIN siswa b on a.id_pst=b.id_osn WHERE a.id_pst = 'P030902430002' AND a.id_lembar = ".$where."");
	
	// Jalankan query
      $data = $this->db
      ->where($where)
	  ->join('siswa', 'siswa.id_osn = tes_jawab.id_pst')
	  ->order_by('no_soal', 'ASC')
      ->get('tes_jawab');
	  
	// Return hasil query
      return $data;
	  
    }
	
	public function GetAnalisis($id_lembar) {
		$query = $this->db->query(	"SELECT nama, kelas,	
										SUM( IF(no_soal = 1, nilai, 0) ) as nomor_1,
										SUM( IF(no_soal = 2, nilai, 0) ) as nomor_2,
										SUM( IF(no_soal = 3, nilai, 0) ) as nomor_3,
										SUM( IF(no_soal = 4, nilai, 0) ) as nomor_4,
										SUM( IF(no_soal = 5, nilai, 0) ) as nomor_5,
										SUM( IF(no_soal = 6, nilai, 0) ) as nomor_6,
										SUM( IF(no_soal = 7, nilai, 0) ) as nomor_7,
										SUM( IF(no_soal = 8, nilai, 0) ) as nomor_8,
										SUM( IF(no_soal = 9, nilai, 0) ) as nomor_9,
										SUM( IF(no_soal = 10, nilai, 0) ) as nomor_10,
										SUM( IF(no_soal = 11, nilai, 0) ) as nomor_11,
										SUM( IF(no_soal = 12, nilai, 0) ) as nomor_12,
										SUM( IF(no_soal = 13, nilai, 0) ) as nomor_13,
										SUM( IF(no_soal = 14, nilai, 0) ) as nomor_14,
										SUM( IF(no_soal = 15, nilai, 0) ) as nomor_15,
										SUM( IF(no_soal = 16, nilai, 0) ) as nomor_16,
										SUM( IF(no_soal = 17, nilai, 0) ) as nomor_17,
										SUM( IF(no_soal = 18, nilai, 0) ) as nomor_18,
										SUM( IF(no_soal = 19, nilai, 0) ) as nomor_19,
										SUM( IF(no_soal = 20, nilai, 0) ) as nomor_20,
										SUM( IF(no_soal = 21, nilai, 0) ) as nomor_21,
										SUM( IF(no_soal = 22, nilai, 0) ) as nomor_22,
										SUM( IF(no_soal = 23, nilai, 0) ) as nomor_23,
										SUM( IF(no_soal = 24, nilai, 0) ) as nomor_24,
										SUM( IF(no_soal = 25, nilai, 0) ) as nomor_25,
										SUM( IF(no_soal = 26, nilai, 0) ) as nomor_26,
										SUM( IF(no_soal = 27, nilai, 0) ) as nomor_27,
										SUM( IF(no_soal = 28, nilai, 0) ) as nomor_28,
										SUM( IF(no_soal = 29, nilai, 0) ) as nomor_29,
										SUM( IF(no_soal = 30, nilai, 0) ) as nomor_30,
										SUM( IF(no_soal = 31, nilai, 0) ) as nomor_31,
										SUM( IF(no_soal = 32, nilai, 0) ) as nomor_32,
										SUM( IF(no_soal = 33, nilai, 0) ) as nomor_33,
										SUM( IF(no_soal = 34, nilai, 0) ) as nomor_34,
										SUM( IF(no_soal = 35, nilai, 0) ) as nomor_35,
										SUM( IF(no_soal = 36, nilai, 0) ) as nomor_36,
										SUM( IF(no_soal = 37, nilai, 0) ) as nomor_37,
										SUM( IF(no_soal = 38, nilai, 0) ) as nomor_38,
										SUM( IF(no_soal = 39, nilai, 0) ) as nomor_39,
										SUM( IF(no_soal = 40, nilai, 0) ) as nomor_40,
										SUM( IF(no_soal = 41, nilai, 0) ) as nomor_41,
										SUM( IF(no_soal = 42, nilai, 0) ) as nomor_42,
										SUM( IF(no_soal = 43, nilai, 0) ) as nomor_43,
										SUM( IF(no_soal = 44, nilai, 0) ) as nomor_44,
										SUM( IF(no_soal = 45, nilai, 0) ) as nomor_45,
										SUM( IF(no_soal = 46, nilai, 0) ) as nomor_46,
										SUM( IF(no_soal = 47, nilai, 0) ) as nomor_47,
										SUM( IF(no_soal = 48, nilai, 0) ) as nomor_48,
										SUM( IF(no_soal = 49, nilai, 0) ) as nomor_49,
										SUM( IF(no_soal = 50, nilai, 0) ) as nomor_50,
										SUM( nilai ) AS nilai_siswa
									FROM tes_jawab
									LEFT JOIN siswa
									ON tes_jawab.id_pst = siswa.id_osn
									WHERE id_lembar = ".$id_lembar."
									GROUP BY id_pst");
		// Return hasil query
      return $query;
	}
	
	public function GetSekolah(){

      // $query = $this->db->query("SELECT a.kode, a.mapel, a.waktu, a.random, a.kelas, a.waktu_mulai, a.waktu_akhir, b.nama FROM lembar_soal a LEFT JOIN mapel b on a.mapel=b.kode where '".$where."' ");

      // Jalankan query
      $query = $this->db
	  
      ->get('sekolah');

      // Return hasil query
      return $query;
    }
	
	public function GetSoal($where) {
		// Jalankan query
      $query = $this->db
      ->where($where)	
		->order_by('id', 'DESC')	  
      ->get('soal_pg');
	  
		return $query->result_array();
	}
}
?>