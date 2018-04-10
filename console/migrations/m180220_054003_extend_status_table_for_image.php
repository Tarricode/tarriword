<?php

use yii\db\Migration;

class m180220_054003_extend_status_table_for_image extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m180220_054003_extend_status_table_for_image cannot be reverted.\n";

        return false;
    }

 public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }
      $this->addColumn('{{%status}}','image_src_filename',Schema::TYPE_STRING.' NOT NULL');
      $this->addColumn('{{%status}}','image_web_filename',Schema::TYPE_STRING.' NOT NULL');
    }
 
    public function down()
    {
        $this->dropColumn('{{%status}}','image_src_filename');
        $this->dropColumn('{{%status}}','image_web_filename');
        return false;
    }
}
