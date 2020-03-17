<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu}}`.
 */
class m200129_130126_create_menu_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%menu}}');
    }

}
