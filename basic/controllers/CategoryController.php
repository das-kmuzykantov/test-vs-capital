<?php

namespace app\controllers;

class CategoryController extends \yii\rest\ActiveController
{
    public $modelClass = 'app/models/Category';

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
}
