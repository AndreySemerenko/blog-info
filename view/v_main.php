<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link href="media/styles.css" rel="stylesheet" type="text/css">
	<title><?=$title?></title>
</head>
<body>
	<div id="wrapper">
		<header>
			<div class="header line">
				<div class="wrapper">
					<div class="logo"></div>
					<div class="slogan">
						<div class="title">Рога и копыта</div>
						<div class="subtitle">Всем по рогам, всем по копытам.</div>
					</div>
					<div class="phone">8 800 800 80 80</div>
				</div>
			</div>		
			<div class="menu line">
				<div class="wrapper">
					<nav>
						<div class="show_menu">Меню</div>
						<ul>
							<li><a href="#">Главная</a></li>
							<li><a href="#">О компании</a></li>
							<li><a href="#">Продукты</a></li>
							<li><a href="#">Услуги</a></li>
							<li><a href="#">Контакты</a></li>
						</ul>					
					</nav>
				</div>
			</div>		
		</header>
		<section>
			<div class="content line">
				<div class="wrapper">
					<?=$content?>
				</div>
			</div>
		</section>
		<footer>
			<div class="footer line">
				<div class="wrapper">
					<span class="copy">&copy; ООО Рога и Копыта, Москва 2014, все права защищены!</span>
				</div>
			</div>
		</footer>
	</div>	
	<script src="media/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="media/js/scripts.js" type="text/javascript"></script>
</body>
</html>