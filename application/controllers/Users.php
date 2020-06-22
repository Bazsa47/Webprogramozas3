<?php

class Users extends CI_Controller{
     public function __construct(){
        parent::__construct();
        
        $this->load->model('users_model');
        //innentől az emp. modell metódusait a $this->employees_model-en keresztül tudjuk hívni.
    }
    
    public function index() {
        //1. lekérdezem az adatbázisból a rekordokat
        $records = $this->users_model->get_list();
        
        //2. a rekordok megjelenítése a böngészőben
        $view_params = [
            'users' => $records
        ];
        
        //aaz url helper által biztzosított metódusokat fel tudom használni 
        $this->load->helper('url');
        //3. felhelyezem a nézetet + átadom a paramétereket.
        $this->load->view('Users/list', $view_params);
        
    }
}