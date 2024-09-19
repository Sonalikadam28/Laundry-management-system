<?php  

include('auth_session.php');

# check if the user is logged in
if (isset($_SESSION['uname'])) {
	
	# database connection file
	include '../db.conn.php';

	# get the logged in user's username from SESSION
	$id = $_SESSION['aid'];

	$sql = "UPDATE tblbuyer
	        SET last_seen = NOW() 
	        WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

}
