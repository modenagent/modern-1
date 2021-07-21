<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserPackageSubscription extends AbstractMigration
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
        $table = $this->table('lp_user_package_subscription');
        $table->addColumn('sub_id', 'string')
              ->addColumn('user_id', 'integer',['null' => true])
              ->addColumn('package_id', 'integer',['null' => true])
              ->addColumn('amount', 'decimal',['precision'=>8,'scale'=>2])
              ->addColumn('interval', 'string')
              ->addColumn('is_live', 'boolean')
              ->addForeignKey('user_id', 'lp_user_mst', 'user_id_pk',['delete'=> 'SET_NULL', 'update'=> 'CASCADE'])
              ->addForeignKey('package_id', 'lp_packages', 'id',['delete'=> 'SET_NULL', 'update'=> 'CASCADE'])
              ->addTimestamps()
              ->create();
    }
}
