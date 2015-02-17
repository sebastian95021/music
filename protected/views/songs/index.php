<header class="codrops-header">
	<h1><?php echo CHtml::encode($title); ?> <span>Visualiza los cambios</span></h1>	
	<button class="btn-orange" id="showMenu">Menu</button>
</header>


<article style="padding:50px 100px;">
<button class="btn-orange" id="btnAddSong">Agregar cancion</button>
<button class="btn-orange" id="btnAccept">Aceptar</button>
<ul class="forums-list" id="ulListSongs">
<?php foreach ($songs as $key => $value) { ?>
	<li class="paper" id="forum-row-9">
		<div class="row-fluid">
			<div class="span6">
				<div class="forum-badge">
					<a class="forum-avatar" href="/es/forums/9-diseno"><?php echo $value->id; ?></a>
					<h1>
						<a class="forum-name" href="songs/view/<?php echo $value->id; ?>"><?php echo $value->name; ?></a>
					</h1>
					<p><?php echo $value->description; ?></p>
				</div>
			</div>
		</div>
	</li>
<?php } ?>
</ul>
</article>


<script type="text/javascript">
$( document ).ready(function() {
	$('#btnAccept').hide();
});

$( "#btnAddSong" ).click(function() {

	html = '<li class="paper" id="liNewSong">'+
				'<div class="row-fluid">'+
					'<div class="span6">'+
						'<div class="forum-badge">'+
							'<a class="forum-avatar" href="/es/forums/9-diseno"></a>'+
							'<h1>'+
								'<input id="txtNameSong" type="text" onkeypress="searchKeyPress(event, this);">'+
							'</h1>'+
							'<p></p>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</li>';

	$( this ).hide('slow');
	$('#btnAccept').show('slow');

	$("#ulListSongs").prepend(html);
});

$( "#btnAccept" ).click(function() {

	$( this ).hide('slow');
	$('#btnAddSong').show();

	name = $('#txtNameSong').val();
	saveSong(name);
});

function searchKeyPress(e, me)
{
    if (e.keyCode == 13)
        saveSong(me.value);
}

function saveSong(name)
{
	json = {"Songs":
				{
					"name":name
				}
			};

	$.post( "songs/create", json, function( data ) {
		console.log(data);
		if(data.error == 0)
		  	bulldNewRowSong(data.data, name)
		 else
		 	console.log(data.data);
	}, "json");
}


function bulldNewRowSong(id, name)
{
	html = '<li class="paper" id="forum-row-9">'+
				'<div class="row-fluid">'+
					'<div class="span6">'+
						'<div class="forum-badge">'+
							'<a class="forum-avatar" href="/es/forums/9-diseno">'+id+'</a>'+
							'<h1>'+
								'<a class="forum-name" href="/es/forums/9-diseno">'+name+'</a>'+
							'</h1>'+
							'<p>Sin versiones disponibles</p>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</li>';


	$("#liNewSong").remove();
	$("#ulListSongs").prepend(html);
	$('#btnAccept').hide();
	$('#btnAddSong').show('slow');
}
</script>
