<?php
/*
 *   Jamshidbek Akhlidinov
 *   10 - 03 2025 06:23:21
 *   https://github.com/JamshidbekAkhlidinov
*/

namespace app\modules\admin\modules\content\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Advertise;

/**
 * AdvertiseSearch represents the model behind the search form of `app\models\Advertise`.
 */
class AdvertiseSearch extends Advertise
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'period', 'align', 'status', 'payed_status'], 'integer'],
            [['image', 'url', 'description', 'payed_at', 'created_at'], 'safe'],
            [['price'], 'number'],
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
        $query = Advertise::find();

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
            'period' => $this->period,
            'price' => $this->price,
            'align' => $this->align,
            'status' => $this->status,
            'payed_at' => $this->payed_at,
            'payed_status' => $this->payed_status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
