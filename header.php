<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
    <title><?php wp_title(' — ',true,'right'); bloginfo('name'); ?></title>

    <!-- Bootstrap -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="wrap"> <!-- for footer-->
  <header>
	  <div id="header" class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="logo"><a href="/"></a></div>
			</div>
			<div class="col-sm-9">
				<nav>
					<?php wp_nav_menu( array(
						'menu'=>'Super_menu',
						'menu_class' => 'menu htable_menu main_menu',
						)); ?>
					<!--li class="item"><a href="/">Садовий центр</a></li>
					<li class="item"><a href="/landshaftna-studiya/">Ландшафтна студiя</a></li>
					<li class="item"><a href="/gazon/">Газон</a></li>
					<li class="item"><a href="/portfolio/">Портфолiо</a></li>
					<li class="item"><a href="/kontakti/">Контакти</a></li-->
				</nav>
			</div>
		</div>
	  </div>
		<hr />
  </header>