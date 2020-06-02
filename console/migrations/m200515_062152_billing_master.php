<?php

use yii\db\Migration;

/**
 * Class m200515_062152_billing_master
 */
class m200515_062152_billing_master extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('billing_master',[
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
            'fk_billing_master_user_id',
            'billing_master',
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
            'fk_billing_master_user_id',
            'billing_master'
        );
       $this->dropTable('billing_master');
    }
}
