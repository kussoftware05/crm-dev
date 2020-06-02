<?php

use yii\db\Migration;

/**
 * Class m200515_062217_order_details
 */
class m200515_062217_order_details extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('order_details',[
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),
            'price' => $this->decimal(10,2)->notNull()->defaultValue(0.00),
            'quantity' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_order_details_order_id',
            'order_details',
            'order_id',
            'order_master',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_order_details_product_id',
            'order_details',
            'product_id',
            'product',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_order_details_user_id',
            'order_details',
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
            'fk_order_details_order_id',
            'order_details'
        );
        $this->dropForeignKey(
            'fk_order_details_product_id',
            'order_details'
        );
        $this->dropForeignKey(
            'fk_order_details_user_id',
            'order_details'
        );

        $this->dropTable('order_details');
    }

}
