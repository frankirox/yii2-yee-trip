<?php

namespace yeesoft\trip\models;

/**
 * This is the ActiveQuery class for [[Trip]].
 *
 * @see Post
 */
class TripQuery extends \yii\db\ActiveQuery
{

    public function active()
    {
        $this->andWhere(['status' => Trip::STATUS_ACTIVE]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return Post[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Post|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
