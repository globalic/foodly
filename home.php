<?php
session_start();
if(!isset($_SESSION['log_email'])){
	header("location:index.php");
}
include 'connection.php';
$q="SELECT * FROM `restaurants`; ";
$q1=mysqli_query($con,$q);

?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<title>home page</title>
	<link rel="shortcut icon" href="images/logo.png" type="image/png">
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
</head>

<body>
<ul>
<li><img src="images\header_logo.jpeg" align="left" width="100" height="52"></li>
</ul>
<center><h2>Restaurants</h2></center>
<div class="cards">
	<?php
	while($row=mysqli_fetch_array($q1)){ ?>
		<div class="card-container">
		<a href="restaurant_menu.php?restaurant=<?php echo $row['email']; ?>">
    		<div class="card">
    		
    				<h4><b><?php echo $row['name'];  ?></b></h4> 
    				<p><?php echo $row['status'];  ?></p>
    			
    		</div>
  		</a>
  	</div>
  	<?php } ?>
</div>


<div id="chat-box">
	<div id="msg-box">
	</div>
	<div>
		<input id="send_msg" type="text" name="msg" >
		<input type="submit" id="send_button" value="send" >
	</div>
</div>
<br><br><br><br><br><br><br>

 <div class="navbar">
       	<a onclick="show_chat_box()">Support</a>
        <a href="#">Past Orders</a>
        <a href="logout.php">Log Out</a>
        <div class="copy">&copy; foodly</div>
</div>
<script>
	$(document).ready(function(){
	$('#send_button').click(function(){
		var send_msg = $('#send_msg').val();
		if($.trim(send_msg) !=''){
			$.ajax({
				url:"send-msg.php",
				method:"POST",
				data:{msg:send_msg,client:"user"},
				dataType:"text",
				success:function(data){
					$('#send_msg').val("");
				}
			});
		}
	});
	setInterval(function(){
		$('#msg-box').load("fetch-msg.php").fadeIn("slow");
	},1000);
});
</script>
<script src="js/home.js" type="text/javascript"></script>
</body>
</html>
