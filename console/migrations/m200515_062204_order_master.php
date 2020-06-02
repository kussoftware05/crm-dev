<?php

use yii\db\Migration;

/**
 * Class m200515_062204_order_master
 */
class m200515_062204_order_master extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('order_master',[
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'billing_id' => $this->integer(),
            'shipping_id' => $this->integer(),
            'order_date' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'order_amount' => $this->decimal(10,2)->notNull()->defaultValue(0.00),
            'order_discount' => $this->decimal(10,2)->notNull()->defaultValue(0.00),
            'shipping_cost' => $this->decimal(10,2)->notNull()->defaultValue(0.00),
            'tax' => $this->decimal(10,2)->notNull()->defaultValue(0.00),
            'order_status' => "ENUM('Processing','Completed','Pending','Cancel')"
        ]);

        $this->addForeignKey(
            'fk_order_master_user_id',
            'order_master',
            'user_id',
            'user',
            'id',
            'CASCADE', 
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_order_master_billing_id',
            'order_master',
            'billing_id',
            'billing_master',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_order_master_shipping_id',
            'order_master',
            'shipping_id',
            'shipping_master',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx_order_master_order_date',
            'order_master',
            'order_date'
        );

    }

    public function down()
    {
       $this->dropForeignKey(
           'fk_order_master_user_id',
           'order_master'
        );
       $this->dropForeignKey(
           'fk_order_master_billing_id',
           'order_master'
        );
       $this->dropForeignKey(
           'fk_order_master_shipping_id',
           'order_master'
        );
       $this->dropIndex(
           'idx_order_master_order_date',
           'order_master'
       );
       $this->dropTable('order_master');
    }
}
