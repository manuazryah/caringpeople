<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m170308_111848_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin_posts', [
            'id' => $this->primaryKey(),
            'post_name'=>$this->string(280),
            'enquiry'=>$this->integer(),
            'users'=>$this->integer(),
            'employees'=>$this->integer(),
            'status'=>$this->integer(),
            'CB'=>$this->integer(),
            'UB'=>$this->integer(),
            'DOC' => $this->dateTime(),
            'DOU' => $this->timestamp(),
        ]);
        
        
        $this->createTable('admin_users', [
            'id' => $this->primaryKey(),
            'post_id'=>$this->integer(),
            'employee_code'=>$this->string(280),
            'user_name'=>$this->string(280),
            'password'=>$this->string(280),
            'name'=>$this->string(280),
            'email'=>$this->string(280),
            'phone_number'=>$this->string(280),
            'CB'=>$this->integer(),
            'UB'=>$this->integer(),
            'DOC' => $this->dateTime(),
            'DOU' => $this->timestamp(),
        ]);
        
        $this->addForeignKey(
            'fk-admin_users-post_id',
            'admin_users',
            'post_id',
            'admin_posts',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
