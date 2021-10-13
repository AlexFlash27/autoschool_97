<?php

namespace frontend\models;

use common\models\Authassignment;
use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Instructors;

/**
 * InstructorsSearch represents the model behind the search form of `common\models\Instructors`.
 */
class InstructorsSearch extends Instructors
{
    public $roleName;
    public $userName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assignment_id'], 'integer'],
            [['roleName', 'userName'], 'safe'],
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
        $query = Instructors::find();

        // add conditions that should always apply here
        $query->joinWith(['assignment', 'user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['roleName'] = [
            'asc' => [[Authassignment::tableName().'.item_name' => SORT_ASC], [User::tableName().'.username' => SORT_ASC]],
            'desc' => [[Authassignment::tableName().'.item_name' => SORT_DESC], [User::tableName().'.username' => SORT_DESC]],
        ];

        //$this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'assignment_id' => $this->assignment_id,
        ]);

        $query->andFilterWhere(['like', Authassignment::tableName().'.item_name', $this->roleName])
            ->andFilterWhere(['like', User::tableName().'.username', $this->userName]);

        return $dataProvider;
    }
}
