<?php 

include('auth_session.php');

# check if the user is logged in
if (isset($_SESSION['uname'])) {

	if (isset($_POST['id_2'])) {
	
	# database connection file
	include '../db.conn.php';

	$id_1  = $_SESSION['aid'];
	$id_2  = $_POST['id_2'];
	$opend = 0;

	$sql = "SELECT * FROM tblchats
	        WHERE to_id=?
	        AND   from_id= ?
	        ORDER BY chat_id ASC";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id_1, $id_2]);

	if ($stmt->rowCount() > 0) {
	    $chats = $stmt->fetchAll();

	    # looping through the chats
	    foreach ($chats as $chat) {
	    	if ($chat['opened'] == 0) {
	    		
	    		$opened = 1;
	    		$chat_id = $chat['chat_id'];

	    		$sql2 = "UPDATE tblchats
	    		         SET opened = ?
	    		         WHERE chat_id = ?";
	    		$stmt2 = $conn->prepare($sql2);
	            $stmt2->execute([$opened, $chat_id]); 

	            ?>
                  <p class="ltext border 
					        rounded p-2 mb-1">
					    <?=$chat['message']?> 
					    <small class="d-block">
					    	<?=$chat['created_at']?>
					    </small>      	
				  </p>        
	            <?php
	    	}
	    }
	}

 }

}