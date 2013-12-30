<?php

/**
 * This is the model class for table "tbl_event".
 *
 * The followings are the available columns in table 'tbl_event':
 * @property string $uid
 * @property integer $start
 * @property integer $ende
 * @property string $category
 * @property string $summary
 * @property string $description
 * @property string $location
 * @property integer $create_time
 * @property integer $update_time
 */
class Event extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uid, start, ende, create_time, update_time', 'required'),
            array('uid', 'unique'),
            array('uid, category, location', 'length', 'max' => 64),
            array('summary', 'length', 'max' => 255),
            array('description', 'safe'),
            array('uid, start, ende, category, summary, description, location', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
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
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('uid', $this->uid, true);
        $criteria->compare('start', $this->start);
        $criteria->compare('ende', $this->ende);
        $criteria->compare('category', $this->category, true);
        $criteria->compare('summary', $this->summary, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('location', $this->location, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        $criteria->order = 'start ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
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
        if ($_POST != null && $_POST['Event'] != null)
        {
            $attributes=$_POST['Event'];
            if (strpos($attributes['start'], ':') != false)
            {
                $this->start = strtotime($attributes['start']);
            }
            if (strpos($attributes['ende'], ':') != false)
            {
                $this->ende = strtotime($attributes['ende']);
            }
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Event the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
