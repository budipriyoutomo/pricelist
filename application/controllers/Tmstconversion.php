<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmstconversion extends MY_Controller {

	protected $access = array('SuperAdmin','Admin', 'User');

    function __construct()
    {
        parent::__construct();
        $this->load->model('Tmstconversion_model');
        $this->load->model('Master');
        $this->load->library('form_validation');
	      $this->load->library('datatables');
    }

    public function index()
    {
	    $tmstconversion = $this->Tmstconversion_model->get_all();

        $data = array(
            'tmstconversion_data' => $tmstconversion
        );
		$this->load->view('header');
        $this->load->view('tmstconversion/tmstconversion_list', $data);
        $this->load->view('footer');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Tmstconversion_model->json();
    }

    public function read($id)
    {
        $row = $this->Tmstconversion_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'uombefore' => $row->uombefore,
		'uomafter' => $row->uomafter,
		'conversion' => $row->conversion,
	    );

			$this->load->view('header');
            $this->load->view('tmstconversion/tmstconversion_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstconversion'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tmstconversion/create_action'),
	    'id' => set_value('id'),
	    'uombefore' => $this->Master->getuom(),
	    'uomafter' => $this->Master->getuom(),
	    'conversion' => set_value('conversion'),
	);

		$this->load->view('header');
		$this->load->view('tmstconversion/tmstconversion_form', $data);
        $this->load->view('footer');

    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'uombefore' => $this->input->post('uombefore',TRUE),
		'uomafter' => $this->input->post('uomafter',TRUE),
		'conversion' => $this->input->post('conversion',TRUE),
	    );

            $this->Tmstconversion_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tmstconversion'));
        }
    }

    public function update($id)
    {
        $row = $this->Tmstconversion_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tmstconversion/update_action'),
		'id' => set_value('id', $row->id),
		'uombefore' => set_value('uombefore', $row->uombefore),
		'uomafter' => set_value('uomafter', $row->uomafter),
		'conversion' => set_value('conversion', $row->conversion),
	    );
			$this->load->view('header');
			$this->load->view('tmstconversion/tmstconversion_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstconversion'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'uombefore' => $this->input->post('uombefore',TRUE),
		'uomafter' => $this->input->post('uomafter',TRUE),
		'conversion' => $this->input->post('conversion',TRUE),
	    );

            $this->Tmstconversion_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tmstconversion'));
        }
    }

    public function delete($id)
    {
     	$level = $this->session->userdata('role') ;

		if ($level!='User')
		{
			$row = $this->Tmstconversion_model->get_by_id($id);

			if ($row) {
				$this->Tmstconversion_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('tmstconversion'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('tmstconversion'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('tmstconversion'));

		}
    }

    public function _rules()
    {
	$this->form_validation->set_rules('uombefore', 'uombefore', 'trim|required');
	$this->form_validation->set_rules('uomafter', 'uomafter', 'trim|required');
	$this->form_validation->set_rules('conversion', 'conversion', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tmstconversion.xls";
        $judul = "tmstconversion";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Uombefore");
	xlsWriteLabel($tablehead, $kolomhead++, "Uomafter");
	xlsWriteLabel($tablehead, $kolomhead++, "Conversion");

	foreach ($this->Tmstconversion_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->uombefore);
	    xlsWriteLabel($tablebody, $kolombody++, $data->uomafter);
	    xlsWriteLabel($tablebody, $kolombody++, $data->conversion);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tmstconversion.doc");

        $data = array(
            'tmstconversion_data' => $this->Tmstconversion_model->get_all(),
            'start' => 0
        );

        $this->load->view('tmstconversion/tmstconversion_doc',$data);
    }

}

/* End of file Tmstconversion.php */
/* Location: ./application/controllers/Tmstconversion.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-15 06:10:35 */
/* http://harviacode.com */
