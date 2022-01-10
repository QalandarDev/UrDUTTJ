<?php

namespace app\models;

use app\models\TtjAriza;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TtjArizaSearch represents the model behind the search form of `app\models\TtjAriza`.
 */
class TtjArizaSearch extends TtjAriza
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', '_student', 'status', '_pdf', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['about', 'answer'], 'safe'],
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
        $query = TtjAriza::find();

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
            '_student' => $this->_student,
            'status' => $this->status,
            '_pdf' => $this->_pdf,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['ilike', 'about', $this->about])
            ->andFilterWhere(['ilike', 'answer', $this->answer]);

        return $dataProvider;
    }
    public function searchbyStatus($params,$status)
    {
        $query = TtjAriza::find()->andFilterWhere(['status'=>$status]);

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
            '_student' => $this->_student,
            'status' => $this->status,
            '_pdf' => $this->_pdf,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['ilike', 'about', $this->about])
            ->andFilterWhere(['ilike', 'answer', $this->answer]);

        return $dataProvider;
    }
}
