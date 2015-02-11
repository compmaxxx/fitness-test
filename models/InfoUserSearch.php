<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InfoUser;

/**
 * InfoUserSearch represents the model behind the search form about `app\models\InfoUser`.
 */
class InfoUserSearch extends InfoUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'age', 'nisit_ku'], 'integer'],
            [['firstname', 'lastname', 'sex', 'uniq_id'], 'safe'],
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
        $query = InfoUser::find();

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
            'age' => $this->age,
            'nisit_ku' => $this->nisit_ku,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'uniq_id', $this->uniq_id]);

        return $dataProvider;
    }
}
