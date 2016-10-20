<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Icons extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->library('breadcrumb');
	}

	function index()
	{	
		//rule type pada function ini: Read
		$this->rule->type('R');
		//Layout
		//title
		$this->layout->set_title('Icons');
		//meta description jika perlu
		$this->layout->set_meta('Made with love by Raksa Abadi Informatika');
		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Designs', site_url('designs'));
		$this->breadcrumb->add_crumb('Icons');
		//judul kategori
		$data['primary_title'] 		= '<i class="fa fa-edit"></i> Designs';
		$data['sub_primary_title']	= 'Variety of icon design';
		//menggunakan layout back/backend templating
		$this->layout->back('designs/icons', $data);
	}
	function test()
    {
        $CI =& get_instance();
        $CI->load->database();
        echo $CI->config->item('encryption_key'); // give the config name here (hostname).
    }
}