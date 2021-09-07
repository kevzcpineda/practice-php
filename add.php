<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add</title>
</head>
<body>
    <?php
        include("connect.php");

        echo "<pre><br>";
        print_r($result);
        echo "</pre>";

        if(isset($_POST['add'])){

            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $email = $_POST['email'];

            $add_user = "INSERT INTO `student`(`id`, `firstname`, `lastname`, `email`) VALUES (null,'$fname' ,'$lname','$email')";
            $prepareStatement = $con->prepare($add_user);
            $result = $prepareStatement->execute();

            if($result){
                header("Location: index.php" );
            }
            else{
                echo "Failed to save";
            }



        }
        

    
    ?>
    <form method="POST">
        <h1>add</h1>
        <label >firstname</label>
        <input type="text" name="firstname"><br>
        <label >lastname</label>
        <input type="text" name="lastname"><br>
        <label >email</label>
        <input type="email" name="email"><br>
        <button type = "submit" name="add">add</button>

    </form>
    
</body>
</html>