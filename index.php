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
		.table{
			position: relative;
			top:8em;
		}
		th{
			padding:2px;
			border:2px solid #A0522D; 
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
							<li class="active"><a href="index.php">首頁</a></li>
							<li><a href="need.php">我有需求</a></li>
							<li><a href="sold.php">我要售出</a></li>
							<?php 
							if(@!$_SESSION['login']){ ?>
							<li><a href="login.php">會員登入</a></li>
							<?php 
							}
							else{ ?>
								<li><a href="userdata.php">嗨，<?php echo $_SESSION['last_name'] ?></a></li>
							<?php 
							} ?>
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
			<p style="color: orange;font-weight: bold;position: absolute;left: 6.1em; top:5em;">查詢票券(關鍵字、類別、日期可擇一填寫)</p>
			<div id="search-ticket" class="container">
				<div style="width:22em; height:3.5em; background-color:#fef7eb; border-radius:5px; padding:10px; position:absolute; left: 0em;top: 1em;">
				    <strong style="float:left;">關鍵字</strong>
					<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
					<input name="keyword" type="text"  style="width:16em; float:right;">
					</form>
				</div>
				<div style="width:9.8em; height:3.5em; background-color:#fef7eb; border-radius:5px; padding:10px; position:absolute; left: 23em; top: 1em;">
					<strong>類別</strong>
					<select name="category">
				          <option>---</option>
						　<option value="concert">concert</option>
						　<option value="movie">movie</option>
						　<option value="sport">sport</option>
						　<option value="exhibition">exhibition</option>
						　<option value="music">music</option>
					</select>
				</div>
				<div style="width:9.8em; height:3.5em; background-color:#fef7eb; border-radius:5px; padding:10px; position:absolute; left: 34em; top: 1em;">
					<strong>時間</strong>
					<select name="Year">
				        	<option>---</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							<option value="2025">2025</option>
							<option value="2026">2026</option>
							<option value="2027">2027</option>
							<option value="2028">2028</option>
							<option value="2029">2029</option>
							<option value="2030">2030</option>
					</select>
				</div>
			<button type="submit" name="search"  style="width:3.3em; height:3.3em; background-color:#e95d3c;
			 border-radius:25px; margin:10px; position:absolute; left: 50em; top:8px;
			 font-family: 微軟正黑體;font-weight: bold;color: white;border: unset;">查詢</button>
			</div>
			<!-- /Extra -->
			
			<div style="position:relative; text-align:center;width:800px;margin:0px auto; top:6em; height:500px; margin-bottom:200px; overflow:auto; font-family:'微軟正黑體';">
			
			<?php
				$ticket_name = @$_POST['keyword'];
			
				$con = new mysqli("localhost", "root", "1061746", "票券系統");

				if ($con->connect_error) {
					die("連接失敗: " . $conn->connect_error);
				}	
					
				$result = $con->query("SELECT ticket_class_name,ticket.ticket_class_id,ticket_name,activity_time,ticket_post_time, ticket_status
					FROM ticket, ticket_class
					WHERE ticket_name like '%$ticket_name%' AND ticket.ticket_class_id = ticket_class.ticket_class_id ");	
					?><table style='color:#444444;' position:relative; top:50em; >
					<tr>
					<th style="width:70px;  background-color:#e95d3c; color:white;">票券類別</th>
					<th style="width:50px;  background-color:#e95d3c; color:white;">票券名稱</th>
					<th style="width:100px;  background-color:#e95d3c; color:white;">活動時間</th>
					<th style="width:100px;  background-color:#e95d3c; color:white;">上架時間</th>
					<th style="width:70px;  background-color:#e95d3c; color:white;">狀態</th>
					
					<?php
					while($row = mysqli_fetch_array($result))
					{

						  echo "<tr>";
						  if($row['ticket_status']=='sold')
						  {echo "<th style=\"vertical-align:middle;\" bgcolor='white'>" . $row['ticket_class_name'] . "</td>";
						  echo "<th style=\"vertical-align:middle;text-align:left;\" bgcolor='white'>" . $row['ticket_name'] . "</td>";
						  echo "<th style=\"vertical-align:middle;\" bgcolor='white'>" . $row['activity_time'] . "</td>";
						  echo "<th style=\"vertical-align:middle;\" bgcolor='white'>" . $row['ticket_post_time'] . "</td>";
						  echo "<th style=\"vertical-align:middle;\" bgcolor='white'>待售</td>";}
						  if($row['ticket_status']=='need')
						  {echo "<th style=\"vertical-align:middle;\" bgcolor='#FFEFD5'>" . $row['ticket_class_name'] . "</td>";
						  echo "<th style=\"vertical-align:middle;text-align:left;\" bgcolor='#FFEFD5'>" . $row['ticket_name'] . "</td>";
						  echo "<th style=\"vertical-align:middle;\" bgcolor='#FFEFD5'>" . $row['activity_time'] . "</td>";
						  echo "<th style=\"vertical-align:middle;\" bgcolor='#FFEFD5'>" . $row['ticket_post_time'] . "</td>";
						  echo "<th style=\"vertical-align:middle;\" bgcolor='#FFEFD5'>徵求</td>";}

					}	
				if(isset($_POST['search']))
				{
				
					// $ticket_class_name = $_POST['category'];
					 $ticket_name = $_POST['keyword'];
					// $activity_time = $_POST['Year'];
					$result = $con->query("SELECT ticket_class_id,ticket_name,activity_time,ticket_post_time
					FROM ticket 
					WHERE ticket_name like '%$ticket_name%' ");	
				while($row = mysqli_fetch_array($result))
				{

					if($_POST['keyword'] == $row["ticket_class_id"])
					{
					  echo "<tr>";
					  echo "<th style=\"vertical-align:middle;\" bgcolor='#FFEFD5'>" . $row['ticket_class_id'] . "</td>";
					  echo "<th style=\"vertical-align:middle;text-align:left;\" bgcolor='#FFEFD5'>" . $row['ticket_name'] . "</td>";
					  echo "<th style=\"vertical-align:middle;\" bgcolor='#FFEFD5'>" . $row['activity_time'] . "</td>";
					  echo "<th style=\"vertical-align:middle;\" bgcolor='#FFEFD5'>" . $row['ticket_post_time'] . "</td>";
					}
						
				}

				}

				$con->close();
			?>
	</div>		
			<!-- Main -->
			
			<!-- Main -->

		</div>

	<!-- Copyright -->
		<div id="copyright" class="container">
			Design by 陳宛君 許博軒 曾鈺惠 邱子玲 許家誠
			<br>
			2019.12
		</div>


	</body>
</html>