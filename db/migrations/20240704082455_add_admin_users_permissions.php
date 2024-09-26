<?php
declare (strict_types = 1);

use Phinx\Migration\AbstractMigration;

final class AddAdminUsersPermissions extends AbstractMigration
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
        $this->query("INSERT INTO lp_permission_function (func_name) VALUES ('add_admin_user')");
        $this->query("INSERT INTO lp_permission_function (func_name) VALUES ('edit_admin_user')");
        $this->query("INSERT INTO lp_permission_function (func_name) VALUES ('deactive_admin_user')");
        $this->query("INSERT INTO lp_permission_function (func_name) VALUES ('del_admin_user')");

        $this->query("INSERT INTO lp_role_func (role_id_fk, permission_func_id) VALUES (1, 46)");
        $this->query("INSERT INTO lp_role_func (role_id_fk, permission_func_id) VALUES (1, 47)");
        $this->query("INSERT INTO lp_role_func (role_id_fk, permission_func_id) VALUES (1, 48)");
        $this->query("INSERT INTO lp_role_func (role_id_fk, permission_func_id) VALUES (1, 49)");
    }
}
