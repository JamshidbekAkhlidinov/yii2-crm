<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Advertise]].
 *
 * @see \app\models\Advertise
 */
class AdvertiseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function user()
    {
        return $this->andWhere(['created_by' => user()->id]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Advertise[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Advertise|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
