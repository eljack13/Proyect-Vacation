<?php

use yii\db\Migration;

/**
 * Class m241126_001604_init_rbac
 */
class m241126_001604_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241126_001604_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241126_001604_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
