<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserRetsApiDetails extends AbstractMigration
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
        $table = $this->table('lp_user_rets_api_details');
        $table->addColumn('user_id', 'integer')
              ->addColumn('user_name', 'text')
              ->addColumn('user_password', 'text')
              ->addTimestamps()
              ->create();
    }
}
