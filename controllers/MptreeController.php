<?php

namespace app\controllers;

use Yii;
use app\models\mp_Models\MpTree;
use app\models\mp_Models\MpTreeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MptreeController implements the CRUD actions for MpTree model.
 */
class MptreeController extends Controller {

    public $layout = 'main_mp';

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MpTree models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MpTreeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('//materializedpath/backend/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MpTree model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('//materializedpath/backend/view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MpTree model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MpTree();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['//materializedpath/backend/view', 'id' => $model->id]);
        }

        return $this->render('//materializedpath/backend/create', [
                    'model' => $model,
        ]);
    }

    public function actionCreatechild($id) {
        // for definition fields
        $model = $this->findModel($id);
        // for saving
        $newModel = new MpTree();

        $childs = MpTree::find()
                ->FilterWhere(['like', 'path', $model->path . '._', false])
                ->orderBy('path')->asArray()
                ->all();

        //print_r($childs);

        $cnt = 0;
        $max_last_char = "";
        $new_max_last_char = 0;
        $new_path_child = "";
        // element of tree has childs (middle elements in tree)
        if (!empty($childs)) {
            foreach ($childs as $arr) {
                $cnt++;
                if (count($childs) === $cnt) {
                    // "1.1.2.3" -->  "3"
                    $max_last_char = substr($arr['path'], -1);
                    // "3" --> 3 + 1 --> "4"
                    $new_max_last_char = (int) $max_last_char + 1;
                    // "1.1.2." + "4" --> "1.1.2.4"
                    $new_path_child = substr($arr['path'], 0, -1) . $new_max_last_char;
                    //echo $new_path_child . "<br>";
                }
            }

            $newModel->path = $new_path_child;
        }
        // element of tree has NO childs (last elements)
        else {

            $newModel->path = $model->path . ".1";
        }

        $newModel->level = (int) $model->level + 1;
        
        if ($newModel->load(Yii::$app->request->post()) && $newModel->save() ) {
            return $this->redirect(['mptree/view', 'id' => $newModel->id]);
        }

        return $this->render('//materializedpath/backend/create', [
            'newModel' => $newModel,
            'path' => $newModel->path,
            'level' => $newModel->level,
            'child' => "createChild"
        ]);
    }

    /**
     * Updates an existing MpTree model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['mptree/view', 'id' => $model->id]);
        }

        return $this->render('//materializedpath/backend/update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MpTree model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['mptree/index']);
    }

    /**
     * Finds the MpTree model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MpTree the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MpTree::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
