<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLpRegistryUsers extends AbstractMigration
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
        $table = $this->table('lp_registry_users');
        $table->addColumn('registry_id', 'integer')
              ->addColumn('name', 'string')
              ->addColumn('email', 'string')
              ->addColumn('phone', 'string')
              ->addTimestamps()
              ->addForeignKey('registry_id', 'lp_registry_master', 'id',['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
              ->create();

        $table = $this->table('lp_registry_master');
        $table->addIndex(['unique_key'])->update();
    }
}
