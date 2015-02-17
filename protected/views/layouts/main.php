<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />

	<!-- CSS para menu -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/menu/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/menu/css/demo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/menu/css/component.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/modal/css/component.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/menu/css/main.css"/>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/listview/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/listview/css/demo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/listview/css/component.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/table/table.css"/>
 	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/table/listview.css"/> 

 	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/tabbed-navigation/css/reset.css"/> 
 	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/tabbed-navigation/css/style.css"/> 


 		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="perspective" class="perspective effect-moveleft">
			<div class="container">
				<div class="wrapper"><!-- wrapper needed for scroll -->


		<?php echo $content; ?>

			<div id="footer">
				Copyright &copy; <?php echo date('Y'); ?> Sebastian Alvarez.<br/>
				Todos los derechos reservados.<br/>
				<?php echo Yii::powered(); ?>
			</div><!-- footer -->

				</div><!-- wrapper -->
			</div><!-- /container -->
			<nav class="outer-nav right vertical">
				<a href="./" class="icon-home">Home</a>
				<a href="songs" class="icon-news">Canciones</a>
				<a href="#" class="icon-image">Interpretes</a>
				<a href="#" class="icon-upload">Documentos</a>
				<a href="#" class="icon-star">Calendarios</a>
				<a href="#" class="icon-image">Multimedia</a>
			</nav>
		</div><!-- /perspective -->


		<!-- JS para menu -->

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/listview/js/snap.svg-min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/menu/js/modernizr.custom.25376.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/menu/js/classie.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/menu/js/menu.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/listview/js/hovers.js"></script>

	<script>
		var polyfilter_scriptpath = '/js/css-filters-polyfill/';
	</script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/modal/js/modernizr.custom.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/modal/js/css-filters-polyfill.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/modal/js/cssParser.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/modal/js/modalEffects.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/tabbed-navigation/js/main.js"></script>

	<script>
			(function() {
	
				function init() {
					var speed = 300,
						easing = mina.backout;

					[].slice.call ( document.querySelectorAll( '#grid > a' ) ).forEach( function( el ) {
						var s = Snap( el.querySelector( 'svg' ) ), path = s.select( 'path' ),
							pathConfig = {
								from : path.attr( 'd' ),
								to : el.getAttribute( 'data-path-hover' )
							};

						el.addEventListener( 'mouseenter', function() {
							path.animate( { 'path' : pathConfig.to }, speed, easing );
						} );

						el.addEventListener( 'mouseleave', function() {
							path.animate( { 'path' : pathConfig.from }, speed, easing );
						} );
					} );
				}

				init();

			})();
		</script>




</body>

</html>
