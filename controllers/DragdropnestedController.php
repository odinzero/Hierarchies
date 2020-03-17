<?php

namespace app\controllers;

use Yii;
use app\models\creocoderModel\Menu;
use app\models\creocoderModel\MenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// https://klisl.com/yii2-menu-nested-sets.html
// https://klisl.com/yii2-Nested-Sets-Drag-and-drop.html
class DragdropnestedController extends Controller {
    
    public $layout = 'main_dragdrop';

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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex() {
        //объект ActiveQuery содержащий данные для дерева. depth = 0 - корень.
        $query = Menu::find()->where(['depth' => '0']);

        return $this->render('index', [
                    'query' => $query,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }
    
    
    public function actionTreemenu() {
        return $this->render('view_tree');
    }

    // http://localhost:8888/index.php?r=dragdropnested/treemenunode&id=9&lft=1&rgt=8&click=false
    public function actionTreemenunode($id, $lft, $rgt, $click) {
        
        $tree = Yii::$app->MenuArray::defineMenuOptionData($lft, $rgt,  $click);
        
        return $this->render('view_tree_nodes', ['tree' => $tree ] );
    }
    
    
    public function actionTreemenu2() {
        
        //var_dump($_POST);
        
        $post_string = $_POST['id'];
        
        var_dump($post_string);
        
        $clicks = array();
        foreach ($post_string as $key => $value) {
          // echo $key . "   " . $value ; 
           $new_value = explode("_", $value);
           $clicks += [ "$key" => $new_value[1] ];
        }
        
   //     print_r($clicks);
        
        //return $this->render('view_tree');
        
        $tree = Yii::$app->MenuArray::check($clicks);
        
      //  print_r($tree);
        
       return $this->render('view_tree_nodes', ['tree' => $tree ] );
        
    }
    
    public function actionTreemenu_jquery() {
        return $this->render('view_tree_jquery' );
    }
    
    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        /** @var  $model Menu|NestedSetsBehavior */
        $model = new Menu ();

        //Поиск корневого элемента
        $root = $model->find()->where(['depth' => '0'])->one();

        if ($model->load(Yii::$app->request->post())) {
            //Если нет корневого элемента (пустая таблица)
            if (!$root) {
                /** @var  $rootModel Menu|NestedSetsBehavior */
                $rootModel = new Menu(['name' => 'root', 'url' => '/']);
                $rootModel->makeRoot(); //делаем корневой
                $model->appendTo($rootModel);
            } else {
                $model->appendTo($root); //вставляем в конец корневого элемента
            }

            if ($model->save()) {
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'root' => $root
        ]);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actions() {
        return [
            'nodeMove' => [
                'class' => 'klisl\nestable\NodeMoveAction',
                'modelName' => Menu::className(),
            ],
        ];
    }

}
