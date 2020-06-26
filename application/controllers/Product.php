<?php

class Product extends CI_Controller{
     public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('product_model');
        $this->load->library('session');
        $this->load->model('order_model');
    }
    
    public function index() {
        $records = $this->product_model->get_list();
        $view_params = [
            'products' => $records
        ];
        
        $this->load->helper('url');
        $this->load->view('Product/list', $view_params);
        
    }
    
    public function insert(){
        if($this->input->post('submit')){
            $upload_config['allowed_types'] = 'jpg|jpeg|png';
            $upload_config['max_size'] = 2300; 
            $upload_config['min_width'] = 50;
            $upload_config['max_width'] = 2000; 
            $upload_config['min_height'] = 50; 
            $upload_config['max_height'] = 2000;
            
            $upload_config['file_name'] = $this->input->post('name').$this->product_model->generateRandomString(5);          
            $upload_config['upload_path'] = "./uploads/img";
            $upload_config['file_ext_tolower'] = true;
            $upload_config['overwrite'] = true;
            
            $this->load->library('upload');
            $this->upload->initialize($upload_config);
            
            $path = base_url("uploads/img")."/".$upload_config['file_name'];
            if(!$this->upload->do_upload('file')){
                $path = null;
            }
            
             $this->load->library('form_validation');
              $this->load->helper('url');
           
            $this->form_validation->set_rules('name','name','required');
            $this->form_validation->set_rules('price','price','required');
            $this->form_validation->set_rules('desc','desc','required');
            $this->form_validation->set_rules('type','type','required');
            $this->form_validation->set_rules('class','class','required');
            
            
            if($this->form_validation->run()){
           
                $this->product_model->insert($this->input->post('name'),
                                               $this->input->post('price'),
                                               $this->input->post('desc'),
                                               $this->input->post('class'),
                                               $path,
                                               $this->input->post('type'));
                
              
                redirect(base_url('Product'));
                
            }
            
        }
        $this->load->helper("url");
        $this->load->helper('form');
        $this->load->view("Product/insert");
    }
    
     public function delete($id = null){
       
        $this->load->helper('url');
        $this->load->library('session');
       
         if($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"){
        if($id == null){
            show_error("Hiányzó rekordazonosító!");
        }
           
        $record = $this->product_model->selectById($id);
        if($record == null){
            show_error("Ilyen azonosítóval nincs rekord!");
        }
        
       
        $this->product_model->delete($id);
        $this->order_model->deleteByProductId($id);
        redirect(base_url('Product'));
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
        
        $record = $this->product_model->selectById($id);
        if($record == null){
           $view_param = [
                 'error' => "Hibás azonosító!"
             ];
            $this->load->view("Error/404NotFound", $view_param);
            return;
        }
        
         if($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"){
        $this->load->library("form_validation");
       
        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('price','price','required');
        $this->form_validation->set_rules('desc','desc','required');
         $this->form_validation->set_rules('type','type','required');
        
       
        if($this->form_validation->run() == true){
            
            $this->product_model->update($id,   $this->input->post('name'),
                                                $this->input->post('price'),
                                                $this->input->post('desc'),
                                                $this->input->post('type'));
            $this->load->helper("url");
            redirect(base_url('Product'));
            }else{
            $view_params = ['product' => $record];
            $this->load->helper("form");     

            $this->load->view('Product/edit',$view_params);
            }
        }else{
            $this->load->view('Error/ForbiddenAccess');
        }
            
    }
}