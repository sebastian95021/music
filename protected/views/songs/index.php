<header class="codrops-header">
	<h1><?php echo CHtml::encode($title); ?> <span>Visualiza los cambios</span></h1>	
	<button class="btn-orange" id="showMenu">Menu</button>
</header>

<article style="padding:50px 100px;">
<ul class="forums-list">
<?php foreach ($songs as $key => $value) { ?>
	<li class="paper" id="forum-row-9">
		<div class="row-fluid">
			<div class="span6">
				<div class="forum-badge">
					<a class="forum-avatar" href="/es/forums/9-diseno"><?php echo $key+1; ?></a>
					<h1>
						<a class="forum-name" href="/es/forums/9-diseno"><?php echo $value->nombre; ?></a>
					</h1>
					<p><?php echo $value->descripcion; ?></p>
				</div>
			</div>
		</div>
	</li>
<?php } ?>
</ul>
</article>

<button class="md-trigger" onclick="popup();" data-modal="modal">3D Flip (horizontal)</button>



		<div class="md-modal md-effect-8" id="modal">
			<div class="md-content">
				<h3>Modal Dialog</h3>
				<div>
					<p>This is a modal window. You can do the following things with it:</p>
					<ul>
						<li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
						<li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
						<li><strong>Close:</strong> click on the button below to close the modal.</li>
					</ul>
					<button class="md-close btn-orange">Cerrar</button>
				</div>
			</div>
		</div>

		<div class="md-overlay"></div>



<script type="text/javascript">
/*function popup() {

	var popup = $('#modal');
	popup.css({ 
	    'left': ($(window).width() / 2 - $(popup).width() / 2) + 'px', 
	    'top': ($(window).height() / 2 - $(popup).height() / 2) + 'px'
	});


}*/

</script>
