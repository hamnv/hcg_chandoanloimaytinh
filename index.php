<?php include_once('header.php'); ?>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/tuychinh.css">
</head>

<body>
	<section id="wrap">
		<section id="main">
			<div class="container">
				<div class="card" style="width:56%;cursor:default;">
					<p><b>Hệ chuyên gia hỗ trợ chẩn đoán lỗi máy tính</b></p>
				</div>
				<div class="card green button submit" style="width:21%;margin-left:1%;">
					<a href="admin.php">
						<p>Sự Kiện >></p>
					</a>
				</div>
				<div class="card red button empty-db submit" style="width:21%;margin-left:1%;">
					<a href="rules.php">
						<p>Luật <<</p> </a> </div> </div> <div class="clear">
				</div>
				<div class="container">

				</div>
				<div class="container">
					<h2 style="color:#ffffff;margin-bottom:0px;">&#9655; Xin cung cấp một số thông tin?</h2>
					<form target="_blank" action="./process.php" method="get">


						<div class="card" style="width:50%;padding:0;">
							<!-- Chon su kien Level 1--->



							<?php
							$query = "SELECT fact_index, fact FROM sukien where fact_level=1";
							$result = mysqli_query($con, $query);
							if (!$result)
								die("Table not found");
							else {
								if ($result->num_rows > 0) {
									?>

							<?php
									while ($row = mysqli_fetch_array($result)) {


										echo "<label class=\"container\">" . $row['fact'] . "[" . $row['fact_index'] . "]" . "
										<input name=\"sukien[]\" type=\"radio\" value=\"" . $row['fact_index'] . "\">
										<span class=\"checkmark\"></span>
									  </label>";
									}
								} else
									echo "<tr><td width=\"100%\">Chưa có sự kiện nào</td></tr>";
							}

							?>


						</div>

						<div class="card" style="width:50%;padding:0;">
							<!-- Chon su kien --->



							<?php
							$query = "SELECT fact_index, fact FROM sukien where fact_level=2";
							$result = mysqli_query($con, $query);
							if (!$result)
								die("Table not found");
							else {
								if ($result->num_rows > 0) {
									?>

							<?php
									while ($row = mysqli_fetch_array($result)) {


										echo "<label class=\"container\">" . $row['fact'] . "[" . $row['fact_index'] . "]" . "
										<input name=\"sukien[]\" type=\"checkbox\" value=\"" . $row['fact_index'] . "\">
										<span class=\"checkmark\"></span>
									  </label>";
									}
								} else
									echo "<tr><td width=\"100%\">Chưa có sự kiện nào</td></tr>";
							}

							?>


						</div>

						<button type="reset" class="button">Đặt lại</button>
						<button type="submit" class="button2">Xác nhận</button>
					</form>
				</div>