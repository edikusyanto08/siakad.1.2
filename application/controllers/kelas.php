

<?php

/**
 * Description of artikel
 *
 * @author white
 */
class Kelas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_kelas', 'the_m');
        $this->load->library(array('breadcrumb', 'sesfilter'));
        $this->load->helper(array('slug', 'filter'));
    }

    function index() {
        $this->rule->type('R');
        $this->layout->set_title('Kelas');
        $this->layout->set_meta('Data Kelas');
        $this->layout->add_includes('css', 'themes/back/css/datatables/dataTables.bootstrap.css');
        $this->layout->add_includes('js', 'themes/back/js/jquery.dataTables.min.js');

        $this->breadcrumb->clear();
        $this->breadcrumb->add_crumb('Beranda', site_url('admin'));
        $this->breadcrumb->add_crumb('Kelas');

        $data['primary_title'] = '<i class="ion-android-note"></i> Kelas';
        $data['sub_primary_title'] = 'Data Kelas';
        $data['list'] = $this->the_m->get()->result_array();
        $data['notif'] = $this->_notification();
        $this->layout->back('kelas/index', $data);
    }

    function add() {
        $this->rule->type('C');
        $this->layout->set_title('Tambah Kelas');

        $this->breadcrumb->clear();
        $this->breadcrumb->add_crumb('Beranda', site_url('admin'));
        $this->breadcrumb->add_crumb('Kelas', site_url('kelas'));
        $this->breadcrumb->add_crumb('Tambah Kelas');

        $data['primary_title'] = 'Kelas';
        $data['sub_primary_title'] = 'Proses tambah data';
        $this->layout->back('kelas/add', $data);
    }

    function save() {
        $this->rule->type('C');
        $this->load->library('form_validation');
        $kelas=$this->input->post('kelas');
        $this->form_validation->set_rules('kelas', 'Nama Kelas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $cariKelas=$this->the_m->cariKelas($kelas)->num_rows();
            if ($cariKelas >= 1) {
                $this->session->set_flashdata('error', 'Nama Kelas yang anda input sudah ada');
            }else{
                $dataInsert=array(
                        'kelas'=>$this->input->post('kelas'),
                        'jenjang'=>$this->input->post('jenjang'),
                        'aktif'=>$this->input->post('aktif')
                    );
                $q = $this->the_m->save($dataInsert);
                if ($q) {
                    $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
                } else {
                    $this->session->set_flashdata('error', 'Data Gagal Disimpan');
                }
            }
        }
        redirect('kelas');
    }

    function deactivated($id){
        $this->rule->type('U');
            $dataUpdate=array(
                'aktif'=>'T'
                );
            $q = $this->the_m->update($id, $dataUpdate);
                if ($q) {
                    $this->session->set_flashdata('success', 'Data Berhasil Dirubah');
            } else {
                    $this->session->set_flashdata('error', 'Data Gagal Dirubah');
            }
        redirect('kelas'); 
    }

    function activated($id){
        $this->rule->type('U');
            $dataUpdate=array(
                'aktif'=>'Y'
                );
            $q = $this->the_m->update($id, $dataUpdate);
                if ($q) {
                    $this->session->set_flashdata('success', 'Data Berhasil Dirubah');
            } else {
                    $this->session->set_flashdata('error', 'Data Gagal Dirubah');
            }
        redirect('kelas'); 
    }

    function edit($id) {
        $this->rule->type('U');
        $data['row'] = $this->the_m->get_by($id)->row_array();
        $data['jenjang'] = array('7','8','9');
        $this->layout->set_title('Edit Kelas');

        $this->breadcrumb->clear();
        $this->breadcrumb->add_crumb('Beranda', site_url('admin'));
        $this->breadcrumb->add_crumb('Kelas', site_url('kelas'));
        $this->breadcrumb->add_crumb('Edit Kelas');

        $data['primary_title'] = 'Kelas';
        $data['sub_primary_title'] = 'Proses edit kelas';
        $this->layout->back('kelas/edit', $data);
    }

    function update() {
        $this->rule->type('U');
        $id = $this->input->post('id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            
            $dataUpdate=array(
                    'kelas'=>$this->input->post('kelas'),
                    'jenjang'=>$this->input->post('jenjang')
                );
            $q = $this->the_m->update($id, $dataUpdate);
                if ($q) {
                    $this->session->set_flashdata('success', 'Data Berhasil Dirubah');
            } else {
                    $this->session->set_flashdata('error', 'Data Gagal Dirubah');
            }
                   
        }
        redirect('kelas');
    }

    function _notification() {
        $notifForm = "";
        if ($this->session->flashdata('error') != "") {
            $notifForm .= '<div style="display:block; margin-bottom:7px;" class="alert alert-info alert-dismissable col-centered col-xs-12">';
            $notifForm .= '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
            $notifForm .= $this->session->flashdata('error');
            $notifForm .= '</div>';
        } else if ($this->session->flashdata('success') != "") {
            $notifForm .= '<div style="display:block; margin-bottom:7px;" class="alert alert-success alert-dismissable col-centered col-xs-12">';
            $notifForm .= '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
            $notifForm .= $this->session->flashdata('success');
            $notifForm .= '</div>';
        }
        return $notifForm;
    }

   
}

