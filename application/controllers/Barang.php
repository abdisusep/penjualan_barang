<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	function __constuct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = $this->db->get('barang')->result();
		echo json_encode($data);
	}

	public function detail()
	{
		$data = $this->db->get_where('barang', ['kode_barang' => $this->input->post('kb')])->result()[0];
		echo json_encode($data);
	}

	public function create()
	{
		$nama_barang  = $this->input->post('nama_barang');
		$harga_barang = $this->input->post('harga_barang');
		$stok 	      = $this->input->post('stok');

		if ($nama_barang!='' && $harga_barang!='' && $stok!='') {
			$data = [
				'nama_barang' => $nama_barang, 
				'harga_barang' => $harga_barang, 
				'stok' => $stok
			];
	
			$this->db->insert('barang', $data);
			$data = [
				'success' => true,
				'message' => 'Data berhasil disimpan'
			];
		}else{
			$data = [
				'success' => false,
				'message' => 'Inputan wajib diisi semua!!!'
			];
		}
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
	
			$this->db->where('kode_barang', $kode_barang);
			$this->db->update('barang', $data);
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
		$this->db->where('kode_barang', $this->input->post('kb'));
        $hapus = $this->db->delete('barang');
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
