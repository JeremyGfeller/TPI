<?php
    require_once('fonction.php');
    connectDB();    

    $query = "SELECT id_users, login FROM cavewine.users;";
    $users = $dbh->query($query);
    
    $arrayUsers = array();
    foreach($users as $user)
    {        
        extract($user);
        $res = array('id_users' => $id_users, 'login' => $login);
        array_push($arrayUsers, $res);
    }
    echo json_encode($arrayUsers);
?>