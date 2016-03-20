<?php

namespace app\models;

use app\core\DtoCollectionTrait;

/**
 * @see ClientMessage
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class ClientMessageQuery extends \yii\db\ActiveQuery
{
    use DtoCollectionTrait;

    /**
     * @inheritdoc
     * @return ClientMessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ClientMessage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $id
     * @return ClientMessageQuery
     */
    public function byClientId($id)
    {
        return $this->andWhere(array('client_id' => $id));
    }
}