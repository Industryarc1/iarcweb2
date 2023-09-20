<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ZspNews]].
 *
 * @see ZspNews
 */
class ZspNewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ZspNews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ZspNews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
