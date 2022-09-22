<?php
session_start();
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Ticket resale platform-index</title>
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
		#logout_button, #change_button{
			width: 60px;
			height: 60px;
			font-family: 微軟正黑體;
			font-weight: bold;
			background-color:#e95d3c;
			color: white;
			border-radius: 30px;
			border: unset;
			margin: 10px;
		}
		.user_information input{
			border-radius: 3px;
			width: 19em;
			margin: 5px 0;
			padding: 0 5px;
		}
		#word{
			padding: 5px 10px;
		}
		#ticket th{
			padding:5px;
			border:2px solid #A0522D; 
			text-align:left;
			background-color:#FFEFD5;
		}
	</style>

	<body class="homepage">

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
							<li class="active"><a href="userdata.php">嗨，<?php echo $_SESSION['last_name'] ?></a></li>
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
			<!-- Extra -->
			<form class = "change_data" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
			<?php
		          $con = new mysqli("localhost", "root", "1061746", "票券系統");
		          if ($con->connect_error) {
		                die("連接失敗: ". $conn->connect_error);
		          }

					if (isset($_POST['send']) && !empty($_POST['password'])
					    && !empty($_POST['first_name']) && !empty($_POST['last_name']) 
						&& !empty($_POST['phone']) && !empty($_POST['address']) && !empty($_POST['email']) ) 
					{
		                $account = $_SESSION['account'];
		                $password = $_POST['password'];
		                $first_name = $_POST['first_name']; 
		                $last_name = $_POST['last_name']; 
		                $phone = $_POST['phone'];
		                $address = $_POST['address'];
						$email = $_POST['email'];
		                $sql = "UPDATE user_data SET user_password='$password', user_firstname='$first_name'
						, user_lastname='$last_name', user_phone_number='$phone'
						, user_address='$address' WHERE user_id='$account'";
						if($con->query($sql) === true) 
						{?>
		            		<script language="javascript"> alert('會員資料已修改完成，請重新登入。');</script>
		    		        <script language="javascript">location.href="logout.php";</script>
		                <?php 
		          		}
					}

			?>
			<center>
			<p style="font-weight: bold; font-size: large; color: #e95d3c;">個人資料</p>
			<hr style="border: 0; height: 1px; background: #e95d3c; background-image: linear-gradient(to right, white, #e95d3c, white);">
			
			<TABLE style="text-align:left; margin:0 3em;" class="user_information">
			    <TR>
					<TH id="word">帳號</TH>
					<TH>&nbsp&nbsp<?php echo $_SESSION['account'] ?></TH>
				</TR>
				<TR>
					<TH id="word">密碼</TH>
					<TH><input type="text" name="password" value="<?php echo $_SESSION['password'] ?>"></TH>
			    </TR>
				<TR>
					<TH id="word">姓氏</TH>
					<TH><input type="text" name="first_name" value="<?php echo $_SESSION['first_name'] ?>"></TH>
				</TR>
				<TR>
					<TH id="word">名字</TH>
					<TH><input type="text" name="last_name" value="<?php echo $_SESSION['last_name'] ?>"><br></TH>
				</TR>
				<TR>
					<TH id="word">地址</TH>
					<TH><input type="text" name="address" value="<?php echo $_SESSION['address'] ?>"><br></TH>
				</TR>
				<TR>
					<TH id="word">電話</TH>
					<TH><input type="text" name="phone" value="<?php echo $_SESSION['phone'] ?>"></TH>
				</TR>
				<TR>
					<TH id="word">E-MAIL</TH>
					<TH><input type="text" name="email" value="<?php echo $_SESSION['email'] ?>"></TH>
				</TR>
				
			</TABLE>
			<br>
			<div style="width:35em">
			<button id="change_button" type="submit" name ="send">修改</button>		
			<button id="logout_button" type="button" name = "logout"  onclick="location.href='logout.php'">登出</button>    
	    	</div>
			</form>
			<br>
			<!-- /Extra -->
			<hr style="border: 0; height: 1px; background: #e95d3c; background-image: linear-gradient(to right, white, #e95d3c, white);">
			<br>
			<p style="font-weight: bold; font-size: large; color: #e95d3c;">你上架的票券</p>
			
			<TABLE id="ticket">
			<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<tr>
					<th style="width:25em; background-color:#e95d3c; color:white;">票券名稱</th>
				    <th style="width:6em; background-color:#e95d3c; color:white">類型</th>
					<th style="width:7em; background-color:#e95d3c; color:white;">活動時間</th>
					<th style="width:11em; background-color:#e95d3c; color:white;">上架時間</th>
					<th style="width:7.7em; background-color:#e95d3c; color:white">
					<button type="submit" name ="action1" formmethod="post" value="Delete" >刪除<br>已選取的票券</button></th>
				</tr>
			
			<?php
			$result = $con->query("SELECT seller_id,ticket_class_id,ticket_name,activity_time,ticket_post_time,ticket_status FROM ticket ");
			while($row = mysqli_fetch_array($result))
			{
				if($row["seller_id"] == $_SESSION['account'] && $row['ticket_status'] == "sold")
				{
		            echo "<tr>";
					echo "<th bgcolor='#FFEFD5'>" . $row['ticket_name'] . "</th>";
					if($row['ticket_class_id']=='concert')
						echo "<th bgcolor='#FFEFD5'>演唱會</th>";
					if($row['ticket_class_id']=='exhibition')
					    echo "<th bgcolor='#FFEFD5'>展覽</th>";
					if($row['ticket_class_id']=='movie')
						echo "<th bgcolor='#FFEFD5'>電影</th>";
					if($row['ticket_class_id']=='music')
						echo "<th bgcolor='#FFEFD5'>音樂會</th>";
					if($row['ticket_class_id']=='sport')
						echo "<th bgcolor='#FFEFD5'>運動賽事</th>";
		    		echo "<th bgcolor='#FFEFD5'>" . $row['activity_time'] . "</th>";
		    		echo "<th bgcolor='#FFEFD5'>" . $row['ticket_post_time'] . "</th>";
					?>
				    <th><input type="checkbox" name="delete[]" value="<?=$row['ticket_id']?>"></td>
				    <?php
					echo "</tr>";
				}
			}

			?>
			</form>
			</TABLE>
			<br>
			<hr style="border: 0; height: 1px; background: #e95d3c; background-image: linear-gradient(to right, white, #e95d3c, white);">
			<br>
			<p style="font-weight: bold; font-size: large; color: #e95d3c;">你需要的票券</p>
			<TABLE id="ticket">
			<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<tr>
				    <th style="width:25em; background-color:#e95d3c; color:white">票券名稱</th>
				    <th style="width:6em; background-color:#e95d3c; color:white">類型</th>
					<th style="width:7em; background-color:#e95d3c; color:white">活動時間</th>
					<th style="width:11em; background-color:#e95d3c; color:white">上架時間</th>
					<th style="width:7.7em; background-color:#e95d3c; color:white">
					<button type="submit" name ="action2" formmethod="post" value="Delete" >刪除<br>已選取的票券</button></th>
				</tr>
			<?php
				if (@$_POST['action1'] == 'Delete') {
					$delete_array = @$_POST["delete"];
					for($i = 0; $i < count($delete_array) ; $i++){
						$sql = "DELETE FROM ticket WHERE ticket_id = '$delete_array[$i]'";
						$con->query($sql);
					}
					?>
		            	<script language="javascript"> alert('刪除成功');</script>
		    		    <script language="javascript">location.href="userdata.php";</script>
		            <?php 
				}
			?>
			<?php
			$result = $con->query("SELECT seller_id,ticket_class_id,ticket_name,activity_time,ticket_post_time,ticket_status FROM ticket ");
			while($row = mysqli_fetch_array($result))
			{
				if($row["seller_id"] == $_SESSION['account'] && $row["ticket_status"] == "need")
				{
		            echo "<tr>";
		    		echo "<th bgcolor='#FFEFD5'>" . $row['ticket_name'] . "</th>";
		    		if($row['ticket_class_id']=='concert')
						echo "<th bgcolor='#FFEFD5'>演唱會</th>";
					if($row['ticket_class_id']=='exhibition')
					    echo "<th bgcolor='#FFEFD5'>展覽</th>";
					if($row['ticket_class_id']=='movie')
						echo "<th bgcolor='#FFEFD5'>電影</th>";
					if($row['ticket_class_id']=='music')
						echo "<th bgcolor='#FFEFD5'>音樂會</th>";
					if($row['ticket_class_id']=='sport')
						echo "<th bgcolor='#FFEFD5'>運動賽事</th>";
		    		echo "<th bgcolor='#FFEFD5'>" . $row['activity_time'] . "</th>";
		    		echo "<th bgcolor='#FFEFD5'>" . $row['ticket_post_time'] . "</th>";
					?>
				    <th><input type="checkbox" name="delete[]" value="<?=$row['ticket_id']?>"></td>
				    <?php
					echo "</tr>";
				}
			}
			$con->close();
			?>
			</form>
			</TABLE>
			<!-- Main -->
			</center>
			<div id="main" class="container">
				
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