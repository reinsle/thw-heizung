<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser
{
    public $password_repeat;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Benutzer', $n);
    }

    public function rules()
    {
        return array(
            array('email, password, password_repeat', 'required'),
            array('create_time, update_time, last_login_time', 'numerical', 'integerOnly' => true),
            array('email, password', 'length', 'max' => 128),
            array('email', 'email'),
            array('email', 'unique'),
            array('password', 'compare'),
            array('last_login_time', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, email, password, password_repeat', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Passwort'),
            'password_repeat' => 'Passwort (wdh.)',
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'last_login_time' => Yii::t('app', 'Letzer Login'),
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
        if (!$this->hasErrors()) {
            $this->password = $this->hashPassword($this->password);
        }
    }

    /**
     * Checks if the given password matches the tored one
     *
     * @param $password the password to check
     * @return bool if password are equal
     */
    public function validatePassword($password)
    {
        return $this->hashPassword($password) === $this->password;
    }

    /**
     * Generates the password hash to store in database
     *
     * @param $password the unencrypted password
     * @return string the encrypted password
     */
    public function hashPassword($password)
    {
        return sha1($password);
    }

}