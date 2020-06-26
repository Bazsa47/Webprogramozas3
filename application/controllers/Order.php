<?php

class Order extends CI_Controller{
     public function __construct(){
        parent::__construct();
        
        $this->load->model('users_model');
        $this->load->model('product_model');
         $this->load->model('order_model');
        $this->load->library('session');
        $this->load->helper("url");
        //innentől az emp. modell metódusait a $this->employees_model-en keresztül tudjuk hívni.
    }
    
    public function index(){
        //1. lekérdezem az adatbázisból a rekordokat
        $records = $this->order_model->get_list();
        
        //2. a rekordok megjelenítése a böngészőben
        $view_params = [
            'orders' => $records
        ];
        
        //aaz url helper által biztzosított metódusokat fel tudom használni 
        $this->load->helper('url');
        //3. felhelyezem a nézetet + átadom a paramétereket.
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
        
        //2. a rekordok megjelenítése a böngészőben
        $view_params = [
            'orders' => $records
        ];
        
        //aaz url helper által biztzosított metódusokat fel tudom használni 
        $this->load->helper('url');
        //3. felhelyezem a nézetet + átadom a paramétereket.
        $this->load->view('Order/list', $view_params);
        
         $html = $this->output->get_output();
        
        // Load pdf library
        $this->load->library('pdf');
        
        // Load HTML content
        $this->dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("Rendelések.pdf", array("Attachment"=>0));
    }
    
     public function deleteByProductId($id){
        $this->order_model->deleteByProductId($id);      
    }
    //put your code here
}
