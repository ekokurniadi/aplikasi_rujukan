<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pasien_model extends CI_Model
{

    public $table = 'pasien';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }


    function kode()
    {
             $this->db->select('RIGHT(pasien.kode_pasien,2) as kode_pasien', FALSE);
             $this->db->order_by('kode_pasien','DESC');    
             $this->db->limit(1);    
             $query = $this->db->get('pasien');  //cek dulu apakah ada sudah ada kode di tabel.    
             if($query->num_rows() <> 0){      
                  //cek kode jika telah tersedia    
                  $data = $query->row();      
                  $kode = intval($data->kode_pasien) + 1; 
             }
             else{      
                  $kode = 1;  //cek jika kode belum terdapat pada table
             }
                 $tgl=date('dmY'); 
                 $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
                 $kodetampil = "PSN"."-".$batas;  //format kode
                 return $kodetampil;  
   }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('kode_pasien', $q);
	$this->db->or_like('no_identitas', $q);
	$this->db->or_like('kategori_pasien', $q);
	$this->db->or_like('no_bpjs', $q);
	$this->db->or_like('nama_pasien', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('usia', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('tanggal_daftar', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('kode_pasien', $q);
	$this->db->or_like('no_identitas', $q);
	$this->db->or_like('kategori_pasien', $q);
	$this->db->or_like('no_bpjs', $q);
	$this->db->or_like('nama_pasien', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('usia', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('tanggal_daftar', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Pasien_model.php */
/* Location: ./application/models/Pasien_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-13 17:10:51 */
/* http://harviacode.com */