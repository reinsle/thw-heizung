<?php

class HistoryController extends GxController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('History', array(
            'criteria' => array(
                'order' => 'tst DESC',
            ),
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

}