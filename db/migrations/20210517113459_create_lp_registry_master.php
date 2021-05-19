<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLpRegistryMaster extends AbstractMigration
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
        $table = $this->table('lp_registry_master');
        $table->addColumn('listing_id', 'integer')
              ->addColumn('is_registered', 'boolean',['default' => 0])
              ->addColumn('unique_key', 'string')
              ->addTimestamps()
              ->addForeignKey('listing_id', 'lp_my_listing', 'project_id_pk',['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
              ->create();
    }
}
