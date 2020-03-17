<?php

namespace app\controllers;

use Yii;
use app\models\NestedCategory;
use app\models\NestedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Nested2Controller implements the CRUD actions for NestedCategory model.
 */
class Nested2Controller extends Controller {
    
    public $layout = 'main';

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET', 'POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all NestedCategory models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new NestedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NestedCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new NestedCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatechild($id) {
        $model = new NestedCategory();

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->category_id]);
//        }

        if ($model->load(Yii::$app->request->post())) {
            $this->createChildCategory($id, $model);
            return $this->redirect(['nested/menu']);
        }

        return $this->render('create', [
                    'model' => $model,
                    'id' => $id,
        ]);
    }

    public function actionCreatenonchild($id) {
        $model = new NestedCategory();

        if ($model->load(Yii::$app->request->post())) {
            $this->createCategory($id, $model);
            return $this->redirect(['nested/menu']);
        }

        return $this->render('create', [
                    'model' => $model,
                    'id' => $id,
        ]);
    }

    public function createCategory($id, $model) {
        $connection = Yii::$app->MyDbConnection->connection();
        $connection->open();

        $command0 = $connection
                ->createCommand("
             SELECT @myRight := rgt FROM nested_category WHERE category_id = $id;
                        
             UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > @myRight;
             UPDATE nested_category SET lft = lft + 2 WHERE lft > @myRight;

             INSERT INTO nested_category(name, lft, rgt) VALUES('$model->name', @myRight + 1, @myRight + 2);");

        $data = $command0->queryAll();
    }

    public function createChildCategory($id, $model) {
        $connection = Yii::$app->MyDbConnection->connection();
        $connection->open();

        $command0 = $connection
                ->createCommand("
             SELECT @myLeft := lft FROM nested_category WHERE category_id = $id;
                        
            UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > @myLeft;
            UPDATE nested_category SET lft = lft + 2 WHERE lft > @myLeft;

            INSERT INTO nested_category(name, lft, rgt) VALUES('$model->name', @myLeft + 1, @myLeft + 2);");

        $data = $command0->queryAll();
    }

    /**
     * Updates an existing NestedCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->category_id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NestedCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();
        $this->deleteCategoryandchilds($id);

        return $this->redirect(['nested/menu']);
    }

    public function deleteCategoryandchilds($id) {
        $connection = Yii::$app->MyDbConnection->connection();
        $connection->open();

        $command0 = $connection
                ->createCommand("
             SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
             FROM nested_category WHERE category_id = $id;

             DELETE FROM nested_category WHERE lft BETWEEN @myLeft AND @myRight;

             UPDATE nested_category SET rgt = rgt - @myWidth WHERE rgt > @myRight;
             UPDATE nested_category SET lft = lft - @myWidth WHERE lft > @myRight;
             ");

        $data = $command0->queryAll();
    }

    /**
     * Finds the NestedCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NestedCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = NestedCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
