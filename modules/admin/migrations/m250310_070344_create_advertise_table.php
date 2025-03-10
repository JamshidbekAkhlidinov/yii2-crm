<?php

use app\models\Advertise;
use app\modules\admin\enums\StatusEnum;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%advertise}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m250310_070344_create_advertise_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%advertise}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'url' => $this->string(),
            'description' => $this->string(),
            'period' => $this->integer(),
            'price' => $this->double(),
            'align' => $this->integer(),
            'status' => $this->integer()->defaultValue(Advertise::status_archive),
            'payed_at' => $this->datetime(),
            'payed_status' => $this->integer()->defaultValue(StatusEnum::INACTIVE),
            'created_at' => $this->datetime(),
            'created_by' => $this->integer(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-advertise-created_by}}',
            '{{%advertise}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-advertise-created_by}}',
            '{{%advertise}}',
            'created_by',
            '{{%user}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-advertise-created_by}}',
            '{{%advertise}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-advertise-created_by}}',
            '{{%advertise}}'
        );

        $this->dropTable('{{%advertise}}');
    }
}
