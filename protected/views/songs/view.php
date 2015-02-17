<header class="codrops-header">
	<h1><?php echo CHtml::encode($title); ?> <span>Detalles</span></h1>	
	<button class="btn-orange" id="showMenu">Menu</button>
</header>


<article style="padding:50px 100px;">
<input type="hidden" id="txtSongId" value="<?php echo $Song->id; ?>">
<div class="container">
	<nav>
		<ul class="cd-tabs-navigation">
			<li><a data-content="new" class="selected tab-navigation" id="liryc">Letra y Acordes</a></li>
			<li><a data-content="new" class="tab-navigation" id="tab">Tablatura</a></li>
			<li><a data-content="new" class="tab-navigation" id="chords">Acordes</a></li>
			<li><a data-content="new" class="tab-navigation" id="partitura">Partituras</a></li>
			<li><a data-content="new" class="tab-navigation" id="audio">Audio y Video</a></li>
		</ul> <!-- cd-tabs-navigation -->
	</nav>
</div>
</article>

<article style="padding:50px 100px;">
	<div class="liryc tab-content">
		<textarea rows="30" id="txtLiryc" cols="80">
			<?php
				if (in_array(1, $songs_files))
				{
					$file_song = fopen('files/Lirycs/'.$Song->id.'_1.txt', "r");

					while(!feof($file_song)) {
					echo fgets($file_song);
					}
					fclose($file_song);
				}
			?>
		</textarea>
		<button class="btn-orange" onclick="Save(1)">Guardar</button>
	</div>


	<div class="tab tab-content">
		<textarea rows="30" id="txtTab" cols="80">
			<?php
				if (in_array(2, $songs_files))
				{
					$file_song = fopen('files/Tabs/'.$Song->id.'_2.txt', "r");

					while(!feof($file_song)) {
					echo fgets($file_song);
					}
					fclose($file_song);	
				}
			?>
		</textarea>
		<button class="btn-orange" id="saveTab" onclick="Save(2)">Guardar</button>
	</div>


	<div class="chords tab-content">
		<textarea rows="30" id="txtChords" cols="80">
			<?php
				if (in_array(3, $songs_files))
				{
					$file_song = fopen('files/Chords/'.$Song->id.'_3.txt', "r");

					while(!feof($file_song)) {
					echo fgets($file_song);
					}
					fclose($file_song);
				}
			?>
		</textarea>
		<button class="btn-orange" id="saveChords" onclick="Save(3)">Guardar</button>
	</div>


	<div class="partitura tab-content">
		<form enctype="multipart/form-data" class="form">
			<input name="archivo" type="file" id="imagen"/>
			<input type="button" class="btn-orange" id="saveChords" value="Guardar" onclick="SavePartitura(3)">
		</form>

		<table id="tblPartituras" class="table table-bordered table-hover">
			<thead>
			     <th>Nombre de archivo</th>
			     <th>Acciones</th>
			</thead>
			<tbody>
		<?php foreach ($Songs_Files as $key => $value) { ?>
			<?php if ($value->file_id == 4) { ?>
				<tr>
					<td><?php echo CHtml::encode($value->description); ?></td>
					<td><a style="color:black;" target="_blank" href="/music/<?php echo CHtml::encode($value->url); ?>">Ver</a></td>
				</tr>
			<?php } ?>
		<?php } ?>
 			</tbody>
		</table>
	</div>


	<div class="audio tab-content">
		<input type="file">
	</div>
</article>


<script type="text/javascript">
$( document ).ready(function() {
	$('.tab-content').hide();
	$('.liryc').show();
});

$( ".tab-navigation" ).click(function() {
	$('.tab-content').hide();
  	$('.'+this.id).show();
});


function Save(file_id)
{
	song_id = $('#txtSongId').val();
	if (file_id == 1)
		file = $('#txtLiryc').val();
	else
	if (file_id == 2)
		file = $('#txtTab').val();
	else
	if (file_id == 3)
		file = $('#txtChords').val();

	json = {"Files":
			{
				"file":file,
				"file_id":file_id,
				"song_id":song_id
			}
		};

	$.post( "/music/songs/create", json, function( data ) {
		console.log(data);
		if(data.error == 0)
		  	alert('Transcripcion guardada');
		 else
		 	console.log(data.data);
	}, "json");
}

$(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
    });



 //al enviar el formulario
function SavePartitura(file_id)
{
		song_id = $('#txtSongId').val();
        //información del formulario
        var formData = new FormData($(".form")[0]);

        //hacemos la petición ajax  
        $.ajax({
            url: '/music/songs/createpartitura/'+song_id,
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
				//   
            },
            //una vez finalizado correctamente
            success: function(data){
            	data = jQuery.parseJSON(data);

            	html = '<tr>'+
							'<td>'+data.data.description+'</td>'+
							'<td><a style="color:black;" target="_blank" href="/music/'+data.data.url+'">Ver</a></td>'
						'</tr>';
            	$('#tblPartituras tbody').append(html);
            },
            //si ha ocurrido un error
            error: function(){
            	alert('no se ha podido guardar el archivo, intentelo de nuevo');
            }
        });
}
</script>
