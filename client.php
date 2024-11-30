<?php
$data[]="";
class Client{
public $id;
public $firstname;
public $lastname;
public $email;
public $password;
public $reg_date;
public static $errorMsg = "";
public static $successMsg="";



public function __construct($firstname,$lastname,$email,$password){
  $this->firstname = $firstname;   
  $this->lastname = $lastname;
  $this->email = $email;
  $this->password = password_hash($password, PASSWORD_DEFAULT);
}



public function insertClient($tableName,$conn){
    $sql = "INSERT INTO $tableName (firstname, lastname, email, password) 
    VALUES ('$this->firstname', '$this->lastname', '$this->email', '$this->password')";
    if (mysqli_query($conn, $sql)) {
        self::$successMsg = "New record created successfully";
    } else {
        self::$errorMsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    

}





public static function selectAllClients($tableName,$conn){
    $sql = "SELECT id, firstname, lastname, email FROM $tableName";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[]=$row;
    }
    return $data;
}


}





static function selectClientById($tableName,$conn,$id){
    $sql = "SELECT firstname, lastname, email FROM $tableName WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}
    return $row;

}




static function updateClient($client, $tableName, $conn, $id) {
    $sql = "UPDATE $tableName 
            SET firstname = '$client->firstname', 
                lastname = '$client->lastname', 
                email = '$client->email', 
                password = '$client->password' 
            WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        self::$successMsg = "Record updated successfully";
        header("Location: read.php");
        exit();
    } else {
        self::$errorMsg = "Error updating record: " . mysqli_error($conn);
    }
}




static function deleteClient($tableName, $conn, $id) {
    $sql = "DELETE FROM $tableName WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        self::$successMsg = "Record deleted successfully";
        // Rediriger l'utilisateur vers une page, par exemple `read.php`
        header("Location: read.php");
        exit();
    } else {
        self::$errorMsg = "Error deleting record: " . mysqli_error($conn);
    }
}
}
?>