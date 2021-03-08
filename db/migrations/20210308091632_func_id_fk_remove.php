<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FuncIdFkRemove extends AbstractMigration
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
    public function up()
    {
        $role_fun = $this->table('lp_role_func');
        $role_fun
            ->changePrimaryKey(['role_id_fk', 'permission_func_id'])
            ->save();

        
        $role_fun->removeColumn('func_id_fk')
              ->save();
    }
}
