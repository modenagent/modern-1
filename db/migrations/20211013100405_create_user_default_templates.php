<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserDefaultTemplates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {

        $table = $this->table('lp_user_default_templates');
        $table->addColumn('user_id', 'integer')
              ->addColumn('theme_type', 'enum', ['values' => ['buyer', 'seller','marketUpdate','registry']])
              ->addColumn('theme_sub_type', 'integer', ['default' => 1])
              ->addColumn('theme_color', 'integer', ['default' => 1])
              ->addForeignKey('user_id', 'lp_user_mst', 'user_id_pk',['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
              ->addTimestamps()
              ->create();

    }
}
