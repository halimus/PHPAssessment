<?php
require 'database.php';

class account {

    public $id;
    public $name;
    public $email;
    
    /**
     * 
     */
    public function __construct() {
        $this->id = '';
        $this->name = '';
        $this->email = '';
    }
    
    /**
     * 
     * @param int $id
     */
    function find_account($id) {
        $db = new database();
        $db->connect();
        
        $this->id = $db->conn->real_escape_string($id); //escape the id
        
        $sql = "select * from `account` where `id`='" . $this->id . "'";
 
        $result = $db->conn->query($sql);
        if($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            $this->id= $row['id'];
            $this->name= $row['name'];
            $this->email= $row['email'];
        }
        
    }
    
    /**
     * 
     * @param type $limit
     * @return type array
     */
    function list_account($limit=10) {
        $db = new database();
        $db->connect();
       
        $sql = "SELECT * FROM account ORDER BY timestamp DESC LIMIT $limit";
        
        $result = $db->conn->query($sql);
        if($result->num_rows > 0) {
            return $result;
        }
        return null;
    }
    
    
    /**
     * 
     */
    function insert_account() {
        $db = new database();
        $db->connect();
        
        $timestamp = date("Y-m-d H:i:s");
        $this->name = $db->conn->real_escape_string($this->name); //escape the name
        $this->email = $db->conn->real_escape_string($this->email); //escape the email
        
        $sql = "INSERT INTO account (name, email, timestamp) VALUES ('$this->name', '$this->email', '$timestamp')";
        
        if ($db->conn->query($sql) === true) {
            return "New record created successfully";
        }
        else{
            die("Error: " . $db->conn->error);
        }
        $db->conn->close(); 
    }
    
    /**
     * validate data before insert it to db
     */
    function validate_input() {
        
        $errros = array();
        
        if(empty($this->name)){
           array_push($errros, 'The name should not be empty!');
        }
        if(empty($this->email)){
           array_push($errros, 'The email should not be empty!');
        }
        elseif(filter_var($this->email, FILTER_VALIDATE_EMAIL) == false) {
            array_push($errros, 'The email is not a valid email address');
        } 
        return $errros;
        
    }
    
}

?>
