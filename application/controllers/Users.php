<?php

class Users extends CI_Controller{
     public function __construct(){
        parent::__construct();
        
        $this->load->model('users_model');
        $this->load->library('session');
        $this->load->helper('url');
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
        $this->load->helper('url');
        $this->load->library('session');
        //létezik e egyeltalán a törölni kívánt rekord?
         if($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"){
        if($id == null){
            show_error("Hiányzó rekordazonosító!");
        }
            //nézzük meg hogy az adb-ben létezik e az adott táblában az id
        $record = $this->users_model->selectById($id);
        if($record == null){
            show_error("Ilyen azonosítóval nincs rekord!");
        }
        
        //ha minden ok, akkör törlés, majd a listázó oldalra megyünk
        $this->users_model->delete($id);
        
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
        //lemásolom az insertből a validációs szabályokat
        $this->form_validation->set_rules('username','username','required');
        $this->form_validation->set_rules('address','address','required');
        
        //megnézem hogy rendben vannak e a validációs szabályok. ha nem akkor felület, ha igen akkor szerkesztés.
        if($this->form_validation->run() == true){
            //kezdeményezzük a rekord frissítését, amely ha sikeeres, visszamegyünk a lista oldalra.
            $this->users_model->update($id, $this->input->post('username'),$this->input->post('address'));
            $this->load->helper("url");
            redirect(base_url('Users'));
            }else{
            $view_params = ['user' => $record];
            $this->load->helper("form");// ahahoz kell hogy a nézetben a form elkészíthető legyyen a metódushívások segítségével      

            //felhelyezem a nézetet
            $this->load->view('Users/edit',$view_params);
            }
        }else{
            $this->load->view('Error/ForbiddenAccess');
        }
            
    }

    
    
    
}


