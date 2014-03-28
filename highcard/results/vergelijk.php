<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head>
    <meta charset="utf-8">
		<title>Bedrijven met elkaar vergeleken - Webhoppers Analytics - Facebook Crawler</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="../../style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="../../style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="../../style.responsive.css" media="all">

    <script src="../../jquery.js"></script>
    <script src="../../script.js"></script>
    <script src="../../script.responsive.js"></script>
			<?php
				//de bedrijf id's opvragen
				$bedrijf1=$_GET['B1'];
				$bedrijf2=$_GET['B2'];
				$bedrijf3=$_GET['B3'];
				
				//verbinding maken met de database
					require '../../sqlconnect.php';
					
					//alle gegevens uit de database halen
					$result = mysqli_query($link, 'SELECT MAX(pagelike) as pagelike FROM Page Where BedrijfID='.$bedrijf1) or die('Er ging iets mis11111' . mysqli_error($link));
					$row1 = mysqli_fetch_array($result);
					$likes1=$row1["pagelike"];
					$result1 = mysqli_query($link, 'SELECT MAX(pagelike) as pagelike2 FROM Page Where BedrijfID='.$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
					$row2 = mysqli_fetch_array($result1);
					$likes2=$row2["pagelike2"];
					$result31 = mysqli_query($link, 'SELECT MAX(pagelike) as pagelike3 FROM Page Where BedrijfID='.$bedrijf3) or die('Er ging iets mis2222' . mysqli_error($link));
					$row2 = mysqli_fetch_array($result31);
					$likes3=$row2["pagelike3"];
					$result2 = mysqli_query($link, 'SELECT MAX(Visitors) as visitors FROM Page Where BedrijfID='.$bedrijf1) or die('Er ging iets mis11111' . mysqli_error($link));
					$row3 = mysqli_fetch_array($result2);
					$waren1=$row3["visitors"];
					$result3 = mysqli_query($link, 'SELECT MAX(Visitors) as visitors2 FROM Page Where BedrijfID='.$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
					$row4 = mysqli_fetch_array($result3);
					$waren2=$row4["visitors2"];
					$result311 = mysqli_query($link, 'SELECT MAX(Visitors) as visitors3 FROM Page Where BedrijfID='.$bedrijf3) or die('Er ging iets mis2222' . mysqli_error($link));
					$row411 = mysqli_fetch_array($result311);
					$waren3=$row411["visitors3"];
					$result4 = mysqli_query($link, 'SELECT MAX(Talk_about) as talkabout FROM Page Where BedrijfID='.$bedrijf1) or die('Er ging iets mis11111' . mysqli_error($link));
					$row5 = mysqli_fetch_array($result4);
					$praten1 =$row5["talkabout"];
					$result5 = mysqli_query($link, "SELECT MAX(Talk_about) as talkabout2 FROM Page Where BedrijfID=".$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
					$row6 = mysqli_fetch_array($result5);
					$praten2 = $row6["talkabout2"];
					$result511 = mysqli_query($link, "SELECT MAX(Talk_about) as talkabout3 FROM Page Where BedrijfID=".$bedrijf3) or die('Er ging iets mis2222' . mysqli_error($link));
					$row611 = mysqli_fetch_array($result511);
					$praten3 = $row611["talkabout3"];
					
					//alle variabelen omzetten naar intergers zodat deze begrepen worden in de javascript
					$e1 = intval($likes1);
					$e2 = intval($likes2);
					$e31 = intval($likes3);
					$e3 = intval($waren1);
					$e4 = intval($waren2);
					$e41 = intval($waren3);
					$e5 = intval($praten1);
					$e6 = intval($praten2);
					$e7 = intval($praten3);
					
					?>
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
				<script type="text/javascript">
				$(function chard() {
				$('#container').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'Vergelijk Bedrijven'
					},
					xAxis: {
						categories: [
							'Uw bedrijf',
							'Concurrent 1',
							'Concurrent2'
						]
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Aantal'
						}
					},
					tooltip: {
						headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
						pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
						footerFormat: '</table>',
						shared: true,
						useHTML: true
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0
						}
					},
					credits: {
						enabled: false
					},
					series: [{
						name: 'Praten over',
						
						data: [<?php echo json_encode($e5); ?>,<?php echo json_encode($e6); ?>,<?php echo json_encode($e7); ?>]
			
					}, {
						name: 'Waren hier',
						data: [<?php echo json_encode($e3); ?>,<?php echo json_encode($e4); ?>,<?php echo json_encode($e41); ?>]
			
					}, {
						name: 'Likes', 
						data: [<?php echo json_encode($e1); ?>,<?php echo json_encode($e2); ?>,<?php echo json_encode($e31); ?>]
			
					}]
				});
			});
			

				</script>
				<script src="../js/highcharts.js"></script>
				<script src="../js/modules/exporting.js"></script>
</head>
<body>
<div id="wha-main">
	<header class="wha-header clearfix">
		<div class="wha-shapes">
			<h1 class="wha-headline" data-left="50%"><a href="#">Webhoppers Analytics</a></h1>
			<h2 class="wha-slogan" data-left="50%">Facebook Crawler</h2>
		</div>                   
	</header>
	<nav class="wha-nav clearfix">
		<div class="wha-nav-inner">
		<ul class="wha-hmenu">
			<?php
			echo '<li><a href="http://www.interbellum.co/facebook/index.php">Home</a></li>';
			echo '<li><a href="totale-activiteit.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'">Totale Activiteit</a></li>';
			echo '<li><a href="vergelijk.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'" class="active">Vergelijk</a></li>';
			echo '<li><a href="maandelijkse-activteit1.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'">Maandelijkse Activteit Bedrijf 1</a></li>';
			echo '<li><a href="maandelijkse-activteit2.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'">Maandelijkse Activteit Bedrijf 2</a></li>';
			echo '<li><a href="maandelijkse-activteit3.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'">Maandelijkse Activteit Bedrijf 3</a></li>';
			?>
		</ul>
        </div>
    </nav>
	<div class="wha-sheet clearfix">
		<div class="wha-layout-wrapper clearfix">
			<div class="wha-content-layout">
				<div class="wha-content-layout-row">
					<div class="wha-layout-cell wha-content clearfix">
						<article class="wha-post wha-article">
							<div class="wha-postmetadataheader">
								<h2 class="wha-postheader">Bedrijven met elkaar vergeleken</h2>                  
							</div>
							<div class="wha-postcontent wha-postcontent-0 clearfix">
							<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
								<p><span style="font-weight: bold;">Vergelijk de ingevulde berdijven op praten over, waren hier en likes.</span></p>
							</div>
						</article>
					</div>
				</div>
			</div>
		</div>
    </div>
		<footer class="wha-footer clearfix">
			<div class="wha-footer-inner">
				<p>Copyright © 2013 Webhoppers Analytics. Alle rechten voorbehouden.<br></p>
			</div>
		</footer>
</div>
</body>
</html>