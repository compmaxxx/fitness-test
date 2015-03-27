<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Translation;

/**
 * TranslationSearch represents the model behind the search form about `app\models\Translation`.
 */
class TranslationSearch extends Translation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['condition_eval', 'value', 'estimate_id', 'gender'], 'safe'],
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
        $query = Translation::find()->groupBy('estimate_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('estimate');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'condition_eval', $this->condition_eval])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'estimate.name', $this->estimate_id])
            ->andFilterWhere(['like', 'gender', $this->gender]);

        return $dataProvider;
    }
}
