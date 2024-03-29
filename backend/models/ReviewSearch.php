<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Review;

/**
 * ReviewSearch represents the model behind the search form of `backend\models\Review`.
 */
class ReviewSearch extends Review
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'coordinator_id', 'event_id', 'student_id', 'registration_index', 'no_of_hours'], 'integer'],
            [['work_statement'], 'safe'],
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
        $query = Review::find();

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
            'coordinator_id' => $this->coordinator_id,
            'event_id' => $this->event_id,
            'student_id' => $this->student_id,
            'registration_index' => $this->registration_index,
            'no_of_hours' => $this->no_of_hours,
        ]);

        $query->andFilterWhere(['like', 'work_statement', $this->work_statement]);

        return $dataProvider;
    }
}
