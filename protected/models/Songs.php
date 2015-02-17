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
class Songs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'songs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('id, status', 'numerical', 'integerOnly'=>true),
			array('name, created_by, updated_by', 'length', 'max'=>45),
			array('description', 'length', 'max'=>100),
			array('updated_at, deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, description, status, created_by, updated_by, created_at, updated_at, deleted_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
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
