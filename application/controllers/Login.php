<?php

class Login extends CI_Controller{
     public function __construct(){
        parent::__construct();
        
        $this->load->model('users_model');
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
                
                $hashed_password = $this->users_model->getPasswordForUsername($this->input->post('username'));
                var_dump($this->input->post('pw')); var_dump($hashed_password); 
                if (password_verify($this->input->post('pw'),$hashed_password)) {
                    $this->load->helper('url');
                    echo "Igen!";
                    redirect(base_url('Product'));     

                }else{
                      echo "Sikertelen Bejelentkezés!";
                }
              
                           
            }
        }
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view("Login/login");
    }
    
    
    
    public function login(){
         
    }
    //put your code here
}
