<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AddCourse;

/**
 * AddCourseSearch represents the model behind the search form about `app\models\AddCourse`.
 */
class AddCourseSearch extends AddCourse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'estimate_id'], 'integer'],
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
        $query = AddCourse::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'course_id' => $this->course_id,
            'estimate_id' => $this->estimate_id,
        ]);

        return $dataProvider;
    }
}
