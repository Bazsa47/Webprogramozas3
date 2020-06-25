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
    
    public function order($id){
        echo $id;
    }
    //put your code here
}
