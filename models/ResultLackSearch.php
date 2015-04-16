<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ResultLackSearch represents the model behind the search form about `app\models\ResultLack`.
 */
class ResultLackSearch extends ResultLack
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id'], 'string'],
            [['tester_id'], 'integer'],
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
//        $estimates = Course::findOne($this->course_id)->getEstimates()->all();
//        $tests = [];
//        foreach ($estimates as $estimate) {
//            $tests = array_merge($tests,$estimate->getTests()->all());
//        }

//        $tests_len = count($tests);

//        $people_incomplete = Tester::find()->where(['course_id' => $this->course_id])->join('LEFT JOIN','result','tester.id = result.tester_id')->groupBy('tester_id')->having('count(*) < '.$tests_len)->select('tester_id');
//
//        $list_incomplete = (new Query())->select(['test_id','tester.tag','test.unit'])->from(['test','tester'])->where('course_id');
        $query = ResultLack::find()/*->joinWith('tester')->where(['tester.course_id'=>$this->course_id])*/;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->joinWith('tester');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $dataProvider->sort->attributes['course_id'] = [
//            'asc' => ['course.name' => SORT_ASC],
//            'desc' => ['course.name' => SORT_DESC]
//        ];

        $dataProvider->sort->attributes['tester_id'] = [
            'asc' => ['tester.tag' => SORT_ASC],
            'desc' => ['tester.tag' => SORT_DESC]
        ];

        $query->andFilterWhere([
            'tester.tag' => $this->tester_id,
            'tester.course_id' => $this->course_id,
        ]);

        $query->andFilterWhere(['like', 'test.name', $this->test_id]);

        return $dataProvider;
    }
}
