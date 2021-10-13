<?php

namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Authassignment;

/**
 * AuthassignmentSearch represents the model behind the search form of `common\models\Authassignment`.
 */
class AuthassignmentSearch extends Authassignment
{
    public $userName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id', 'userName'], 'safe'],
            [['created_at'], 'integer'],
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
        $query = Authassignment::find();

        // add conditions that should always apply here
        $query->joinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /*$dataProvider->sort->attributes['user'] = [
            'asc' => ['auth_assignment_user.username' => SORT_ASC],
            'desc' => ['auth_assignment_user.username' => SORT_DESC],
        ];*/

        $dataProvider->sort->attributes['userName'] = [
            'asc' => [User::tableName().'.username' => SORT_ASC],
            'desc' => [User::tableName().'.username' => SORT_DESC],
        ];

        //$this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            //->andFilterWhere(['like', 'auth_assignment_user.username', $this->userName]);
            ->andFilterWhere(['like', User::tableName().'.username', $this->userName]);

        return $dataProvider;
    }
}
