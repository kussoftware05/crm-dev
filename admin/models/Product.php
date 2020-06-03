<?php

namespace admin\models;

use Yii;
use yii\helpers\Url;
use admin\models\Image;
use yii\helpers\ArrayHelper;
use admin\models\interfaces\ImageInterface;
use common\models\helper\Util;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string|null $short_desp
 * @property string|null $long_desp
 * @property float $price
 * @property float|null $sell_price
 * @property int|null $image_id
 * @property int|null $quantity_in_stock
 * @property int|null $product_cat_id
 *
 * @property Image $image
 * @property ProductCategory $productCat
 */
class Product extends \yii\db\ActiveRecord implements ImageInterface
{

    /**
     * @var $TYPE
     */
    const TYPE = 'PRODUCT';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','price'], 'required'],
            [['short_desp', 'long_desp'], 'string'],
            [['price', 'sell_price'], 'number'],
            [['image_id', 'quantity_in_stock', 'product_cat_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['product_cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['product_cat_id' => 'id']],
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
            'short_desp' => 'Short Description',
            'long_desp' => 'Long Description',
            'price' => 'Price',
            'sell_price' => 'Sell Price',
            'image_id' => 'Image ID',
            'quantity_in_stock' => 'Quantity In Stock',
            'product_cat_id' => 'Category',
            
            'productPriceWithCurrency' => 'Price',
            'productSellPriceWithCurrency' => 'Sell Price',
            'catName' => 'Category'
        ];
    }

    /**
     * Gets query for [[Image]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * Gets query for [[ProductCat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCat()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'product_cat_id']);
    }

    /**
     * create a new product
     * 
     * @param array $data
     * @param array $file
     */
    public function createProduct($data, $file)
    {
        if(empty($data)) 
            return;
        if($this->load($data)) 
        {
            $this->insert();
            if($file['name'] != '') 
            {
                $image = new Image;
                $image_upload_id = $image->createOrUploadAnImage(null,self::TYPE, $file,self::uploadImagePath());
                if($image_upload_id !== false) 
                {
                    $current_model = self::findOne($this->id);
                    $current_model->image_id = (int)$image_upload_id;
                    return $current_model->save();
                }
            }
            return true;
        }
        return false;
    }

    /**
     * update an product
     * @param int $id 
     * @param array $data
     * @param array $file
     */
    public function updateProduct($id, $data, $file)
    {
        $product = self::findOne($id);
        if($product->load($data)) 
            $product->save();
        if(isset($file['name']) && !empty($file['name']))
        {
            $image = new Image;
            $image_id = $product->image_id;
            if(is_null($image_id) || empty($image_id))
            {
                $image_upload_id = $image->createOrUploadAnImage(null,self::TYPE, $file,self::uploadImagePath());
                $current_model = self::findOne($id);
                $current_model->image_id = (int)$image_upload_id;
                return $current_model->save();
            }
            else 
                $image->createOrUploadAnImage($product->image_id, self::TYPE, $file, self::uploadImagePath());
        }
        return true;
    }

    /**
     * delete a product
     * 
     * @param int $id
     * @return bool
     */
    public static function deleteProduct($id)
    {
        if(empty($id)) 
        return false;
        $product = self::findOne($id);
        if($product)
        {
            Image::deleteAnImage($product->image_id,self::uploadImagePath());
            $product->delete();
            return true;
        } 
        else 
            return false;
    }


    /**
     * get product image
     * 
     * @param int $id
     * @return string 
     */
    public static function getProductImage($id) 
    {
        $product = self::findOne($id);
        if(is_null($product)) 
            return '';
        return Image::getImageNameById($product->image_id);
    }

    /**
     * return image full path 
     * 
     * @param int $id
     * @return string
     */
    public static function getProductImageWithPath($id) 
    {
        $image_name = self::getproductImage($id);
        return Url::to(['/web/uploads/'. strtolower(self::TYPE) . '/' . $image_name]);
    }

    /**
     * product upload image path
     * 
     * @return string
     */
    public static function uploadImagePath()
    {
        return Yii::getAlias('@webroot') . '/web/uploads/' . strtolower(self::TYPE);
    }

    /**
     * get all product with pk and name
     * 
     * @return array
     */
    public static function getAllProductNameWithPrice()
    {
        $products = self::find()->asArray()->all();
        if(empty($products))
            return [];
        else 
            return ArrayHelper::map($products, 'id', 'name');
    }

    /**
     * get product price by product pk
     * 
     * @param int $id
     * @return string
     */
    public static function getPriceById($id)
    {
        $product = self::find()
            ->where(['id' => $id])
            ->one();
        
        if(!is_null($product->sell_price) && (int)$product->sell_price > 0 )
            return $product->sell_price;
        else
            return $product->price;
    }

    /**
     * format price with local currency
     * @return string
     */
    public function getProductPriceWithCurrency()
    {
        return Util::getPriceWithCurrency($this->price);
    }

    /**
     * format sell price with local currency
     * @return string
     */
    public function getProductSellPriceWithCurrency()
    {
        return Util::getPriceWithCurrency($this->sell_price);
    }

    /**
     * return product category name by id
     * @return string
     */
    public function getCatName()
    {
        return ProductCategory::getCategoryNameById($this->product_cat_id);
    }
}
