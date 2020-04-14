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

		var new_rule_short = $("#new_rule_short").val();
		var new_rule = $("#new_rule").val();


		$('.key').click(function() {
			if ($(this).attr('ref') == "CLEAR") {
				new_rule = '';
				new_rule_short = '';
			} else {
				if (new_rule != '') {
					new_rule = new_rule + ' ' + $(this).text();
					new_rule_short = new_rule_short + '+' + $(this).attr('ref');
				} else {
					new_rule = new_rule + $(this).text();
					new_rule_short = new_rule_short + $(this).attr('ref');
				}
			}
			$("#new_rule").val(new_rule);
			$("#new_rule_short").val(new_rule_short);
		});
	})
</script>
</head>

<body>

	<section id="wrap">
		<section id="main">
			<div class="container">
				<div class="card" style="width:56%;cursor:default;">
					<p><b> Quản lý luật!</b></p>
				</div>
				<form method="post" action="index.php">
					<input type="hidden" name="source" value="rules.php" />
					<div class="card yellow button submit" style="width:21%;margin-left:1%;">
						<a href="index.php">
							<p>TRANG CHỦ &#8635;</p>
						</a>
					</div>
				</form>
				<div class="card green button submit" style="width:21%;margin-left:1%;">
					<a href="admin.php">
						<p>Sự Kiện >></p>
					</a>
				</div>


			</div>
			<div class="clear"></div>
			<div class="container">
				<form method="post" action="rules.exec.php">
					<div class="card" style="width:78%;">
						<input type="text" id="new_rule" value="" required="required" name="new_rule" placeholder="Thêm luật mới" />
						<input type="hidden" id="new_rule_short" value="" name="new_rule_short" />
					</div>
					<div class="card green button submit" style="width:21%;margin-left:1%;">
						<p>Thêm luật &#9166;</p>
					</div>
				</form>
			</div>
			<div class="container">
				<div class="key" ref="">NẾU</div>
				<div class="key" ref=".">VÀ</div>
				<div class="key" ref=":">THÌ</div>
				<div class="key" ref="CLEAR" style="background-color:rgb(173, 83, 79);">XOÁ BỎ &#8999;</div>
			</div>
			<div class="container" style="margin-bottom:15px;">
				<?php

				$query = "SELECT fact_index, fact FROM sukien";
				$result = mysqli_query($con, $query);
				if (!$result)
					die("Table not found");
				else {
					if ($result->num_rows > 0) {

						while ($row = mysqli_fetch_array($result)) {
							//echo "<div class=\"key\">".$row['fact_index']."</div>";
							echo "<div class=\"key\" ref=\"" . $row['fact_index'] . "\" style=\"text-transform:lowercase;\">" . $row['fact'] . "</div>";
						}
					} else
						echo "<div class=\"card\" style=\"width:100%\">Không có sự kiện trong CSDL</div>";
				}

				?>
			</div>
			<div class="clear"></div>
			<div class="container">
				<h2 style="color:#ffffff;margin-bottom:0px;">&#9655; Tập luật</h2>
				<div class="card" style="width:100%;padding:0;">
					<table>
						<tbody>
							<?php

							$query = "SELECT rule_index, rule FROM tapluat";
							$result = mysqli_query($con, $query);
							if (!$result)
								die("Table not found");
							else {
								if ($result->num_rows > 0) {
									?>
									<tr>
										<td width="10%">ID Luật</td>
										<td width="90%" class="no-border">Phát biểu luật</td>
									</tr>
							<?php
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr>
													<td style=\"text-align:center;\">" . $row['rule_index'] . "</td>
													<td class=\"no-border\">" . $row['rule'] . "</td>
												</tr>";
									}
								} else
									echo "<tr><td width=\"100%\">Không có luật nào trong CSDL</td></tr>";
							}

							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php include_once('footer.php'); ?>