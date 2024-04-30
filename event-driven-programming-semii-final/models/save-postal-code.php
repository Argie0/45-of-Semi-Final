<?php

$registration = array(
    'postal_regCode' => "'" . $_POST['inp_region'] . "'",
    'postal_provCode' => "'" . $_POST['inp_province'] . "'",
    'postal_citymunCode' => "'" . $_POST['inp_citymun'] . "'",
    'postal_code' => "'" . $_POST['inp_postalcode'] . "'",

);

save($registration);
function save($data)
{
    include('../config/database.php');

    $attributes = implode(", ", array_keys($data));
    $values = implode(", ", array_values($data));

    
    $postal_code = $_POST['inp_postalcode'];
    $validate = "SELECT COUNT(*) AS i FROM ph_postalcode WHERE postal_code LIKE '$postal_code'";
    
   $rs = $conn->query($validate);
    $count =  $rs->fetch_assoc();
   
    

   if($count['i'] == 0){
       $query = "INSERT INTO ph_postalcode ($attributes) VALUES ($values)";
       $conn->query($query);
        header('location: ../postalcode.php?success');
    }else{
       header('location: ../postalcode.php?invalid');
}
    $conn->close();
}