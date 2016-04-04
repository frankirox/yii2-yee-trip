<?php

namespace yeesoft\trip\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TripSearch represents the model behind the search form about `yeesoft\trip\models\Trip`.
 */
class TripSearch extends Trip
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'date', 'vehicle', 'wifi', 'fridge', 'conditioner', 'luggage', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['city_from', 'city_to', 'city_between', 'schedule', 'price', 'vehicle_model', 'contacts', 'details'], 'safe'],
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
        $query = Trip::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'date' => $this->date,
            'vehicle' => $this->vehicle,
            'wifi' => $this->wifi,
            'fridge' => $this->fridge,
            'conditioner' => $this->conditioner,
            'luggage' => $this->luggage,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'city_from', $this->city_from])
            ->andFilterWhere(['like', 'city_to', $this->city_to])
            ->andFilterWhere(['like', 'city_between', $this->city_between])
            ->andFilterWhere(['like', 'schedule', $this->schedule])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'vehicle_model', $this->vehicle_model])
            ->andFilterWhere(['like', 'contacts', $this->contacts])
            ->andFilterWhere(['like', 'details', $this->details]);

        return $dataProvider;
    }
}
