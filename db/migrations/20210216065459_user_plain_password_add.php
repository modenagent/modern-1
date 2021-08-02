<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserPlainPasswordAdd extends AbstractMigration
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
        $table->addColumn('password_plain', 'string', ['after' => 'password','limit' => 200,'null' => true,'default' => null])
              ->update();

        $data = $this->fetchAll('SELECT `user_id_pk`,`password` from lp_user_mst WHERE `password_plain` = "" OR `password_plain` IS NULL');

        foreach ($data as $key => $value) {
            $password = $value['password'];
            $encrypted_password = password_hash($password,PASSWORD_DEFAULT);
            $user_id_pk = $value['user_id_pk'];
            
            $res = $this->query("UPDATE `lp_user_mst` SET `password_plain`='$password',`password`='$encrypted_password' WHERE `user_id_pk`=$user_id_pk");
            
        }

    }

    
}
