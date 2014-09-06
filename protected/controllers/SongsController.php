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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
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
		$model = new Songs;
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
					$mensaje = "No se ha podido guardar";
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
		//
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

}
