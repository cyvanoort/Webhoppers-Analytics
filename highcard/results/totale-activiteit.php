<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head>
    <meta charset="utf-8">
		<title>Totale Facebook activiteit - Webhoppers Analytics - Facebook Crawler</title>
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
				
					//connectie maken met de database
					require '../../sqlconnect.php';
					
					//de gegevens uit de database halen
					$result = mysqli_query($link, 'SELECT MAX(pagelike) as pagelike FROM Page Where BedrijfID='.$bedrijf1) or die('Er ging iets mis11111' . mysqli_error($link));
					$row1 = mysqli_fetch_array($result);
					$likes1=$row1["pagelike"];
					$result1 = mysqli_query($link, 'SELECT MAX(pagelike) as pagelike2 FROM Page Where BedrijfID='.$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
					$row2 = mysqli_fetch_array($result1);
					$likes2=$row2["pagelike2"];
					$result11 = mysqli_query($link, 'SELECT MAX(pagelike) as pagelike2 FROM Page Where BedrijfID='.$bedrijf3) or die('Er ging iets mis2222' . mysqli_error($link));
					$row12 = mysqli_fetch_array($result1);
					$likes3=$row12["pagelike2"];
					$result2 = mysqli_query($link, 'SELECT MAX(Visitors) as visitors FROM Page Where BedrijfID='.$bedrijf1) or die('Er ging iets mis11111' . mysqli_error($link));
					$row3 = mysqli_fetch_array($result2);
					$waren1=$row3["visitors"];
					$result3 = mysqli_query($link, 'SELECT MAX(Visitors) as visitors2 FROM Page Where BedrijfID='.$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
					$row4 = mysqli_fetch_array($result3);
					$waren2=$row4["visitors2"];
					$result13 = mysqli_query($link, 'SELECT MAX(Visitors) as visitors2 FROM Page Where BedrijfID='.$bedrijf3) or die('Er ging iets mis2222' . mysqli_error($link));
					$row14 = mysqli_fetch_array($result13);
					$waren3=$row4["visitors2"];
					$result4 = mysqli_query($link, 'SELECT MAX(Talk_about) as talkabout FROM Page Where BedrijfID='.$bedrijf1) or die('Er ging iets mis11111' . mysqli_error($link));
					$row5 = mysqli_fetch_array($result4);
					$praten1 =$row5["talkabout"];
					$result5 = mysqli_query($link, "SELECT MAX(Talk_about) as talkabout2 FROM Page Where BedrijfID=".$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
					$row6 = mysqli_fetch_array($result5);
					$praten2 = $row6["talkabout2"];
					$result5 = mysqli_query($link, "SELECT MAX(Talk_about) as talkabout2 FROM Page Where BedrijfID=".$bedrijf3) or die('Er ging iets mis2222' . mysqli_error($link));
					$row16 = mysqli_fetch_array($result15);
					$praten3 = $row16["talkabout2"];
					$result6 = mysqli_query($link, "SELECT COUNT(BerichtID) as bericht FROM Bericht Where BedrijfID=".$bedrijf1) or die('Er ging iets mis2222' . mysqli_error($link));
					$row6 = mysqli_fetch_array($result6);
					$berichten1 = $row6["bericht"];
					$result7 = mysqli_query($link, "SELECT COUNT(BerichtID) as bericht FROM Bericht Where BedrijfID=".$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
					$row7 = mysqli_fetch_array($result7);
					$berichten2 = $row7["bericht"];
					$result17 = mysqli_query($link, "SELECT COUNT(BerichtID) as bericht FROM Bericht Where BedrijfID=".$bedrijf3) or die('Er ging iets mis2222' . mysqli_error($link));
					$row17 = mysqli_fetch_array($result17);
					$berichten2 = $row17["bericht"];
					$result8 = mysqli_query($link, "SELECT COUNT(BerichtID) as reactie FROM Reactie Where BedrijfID=".$bedrijf1) or die('Er ging iets mis2222' . mysqli_error($link));
					$row8 = mysqli_fetch_array($result8);
					$reactie1 = $row8["reactie"];
					$result9 = mysqli_query($link, "SELECT COUNT(BerichtID) as reactie FROM Reactie Where BedrijfID=".$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
					$row9 = mysqli_fetch_array($result9);
					$reactie2 = $row9["reactie"];
					$result19 = mysqli_query($link, "SELECT COUNT(BerichtID) as reactie FROM Reactie Where BedrijfID=".$bedrijf2) or die('Er ging iets mis2222' . mysqli_error($link));
					$row19 = mysqli_fetch_array($result19);
					$reactie2 = $row19["reactie"];
					
					//de gegevens omzetten naar integers zodat javascript ze zeker begrijp
					$e1 = intval($likes1);
					$e2 = intval($likes2);
					$e3 = intval($waren1);
					$e4 = intval($waren2);
					$e5 = intval($praten1);
					$e6 = intval($praten2);
					$e7 = intval($berichten1);
					$e8 = intval($berichten2);
					$e9 = intval($reactie1);
					$e10 = intval($reactie2);
					$e11 = intval($berichten3);
					$e12 = intval($waren3);
					$e13 = intval($likes3);
					$e14 = intval($reactie3);
					
					$bedrijf_stat1=$e1+$e3+$e5+$e7+$e9;
					$bedrijf_stat2=$e2+$e4+$e6+$e8+$e10;
					$bedrijf_stat3=$e11+$e12+$e13+$e14;
					?>
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
				<script type="text/javascript">
		$(function () {
				$('#container').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'Vergelijk Bedrijven'
					},
					/*subtitle: {
						text: ''
					},*/
					legend: {
						enabled: false
						},
					xAxis: {
						categories: [
							'Uw bedrijf',
							'concurrent 1',
							'concurrent 2'
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
						name: 'activiteit',
						data: [<?php echo json_encode($bedrijf_stat1); ?>,<?php echo json_encode($bedrijf_stat2); ?>,<?php echo json_encode($bedrijf_stat3); ?>]
			
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
			echo '<li><a href="totale-activiteit.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'" class="active">Totale Activiteit</a></li>';
			echo '<li><a href="vergelijk.php?B1='. $bedrijf1 .'&B2='.$bedrijf2.'&B3='.$bedrijf3.'">Vergelijk</a></li>';
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
								<h2 class="wha-postheader">Totale Facebook activiteit</h2>                  
							</div>
							<div class="wha-postcontent wha-postcontent-0 clearfix">
							<div id="container" style="width: 400px; height: 400px; margin: 0 auto"></div>							
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