<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __constuct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = $this->db->get('transaksi')->result();
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
		$qty 	        = $this->input->post('qty');

		if ($qty > 0) {	
			$get_barang = $this->db->get_where('barang', ['kode_barang' => $kode_barang])->result()[0];
			
			$cek_item = $this->db->get_where('item_transaksi', ['kode_barang'=>$kode_barang, 'kode_transaksi'=>$kode_transaksi])->num_rows();
			if (!$cek_item) {
				$insert = [
					'kode_barang' => $kode_barang, 
					'kode_transaksi' => $kode_transaksi, 
					'harga_barang' => $get_barang->harga_barang,
					'qty' => $qty
				];
				$this->db->insert('item_transaksi', $insert);
				$data = [
					'success' => true,
					'message' => 'Data disimpan'
				];
			}else{
				$get_item = $this->db->get_where('item_transaksi', ['kode_barang'=>$kode_barang, 'kode_transaksi'=>$kode_transaksi])->result()[0];
				$qty_baru = $get_item->qty + $qty;
				$this->db->where(['kode_barang'=>$kode_barang, 'kode_transaksi'=>$kode_transaksi])->update('item_transaksi', ['qty' => $qty_baru]);
				$data = [
					'success' => true,
					'message' => 'Update qty'
				];
			}		
		}else{
			$data = [
				'success' => false,
				'message' => 'Inputan harus diisi'
			];
		}
		echo json_encode($data);
	}

	public function get_item()
	{
		$this->db->select('*');
		$this->db->from('item_transaksi');
		$this->db->join('barang','item_transaksi.kode_barang = barang.kode_barang');      
		$data = $this->db->where(['kode_transaksi' => 'LMfXlUOjakrg8tbSJRme'])->get()->result();
		echo json_encode($data);
	}

}
