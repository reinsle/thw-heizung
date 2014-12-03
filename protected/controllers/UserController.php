<?php

class UserController extends GxController
{

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

    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'User'),
        ));
    }

    public function actionCreate()
    {
        $model = new User;

        $this->performAjaxValidation($model, 'user-form');

        if (isset($_POST['User'])) {
            $model->setAttributes($_POST['User']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'User');

        $this->performAjaxValidation($model, 'user-form');

        if (isset($_POST['User'])) {
            $model->setAttributes($_POST['User']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'User')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('index'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex()
    {
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $model = new User('search');
        $model->unsetAttributes();

        if (isset($_GET['User']))
            $model->setAttributes($_GET['User']);

        $this->render('index', array(
            'model' => $model,
        ));
    }

}
