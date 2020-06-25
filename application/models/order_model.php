<?php

class order_model extends CI_Model{
     public function __construct() {
        parent::__construct();
        
        $this->load->database();
        //innentől kezdve lesz db kapcsolatom -> a példányban a $this->db mezőn keresztül érem el az adatbázist
    }
    
     public function get_list(){
        $this->db->select('*');  //SELECT * 
        $this->db->from('orders'); //FROM employees
        //kell-e where feltétel? most nem.
        //kell-e rendezni?
        
        $query = $this->db->get();  //lekérdezés OBJEKTUM!!!
        $result = $query->result();  //lekérdezés végrehajtása + rekordok betöltése.
        
        return $result;
    }
    
    public function insert($productId,$userId){
         $record = [
          'productId' => $productId,
          'userId'  => $userId
        ];
        
        //2. hívjuk meg az insert metódust
        //a) elég tudnom azt h a beszúrás megtörtént
        return $this->db->insert('orders',$record);
    }
    
   
    //put your code here
}
