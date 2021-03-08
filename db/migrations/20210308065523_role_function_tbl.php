<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RoleFunctionTbl extends AbstractMigration
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
        $table = $this->table('lp_permission_function');
        $table->addColumn('func_name', 'string', ['limit' => 50])
              ->create();

        $data = $this->fetchAll('SELECT `func_id_fk`  FROM `lp_role_func` GROUP BY `func_id_fk` ORDER by `func_id_fk`');

        $rows = array();

        foreach ($data as $key => $value) {
            $function_name = $value['func_id_fk'];
            $rows[] = [
                  'func_name'    => $function_name
                ];
        }
        if(count($rows)) {
            $this->table('lp_permission_function')->insert($rows)->save();
        }

        $table = $this->table('lp_role_func');
        $table->addColumn('permission_func_id', 'integer',['null' => true])
              ->addForeignKey('permission_func_id', 'lp_permission_function', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
              ->update();

        $data = $this->fetchAll('SELECT lp_role_func.*,`lp_permission_function`.`id`  FROM `lp_role_func` LEFT JOIN `lp_permission_function` ON `lp_role_func`.`func_id_fk` = `lp_permission_function`.`func_name`');

        foreach ($data as $key => $value) {
            $update_id = $value['id'];
            $role_id = $value['role_id_fk'];
            $fun_name = $value['func_id_fk'];

            $res = $this->query("UPDATE `lp_role_func` SET `permission_func_id`=$update_id WHERE `role_id_fk`=$role_id AND func_id_fk='$fun_name'");
        }
    }
}
