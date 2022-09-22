<?php
session_start();
?>
<!DOCTYPE HTML>
<!--
	Ex Machina by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Ticket resale platform-sold</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<style>
		#small_title{
			width: 20.6em;
			height: 40px;
			background-color: #e95d3c;
			color:white;
			font-size: 20px;
			text-align: center;
			font-weight: bold;
			padding: 5px;
			margin-right: 30px;
			float: left;
		}
		#insert_button{
			width: 60px;
			height: 60px;
			font-family: 微軟正黑體;
			font-weight: bold;
			background-color:#e95d3c;
			color: white;
			border-radius: 30px;
			border: unset;
			float: right;
		}
	
	</style>
	<body class="sold">

	<!-- Header -->
	<?php 
	if(@!$_SESSION['login'])
	{
		echo "<script>alert('您尚未登入，請先登入帳號。'); location.href = 'login.php';</script>";
	}
	?>
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<a href="index.html"><img src="images/03.png" alt="票券轉售平台" border="0" height="120em"></a>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="index.php">首頁</a></li>
							<li><a href="need.php">我有需求</a></li>
							<li class="active"><a href="sold.php">我要售出</a></li>
							<li><a href="userdata.php">嗨，<?php echo $_SESSION['last_name'] ?></a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
		
	<!-- Banner -->
		<div id="banner">
			<div class="container">
			</div>
		</div>
	<!-- /Banner -->

	<!-- Main -->
		<div id="page">
				
			<!-- Main -->
			<div id="main" class="container">
				    <div style="align:center; width:50em; margin: 0 auto; border-width:3px; border-style:solid; border-color: #e95d3c; border-radius:0.5em; border-bottom-right-radius:1.5em; display:inline-block;">
					    <div id="small_title" style="align:center;border-bottom-right-radius:0.5em;  width: 40%">我&nbsp&nbsp要&nbsp&nbsp售&nbsp&nbsp出</div>
						<?php 
								$con = new mysqli("localhost", "root", "1061746", "票券系統");
								if ($con->connect_error) {
									die("連接失敗: " . $conn->connect_error);
								}
						$r_msg = "";
						if (isset($_POST['insert']) && !empty($_POST['ticket_name']) && !empty($_POST['Category']) 
							&& !empty($_POST['activity_date'])) 
						{
							$ticket_id = md5(uniqid());
							$ticket_name = $_POST['ticket_name'];
							$buyer_id = $_SESSION['account'];
							$ticket_class_id = $_POST['Category'];
							$ticket_post_time =  date("Y-m-d H:i:s");
							$activity_date= $_POST['activity_date'];
							$ticket_status = "sold";
									$wsql = "INSERT INTO ticket(ticket_id,seller_id,ticket_name,ticket_post_time,activity_time,ticket_status,ticket_class_id) 
										VALUES('$ticket_id','$buyer_id','$ticket_name','$ticket_post_time','$activity_date','$ticket_status','$ticket_class_id')";
									
									
									if($con->query($wsql) === true){
					
										$r_msg = "票券新增成功!";?>
										<script language="javascript"> alert('<?=$r_msg?>');</script>
										<script language="javascript">location.href="userdata.php";</script>
								  <?php 
									  }
						}
					
							$con->close();
						?>
						
						<div style="padding: 5px; margin: 10px; margin-top: 50px; align:center;">
						<form  role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
						<h4><?php echo $r_msg; ?></h4>
							<b>票券名稱 </b>
							<input type="text" name="ticket_name" style="width: 30em;">
							<BR>
							<BR>
							<b>活動時間 </b>
							<input type="date" name="activity_date">
							<BR>
							<BR>
							<b>票券類別 </b>
					    	<select name="Category">
					    	　  <option value="concert">演唱會</option>
							　  <option value="movie">電影</option>
						　      <option value="sport">運動賽事</option>
						　      <option value="exhibition">展覽</option>
						　      <option value="music">音樂會</option>
						    </select>
							</div>

							<BR>
							<BR>
							<button id="insert_button" type = "submit" name = "insert" style="margin: 1px;">送出</button>
						</div>
							
						</form>
				    </div>	
			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->

	<!-- Featured -->
		<div id="featured">
			<div class="container">
				
			</div>
		</div>
	<!-- /Featured -->

	<!-- Footer -->
		<div id="footer">
			<div class="container">
				
			</div>
		</div>
	<!-- /Footer -->

	<!-- Copyright -->
		<div id="copyright" class="container">
			Design by 陳宛君 許博軒 曾鈺惠 邱子玲 許家誠
			<br>
			2019.12
		</div>


	</body>
</html>