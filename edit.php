<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
</head>
<body> -->
    <?php
        include("connect.php");
            $id = $_POST['editId'];

            $edit_user = "SELECT * FROM `student` WHERE id = '$id'";
            $prepareStatement = $con->prepare($edit_user);
            $result = $prepareStatement->execute();
            $user = $prepareStatement->fetch();

        

        if(isset($_POST['edit'])){
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $email = $_POST['email'];
            $id = $_POST['editId'];

            

            $edit_user = "UPDATE `student` SET `firstname`='$fname',`lastname`='$lname',`email`='$email' WHERE id= $id";
            $prepareStatement = $con->prepare($edit_user);
            $result = $prepareStatement->execute();
            

            echo "<pre>";
            print_r($user);
            echo "</pre>";

            if($result){
                header("Location: index.php" );
            }
            else{
                echo "Failed to save";
            }



        }
        

    
    ?>
       <!-- <form method="POST">
        <h1>edit</h1>
        <label >firstname</label>
        <input type="text" name="firstname"valu ><br>
        <label >lastname</label>
        <input type="text" name="lastname" value=""><br>
        <label >email</label>
        <input type="email" name="email" value=""><br>
        <button type = "submit" name="edit">edit</button>

    </form>
    
</body>
</html> -->