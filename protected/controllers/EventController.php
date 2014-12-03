<?php

class EventController extends GxController
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
                'actions' => array('index', 'view', 'minicreate', 'create', 'update', 'admin', 'delete', 'calendarEvents'),
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
            'model' => $this->loadModel($id, 'Event'),
        ));
    }

    public function actionCreate()
    {
        $model = new Event;
        $model->uid = 'man_' . strtotime('now');

        $this->performAjaxValidation($model, 'event-form');

        if (isset($_POST['Event'])) {
            $model->setAttributes($_POST['Event']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->uid));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'Event');

        $this->performAjaxValidation($model, 'event-form');

        if (isset($_POST['Event'])) {
            $model->setAttributes($_POST['Event']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->uid));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Event')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionAdmin()
    {
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $model = new Event('search');
        $model->unsetAttributes();

        if (isset($_GET['Event']))
            $model->setAttributes($_GET['Event']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Create the public calendar events
     */
    public function actionCalendarEvents()
    {
        $events = Event::model()->findAll();
        foreach ($events as $event) {
            $items[] = array(
                'title' => $event->summary,
                'start' => $event->start,
                'end' => $event->ende,
                'color' => 'blue',
                'url' => CController::createUrl('event/view', array('id' => $event->uid)),
                'tooltip' => date("d.m.Y/H:i", $event->start) .
                    ' bis ' .
                    date("d.m.Y/H:i", $event->ende) .
                    "\r\nKategorie: " .
                    $event->category .
                    "\r\nTitel: " .
                    $event->summary .
                    "\r\nBeschreibung: " .
                    $event->description .
                    "\r\nOrt: " .
                    $event->location,
            );
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

}