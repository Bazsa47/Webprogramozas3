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
            $upload_config['min_width'] = 250; //minimum képszélesség (pixel)
            $upload_config['max_width'] = 2000; //max képszélesség
            $upload_config['min_height'] = 250; //min magasság
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
            
            if(!$this->upload->do_upload('file')){
                //sikertelen feltöltés
                //a hiba oka a this->upload->display_error() hívással kérhető le
                //hiba esetén biztosítom, hogy újra fel tudja tölteni.

  
                $this->load->helper('form');               
                //$this->load->view('file_upload/form', $view_params);
            }
            
             $this->load->library('form_validation');
              $this->load->helper('url');
            
            //validációs szabályok beállítása
            //a) mindhárom mező kitöltése kötelező
            
            $this->form_validation->set_rules('name','name','required');
            $this->form_validation->set_rules('price','price','required');
            $this->form_validation->set_rules('desc','desc','required');
            $this->form_validation->set_rules('type','type','required');
            
            
            $path = base_url("uploads/img")."/".$upload_config['file_name'];
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
}