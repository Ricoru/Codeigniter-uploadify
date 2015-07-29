<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_file extends CI_Controller {

	public function __construct()
	{
	   parent::__construct();
	   $this->load->helper(array('url', 'form', 'download' , 'html'));
	   //$this->load->library(array('session', 'encrypt'));
	}

	public function index()
	{
		$this->load->view('upload_form');
	}

	public function uploadFile()
	{
		$config['upload_path'] = "./uploads";
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("txt_adjunto"))
		{
			$error = $this->upload->display_errors();
			echo json_encode($error);

		}
		else
		{
			$data = $this->upload->data();
            echo json_encode($data);
		}
	}

	public function downloads_name($name){
       $data = file_get_contents("./uploads/".$name); 
       force_download($name,$data);
	}

}