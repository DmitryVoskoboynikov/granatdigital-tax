<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;
use yii\db\ActiveQuery;

/**
 * @property integer $client_id
 * @property string $message
 * @property integer $owner_id
 * @property string $created_at
 * @property integer $type_id
 *
 * @property Client $client
 * @property User $owner
 * @property Company $company
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class ClientMessage extends DtoModel implements HasDto
{
    const TYPE_NEUTRAL = 1;
    const TYPE_NEGATIVE = 2;
    const TYPE_POSITIVE = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'owner_id'], 'required'],
            [['client_id', 'owner_id', 'type_id'], 'integer'],
            [['message'], 'string', 'max' => 500],
            [['created_at'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_id' => Yii::t('app', 'Client ID'),
            'message' => Yii::t('app', 'Message'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'type_id' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @inheritdoc
     * @return ClientMessageQuery
     */
    public static function find()
    {
        return new ClientMessageQuery(get_called_class());
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($this->type_id === self::TYPE_NEGATIVE) {
            $client = $this->getClient()->one();
            $client->in_blacklist = 1;
            $client->save(false);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(array(
                'id',
                'message',
                'owner',
                'type',
                'created_at',
            )
        );
    }

    /**
     * @return string
     */
    public function getType()
    {
        $statuses = $this->getTypes();

        return $statuses[$this->type_id];
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return  array(
            self::TYPE_NEUTRAL => Yii::t('app', 'client_message_type_neutral'),
            self::TYPE_NEGATIVE => Yii::t('app', 'client_message_type_negative'),
            self::TYPE_POSITIVE => Yii::t('app', 'client_message_type_positive'),
        );
    }
}
