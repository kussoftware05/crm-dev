<?php

namespace admin\models;

use Yii;
use \Bera\Upload\Upload;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $type
 * @property string $name
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'name'], 'required'],
            [['type'], 'string'],
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Image',
        ];
    }

    /**
     * upload a new image and create a new image instance
     * @param string $type
     * @param array $image_file
     * @return bool|int
     */
    public function createNewImage( $type, $image_file, $upload_path )
    {
        if(empty($type)) 
            return false;
        if(empty($upload_path)) 
            $u_path = self::defultUploadPath();
        else 
            $u_path = $upload_path;
        $this->type = $type;
        $uploded_image = self::uploadAnImage($image_file, $u_path);
        if($uploded_image === false)
            return false;
        $this->name = $uploded_image;
        if($this->insert())
            return $this->id;
        else 
            return false;
        
    }

    /**
     * upload an image
     * @param array $image_file
     * @param string $upload_path
     * @return bool|string
     */
    public static function uploadAnImage( $image_file, $upload_path ) 
    {
        $new_upload = new Upload($image_file);
        $new_upload->setUploadConditon( [
            'file_size' => '3M',
            'allowed_extension' => ['png','jpeg','jpg']
        ]);
        $new_upload->setUploadDir($upload_path);
        try {
            if($new_upload->upload())
                return $new_upload->getUploadedFileName();
            else
                return false;
        }catch ( \Bera\Upload\Exception\FileTypeNotSupprotExectpion $e) {
            return false;
        }catch ( \Bera\Upload\Exception\UplodMaxSizeException $e) {
            return false;
        }
    }

    /**
     * return defult image path
     * @return string
     */
    public static function defultUploadPath()
    {
        return Yii::getAlias('@webroot') . '/uploads';
    }

    /**
     * create or update an image based on id 
     * if id is null then create a new image and return the pk 
     * if id is not null then find the image by id remove image from disk and then 
     * upload the new image and save into the db
     * 
     * @param int|null $id
     * @param string $type
     * @param array $file
     * @param string $upload_location
     * @return bool|int
     */
    public function createOrUploadAnImage($id, $type, $file, $upload_location) 
    {
        if(is_null($id) || empty($id)) 
        {
            $image_upload_id = $this->createNewImage($type, $file, $upload_location);
            return $image_upload_id;
        } 
        else 
        {
            // find old
            $image = self::findOne($id);
            $image_path = $upload_location . DIRECTORY_SEPARATOR . $image->name;
            //delete old
            if(\file_exists($image_path))
                \unlink($image_path);
            // upload new image
            $upload_new_file = self::uploadAnImage($file,$upload_location);
            //save new name
            $image->name = $upload_new_file ;
            return $image->save();
        }
    }

    /**
     * delete an image
     * @param int $id
     * @param string $image_path
     * @return bool
     */
    public static function deleteAnImage($id, $image_path) 
    {
        $image = self::findOne($id);
        if($image) 
        {
            $image_in_folder = $image_path . DIRECTORY_SEPARATOR . $image->name;
            if(\file_exists($image_in_folder))
                \unlink($image_in_folder);
            $image->delete();
        }
        return true;
    }

    /**
     * return image name
     * @param int $id
     * @return string
     */
    public static function getImageNameById($id) 
    {
        $image = self::findOne($id);
        if(is_null($image))
            return '';
        return $image->name;
    }
}
