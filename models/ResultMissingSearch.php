<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ResultMissingSearch represents the model behind the search form about `app\models\ResultMissing`.
 */
class ResultMissingSearch extends ResultMissing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tester_id','course_id','test_id','tag'], 'integer'],
            [['test_name'], 'string']
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
        $query = ResultMissing::find()/*->joinWith('tester')->where(['tester.course_id'=>$this->course_id])*/;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//        $query->join('INNER JOIN','tester','tester.id=tester_id')->join('INNER JOIN','test','test.id=test_id');

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
//
//        $dataProvider->sort->attributes['tester_id'] = [
//            'asc' => ['tester.tag' => SORT_ASC],
//            'desc' => ['tester.tag' => SORT_DESC]
//        ];

        $query->andFilterWhere([
            'tester.tag' => $this->tester_id,
            'course_id' => $this->course_id,
            'tag' => $this->tag,
        ]);

        $query->andFilterWhere(['like', 'test_name', $this->test_name]);


        return $dataProvider;
    }
}
