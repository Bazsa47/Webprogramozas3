<?php

class Login extends CI_Controller{
     public function __construct(){
        parent::__construct();
        
        $this->load->model('users_model');
        $this->load->library('session');
        //innentől az emp. modell metódusait a $this->employees_model-en keresztül tudjuk hívni.
    }
    
    public function index(){
        $this->load->helper('url');
        $this->load->helper('form');   
        //3. felhelyezem a nézetet + átadom a paramétereket.
 
         if($this->input->post('submit')){        
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username','username','required');
            $this->form_validation->set_rules('pw','pw','required');
            if($this->form_validation->run()){
                if($this->users_model->getPasswordForUsername($this->input->post('username')) != null) {
                $hashed_password = $this->users_model->getPasswordForUsername($this->input->post('username'));
                if (password_verify($this->input->post('pw'),$hashed_password)) {
                    $this->load->helper('url');
                    $this->load->library('session');
                  //  var_dump($this->users_model->getUserRoleByUsername($this->input->post('username')));
                    
                        $this->session->set_userdata('role', $this->users_model->getUserRoleByUsername($this->input->post('username')));
                    redirect(base_url('Product'));     
                }
                else{
                    echo "Hibás felhasználónév!";
                }
                   

                }                       
            }
        }
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view("Login/login");
    }
    
    
    
    public function logout(){
        $this->load->library('session');
        $this->load->helper('url');
        $this->session->sess_destroy();
        redirect(base_url("Product"));
    }
    //put your code here
}
