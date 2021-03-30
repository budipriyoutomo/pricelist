<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmstpricefnb extends MY_Controller {

	protected $access = array('SuperAdmin','Admin', 'User');

    function __construct()
    {
        parent::__construct();
        $this->load->model('Tmstpricefnb_model');
        $this->load->model('Tmstpricefnb_log_model');
        $this->load->model('Master');
        $this->load->library('form_validation');
	$this->load->library('datatables');
    }

    public function index()
    {
	    $tmstpricefnb = $this->Tmstpricefnb_model->get_all();

        $data = array(
            'tmstpricefnb_data' => $tmstpricefnb
        );
		$this->load->view('header');
        $this->load->view('tmstpricefnb/tmstpricefnb_list', $data);
        $this->load->view('footer');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Tmstpricefnb_model->json();
    }

    public function read($id)
    {
        $row = $this->Tmstpricefnb_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'iditem' => $row->iditem,
		'convert' => $row->convert,
	    );

			$this->load->view('header');
            $this->load->view('tmstpricefnb/tmstpricefnb_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstpricefnb'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tmstpricefnb/create_action'),
	    'id' => set_value('id'),
	    'iditem' => $this->Master->getitem(),
	    'convert' => $this->Master->getconvert(),
	);

		$this->load->view('header');
		$this->load->view('tmstpricefnb/tmstpricefnb_form', $data);
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
		'convert' => $this->input->post('convert',TRUE),
	    );

            $this->Tmstpricefnb_model->insert($data);

            $data = array(
                'iditem' => $this->input->post('iditem',TRUE),
                'convert' => $this->input->post('convert',TRUE),
                'user' => $this->session->userdata('username'),
                'aksi' => 'INSERT',
            );

            $this->db->set('daterecord', 'NOW()', FALSE);
            $this->Tmstpricefnb_log_model->insert($data);

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tmstpricefnb'));
        }
    }

    public function update($id)
    {
        $row = $this->Tmstpricefnb_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tmstpricefnb/update_action'),
		'id' => set_value('id', $row->id),
		'iditem' => set_value('iditem', $row->iditem),
		'convert' => set_value('convert', $row->convert),
	    );
			$this->load->view('header');
			$this->load->view('tmstpricefnb/tmstpricefnb_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstpricefnb'));
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
		'convert' => $this->input->post('convert',TRUE),
	    );

            $this->Tmstpricefnb_model->update($this->input->post('id', TRUE), $data);

            $data = array(
                'iditem' => $this->input->post('iditem',TRUE),
                'convert' => $this->input->post('convert',TRUE),
                'user' => $this->session->userdata('username'),
                'aksi' => 'UPDATE',
            );

            $this->db->set('daterecord', 'NOW()', FALSE);
            $this->Tmstpricefnb_log_model->insert($data);

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tmstpricefnb'));
        }
    }

    public function delete($id)
    {
     	$level = $this->session->userdata('role') ;

		if ($level!='User')
		{
			$row = $this->Tmstpricefnb_model->get_by_id($id);

			if ($row) {
        $data = array(
            'iditem' => $row->iditem,
            'convert' => $row->convert,
            'user' => $this->session->userdata('username'),
            'aksi' => 'DELETE',
        );


				$this->Tmstpricefnb_model->delete($id);

        $this->db->set('daterecord', 'NOW()', FALSE);
        $this->Tmstpricefnb_log_model->insert($data);

				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('tmstpricefnb'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('tmstpricefnb'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('tmstpricefnb'));

		}
    }

    public function _rules()
    {
	$this->form_validation->set_rules('iditem', 'iditem', 'trim|required');
	$this->form_validation->set_rules('convert', 'convert', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tmstpricefnb.xls";
        $judul = "tmstpricefnb";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Convert");

	foreach ($this->Tmstpricefnb_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->iditem);
	    xlsWriteLabel($tablebody, $kolombody++, $data->convert);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tmstpricefnb.doc");

        $data = array(
            'tmstpricefnb_data' => $this->Tmstpricefnb_model->get_all(),
            'start' => 0
        );

        $this->load->view('tmstpricefnb/tmstpricefnb_doc',$data);
    }

}

/* End of file Tmstpricefnb.php */
/* Location: ./application/controllers/Tmstpricefnb.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-15 06:10:36 */
/* http://harviacode.com */
