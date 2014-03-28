<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head>
    <meta charset="utf-8">
		<title>Webhoppers Analytics - Facebook Crawler</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="style.responsive.css" media="all">

    <script src="jquery.js"></script>
    <script src="script.js"></script>
    <script src="script.responsive.js"></script>
	<style>.wha-content .wha-postcontent-0 .layout-item-0 { border-right-style:solid;border-bottom-style:solid;border-right-width:0px;border-bottom-width:0px;border-right-color:#9DC4D7;border-bottom-color:#9DC4D7; padding-right: 10px;padding-left: 10px;  }
		.ie7 .post .layout-cell {border:none !important; padding:0 !important; }
		.ie6 .post .layout-cell {border:none !important; padding:0 !important; }
	</style>
</head>
<body>
<div id="wha-main">
	<header class="wha-header clearfix">
		<div class="wha-shapes">
			<h1 class="wha-headline" data-left="50%"><a href="#">Webhoppers Analytics</a></h1>
			<h2 class="wha-slogan" data-left="50.25%">Facebook Crawler</h2>
		</div>               
	</header>
	<nav class="wha-nav clearfix">
		<div class="wha-nav-inner">
			<ul class="wha-hmenu"><li>
			<?php
			echo '<a href="interbellum.co/facebook/index.php" class="active">Home</a></li>';
			?>
        </div>
    </nav>
	<div class="wha-sheet clearfix">
		<div class="wha-layout-wrapper clearfix">
			<div class="wha-content-layout">
				<div class="wha-content-layout-row">
					<div class="wha-layout-cell wha-content clearfix">
						<article class="wha-post wha-article">
							<div class="wha-postcontent wha-postcontent-0 clearfix">
								<div class="wha-content-layout">
									<div class="wha-content-layout-row">
										<div class="wha-layout-cell layout-item-0" style="width: 100%" >
											<h2 style="border-bottom: 1px solid #9DC4D7; padding-bottom: 5px">Welkom</h2>
												<br />
												<div style="width: 100%"><span style="font-weight: bold;">Vul hier uw eigen bedrijf in en ten minste een concurrent.</span><br></div>
														<!--een invulformulier zodat het systeem weet welke bedrijven je wilt zoeken -->
														<form action="crawler.php" method="get">
															Vul uw bedrijf in: <input type="text" name="keyword"><br>
															Vul uw concurerend bedrijf in: <input type="text" name="concurrent1"><br>
															Vul een ander concurerend bedrijf in: <input type="text" name="concurrent2"><br>
															<input type="submit" value="Zoeken">
														</form>
													<div style="width: 100%"></div><br />
													<p>Klik vervolgens op Zoeken en daarna op een van de menu items om verschillende weergave te zien.</p>
										</div>
									</div>
								</div>
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