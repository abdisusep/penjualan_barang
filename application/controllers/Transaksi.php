<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __constuct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->db->from('transaksi');
		$this->db->order_by("tanggal", $this->input->post('urut'));
		$data = $this->db->get()->result();
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
			if ($get_barang->stok > 0 && $get_barang->stok >= $qty) {
				$cek_item = $this->db->get_where('item_transaksi', ['kode_barang'=>$kode_barang, 'kode_transaksi'=>$kode_transaksi])->num_rows();
				if (!$cek_item) {
					$insert = [
						'kode_barang' => $kode_barang, 
						'kode_transaksi' => $kode_transaksi, 
						'harga_barang' => $get_barang->harga_barang,
						'qty' => $qty
					];
					$this->db->where(['kode_barang'=>$kode_barang])->update('barang', ['stok' => $get_barang->stok-$qty]);
					$this->db->insert('item_transaksi', $insert);
					$data = [
						'success' => true,
						'message' => $get_barang->stok
					];
				}else{
					$this->db->where(['kode_barang'=>$kode_barang])->update('barang', ['stok' => $get_barang->stok-$qty]);
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
					'message' => 'Stok barang kurang'
				];
			}		
		}else{
			$data = [
				'success' => false,
				'message' => 'Qty tidak boleh 0'
			];
		}
		echo json_encode($data);
	}

	public function get_item()
	{
		$this->db->select('*');
		$this->db->from('item_transaksi');
		$this->db->join('barang','item_transaksi.kode_barang = barang.kode_barang');      
		$data = $this->db->where(['kode_transaksi' => $_POST['kode_transaksi']])->get()->result();
		echo json_encode($data);
	}

	public function hapus_item()
	{
		$get_barang = $this->db->get_where('barang', ['kode_barang' => $this->input->post('kb')])->result()[0];
		$get_item = $this->db->get_where('item_transaksi', ['kode_item_transaksi' => $this->input->post('ki')])->result()[0];
		$this->db->where(['kode_barang'=>$this->input->post('kb')])->update('barang', ['stok' => $get_barang->stok+$get_item->qty]);
		$hapus = $this->db->where('kode_item_transaksi', $this->input->post('ki'))->delete('item_transaksi');
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

	public function selesai_transaksi()
	{
		$this->db->where(['kode_transaksi'=>$this->input->post('kt')])->update('transaksi', ['total_bayar' => $this->input->post('tb'), 'tanggal' => date("Y-m-d H-i-s")]);
		$data = [
			'success' => true,
			'message' => 'Transaksi berhasil'
		];
		echo json_encode($data);
	}

}
