<?php

class Order extends CI_Controller{
     public function __construct(){
        parent::__construct();
        
        $this->load->model('users_model');
        $this->load->model('product_model');
         $this->load->model('order_model');
        $this->load->library('session');
        $this->load->helper("url");
    }
    
    public function index(){
        $records = $this->order_model->get_list();
        
        $view_params = [
            'orders' => $records
        ];

        $this->load->helper('url');
        $this->load->view('Order/list', $view_params);
    }
    
    public function placeOrder($productId = null){
        if($productId == null ) {
            $this->load->view("Error/404NotFound", ['error' => "Hiábyzó azonosító!"]);
            return;
        }
        $this->order_model->insert($productId, $this->session->userdata("id"));
        redirect(base_url("Product"));
    }
    
    public function deleteByUserId($id){
        $this->order_model->deleteByUserId($id);      
    }
    
    public function ordersPDF(){
         $records = $this->order_model->get_list();
        $view_params = [
            'orders' => $records
        ];

        $this->load->helper('url');
        $this->load->view('Order/list', $view_params);
        
         $html = $this->output->get_output();
        
        $this->load->library('pdf');
        
        $this->dompdf->loadHtml($html);
        
        $this->dompdf->setPaper('A4', 'portrait');
        
        $this->dompdf->render();
        
        $this->dompdf->stream("Rendelések.pdf", array("Attachment"=>0));
    }
    
     public function deleteByProductId($id){
        $this->order_model->deleteByProductId($id);      
    }
}
