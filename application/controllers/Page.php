<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
		$this->load->view('template/master');
	}

	public function transaki()
	{
		$this->load->view('transaksi');
	}

	public function transaki_baru()
	{
		$kode = $_GET['kode_transaksi'];
		$batal = isset($_GET['batal']);

		if (!isset($kode)) {
			$rand = substr(str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm'), 0, 20);
			$data = [
				'kode_transaksi' => $rand, 
			];
	
			$this->db->insert('transaksi', $data);
			redirect(base_url('transaksi_baru?kode_transaksi='.$rand));
		}
		
		if($batal){
			$this->db->where('kode_transaksi', $kode)->delete('transaksi');
			$this->db->where('kode_transaksi', $kode)->delete('item_transaksi');
			redirect(base_url('transaksi'));
		}

		$this->load->view('transaksi_baru');
	}

	public function barang()
	{
		$this->load->view('barang');
	}

	public function tambah_barang()
	{
		$this->load->view('tambah_barang');
	}
}
