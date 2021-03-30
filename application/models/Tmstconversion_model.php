<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmstconversion_model extends CI_Model
{

    public $table = 'tmstconversion';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,tmstuom.uom as uombefore, tmstuom.uom as uomafter,conversion');
        $this->datatables->from('tmstconversion');
        //add this line for join
        //$this->datatables->join('table2', 'tmstconversion.field = table2.field');
        $this->datatables->join('tmstuom', 'tmstconversion.uomafter = tmstuom.id');
        $this->datatables->add_column('action', anchor(site_url('tmstconversion/read/$1'),'Read')." | ".anchor(site_url('tmstconversion/update/$1'),'Update')." | ".anchor(site_url('tmstconversion/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
        
//query for list conversion Type//
  /*      select uombefore.id, uombefore.uom as uombefore, uomafter.uom as uomafter, uombefore.conversion from (
select tmstconversion.id, tmstuom.uom,conversion from tmstconversion , tmstuom
where tmstconversion.uomafter =  tmstuom.id
) as uomafter ,
(
select tmstconversion.id, tmstuom.uom,conversion from tmstconversion , tmstuom
where tmstconversion.uombefore =  tmstuom.id
) as uombefore
where uomafter.id = uombefore.id
*/

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
	$this->db->or_like('uombefore', $q);
	$this->db->or_like('uomafter', $q);
	$this->db->or_like('conversion', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('uombefore', $q);
	$this->db->or_like('uomafter', $q);
	$this->db->or_like('conversion', $q);
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

/* End of file Tmstconversion_model.php */
/* Location: ./application/models/Tmstconversion_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-15 06:10:35 */
/* http://harviacode.com */