<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmstpricelist extends MY_Controller {

	protected $access = array('SuperAdmin','Admin', 'User');

    function __construct()
    {
        parent::__construct();
        $this->load->model('Tmstpricelist_model');
        $this->load->model('Tmstpricelist_log_model');
        $this->load->model('Master');
        $this->load->library('form_validation');
	      $this->load->library('datatables');
    }

    public function index()
    {
	    $tmstpricelist = $this->Tmstpricelist_model->get_all();

        $data = array(
            'tmstpricelist_data' => $tmstpricelist
        );
		$this->load->view('header');
        $this->load->view('tmstpricelist/tmstpricelist_list', $data);
        $this->load->view('footer');
    }

    public function json() {
        header('Content-Type: application/json');
        print $this->Tmstpricelist_model->json();
    }

    public function read($id)
    {
        $row = $this->Tmstpricelist_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'iditem' => $row->iditem,
		'packaging' => $row->packaging,
		'uom' => $row->uom,
		'size' => $row->size,
		'price' => $row->price,
		'source' => $row->source,
	    );

			$this->load->view('header');
            $this->load->view('tmstpricelist/tmstpricelist_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstpricelist'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tmstpricelist/create_action'),
	    'id' => set_value('id'),
	    'iditem' => $this->Master->getitem(),
	    'packaging' => $this->Master->getpackaging(),
	    'uom' => $this->Master->getuom(),
	    'size' => set_value('size'),
	    'price' => set_value('price'),
	    'source' => $this->Master->getsource(),
	);

		$this->load->view('header');
		$this->load->view('tmstpricelist/tmstpricelist_form', $data);
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
	    );

            $this->Tmstpricelist_model->insert($data);

            $data = array(
          		'iditem' => $this->input->post('iditem',TRUE),
          		'packaging' => $this->input->post('packaging',TRUE),
          		'uom' => $this->input->post('uom',TRUE),
          		'size' => $this->input->post('size',TRUE),
          		'price' => $this->input->post('price',TRUE),
          		'source' => $this->input->post('source',TRUE),
              'user' => $this->session->userdata('username'),
              'aksi' => 'INSERT',
            );


            $this->db->set('daterecord', 'NOW()', FALSE);
            $this->Tmstpricelist_log_model->insert($data);

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tmstpricelist'));
        }
    }

    public function update($id)
    {
        $row = $this->Tmstpricelist_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tmstpricelist/update_action'),
		'id' => set_value('id', $row->id),
		'iditem' => set_value('iditem', $row->iditem),
		'packaging' => set_value('packaging', $row->packaging),
		'uom' => set_value('uom', $row->uom),
		'size' => set_value('size', $row->size),
		'price' => set_value('price', $row->price),
		'source' => set_value('source', $row->source),
	    );
			$this->load->view('header');
			$this->load->view('tmstpricelist/tmstpricelist_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tmstpricelist'));
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
	    );

            $this->Tmstpricelist_model->update($this->input->post('id', TRUE), $data);

            $data = array(
              'iditem' => $this->input->post('iditem',TRUE),
              'packaging' => $this->input->post('packaging',TRUE),
              'uom' => $this->input->post('uom',TRUE),
              'size' => $this->input->post('size',TRUE),
              'price' => $this->input->post('price',TRUE),
              'source' => $this->input->post('source',TRUE),
              'user' => $this->session->userdata('username'),
              'aksi' => 'UPDATE',
            );


            $this->db->set('daterecord', 'NOW()', FALSE);
            $this->Tmstpricelist_log_model->insert($data);

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tmstpricelist'));
        }
    }

    public function delete($id)
    {
     	$level = $this->session->userdata('role') ;

		if ($level!='User')
		{
			$row = $this->Tmstpricelist_model->get_by_id($id);

			if ($row) {

                $data = array(
                  'iditem' =>$row->iditem,
                  'packaging' => $row->packaging,
                  'uom' => $row->uom,
                  'size' => $row->size,
                  'price' => $row->price,
                  'source' => $row->source,
                  'user' => $this->session->userdata('username'),
                  'aksi' => 'DELETE',
                );

				$this->Tmstpricelist_model->delete($id);

        $this->db->set('daterecord', 'NOW()', FALSE);
        $this->Tmstpricelist_log_model->insert($data);

				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('tmstpricelist'));
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('tmstpricelist'));
			}
		}else{
			$this->session->set_flashdata('message', 'Access Denied');
			redirect(site_url('tmstpricelist'));

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

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tmstpricelist.xls";
        $judul = "tmstpricelist";
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

	foreach ($this->Tmstpricelist_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->iditem);
	    xlsWriteLabel($tablebody, $kolombody++, $data->packaging);
	    xlsWriteLabel($tablebody, $kolombody++, $data->uom);
	    xlsWriteLabel($tablebody, $kolombody++, $data->size);
	    xlsWriteNumber($tablebody, $kolombody++, $data->price);
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
        header("Content-Disposition: attachment;Filename=tmstpricelist.doc");

        $data = array(
            'tmstpricelist_data' => $this->Tmstpricelist_model->get_all(),
            'start' => 0
        );

        $this->load->view('tmstpricelist/tmstpricelist_doc',$data);
    }

}

/* End of file Tmstpricelist.php */
/* Location: ./application/controllers/Tmstpricelist.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-15 06:10:36 */
/* http://harviacode.com */
