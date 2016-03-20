<?php

namespace app\models;

use app\core\DtoModel;
use app\core\HasDto;
use Yii;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;

/**
 * @property integer $id
 * @property integer $group_id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property integer $company_id
 * @property string $first_name
 * @property string $second_name
 * @property string $last_name
 * @property string $salt
 * @property string $phone
 * @property string $birthday
 * @property int $status_id
 *
 * @property Car[] $cars
 * @property ClientMessage[] $clientMessages
 * @property Company $company
 * @property Order[] $orders
 * @property OrderHistory[] $orderHistories
 * @property OrderMessage[] $orderMessages
 * @property UploadedFile[] $uploadedFiles
 *
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru>
 */
class User extends DtoModel implements IdentityInterface, HasDto
{
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCK = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'company_id', 'status_id'], 'integer'],
            [['birthday'], 'safe'],
            [['login', 'email'], 'string', 'max' => 60],
            [['password'], 'string', 'max' => 32],
            [['first_name', 'second_name', 'last_name'], 'string', 'max' => 45],
            [['salt'], 'string', 'max' => 10],
            [['phone'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'login' => Yii::t('app', 'Login'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'company_id' => Yii::t('app', 'Company ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'second_name' => Yii::t('app', 'Second Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'salt' => Yii::t('app', 'Salt'),
            'phone' => Yii::t('app', 'Phone'),
            'birthday' => Yii::t('app', 'Birthday'),
            'status_id' => Yii::t('app', 'status'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::className(), ['owner_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getClientMessages()
    {
        return $this->hasMany(ClientMessage::className(), ['owner_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['owner_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrderHistories()
    {
        return $this->hasMany(OrderHistory::className(), ['owner_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrderMessages()
    {
        return $this->hasMany(OrderMessage::className(), ['owner_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUploadedFiles()
    {
        return $this->hasMany(UploadedFile::className(), ['owner_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserQuery
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * Return related company title if exist.
     *
     * return string
     */
    public function getCompanyTitle()
    {
        $company = $this->getCompany()->one();

        if ($company !== null) {
            return $company->title;
        }

        return null;
    }

    /**
     * @param string $password
     * @return string
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function encodePassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * @return string
     */
    public function generateToken()
    {
        return sha1(substr(md5(microtime()), -7));
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function getFull_name()
    {
        return $this->first_name . ' ' .$this->last_name;
    }

    /**
     * @return array
     */
    public function getDto()
    {
        return $this->getDtoAttributes(
            array(
                'id',
                'full_name',
                'company',
                'phone',
                'status'
            )
        );
    }

    /**
     * @return array
     */
    public function getDriverDto()
    {
        return $this->getDtoAttributes(
            array(
                'id',
                'full_name',
                'company',
                'phone',
                'cars',
                'status'
            )
        );
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        $statuses = $this->getStatuses();

        return $statuses[$this->status_id];
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        return  array(
            self::STATUS_ACTIVE => Yii::t('app', 'user_status_active'),
            self::STATUS_BLOCK => Yii::t('app', 'user_status_block'),
        );
    }

    /**
     * @return User
     */
    public function block()
    {
        $this->status_id = self::STATUS_BLOCK;

        return $this;
    }

    /**
     * @return User
     */
    public function unBlock()
    {
        $this->status_id = self::STATUS_ACTIVE;

        return $this;
    }
}
