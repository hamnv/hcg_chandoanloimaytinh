<?php include_once('header.php'); ?>

<script>
	$(document).ready(function() {
		var windowH = $(window).height();
		var wrapperH = $('#wrap').height();
		var margin = (windowH) * 0.05;
		var wrapH = (windowH) * 0.9;

		$('#wrap').css('min-height', (wrapH) + 'px');
		$('#main').css('min-height', (wrapH) + 'px');
		var mainH = $('#main').height();
		$('aside').css('min-height', (mainH) + 'px');

		$(window).resize(function() {
			var windowH = $(window).height();
			var wrapperH = $('#wrap').height();
			var margin = (windowH) * 0.05;
			var wrapH = (windowH) * 0.9;

			$('#wrap').css('min-height', (wrapH) + 'px');
			$('#main').css('min-height', (wrapH) + 'px');
			var mainH = $('#main').height();
			$('aside').css('min-height', (mainH) + 'px');
		})
		$('form .submit').click(function() {
			$(this).parent().submit();
		});
	})
</script>
</head>

<body>
	<section id="wrap">
		<section id="main">
			<div class="container">
				<div class="card" style="width:56%;cursor:default;">
					<p>Hệ chuyên gia chẩn đoán lỗi máy tính!</p>
				</div>
					<input type="hidden" name="source" value="index.php" />
					<div class="card green button submit" style="width:21%;margin-left:1%;">
						<a href="index.php"> <p>TRANG CHỦ &#8635;</p></a>
					</div>
					<input type="hidden" name="source" value="index.php" />
					<div class="card red button empty-db submit" style="width:21%;margin-left:1%;">
						<a href="rules.php"> <p>Luật <<</p></a>
					</div>
			</div>
			<div class="clear"></div>
			<div class="container">
				<form method="post" action="add_fact.php">
					<div class="card" style="width:78%;">
						<input type="text" class="form-group"  required="required" name="new_fact" placeholder="Thêm sự kiện" />
						<div class="container2">
							<ul class="ks-cboxtags">
						<li><input type="checkbox" name="final_fact" value="1"><label for="checkboxOne">Sự kiện cuối</label></li>
						<li><input type="radio" name="level" value="1"><label for="radio"></label> Level 1</label></li>
						<li><input type="radio" name="level" value="2"><label for="radio"></label> Level 2</label></li>
						<li><input type="radio" name="level" value="3"><label for="radio"></label> Level 3</label></li>
						</ul>
						</div>	
					</div>
					<div class="card green button submit" style="width:21%;margin-left:1%;">
						<p>Thêm sự kiện &#9166;</p>
					</div>
				</form>
			</div>

			<div class="container">
				<h2 style="color:#ffffff;margin-bottom:0px;">&#9655; Danh sách sự kiện</h2>
				<div class="card" style="width:100%;padding:0;">
					<table>
						<tbody>
							<?php

							$query = "SELECT fact_index, fact FROM sukien";
							$result = mysqli_query($con, $query);
							if (!$result)
								die("Khổng tìm thấy bảng");
							else {
								if ($result->num_rows > 0) {
									?>
									<tr>
										<td width="10%">ID</td>
										<td width="90%" class="no-border">Tên sự kiện</td>
									</tr>
							<?php
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr>
													<td style=\"text-align:center;\">" . $row['fact_index'] . "</td>
													<td class=\"no-border\">" . $row['fact'] . "</td>
												</tr>";
									}
								} else
									echo "<tr><td width=\"100%\">Không có sự kiện nào trong cơ sở dữ liệu</td></tr>";
							}

							?>
						</tbody>
					</table>
				</div>
			</div>
<?php include_once('footer.php'); ?>