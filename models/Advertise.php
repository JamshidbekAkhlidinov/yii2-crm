<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "advertise".
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $url
 * @property string|null $description
 * @property int|null $period
 * @property float|null $price
 * @property int|null $align
 * @property int|null $status
 * @property string|null $payed_at
 * @property int|null $payed_status
 * @property string|null $created_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Advertise extends \yii\db\ActiveRecord
{

    public const align_top = 10;
    public const align_sidebar = 20;

    public const align_list = [
        self::align_top => "Top",
        self::align_sidebar => "Sidebar",
    ];

    public const status_archive = 10;
    public const status_send = 20;
    public const status_active = 30;
    public const status_cancel = 40;
    public const status_done = 50;

    public const status_list = [
        self::status_archive => "Archive",
        self::status_send => "Send",
        self::status_active => "Active",
        self::status_cancel => "Cancel",
        self::status_done => "Done"
    ];

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s'),
                'updatedAtAttribute' => false
            ],
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'advertise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'url', 'description', 'period', 'price', 'align', 'payed_at', 'created_at', 'created_by'], 'default', 'value' => null],
            [['period', 'align', 'status', 'payed_status', 'created_by'], 'integer'],
            [['price'], 'number'],
            [['payed_at', 'created_at'], 'safe'],
            [['image', 'url', 'description'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],

            [['image', 'url', 'description', 'period', 'price', 'align'], 'required'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'url' => Yii::t('app', 'Url'),
            'description' => Yii::t('app', 'Description'),
            'period' => Yii::t('app', 'Period'),
            'price' => Yii::t('app', 'Price'),
            'align' => Yii::t('app', 'Align'),
            'status' => Yii::t('app', 'Status'),
            'payed_at' => Yii::t('app', 'Payed At'),
            'payed_status' => Yii::t('app', 'Payed Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\AdvertiseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AdvertiseQuery(get_called_class());
    }

}
