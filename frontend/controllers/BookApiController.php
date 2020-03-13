<?php
namespace frontend\controllers;

use common\models\Book;
use frontend\apiModels\ApiBook;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Api controller
 */
class BookApiController extends Controller
{

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index'  => ['GET'],
                'view'   => ['GET'],
                'update' => ['POST'],
                'delete' => ['POST'],
            ]
        ];

        return $behaviors;
    }

    /**
     * @return ActiveDataProvider
     */
    public function actionIndex()
    {
        $query = ApiBook::find();

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    }

    /**
     * @param int $id
     * @return ApiBook|null
     */
    public function actionView($id)
    {
        return ApiBook::findOne($id);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function actionUpdate($id)
    {
        $model = Book::findOne($id);
        if(empty($model)) {
            return null;
        }
        $attributes = Yii::$app->request->post();
        $model->setAttributes($attributes);

        return $model->save();
    }

    /**
     * @param int $id
     * @return false|int|null
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete($id)
    {
        $model = Book::findOne($id);
        if(empty($model)) {
            return null;
        }

        return $model->delete();
    }

}
