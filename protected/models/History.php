<?php

Yii::import('application.models._base.BaseHistory');

class History extends BaseHistory
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max' => 255),
            array('id, name, tst, create_time, update_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Attach behavors to the class
     *
     * @return array whith behavors
     */
    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
                'setUpdateOnCreate' => true,
            ),
        );
    }

}