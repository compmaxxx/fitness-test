<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tester;

/**
 * TesterSearch represents the model behind the search form about `app\models\Tester`.
 */
class TesterSearch extends Tester
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'course_id', 'tag', 'info_user_id'], 'integer'],
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
        $query = Tester::find();

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
            'id' => $this->id,
            'course_id' => $this->course_id,
            'tag' => $this->tag,
            'info_user_id' => $this->info_user_id,
        ]);

        return $dataProvider;
    }
}
