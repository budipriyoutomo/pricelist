<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PriceUom extends MY_Controller {

	protected $access = array('SuperAdmin','Admin', 'User');

    function __construct()
    {
        parent::__construct();
        $this->load->model('PriceUom_model');
        $this->load->model('Master');
        $this->load->library('form_validation');
	      $this->load->library('datatables');
    }

    public function index()
    {
	    $priceuom = $this->PriceUom_model->get_all();

        $data = array(
            'iduser' => $this->Master->getuser()
        );
		    $this->load->view('header');
        $this->load->view('PriceUom/PriceUom_list', $data);
        $this->load->view('footer');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->PriceUom_model->json();
    	//$data = $this->Master->getpriceuom();
    	//echo json_encode($data);
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "PriceUom.xls";
        $judul = "PriceUom";
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