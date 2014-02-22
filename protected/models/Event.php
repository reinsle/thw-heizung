<?php

Yii::import('application.models._base.BaseEvent');

class Event extends BaseEvent
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uid, start, ende', 'required'),
            array('uid', 'unique'),
            array('uid, category, location', 'length', 'max' => 64),
            array('summary', 'length', 'max' => 255),
            array('description', 'safe'),
            array('uid, start, ende, category, summary, description, location', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'uid' => 'Uid',
            'start' => 'Start',
            'ende' => 'Ende',
            'category' => 'Category',
            'summary' => 'Summary',
            'description' => 'Description',
            'location' => 'Location',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
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

    /**
     * apply a hash to the password before store in database
     */
    protected function afterValidate()
    {
        parent::afterValidate();
        if ($_POST != null && $_POST['Event'] != null) {
            $attributes = $_POST['Event'];
            if (strpos($attributes['start'], ':') != false) {
                $this->start = strtotime($attributes['start']);
            }
            if (strpos($attributes['ende'], ':') != false) {
                $this->ende = strtotime($attributes['ende']);
            }
        }
    }

}