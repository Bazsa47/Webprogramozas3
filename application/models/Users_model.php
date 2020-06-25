<?php

class Users_model extends CI_Model{
     public function __construct() {
        parent::__construct();
        
        $this->load->database();
        //innentől kezdve lesz db kapcsolatom -> a példányban a $this->db mezőn keresztül érem el az adatbázist
    }
    
     public function get_list(){
        $this->db->select('*');  //SELECT * 
        $this->db->from('users'); //FROM employees
        //kell-e where feltétel? most nem.
        //kell-e rendezni?
        $this->db->order_by('username','ASC'); //ORDER BY name ASC
        
        $query = $this->db->get();  //lekérdezés OBJEKTUM!!!
        $result = $query->result();  //lekérdezés végrehajtása + rekordok betöltése.
        
        return $result;
    }
    
    public function getPasswordForUsername($username){
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('username',$username);
        
        $query = $this->db->get();
        $result = $query->row();
        if($result == null ) return "Invalid username";
        return $result->password;
    }
    
    public function getUserRoleByUsername($userName) {
        $this->db->select('roleId');
        $this->db->from('users');
        $this->db->where('username',$userName);
        $query = $this->db->get();
        $roleId = $query->row();
        $roleId = $roleId->roleId;
        
        $this->db->select('roleName');
        $this->db->from('roles');
        $this->db->where('roleId',$roleId);
        $query = $this->db->get();
        $result = $query->row();
        
        return $result->roleName;
        
    }
    
     public function delete($id){
        $this->db->where('id',$id);
        return $this->db->delete('users');
    }
    
    public function insert($username, $pw, $address) {
        $secret_password = password_hash($pw,PASSWORD_DEFAULT);
         $record = [
          'username' => $username,
          'password'  => $secret_password,
          'address'  => $address,
          'roleId' => 0
        ];
        
        //2. hívjuk meg az insert metódust
        //a) elég tudnom azt h a beszúrás megtörtént
        return $this->db->insert('users',$record);
        
    }
    
    public function selectById($id){
         $this->db->select("*");
        $this->db->from("users");
        $this->db->where('id',$id);
        
        return $this->db->get()->row(); 
    }
    
      public function update($id,$username, $address){
        $record = ['username' => $username,
                   'address' => $address,
                  ];
        
        $this->db->where('id',$id);
        return $this->db->update('users',$record);
    }
}
