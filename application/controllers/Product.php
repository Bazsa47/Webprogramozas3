<?php

class Product extends CI_Controller{
     public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('product_model');
        $this->load->library('session');
        //innentől az emp. modell metódusait a $this->employees_model-en keresztül tudjuk hívni.
    }
    
    public function index() {
        //1. lekérdezem az adatbázisból a rekordokat
        $records = $this->product_model->get_list();
        
        //2. a rekordok megjelenítése a böngészőben
        $view_params = [
            'products' => $records
        ];
        
        //aaz url helper által biztzosított metódusokat fel tudom használni 
        $this->load->helper('url');
        //3. felhelyezem a nézetet + átadom a paramétereket.
        $this->load->view('Product/list', $view_params);
        
    }
    
    public function insert(){
         //miért kerültünk ide?
        //a) valaki meghívta első alkalommal ezt a metódust
        //b) valaki kitöltötte az űrlapot és szeretné beküldeni
        
        //a $this->input az input kezelést valósítja meg
        if($this->input->post('submit')){
            //valaki rákattintott a submitra, az adatokat validálni kell.
            //a validációhoz a form_validation könyvtárat használjuk.
            
            //az űrlapot beküldték
            //file feltöltése. Csak ez is egy input adat, azaz validálnom kell.
            //a fájlok validálásához egy olyan konfigurációs tömböt kell építenünk, ahol az egyes bejegyzések
            //mondják meg a validációs szabályt.
            
            $upload_config['allowed_types'] = 'jpg|jpeg|png'; //kiterjesztés
            $upload_config['max_size'] = 2300; //méret(kb)
            $upload_config['min_width'] = 50; //minimum képszélesség (pixel)
            $upload_config['max_width'] = 2000; //max képszélesség
            $upload_config['min_height'] = 50; //min magasság
            $upload_config['max_height'] = 2000; //max magasság
            
            //állítsuk be a feltöltés konfigurációját
            $upload_config['file_name'] = $this->input->post('name').$this->product_model->generateRandomString(5); //alapértelmezetten a feltöltési név
            //feltöltés helye. a gyökértől határozom meg.
            $upload_config['upload_path'] = "./uploads/img";
            //kiterjesztés kisbetűssé konvertálása megtörténjen e
            $upload_config['file_ext_tolower'] = true;
            //ha létezik a fájl akkor felülírjuk e
            $upload_config['overwrite'] = true;
            
            //a feltöltést egy külső könyvtárral valósítjuk meg.
            $this->load->library('upload');
            //a feltöltéshez hozzárendelem a fenti konfigurációt
            $this->upload->initialize($upload_config);
            
            //kezdeményezem az űrlapon megfelelő névvel ellátott űrlapmező alapján a feltöltést.
            //el akarom végezni a feltöltést úgy hogy a feltötleni 
            //kívánt állomány a file mezöben van, ezt validáljuk le a config_upload alapján, 
            //ha minden kritériumnak eleget tesz akkor mentsük el a config_upload alapján!
            $path = base_url("uploads/img")."/".$upload_config['file_name'];
            if(!$this->upload->do_upload('file')){
                $path = null;
            }
            
             $this->load->library('form_validation');
              $this->load->helper('url');
            
            //validációs szabályok beállítása
            //a) mindhárom mező kitöltése kötelező
            
            $this->form_validation->set_rules('name','name','required');
            $this->form_validation->set_rules('price','price','required');
            $this->form_validation->set_rules('desc','desc','required');
            $this->form_validation->set_rules('type','type','required');
            
            
            
            if($this->form_validation->run()){
                //a validáció ok, mehet a beszúrás az adatbázisba
                $this->product_model->insert($this->input->post('name'),
                                               $this->input->post('price'),
                                               $this->input->post('desc'),
                                               $path,
                                               $this->input->post('type'));
                
                //irányítsuk az oldalt listázó nézetbe
                //redirect -> átirányítás
                redirect(base_url('Product'));
                
            }
            
        }
        $this->load->helper("url");
        $this->load->helper('form');
        $this->load->view("Product/insert");
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
        $record = $this->product_model->selectById($id);
        if($record == null){
            show_error("Ilyen azonosítóval nincs rekord!");
        }
        
        //ha minden ok, akkör törlés, majd a listázó oldalra megyünk
        $this->product_model->delete($id);
        
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
        //lemásolom az insertből a validációs szabályokat
        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('price','price','required');
        $this->form_validation->set_rules('desc','desc','required');
         $this->form_validation->set_rules('type','type','required');
        
        //megnézem hogy rendben vannak e a validációs szabályok. ha nem akkor felület, ha igen akkor szerkesztés.
        if($this->form_validation->run() == true){
            //kezdeményezzük a rekord frissítését, amely ha sikeeres, visszamegyünk a lista oldalra.
            $this->product_model->update($id,   $this->input->post('name'),
                                                $this->input->post('price'),
                                                $this->input->post('desc'),
                                                $this->input->post('type'));
            $this->load->helper("url");
            redirect(base_url('Product'));
            }else{
            $view_params = ['product' => $record];
            $this->load->helper("form");// ahahoz kell hogy a nézetben a form elkészíthető legyyen a metódushívások segítségével      

            //felhelyezem a nézetet
            $this->load->view('Product/edit',$view_params);
            }
        }else{
            $this->load->view('Error/ForbiddenAccess');
        }
            
    }
}