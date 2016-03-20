<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * Company Search model.
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class CompanySearch extends Company
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
        $query = Company::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['balance' => $this->balance]);
        $query->andFilterWhere(['like', 'dispatcher_phone', $this->dispatcher_phone]);
        $query->andFilterWhere(['like', 'legal_address', $this->legal_address]);
        $query->andFilterWhere(['like', 'physical_address', $this->physical_address]);
        $query->andFilterWhere(['like', 'inn', $this->inn]);
        $query->andFilterWhere(['like', 'kpp', $this->kpp]);
        $query->andFilterWhere(['like', 'bank', $this->bank]);
        $query->andFilterWhere(['like', 'bik', $this->bik]);
        $query->andFilterWhere(['like', 'okpo', $this->okpo]);
        $query->andFilterWhere(['like', 'ogrn', $this->ogrn]);

        return $dataProvider;
    }
}
