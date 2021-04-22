<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddReportFieldsToUserTable extends AbstractMigration
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
        $table = $this->table('lp_user_mst');
        $table->addColumn('report_dir_name', 'string', ['null' => true,'default' => null,'comment'=>'Directory name to fetch reports'])
              ->addColumn('use_rets_api', 'boolean', ['default' => 0,'comment'=>'Use rets API for compare or not'])
              ->update();
    }
}
