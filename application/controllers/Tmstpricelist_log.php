<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmstpricelist_log extends MY_Controller {
	
	protected $access = array('SuperAdmin','Admin', 'User');
	
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tmstpricelist_log_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
	    $tmstpricelist_log = $this->Tmstpricelist_log_model->get_all();

        $data = array(
            'tmstpricelist_log_data' => $tmstpricelist_log
        );
		$this->load->view('header');
        $this->load->view('tmstpricelist_log/tmstpricelist_log_list', $data);
        $this->load->view('footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tmstpricelist_log_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tmstpricelist_log_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'iditem' => $row->iditem,
		'packaging' => $row->packaging,
		'uom' => $row->uom,
		'size' => $row->size,
		'price' => $row->price,
		'source' => $row->source,
		'user' => $row->user,
		'aksi' => $row->aksi,
		'daterecord' => $row->daterecord,
	    );
            
			$this->load->view('header');
            $this->load->view('tmstpricelist_log/tmstpricelist_log_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstpricelist_log'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tmstpricelist_log/create_action'),
	    'id' => set_value('id'),
	    'iditem' => set_value('iditem'),
	    'packaging' => set_value('packaging'),
	    'uom' => set_value('uom'),
	    'size' => set_value('size'),
	    'price' => set_value('price'),
	    'source' => set_value('source'),
	    'user' => set_value('user'),
	    'aksi' => set_value('aksi'),
	    'daterecord' => set_value('daterecord'),
	);

		$this->load->view('header');
		$this->load->view('tmstpricelist_log/tmstpricelist_log_form', $data);
        $this->load->view('footer');
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'iditem' => $this->input->post('iditem',TRUE),
		'packaging' => $this->input->post('packaging',TRUE),
		'uom' => $this->input->post('uom',TRUE),
		'size' => $this->input->post('size',TRUE),
		'price' => $this->input->post('price',TRUE),
		'source' => $this->input->post('source',TRUE),
		'user' => $this->input->post('user',TRUE),
		'aksi' => $this->input->post('aksi',TRUE),
		'daterecord' => $this->input->post('daterecord',TRUE),
	    );

            $this->Tmstpricelist_log_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tmstpricelist_log'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tmstpricelist_log_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tmstpricelist_log/update_action'),
		'id' => set_value('id', $row->id),
		'iditem' => set_value('iditem', $row->iditem),
		'packaging' => set_value('packaging', $row->packaging),
		'uom' => set_value('uom', $row->uom),
		'size' => set_value('size', $row->size),
		'price' => set_value('price', $row->price),
		'source' => set_value('source', $row->source),
		'user' => set_value('user', $row->user),
		'aksi' => set_value('aksi', $row->aksi),
		'daterecord' => set_value('daterecord', $row->daterecord),
	    );
			$this->load->view('header');
			$this->load->view('tmstpricelist_log/tmstpricelist_log_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstpricelist_log'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'iditem' => $this->input->post('iditem',TRUE),
		'packaging' => $this->input->post('packaging',TRUE),
		'uom' => $this->input->post('uom',TRUE),
		'size' => $this->input->post('size',TRUE),
		'price' => $this->input->post('price',TRUE),
		'source' => $this->input->post('source',TRUE),
		'user' => $this->input->post('user',TRUE),
		'aksi' => $this->input->post('aksi',TRUE),
		'daterecord' => $this->input->post('daterecord',TRUE),
	    );

            $this->Tmstpricelist_log_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tmstpricelist_log'));
        }
    }
    
    public function delete($id) 
    {
     	$level = $this->session->userdata('role') ; 
	
		if ($level!='User') 
		{
			$row = $this->Tmstpricelist_log_model->get_by_id($id);

			if ($row) {
				$this->Tmstpricelist_log_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('tmstpricelist_log'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('tmstpricelist_log'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('tmstpricelist_log'));
			
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('iditem', 'iditem', 'trim|required');
	$this->form_validation->set_rules('packaging', 'packaging', 'trim|required');
	$this->form_validation->set_rules('uom', 'uom', 'trim|required');
	$this->form_validation->set_rules('size', 'size', 'trim|required');
	$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
	$this->form_validation->set_rules('source', 'source', 'trim|required');
	$this->form_validation->set_rules('user', 'user', 'trim|required');
	$this->form_validation->set_rules('aksi', 'aksi', 'trim|required');
	$this->form_validation->set_rules('daterecord', 'daterecord', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tmstpricelist_log.xls";
        $judul = "tmstpricelist_log";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Iditem");
	xlsWriteLabel($tablehead, $kolomhead++, "Packaging");
	xlsWriteLabel($tablehead, $kolomhead++, "Uom");
	xlsWriteLabel($tablehead, $kolomhead++, "Size");
	xlsWriteLabel($tablehead, $kolomhead++, "Price");
	xlsWriteLabel($tablehead, $kolomhead++, "Source");
	xlsWriteLabel($tablehead, $kolomhead++, "User");
	xlsWriteLabel($tablehead, $kolomhead++, "Aksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Daterecord");

	foreach ($this->Tmstpricelist_log_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->iditem);
	    xlsWriteLabel($tablebody, $kolombody++, $data->packaging);
	    xlsWriteLabel($tablebody, $kolombody++, $data->uom);
	    xlsWriteLabel($tablebody, $kolombody++, $data->size);
	    xlsWriteNumber($tablebody, $kolombody++, $data->price);
	    xlsWriteLabel($tablebody, $kolombody++, $data->source);
	    xlsWriteLabel($tablebody, $kolombody++, $data->user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->aksi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->daterecord);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tmstpricelist_log.doc");

        $data = array(
            'tmstpricelist_log_data' => $this->Tmstpricelist_log_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tmstpricelist_log/tmstpricelist_log_doc',$data);
    }

}

/* End of file Tmstpricelist_log.php */
/* Location: ./application/controllers/Tmstpricelist_log.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-15 06:10:36 */
/* http://harviacode.com */