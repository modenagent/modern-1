<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class IpIdpsTableCreate extends AbstractMigration
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
        $table = $this->table('lp_idps');
        $table->addColumn('company_id', 'integer',['null' => true])
              ->addColumn('unique_id', 'string', ['limit' => 50])
              ->addColumn('metadata_url', 'string', ['limit' => 100])
              ->addForeignKey('company_id', 'lp_user_mst', 'user_id_pk', ['delete'=> 'SET_NULL', 'update'=> 'RESTRICT'])
              ->create();
    }
}
