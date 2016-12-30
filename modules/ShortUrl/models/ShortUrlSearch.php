<?php
namespace app\modules\ShortUrl\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class ShortUrlSearch
 */
class ShortUrlSearch extends ShortUrl
{
    /**
     * Reset model Behaviors
     * @return array
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['code'], 'string'],
        ];
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ShortUrl::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }

}