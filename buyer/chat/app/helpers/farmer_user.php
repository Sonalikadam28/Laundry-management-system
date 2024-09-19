<?php  

function getUser($username, $conn){
   $sql = "SELECT * FROM tblfarmer 
           WHERE fullname=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$username]);

   if ($stmt->rowCount() === 1) {
   	 $user = $stmt->fetch();
   	 return $user;
   }else {
   	$user = [];
   	return $user;
   }
}