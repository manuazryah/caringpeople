<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m170309_054104_create_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
         $this->addColumn('admin_users', 'status', 'INTEGER NOT NULL AFTER phone_number');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('status');
    }
}
