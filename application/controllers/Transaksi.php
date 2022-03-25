<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __constuct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data_t = $this->db->get_where('transaksi', ['kode_transaksi' => 1])->result();
		$data_it = $this->db->get_where('item_transaksi', ['kode_transaksi' => 1])->result();
		$data = [
			'transaksi' => $data_t,
			'item_transaksi' => $data_it
		];
		echo json_encode($data);
	}

	public function detail()
	{
		$data = $this->db->get_where('barang', ['kode_barang' => $this->input->post('kb')])->result()[0];
		echo json_encode($data);
	}

	public function create_item()
	{
		$kode_barang    = $this->input->post('kode_barang');
		$kode_transaksi = $this->input->post('kode_transaksi');
		$harga_barang   = $this->input->post('harga_barang');
		$qty 	        = $this->input->post('qty');

		if ($kode_barang!='' && $qty!='') {
			$get_barang = $this->db->get_where('barang', ['kode_barang' => $kode_barang])->result()[0];

			$data = [
				'kode_barang' => $kode_barang, 
				'kode_transaksi' => $kode_transaksi, 
				'harga_barang' => $get_barang->harga_barang,
				'qty' => $qty
			];

			$cek_item = $this->db->get_where('item_transaksi', ['kode_barang' => $kode_barang])->result();
			if (!$cek_item) {
				$this->db->insert('item_transaksi', $data);
				$data = [
					'success' => true,
					'message' => 'Data disimpan'
				];
			}else{
				$this->db->where('kode_barang', $kode_barang)->update('item_transaksi', ['qty' => ($get_barang->qty+$qty)]);
				$data = [
					'success' => false,
					'message' => 'Update qty'
				];
			}		
		}else{
			$data = [
				'success' => false,
				'message' => 'Inputan wajib diisi semua!!!'
			];
		}
		echo json_encode($data);
	}

	public function get_item()
	{
		$data_t = $this->db->get_where('transaksi', ['kode_transaksi' => 1])->result();
		$data_it = $this->db->get_where('item_transaksi', ['kode_transaksi' => 1])->result();
		$data = [
			'transaksi' => $data_t,
			'item_transaksi' => $data_it
		];
		echo json_encode($data);
	}

	public function update()
	{
		$kode_barang  = $this->input->post('e_kode_barang');
		$nama_barang  = $this->input->post('e_nama_barang');
		$harga_barang = $this->input->post('e_harga_barang');
		$stok 	      = $this->input->post('e_stok');

		if ($nama_barang!='' && $harga_barang!='' && $stok!='') {
			$data = [
				'nama_barang' => $nama_barang, 
				'harga_barang' => $harga_barang, 
				'stok' => $stok
			];
	
			$this->db->where('kode_barang', $kode_barang)->update('barang', $data);
			$data = [
				'success' => true,
				'message' => 'Data berhasil diupdate'
			];
		}else{
			$data = [
				'success' => false,
				'message' => 'Inputan wajib diisi semua!!!'
			];
		}
		echo json_encode($data);
	}

	public function delete()
	{
		$this->db->where('kode_barang', $this->input->post('kb'))->delete('barang');
		if ($hapus) {
			$data = [
				'success' => true,
				'message' => 'Data berhasil dihapus'
			];
		}else{
			$data = [
				'success' => false
			];
		}
		echo json_encode($data);
	}
}
