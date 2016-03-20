<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * @see UploadedFile
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class UploadedFileQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return UploadedFile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UploadedFile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}