<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'page';
$route['transaksi'] = 'page/transaki';
$route['transaksi_baru'] = 'page/transaki_baru';
$route['barang'] = 'page/barang';
// $route['tambah_barang'] = 'page/tambah_barang';

// json barang
$route['get_barang'] = 'barang';
$route['tambah_barang'] = 'barang/create';
$route['hapus_barang'] = 'barang/delete';
$route['detail_barang'] = 'barang/detail';
$route['update_barang'] = 'barang/update';

// transaksi
$route['get_transaksi'] = 'transaksi';
$route['tambah_item'] = 'transaksi/create_item';
$route['get_item'] = 'transaksi/get_item';
