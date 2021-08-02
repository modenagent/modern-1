<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddFieldsToPackage extends AbstractMigration
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
        $table = $this->table('lp_packages');
        $table->addColumn('title', 'string',['after'=>'package'])
              ->addColumn('price_per_month', 'decimal', ['precision'=>8,'scale'=>2,'comment'=>'Subscription plan price per month','after'=>'price'])
              ->addColumn('is_active', 'boolean', ['default' => 0,'comment'=>'Is plan acitivate','after'=>'price_per_month'])
              ->update();
    }
}
