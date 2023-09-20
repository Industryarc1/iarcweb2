<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ZspCatlogCategories]].
 *
 * @see ZspCatlogCategories
 */
class ZspCatlogCategoriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ZspCatlogCategories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ZspCatlogCategories|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	
	public static function getAllCatlogs(){
		$arrCategories = ZspCatlogCategories::find()//->select(['inc_id','name','p_id','status'])
					->where(['status'=>1])->asArray()->all();	
		return $arrCategories;
		}
}
