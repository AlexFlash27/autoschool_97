<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ApplicationForm;

/**
 * ApplicationFormSearch represents the model behind the search form of `common\models\ApplicationForm`.
 */
class ApplicationFormSearch extends ApplicationForm
{
    public $human_date;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'password', 'password_hash', 'first_name', 'last_name', 'patronymic', 'phone_number', 'email', 'category', 'place_registration', 'place_residence', 'series_number', 'date_of_issue', 'issued_by', 'department_code', 'date_of_birth', 'birthplace', 'education', 'place_work', 'position', 'series_number_aut', 'category_aut', 'human_date'], 'safe'],
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
        $query = ApplicationForm::find();

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
            'date_of_issue' => $this->date_of_issue,
            'date_of_birth' => $this->date_of_birth,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'place_registration', $this->place_registration])
            ->andFilterWhere(['like', 'place_residence', $this->place_residence])
            ->andFilterWhere(['like', 'series_number', $this->series_number])
            ->andFilterWhere(['like', 'issued_by', $this->issued_by])
            ->andFilterWhere(['like', 'department_code', $this->department_code])
            ->andFilterWhere(['like', 'birthplace', $this->birthplace])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'place_work', $this->place_work])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'series_number_aut', $this->series_number_aut])
            ->andFilterWhere(['like', 'category_aut', $this->category_aut]);
            //->andFilterWhere(['like', 'date_of_issue', $this->human_date]);

        return $dataProvider;
    }
}
