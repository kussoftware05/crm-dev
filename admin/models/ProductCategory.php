<?php

namespace admin\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['parent_id'], 'integer'],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return array
     */
    public static function getAllCategoryForDropdown()
    {
        $cats = self::find()
        ->asArray()
        ->all();
        return ArrayHelper::map($cats,'id','name');
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getCategoryNameById($id)
    {
        $cat = self::findOne($id);
        if($cat)
            return $cat->name;
        else 
            return '';
    }
}
