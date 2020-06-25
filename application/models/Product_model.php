<?php

class Product_model extends CI_Model{
     public function __construct() {
        parent::__construct();
        
        $this->load->database();
        //innentől kezdve lesz db kapcsolatom -> a példányban a $this->db mezőn keresztül érem el az adatbázist
    }
    
     public function get_list(){
        $this->db->select('*');  //SELECT * 
        $this->db->from('products'); //FROM employees
        //kell-e where feltétel? most nem.
        //kell-e rendezni?
        
        $query = $this->db->get();  //lekérdezés OBJEKTUM!!!
        $result = $query->result();  //lekérdezés végrehajtása + rekordok betöltése.
        
        return $result;
    }
    
    public function getProductTypeByProductId($id){
         $this->db->select('typeName');  //SELECT * 
        $this->db->from('types'); //FROM employees
        $this->db->where('typeId', $id);
        
        $query = $this->db->get();
        $result = $query->row();
        
        return $result->typeName;
    }
    
    public function getProductNameById($id) {
          $this->db->select('name');  //SELECT * 
        $this->db->from('products'); //FROM employees
        $this->db->where('id', $id);
        
        $query = $this->db->get();
        $result = $query->row();
        
        return $result->name;
    }
    
    function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
    
     public function insert($name, $price, $desc, $photo_path, $typeId) {
         $record = [
          'name' => $name,
          'price'  => $price,
          'description'  => $desc,
          'picture' => $photo_path,
          'typeId' => $typeId
        ];
        
        //2. hívjuk meg az insert metódust
        //a) elég tudnom azt h a beszúrás megtörtént
        return $this->db->insert('products',$record);
        
    }
    
     public function selectById($id){
         $this->db->select("*");
        $this->db->from("products");
        $this->db->where('id',$id);
        
        return $this->db->get()->row(); 
    }
    
     public function delete($id){
        $this->db->where('id',$id);
        return $this->db->delete('products');
    }
    
     public function update($id,$name, $price, $desc, $type){
        $record = ['name' => $name,
                   'price' => $price,
                   'description' => $desc,
                   'typeId' => $type
                  ];
        
        $this->db->where('id',$id);
        return $this->db->update('products',$record);
    }
}