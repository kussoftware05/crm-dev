<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(), 
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'type' => "ENUM('NORMAL','ADMIN')"
        ], $tableOptions);

        $this->insert('user', [
            'username' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'email' => 'admin@xyz.com',
            'first_name' => 'Joan',
            'last_name' => 'Doe',
            'type' => 'ADMIN'

        ]);

        $this->insert('user', [
            'username' => 'testuser',
            'password_hash' => Yii::$app->security->generatePasswordHash('testuser'),
            'email' => 'dev.paul@xyz.com',
            'first_name' => 'Dev',
            'last_name' => 'Paul',
            'type' => 'NORMAL'
        ]);
    }

    public function down()
    {
        $this->delete('user', ['id' => 1]);
        $this->delete('user', ['id' => 2]);
        $this->dropTable('{{%user}}');
    }
}
