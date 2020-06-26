<?php

class Users_model extends CI_Model{
     public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
     public function get_list(){
        $this->db->select('*'); 
        $this->db->from('users'); 
        $this->db->order_by('username','ASC'); 
        
        $query = $this->db->get(); 
        $result = $query->result(); 
        
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
    
    public function getUserRoleNameByUserRoleId($id){
         $this->db->select("roleName");
        $this->db->from("roles");
        $this->db->where('roleId',$id);
        
        $query = $this->db->get();
        $result = $query->row();
        
        return $result->roleName;
    }
     public function getUsernameByUserId($id){
          $this->db->select('username'); 
        $this->db->from('users');
        $this->db->where('id', $id);
        
        $query = $this->db->get();
        $result = $query->row();
        
        return $result->username;
    }
    
    
   public function getUserIdByUsername($username){
         $this->db->select("id");
        $this->db->from("users");
        $this->db->where('username',$username);
        
        $query = $this->db->get();
        $result = $query->row();
        
        return $result->id;
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
