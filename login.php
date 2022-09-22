<?php
session_start();
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Ticket resale platform-login</title>
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
		#small_title1{
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
		#small_title2{
			width: 20.6em;
			height: 40px;
			background-color: #e95d3c;
			color:white;
			font-size: 20px;
			text-align: center;
			font-weight: bold;
			padding: 5px;
			float: left;
		}
		#login_button, #register_button{
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
		input {
			border-radius: 3px;
			padding: 0 5px;
		}
	
	</style>
	<body class="login">

	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<a href="index.php"><img src="images/03.png" alt="票券轉售平台" border="0" height="120em"></a>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="index.php">首頁</a></li>
							<li><a href="need.php">我有需求</a></li>
							<li><a href="sold.php">我要售出</a></li>
							<li class="active"><a href="login.php">會員登入</a></li>
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
				<div style="width:900px;height:800px; position: relative;margin:0px auto;">
		<?php
		$con = new mysqli("localhost", "root", "1061746", "票券系統");
		$sql = "SELECT * FROM user_data";
		if ($con->connect_error) {
			die("連接失敗: " . $conn->connect_error);
		}
		$result = $con->query($sql);
		if (isset($_POST['login']) && !empty($_POST['l_account']) && !empty($_POST['l_password'])) {

			$account = $_POST['l_account'];
			$password = $_POST['l_password'];
			
			while($row = $result->fetch_assoc()){ // 一直撈
				if($account == $row["user_id"] && $password == $row["user_password"])
				{
					$_SESSION['login'] = TRUE;
					$_SESSION['first_name'] = $row['user_firstname'];
					$_SESSION['last_name'] = $row['user_lastname'];
					$_SESSION['address'] = $row['user_address'];
					$_SESSION['phone'] = $row['user_phone_number'];
					$_SESSION['email'] = $row['user_email'];
					$_SESSION['account'] = $row['user_id'];
					$_SESSION['password'] = $row['user_password'];
				}
			}
			if(@$_SESSION['login'])
			{
				?>
		            <script language="javascript"> alert('登入成功');</script>
		    		<script language="javascript">location.href="index.php";</script>
				<?php 
			}
			else
			{
				?>
		            <script language="javascript"> alert('帳號或密碼錯誤');</script>
		    		<script language="javascript">location.href="login.php";</script>
				<?php 
			}
		}
	?>
					
					<div style="position:relative; float: left; width:28.4em; top:10px; height:26em; border-width:3px; border-style:solid; border-color: #e95d3c; border-radius:0.5em; border-bottom-left-radius:1.5em;">
					
					<form class = "form-signin" role = "form" 
					 action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
						<div id="small_title1">會&nbsp&nbsp員&nbsp&nbsp登&nbsp&nbsp入</div>
						<div style="position:relative; padding: 1.5em; top: 1em;float: left;">
							<BR>
							<BR>
							<BR>
							<b>帳號 : </b>
							<input type="text" name="l_account" style="width: 11em;">
							<BR>
							<BR>
							<b>密碼 : </b>
							<input type="password" name="l_password" style="width: 11em;">
							<BR>
							<BR>
						</div>
							<button id="login_button" type = "submit" name = "login" style="margin: 3em;margin-top: 9em;">登入</button>
					</form>
					</div>
						<?php 
						$account = "";
						$password = "";
						$first_name = "";
						$last_name = "";
						$phone = "";
						$address= "";
						$email= "";
						if (isset($_POST['register']) && !empty($_POST['r_account']) && !empty($_POST['r_password']) 
							&& !empty($_POST['r_user_firstname']) && !empty($_POST['r_user_lastname']) 
							&& !empty($_POST['r_user_phone_number']) && !empty($_POST['r_user_address']) && !empty($_POST['r_user_email']) ) 
						{
							$account = $_POST['r_account'];
							$password = $_POST['r_password'];
							$first_name = $_POST['r_user_firstname'];
							$last_name = $_POST['r_user_lastname'];
							$phone = $_POST['r_user_phone_number'];
							$address= $_POST['r_user_address'];
							$email= $_POST['r_user_email'];
					
							$duplicate = false; // 檢查帳號是否重複
							while($row = $result->fetch_assoc()){ // 一直撈
								if($account == $row["user_id"]){
									$duplicate = true;
								}
							}
							if(!$duplicate){
								$wsql = "INSERT INTO user_data (user_id, user_password, user_firstname, user_lastname, 
								                                user_phone_number, user_address, user_email) 
											VALUES ('$account','$password','$first_name','$last_name','$phone','$address','$email')";
					
									if($con->query($wsql) === true)
									{
										?>
										<script language="javascript"> alert('Hi, 您已成功加入會員, 請重新登入!');</script>
										<script language="javascript">location.href="login.php";</script>
								        <?php 
									  }
									  
									
							}
							else
							{
								?>
									<script language="javascript"> alert('此帳號已存在');</script>
									<script language="javascript">location.href="login.php";</script>
								<?php 
							}
						}
					
							$con->close();
						?>
						<?php
						    $msg="";
							if (isset($_POST['check']) && !empty($_POST['r_account'])) 
						    {
								$account = $_POST['r_account'];
								$password = $_POST['r_password'];
						    	$first_name = $_POST['r_user_firstname'];
						    	$last_name = $_POST['r_user_lastname'];
						    	$phone = $_POST['r_user_phone_number'];
						    	$address= $_POST['r_user_address'];
						    	$email= $_POST['r_user_email'];
								
								$duplicate = false; // 檢查帳號是否重複
						    	while($row = $result->fetch_assoc()) // 一直撈
						    	{ 
							    	if($account == $row["user_id"])
								    {
									    $duplicate = true;
						    		}
					    		}
						    	if(!$duplicate)
						     	{
							    	$msg="此帳號可以使用";
							    }
						    	else
						    	{
									$account = "";
						    		$msg="此帳號已被使用，請修改帳號";
								}
						    }
						?>
				    <div style="position:relative; float: right; width:28.4em; top:10px; height:40em; border-width:3px; border-style:solid;
					            border-color: #e95d3c; border-radius:0.5em; border-bottom-right-radius:1.5em;">
					    <div id="small_title2">會&nbsp&nbsp員&nbsp&nbsp註&nbsp&nbsp冊</div>
						<form  role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
						<div style="position:relative; padding: 1.5em; top: 1em;float: left;">
							<b>姓氏 : </b>
							<input type="text" name="r_user_firstname" value="<?php echo $first_name ?>" style="width: 11em;">
							<BR>
							<BR>
							<b>名字 : </b>
							<input type="text" name="r_user_lastname" value="<?php echo $last_name ?>" style="width: 11em;">
							<BR>
							<BR>
							<b>帳號 : </b>
							<input type="text" name="r_account" value="<?php echo $account ?>" style="width: 11em;">&nbsp&nbsp
							<button type="submit" name="check" style="width: 100px; height: 40px;font-family: 微軟正黑體; 
							background-color: #e95d3c;color: white;border: unset;border-radius: 5px;font-weight: bold;">檢查是否可用</button>
							<BR><b style="color:#e95d3c; float:right;"><?php echo $msg; ?></b>
							<BR>
							<b>密碼 : </b>
							<input type="password" name="r_password" value="<?php echo $password ?>" style="width: 11em;">
							<BR>
							<BR>
							<hr>
							<BR>
							<b>地址 : </b>
							<input type="text" name="r_user_address" value="<?php echo $address ?>" style="width: 19em;">
							<BR>
							<BR>
							<b>電話 : </b>
							<input type="text" name="r_user_phone_number" value="<?php echo $phone ?>" style="width: 11em;">
							<BR>
							<BR>
							<b>E-MAIL : </b>
							<input type="email" name="r_user_email" value="<?php echo $email ?>" style="width: 11em;">
							
						</div>
							<button id="register_button" type = "submit" name = "register" style="margin-right: 3em;">註冊</button>
						</form>
				    </div>	
				</div>
			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->


	<!-- Footer -->
		<div id="footer">
			
		</div>
	<!-- /Footer -->

	<!-- Copyright -->
		<div id="copyright" class="container" style="top:91.5em;">
			Design by 陳宛君 許博軒 曾鈺惠 邱子玲 許家誠
			<br>
			2019.12
		</div>


	</body>
</html>