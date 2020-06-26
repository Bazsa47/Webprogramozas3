<?php

class Register extends CI_Controller{
     public function __construct(){
        parent::__construct();
        
        $this->load->model('users_model');
        $this->load->library('session');
    } 
    
    public function index() {
        if($this->input->post('submit')){        
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username','username','required');
            $this->form_validation->set_rules('pw','pw','required');
            $this->form_validation->set_rules('address','address','required');
            if($this->form_validation->run()){
                $this->users_model->insert($this->input->post('username'),
                                               $this->input->post('pw'),$this->input->post('address'));
                $this->load->helper('url');
                redirect(base_url('Login'));                
            }
        }
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view("Register/register");
    }
}
   
        

