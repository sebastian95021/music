<?php

/**
 * This is the model class for table "songs".
 *
 * The followings are the available columns in table 'songs':
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Errors extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'errors';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Songs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
