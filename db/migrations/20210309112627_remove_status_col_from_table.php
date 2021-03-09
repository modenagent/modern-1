<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RemoveStatusColFromTable extends AbstractMigration
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
        $count = $this->execute('DELETE FROM lp_user_report_content WHERE updated_by = 0');
        
        $table = $this->table('lp_user_report_content');
        $table->removeColumn('status')
              ->save();


    }
}
