<?php

namespace app\controllers;

use app\models\Category;
use app\models\Item;
use Yii;
use app\actions\CreateItemAction;

class ItemController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Item';

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function actions() {
        $actions = parent::actions();
        $actions['create']['class'] = 'app\actions\CreateItemAction';
        return $actions;
    }

    public function actionItemByCategory($id) {
        $query = Item::find()->innerJoin('item_categories', '`item`.`id` = `item_categories`.`item_id`');
        $query->andFilterWhere(['`item_categories`.`category_id`' => $id]);
        return $query->all();
    }

}
