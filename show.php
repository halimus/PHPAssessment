<?php 
   require 'account.php';
?>
<html> 
    <body> 
        <a href="index.php">Back to Home</a><br>
        <?php 
            if(isset($_GET['id'])and !empty($_GET['id'])){
               $id = $_GET['id'];
               
               $account = new account();
               $account->find_account($id);  
               
               if(!empty($account->id)){
                   echo '<br>Id = '.$account->id;
                   echo '<br>Name = '.$account->name;
                   echo '<br>Email = '.$account->email; 
               }
               else{
                   echo '<br>No record found with this id';
               }
            }
        ?>
    </body> 
</html>


