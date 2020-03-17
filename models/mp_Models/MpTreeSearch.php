<?php

namespace app\models\mp_Models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\mp_Models\MpTree;

/**
 * MpTreeSearch represents the model behind the search form of `app\models\mp_Models\MpTree`.
 */
class MpTreeSearch extends MpTree
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'level'], 'integer'],
            [['name', 'path'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MpTree::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
    
    public function searchChilds($params)
    {
        $query = MpTree::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

       // $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $params['id'] , 
            'path' => $params['path'],
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'path', $this->path]);
        
     //   print_r($query);

        return $dataProvider;
    }
}
