<?php

namespace app\actions;

use app\models\Category;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

/**
 * CreateAction
 */
class CreateItemAction extends Action
{
    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = Model::SCENARIO_DEFAULT;
    /**
     * @var string the name of the view action. This property is needed to create the URL when the model is successfully created.
     */
    public $viewAction = 'view';


    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     * @throws ServerErrorHttpException|\yii\base\InvalidConfigException if there is any error when creating the model
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        /* @var $model ActiveRecord */
        $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', $model->getPrimaryKey(true));
            $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        $request = Yii::$app->request;
        $categoriesIds = $request->post('categories');
        $categories = Category::find()->where(['id' => $categoriesIds])->all();
        $insertData = [];
        foreach ($categories as $category) {
            $insertData[] = [$model->id, $category->id];
        }
        Yii::$app->db->createCommand()->batchInsert('item_categories', ['item_id', 'category_id'], $insertData)->execute();

        return $model;
    }
}
