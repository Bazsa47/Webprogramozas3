<?php

class order_model extends CI_Model{
     public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
     public function get_list(){
        $this->db->select('*');  
        $this->db->from('orders'); 
      
        $query = $this->db->get();  
        $result = $query->result();  
        
        return $result;
    }
    
    public function insert($productId,$userId){
         $record = [
          'productId' => $productId,
          'userId'  => $userId
        ];
        return $this->db->insert('orders',$record);
    }
    
    public function deleteByUserId($id){
        $this->db->where('userId',$id);
        return $this->db->delete('orders');
    }
    
     public function deleteByProductId($id){
        $this->db->where('ProductId',$id);
        return $this->db->delete('orders'); 
    }

}
