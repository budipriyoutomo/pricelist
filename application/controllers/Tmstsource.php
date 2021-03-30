<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmstsource extends MY_Controller {
	
	protected $access = array('SuperAdmin','Admin', 'User');
	
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tmstsource_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
	    $tmstsource = $this->Tmstsource_model->get_all();

        $data = array(
            'tmstsource_data' => $tmstsource
        );
		$this->load->view('header');
        $this->load->view('tmstsource/tmstsource_list', $data);
        $this->load->view('footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tmstsource_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tmstsource_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'source' => $row->source,
	    );
            
			$this->load->view('header');
            $this->load->view('tmstsource/tmstsource_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstsource'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tmstsource/create_action'),
	    'id' => set_value('id'),
	    'source' => set_value('source'),
	);

		$this->load->view('header');
		$this->load->view('tmstsource/tmstsource_form', $data);
        $this->load->view('footer');
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'source' => $this->input->post('source',TRUE),
	    );

            $this->Tmstsource_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tmstsource'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tmstsource_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tmstsource/update_action'),
		'id' => set_value('id', $row->id),
		'source' => set_value('source', $row->source),
	    );
			$this->load->view('header');
			$this->load->view('tmstsource/tmstsource_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstsource'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'source' => $this->input->post('source',TRUE),
	    );

            $this->Tmstsource_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tmstsource'));
        }
    }
    
    public function delete($id) 
    {
     	$level = $this->session->userdata('role') ; 
	
		if ($level!='User') 
		{
			$row = $this->Tmstsource_model->get_by_id($id);

			if ($row) {
				$this->Tmstsource_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('tmstsource'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('tmstsource'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('tmstsource'));
			
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('source', 'source', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tmstsource.xls";
        $judul = "tmstsource";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Source");

	foreach ($this->Tmstsource_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->source);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tmstsource.doc");

        $data = array(
            'tmstsource_data' => $this->Tmstsource_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tmstsource/tmstsource_doc',$data);
    }

}

/* End of file Tmstsource.php */
/* Location: ./application/controllers/Tmstsource.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-15 06:10:36 */
/* http://harviacode.com */