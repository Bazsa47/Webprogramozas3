<?php

class Users extends CI_Controller{
     public function __construct(){
        parent::__construct();
        
        $this->load->model('users_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('order_model');
    }
    
    public function index() {
        $this->load->library("session");
        if($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"){
            
        $records = $this->users_model->get_list();
        $view_params = [
            'users' => $records
        ];
        
        $this->load->helper('url');
        $this->load->view('Users/list', $view_params);
        }else{
            $this->load->helper("url");
            $this->load->view("Error/ForbiddenAccess");
        }
        
    }
    
     public function delete($id = null){
        $this->load->helper('url');
        $this->load->library('session');
         if($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"){
        if($id == null){
            show_error("Hiányzó rekordazonosító!");
        }
        $record = $this->users_model->selectById($id);
        if($record == null){
            show_error("Ilyen azonosítóval nincs rekord!");
        }
        
        $this->users_model->delete($id);
        $this->order_model->deleteByUserId($id);
        
        redirect(base_url('Users'));
         }else{
             $this->load->view("Error/ForbiddenAccess");
         }
    }
    
    public function edit($id = -1){
       
         if($id == null || $id == -1){
             $view_param = [
                 'error' => "Hibás azonosító!"
             ];
            $this->load->view("Error/404NotFound", $view_param);
            return;
        }
        
        $record = $this->users_model->selectById($id);
        if($record == null){
           $view_param = [
                 'error' => "Hibás azonosító!"
             ];
            $this->load->view("Error/404NotFound", $view_param);
            return;
        }
        
         if($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"){
        $this->load->library("form_validation");
        $this->form_validation->set_rules('username','username','required');
        $this->form_validation->set_rules('address','address','required');
        
        if($this->form_validation->run() == true){
            $this->users_model->update($id, $this->input->post('username'),$this->input->post('address'));
            $this->load->helper("url");
            redirect(base_url('Users'));
            }else{
            $view_params = ['user' => $record];
            $this->load->helper("form");

            $this->load->view('Users/edit',$view_params);
            }
        }else{
            $this->load->view('Error/ForbiddenAccess');
        }
            
    }

    
    
    
}


