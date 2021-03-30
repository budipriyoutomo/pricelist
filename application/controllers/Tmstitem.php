<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmstitem extends MY_Controller {
	
	protected $access = array('SuperAdmin','Admin', 'User');
	
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tmstitem_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
	    $tmstitem = $this->Tmstitem_model->get_all();

        $data = array(
            'tmstitem_data' => $tmstitem
        );
		$this->load->view('header');
        $this->load->view('tmstitem/tmstitem_list', $data);
        $this->load->view('footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tmstitem_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tmstitem_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'code' => $row->code,
		'desc' => $row->desc,
	    );
            
			$this->load->view('header');
            $this->load->view('tmstitem/tmstitem_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstitem'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tmstitem/create_action'),
	    'id' => set_value('id'),
	    'code' => set_value('code'),
	    'desc' => set_value('desc'),
	);

		$this->load->view('header');
		$this->load->view('tmstitem/tmstitem_form', $data);
        $this->load->view('footer');
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'code' => $this->input->post('code',TRUE),
		'desc' => $this->input->post('desc',TRUE),
	    );

            $this->Tmstitem_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tmstitem'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tmstitem_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tmstitem/update_action'),
		'id' => set_value('id', $row->id),
		'code' => set_value('code', $row->code),
		'desc' => set_value('desc', $row->desc),
	    );
			$this->load->view('header');
			$this->load->view('tmstitem/tmstitem_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstitem'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'code' => $this->input->post('code',TRUE),
		'desc' => $this->input->post('desc',TRUE),
	    );

            $this->Tmstitem_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tmstitem'));
        }
    }
    
    public function delete($id) 
    {
     	$level = $this->session->userdata('role') ; 
	
		if ($level!='User') 
		{
			$row = $this->Tmstitem_model->get_by_id($id);

			if ($row) {
				$this->Tmstitem_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('tmstitem'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('tmstitem'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('tmstitem'));
			
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('code', 'code', 'trim|required');
	$this->form_validation->set_rules('desc', 'desc', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tmstitem.xls";
        $judul = "tmstitem";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Code");
	xlsWriteLabel($tablehead, $kolomhead++, "Desc");

	foreach ($this->Tmstitem_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->code);
	    xlsWriteLabel($tablebody, $kolombody++, $data->desc);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tmstitem.doc");

        $data = array(
            'tmstitem_data' => $this->Tmstitem_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tmstitem/tmstitem_doc',$data);
    }

}

/* End of file Tmstitem.php */
/* Location: ./application/controllers/Tmstitem.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-15 06:10:35 */
/* http://harviacode.com */