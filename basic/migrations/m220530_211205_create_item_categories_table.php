<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_categories}}`.
 */
class m220530_211205_create_item_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_categories}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-item_category-item', 'item_categories', 'item_id', 'item', 'id', 'CASCADE');

        $this->addForeignKey(
            'fk-item_category-category', 'item_categories', 'category_id', 'category', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_categories}}');
    }
}
