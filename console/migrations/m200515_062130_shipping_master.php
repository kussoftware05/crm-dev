<?php

use yii\db\Migration;

/**
 * Class m200515_062130_shipping_master
 */
class m200515_062130_shipping_master extends Migration
{
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('shipping_master',[
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'email' => $this->string(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'company_name' => $this->string(),
            'address_line_1' => $this->string(),
            'address_line_2' => $this->string(),
            'city' => $this->string(),
            'zipcode' => $this->string()
        ]);

        $this->addForeignKey(
            'fk_shipping_master_user_id',
            'shipping_master',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
       $this->dropForeignKey(
           'fk_shipping_master_user_id',
           'shipping_master'
        );
       $this->dropTable('shipping_master');
    }
}
