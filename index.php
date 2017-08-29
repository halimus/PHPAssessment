<?php 
    require 'account.php';
   
    $message =''; // message to display to the user
   
    if(count($_POST)){
        $account = new account();
        $account->name = $_POST['account_name'];
        $account->email = $_POST['account_email'];

        $errors = $account->validate_input();
        if(!empty($errors)){
            foreach ($errors as $value) {
                $message.= $value.'<br>';
            }
            $message ='<div style="color:red">There is errors:<br>'.$message.'</div>';
        }
        else{
            $message = $account->insert_account();  
            $message ='<div style="color:green">'.$message.'</div>';
        }
   }
?>
<html> 
    <body> 
        
        <div> 
            <?php 
               echo @$message;
            ?>
            <br>
            <h3><u>Insert Form:</u></h3>
            <form method="POST" action=""> 
                name: <input type='text' id="account_name" name='account_name' value="<?php echo @$_POST['name'];?>"> 
                email:<input type='text' id='account_email' name="account_email" value="<?php echo @$_POST['email'];?>"> 
                <input type="submit" value="submit"> 
            </form> 
        </div>
        
        <div style="border:solid 1px #F60;"> 
            Last 10 entry: 
        </div> 
        <div style="border:solid 1px #000;">  
            <?php 
               $account = new account();
               $records = $account->list_account();
               if(!empty($records)){
            ?>
            <table border="1" style="">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = $records->fetch_assoc()) {
                        $show_link = '<a href="show.php?id='.$row['id'].'">Show</a>';
                        echo 
                        '<tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$show_link.'</td>
                        </tr>'; 
                    }
                    ?>
                </tbody>
            </table>
            <?php 
                }else{
                   echo 'No records exist!';
                }
            ?>
        </div> 
    </body> 
</html>

