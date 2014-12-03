<?php

class HistoryController extends GxController
{

    public $layout = '//layouts/column1';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'view', 'minicreate', 'create', 'update', 'admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $model = new History();
        $this->render('index', array(
            'model' => $model,
        ));
    }

}