<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * Company Search model.
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class ManagerSearch extends User
{
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'login', $this->login]);
        $query->andFilterWhere(['like', 'email', $this->email]);
        $query->andFilterWhere(['like', 'first_name', $this->first_name]);
        $query->andFilterWhere(['like', 'second_name', $this->second_name]);
        $query->andFilterWhere(['like', 'last_name', $this->last_name]);
        $query->andFilterWhere(['like', 'phone', $this->phone]);
        $query->andFilterWhere(['like', 'birthday', $this->birthday]);

        return $dataProvider;
    }
}
