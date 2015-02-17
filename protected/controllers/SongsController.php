<?php

class SongsController extends Controller
{

	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$title = 'Canciones';
		$songs = Songs::model()->findAll();
		$this->render('index',array(
			'songs'=>$songs, 'title' => $title
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$Songs_Files = new Songs_Files;
		$error = 0;
		$data = '';
		$message = '';

		if(isset($_POST['Files']))
		{
			$file_id = $_POST['Files']['file_id'];
			$song_id = $_POST['Files']['song_id'];
			$file = $_POST['Files']['file'];

			if ($this->CreateTxt($file_id, $song_id, $file) )
			{
				$Songs_Files->file_id = $file_id;
				$Songs_Files->song_id = $song_id;
				$Songs_Files->created_by = 'sebastian.alvarez';

				try
				{
					if($Songs_Files->save())
					{
						$data = $Songs_Files->id;
						$message = "Transcripcion creada correctamente";
					}
					else
					{
						$error = 1;
						$message = "No se ha podido guardar en la base de datos";
					}
				}
				catch(Exception $e)
				{
					$error = 1;
					$message = "No se ha podido guardar, intentelo de nuevo";
					$data = $e;
					$this->handleErrors($e);
				}
			}
			else
			{
				$error = 1;
				$message = "No se ha podido crear el archivo";
			}
		}

		echo json_encode(array('error' => $error, 'message' => $message, 'data' => $data));
	}



	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreatePartitura($id)
	{
		$Songs_Files = new Songs_Files;
		$error = 0;
		$data = array();
		$message = '';

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
		    //obtenemos el archivo a subir
		    $file = $_FILES['archivo']['name'];
		 
		    //comprobamos si existe un directorio para subir el archivo
		    //si no es así, lo creamos
		    if(!is_dir("files/Partituras/")) 
		        mkdir("files/Partituras/", 0777);
		     
		    //comprobamos si el archivo ha subido
		    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], "files/Partituras/".$file))
		    {
				$Songs_Files->file_id = 4;
				$Songs_Files->song_id = $id;
				$Songs_Files->url = "files/Partituras/".$file;
				$Songs_Files->description = $file;
				$Songs_Files->created_by = 'sebastian.alvarez';

				try
				{
					if($Songs_Files->save())
					{
						$data = array('saved_id' => $Songs_Files->id, 'description' => $file, 'url' => $Songs_Files->url);
						$message = "Transcripcion creada correctamente";
					}
					else
					{
						$error = 1;
						$message = "No se ha podido guardar en la base de datos";
					}
				}
				catch(Exception $e)
				{
					$error = 1;
					$message = "No se ha podido guardar, intentelo de nuevo";
					$data = $e;
					$this->handleErrors($e);
				}	    
			}
			else
			{
		    	throw new Exception("Error Processing Request", 1);   
			}
		}

		echo json_encode(array('error' => $error, 'message' => $message, 'data' => $data));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$error = 0;
		$contenido = '';
		$mensaje = '';

		if(isset($_POST['Songs']))
		{
			$model->attributes=$_POST['Songs'];

			try
			{
				if($model->save())
				{
					$contenido = $model->id;
					$mensaje = "Cancion creada correctamente";
				}
				else
				{
					$error = 1;
					$mensaje = "No se ha podido actualizar";
				}
			}
			catch(Exception $e)
			{
				$error = 1;
				$mensaje = "No se ha podido guardar, intentelo de nuevo";
				$contenido = $e;
			}
		}

		return json_enconde(array('error' => $error, 'mensaje' => $mensaje, 'contenido' => $contenido));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$error = 0;
		$contenido = '';
		$mensaje = '';
		$model = new Songs;


		$model->status = 0;

		try
		{
			if($model->update())
			{
				$contenido = $model->id;
				$mensaje = "Cancion eliminada correctamente";
			}
			else
			{
				$error = 1;
				$mensaje = "No se ha podido eliminar, intentelo de nuevo";
			}
		}
		catch(Exception $e)
		{
			$error = 1;
			$mensaje = "No se ha podido eliminar, intentelo de nuevo";
			$contenido = $e;
		}

		return json_enconde(array('error' => $error, 'mensaje' => $mensaje, 'contenido' => $contenido));
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$Song = Songs::model()->findByPk($id);
		$Songs_Files = Songs_Files::model()->findAll('song_id = :song_id',array(':song_id'=>$id));

		$songs_files = array();
		foreach ($Songs_Files as $key => $value) {
			$songs_files[] = $value->file_id;
		}

		$title = $Song->name;
		$this->render('view',array(
			'Song'=>$Song, 'songs_files' => $songs_files, 'Songs_Files' => $Songs_Files, 'title' => $title
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Songs the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Songs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	public function handleErrors($e)
	{
		$Errors = new Errors;
		try
		{
			$Errors->description = $e;
			$Errors->save();
		}catch(Exception $e)
		{
			$miarchivo=fopen('errors.txt','w');//abrir archivo, nombre archivo, modo apertura
			fwrite($miarchivo, $e);
			fclose($miarchivo); //cerrar archivo
		}
	}


	public function CreateTxt($file_id, $song_id, $file)
	{
		if ($file_id == 1)
			$module = 'Lirycs';
		else
		if ($file_id == 2)
			$module = 'Tabs';
		else
		if ($file_id == 3)
			$module = 'Chords';
		else
		if ($file_id == 4)
			$module = 'Partituras';
		else
		if ($file_id == 5)
			$module = 'Media';
		else
			return false;

		try
		{
			//Abrir archivo, nombre archivo, modo apertura
			$txt = fopen('files/'.$module.'/'.$song_id.'_'.$file_id.'.txt','w');
			fwrite($txt, $file);
			fclose($txt);

			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
}
