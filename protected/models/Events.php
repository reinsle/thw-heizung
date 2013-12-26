<?php

/**
 * This is the model class for table "tbl_events".
 *
 * The followings are the available columns in table 'tbl_events':
 * @property string $uid
 * @property string $dtstamp
 * @property string $dtstart
 * @property string $dtend
 * @property string $category
 * @property string $summary
 * @property string $description
 * @property string $location
 */
class Events extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_events';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uid', 'required'),
            array('uid, category, location', 'length', 'max'=>64),
            array('summary', 'length', 'max'=>255),
            array('dtstamp, dtstart, dtend, description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('uid, dtstamp, dtstart, dtend, category, summary, description, location', 'safe', 'on'=>'search'),
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
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'uid' => 'Uid',
            'dtstamp' => 'Dtstamp',
            'dtstart' => 'Dtstart',
            'dtend' => 'Dtend',
            'category' => 'Category',
            'summary' => 'Summary',
            'description' => 'Description',
            'location' => 'Location',
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

        $criteria=new CDbCriteria;

        $criteria->compare('uid',$this->uid,true);
        $criteria->compare('dtstamp',$this->dtstamp,true);
        $criteria->compare('dtstart',$this->dtstart,true);
        $criteria->compare('dtend',$this->dtend,true);
        $criteria->compare('category',$this->category,true);
        $criteria->compare('summary',$this->summary,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('location',$this->location,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Events the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}