<?php

use yii\db\Migration;

class m170309_053458_forgot_password extends Migration {

        public function up() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%forgot_password_tokens}}', [
                    'id' => $this->primaryKey(),
                    'user_id' => $this->integer()->notNull(),
                    'token' => $this->string(100)->notNull(),
                    'date' => $this->date(),
                        ], $tableOptions);
                $this->alterColumn('{{%forgot_password_tokens}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');
        }

        public function down() {
                echo "m170309_053458_forgot_password cannot be reverted.\n";

                return false;
        }

        /*
          // Use safeUp/safeDown to run migration code within a transaction
          public function safeUp()
          {
          }

          public function safeDown()
          {
          }
         */
}
