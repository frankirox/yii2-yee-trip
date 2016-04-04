<?php

namespace yeesoft\trip\models;

use yeesoft\models\OwnerAccess;
use yeesoft\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%trip}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $city_from
 * @property string $city_to
 * @property string $city_between
 * @property integer $date
 * @property string $schedule
 * @property string $price
 * @property integer $vehicle
 * @property string $vehicle_model
 * @property integer $wifi
 * @property integer $fridge
 * @property integer $conditioner
 * @property string $contacts
 * @property integer $luggage
 * @property string $details
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Trip extends ActiveRecord implements OwnerAccess
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_ONE_TIME = 1;
    const TYPE_REGULAR = 2;

    const VEHICLE_CAR = 1;
    const VEHICLE_MINIBUS = 2;
    const VEHICLE_BUS = 3;

    const LUGGAGE_NON = 0;
    const LUGGAGE_SMALL = 1;
    const LUGGAGE_MEDIUM = 2;
    const LUGGAGE_LARGE = 3;
    const LUGGAGE_UNLIMITED = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%trip}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'vehicle', 'wifi', 'fridge', 'conditioner', 'luggage', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['type', 'city_from', 'city_to', 'luggage', 'price', 'contacts', 'vehicle_model'], 'required'],
            [['city_between', 'schedule', 'price', 'contacts', 'details'], 'string'],
            [['city_from', 'city_to'], 'string', 'max' => 64],
            [['vehicle_model'], 'string', 'max' => 127],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->isNewRecord && $this->className() == Trip::className()) {
            $this->type = 2;
            $this->vehicle = 2;
        }

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yee', 'ID'),
            'type' => Yii::t('yee/trip', 'Trip Type'),
            'city_from' => Yii::t('yee/trip', 'City From'),
            'city_to' => Yii::t('yee/trip', 'City To'),
            'city_between' => Yii::t('yee/trip', 'Cities Between'),
            'date' => Yii::t('yee/trip', 'Date'),
            'schedule' => Yii::t('yee/trip', 'Schedule'),
            'price' => Yii::t('yee/trip', 'Price'),
            'vehicle' => Yii::t('yee/trip', 'Vehicle'),
            'vehicle_model' => Yii::t('yee/trip', 'Vehicle Model'),
            'wifi' => Yii::t('yee/trip', 'Wi-Fi'),
            'fridge' => Yii::t('yee/trip', 'Fridge'),
            'conditioner' => Yii::t('yee/trip', 'Air Conditioner'),
            'contacts' => Yii::t('yee/trip', 'Contacts'),
            'luggage' => Yii::t('yee/trip', 'Allowed Luggage'),
            'details' => Yii::t('yee/trip', 'Details'),
            'status' => Yii::t('yee', 'Status'),
            'created_by' => Yii::t('yee', 'Author'),
            'updated_by' => Yii::t('yee', 'Updated By'),
            'created_at' => Yii::t('yee', 'Created'),
            'updated_at' => Yii::t('yee', 'Updated'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'city_from' => Yii::t('yee/trip', 'Example: Kyiv'),
            'city_to' => Yii::t('yee/trip', 'Example: Copenhagen'),
            'city_between' => Yii::t('yee/trip', 'Example: Lviv, Warsaw, Berlin'),
            'price' => Yii::t('yee/trip', 'Example: from 90$ to 140$'),
            'vehicle_model' => Yii::t('yee/trip', 'Example: Mercedes Sprinter'),
            'contacts' => Yii::t('yee/trip', 'Please, enter phone numbers to contact you'),
            'luggage' => Yii::t('yee/trip', 'Allowed Luggage'),
            'details' => Yii::t('yee/trip', 'More Details'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TripQuery(get_called_class());
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getCreatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedDatetime()
    {
        return "{$this->createdDate} {$this->createdTime}";
    }

    public function getUpdatedDatetime()
    {
        return "{$this->updatedDate} {$this->updatedTime}";
    }

    public function getStatusText()
    {
        return $this->getStatusList()[$this->status];
    }

    /**
     * getTypeList
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('yee', 'Active'),
            self::STATUS_INACTIVE => Yii::t('yee', 'Inactive'),
        ];
    }

    /**
     * getStatusOptionsList
     * @return array
     */
    public static function getStatusOptionsList()
    {
        return [
            [self::STATUS_ACTIVE, Yii::t('yee', 'Active'), 'primary'],
            [self::STATUS_INACTIVE, Yii::t('yee', 'Inactive'), 'default']
        ];
    }

    /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullTripAccess';
    }

    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }

    /**
     * getTypeList
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_ONE_TIME => Yii::t('yee/trip', 'One Time'),
            self::TYPE_REGULAR => Yii::t('yee/trip', 'Regular'),
        ];
    }

    public static function getTypeOptionsList()
    {
        return [
            [self::TYPE_ONE_TIME, Yii::t('yee/trip', 'One Time'), 'primary'],
            [self::TYPE_REGULAR, Yii::t('yee/trip', 'Regular'), 'primary']
        ];
    }

    /**
     * getVehicles
     * @return array
     */
    public static function getVehicles()
    {
        return [
            self::VEHICLE_CAR => Yii::t('yee/trip', 'Car'),
            self::VEHICLE_MINIBUS => Yii::t('yee/trip', 'Minibus'),
            self::VEHICLE_BUS => Yii::t('yee/trip', 'Bus'),
        ];
    }

    /**
     * getTypeList
     * @return array
     */
    public static function getLuggages()
    {
        return [
            self::LUGGAGE_NON => Yii::t('yee/trip', 'Not Allowed'),
            self::LUGGAGE_SMALL => Yii::t('yee/trip', 'Compact bag (about 5 kg.)'),
            self::LUGGAGE_MEDIUM => Yii::t('yee/trip', 'Travelling bag (about 15 kg.)'),
            self::LUGGAGE_LARGE => Yii::t('yee/trip', 'Large bag (about 30 kg.)'),
            self::LUGGAGE_UNLIMITED => Yii::t('yee/trip', 'Not limited'),
        ];
    }
}