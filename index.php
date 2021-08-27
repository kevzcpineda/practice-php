<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <?php
        include("connect.php");
        $selectUsers = "SELECT * FROM student";
        $prepareStatement = $con->prepare($selectUsers);
        $result = $prepareStatement->execute();
        $users = $prepareStatement->fetchAll();

        // echo "<pre>";
        // print_r($users);
        // echo "</pre>";

        ?>
        <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($users as $user){?>
            <tr>
            <th scope="row"><?php echo $user["id"]?></th>
            <td><?php echo $user["firstname"]?></td>
            <td><?php echo $user["lastname"]?></td>
            <td>
                <button class="btn btn-success">edit</button>
                <a href="delete.php?id=<?php echo $user['id']?>"><button class ="btn btn-danger">delete</button></a>
        
        </td>
            </tr>
        
        <?php }?>
    </tbody>
    </table>

    
</body>
</html>