<?php

include('auth_session.php');

# check if the user is logged in
if (isset($_SESSION['uname'])) {
    # check if the key is submitted
    if(isset($_POST['key'])){
       # database connection file
	   include '../db.conn.php';

	   # creating simple search algorithm :) 
	   $key = "%{$_POST['key']}%";
     
	   $sql = "SELECT * FROM tblfarmer
	           WHERE fullname
	           LIKE ? OR fullname LIKE ?";
       $stmt = $conn->prepare($sql);
       $stmt->execute([$key, $key]);

       if($stmt->rowCount() > 0){ 
         $users = $stmt->fetchAll();

         foreach ($users as $user) {
         	if ($user['id'] == $_SESSION['aid']) continue;
       ?>
       <li class="list-group-item">
		<a href="chat.php?user=<?=$user['fullname']?>"
		   class="d-flex
		          justify-content-between
		          align-items-center p-2">
			<div class="d-flex
			            align-items-center">

			
			    <h3 class="fs-xs m-2">
			    	<?=$user['fullname']?>
			    </h3>            	
			</div>
		 </a>
	   </li>
       <?php } }else { ?>
         <div class="alert alert-info 
    				 text-center">
		   <i class="fa fa-user-times d-block fs-big"></i>
           The user "<?=htmlspecialchars($_POST['key'])?>"
           is  not found.
		</div>
    <?php }
    }

}
