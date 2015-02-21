<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Result;

/**
 * ResultSearch represents the model behind the search form about `app\models\Result`.
 */
class ResultSearch extends Result
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tester_id'], 'integer'],
            [['test_id', 'course_id'], 'string'],
            [['value'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Result::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('tester')->join('INNER JOIN','course','tester.course_id = course.id');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['course_id'] = [
            'asc' => ['course.name' => SORT_ASC],
            'desc' => ['course.name' => SORT_DESC]
        ];

        $dataProvider->sort->attributes['tester_id'] = [
            'asc' => ['tester.tag' => SORT_ASC],
            'desc' => ['tester.tag' => SORT_DESC]
        ];

        $query->andFilterWhere([
            'id' => $this->id,
            'value' => $this->value,
            'tester.tag' => $this->tester_id,
        ]);

        $query->andFilterWhere(['like', 'test.name', $this->test_id])
            ->andFilterWhere(['like', 'course.name', $this->course_id]);

        return $dataProvider;
    }
}
