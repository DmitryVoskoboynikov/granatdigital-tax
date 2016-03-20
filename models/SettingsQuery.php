<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * @see Settings
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class SettingsQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return Settings|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $id
     * @return Settings|array|null
     */
    public function getSettings($id = 1)
    {
        return $this->where(['id' => $id])->one();
    }
}