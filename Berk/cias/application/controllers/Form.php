<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Form extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Form_model');
    }

    public function index()
    {
        $this->load->view('form/user');
    }

    public function admin()
    {
        // Form görüntüleme işlemleri
        // Form verilerini al
        $data['forms'] = $this->Form_model->list();

        // Form görüntüleme işlemleri
        $this->load->view('form/admin', $data);
    }

    public function submit()
    {
        // Form gönderme işlemleri

        // Form verilerini al
        $ad = $this->input->post('ad');
        $soyad = $this->input->post('soyad');
        $email = $this->input->post('email');
        $telefon = $this->input->post('telefon');
        $mesaj = $this->input->post('mesaj');

        // Veritabanına kaydet
        $formData = [
            'ad' => $ad,
            'soyad' => $soyad,
            'email' => $email,
            'telefon' => $telefon,
            'mesaj' => $mesaj
        ];


        $this->Form_model->insert($formData);

        redirect(base_url('dashboard'));
    }
}
