<?php

class Users extends CI_Controller{
     public function __construct(){
        parent::__construct();
        
        $this->load->model('users_model');
        //innentől az emp. modell metódusait a $this->employees_model-en keresztül tudjuk hívni.
    }
    
    public function index() {
        //1. lekérdezem az adatbázisból a rekordokat
        //Ha admin jogosultsággal rendelkezünk
        $this->load->library("session");
        if($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"){
            
        $records = $this->users_model->get_list();
        
        //2. a rekordok megjelenítése a böngészőben
        $view_params = [
            'users' => $records
        ];
        
        //aaz url helper által biztzosított metódusokat fel tudom használni 
        $this->load->helper('url');
        //3. felhelyezem a nézetet + átadom a paramétereket.
        $this->load->view('Users/list', $view_params);
        }else{
            $this->load->helper("url");
            $this->load->view("Error/ForbiddenAccess");
        }
        
    }
    
     public function delete($id = null){
        //van e jogosultságom a rekord törlésére?
        
        //létezik e egyeltalán a törölni kívánt rekord?
        if($id == null){
            show_error("Hiányzó rekordazonosító!");
        }
            //nézzük meg hogy az adb-ben létezik e az adott táblában az id
        $record = $this->users_model->select_by_id($id);
        if($record == null){
            show_error("Ilyen azonosítóval nincs rekord!");
        }
        
        //ha minden ok, akkör törlés, majd a listázó oldalra megyünk
        $this->users_model->delete($id);
        $this->load->helper('url');
        redirect(base_url('users'));
    }

    
    
    
}


