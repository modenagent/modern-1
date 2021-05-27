<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateWidgetFeaturedHomeTable extends AbstractMigration
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
        $table = $this->table('lp_featured_home');
        $table->addColumn('image', 'string')
              ->addColumn('price', 'float')
              ->addColumn('address', 'string')
              ->addColumn('city', 'string')
              ->create();

        $data = array(
            array(
                'image'=>'assets/reports/widget/images/featured/AdobeStock_193618205.jpeg',
                'price'=>8177000,
                'address'=>'10509 LA PAZ ROAD ',
                'city'=>'DEL MAR, CA',
            ),
            array(
                'image'=>'assets/reports/widget/images/featured/AdobeStock_168851148.jpeg',
                'price'=>8800000,
                'address'=>'12979 TRABUCO WOODS ',
                'city'=>'LA JOLLA, CA',
            ),
            array(
                'image'=>'assets/reports/widget/images/featured/AdobeStock_227074608.jpeg',
                'price'=>7500000,
                'address'=>'4717 FREIGHTON WAY',
                'city'=>'LA JOLLA, CA',
            ),
            array(
                'image'=>'assets/reports/widget/images/featured/AdobeStock_201642793.jpeg',
                'price'=>7500000,
                'address'=>'5025 ATRISCO WAY',
                'city'=>'ENCINITAS, CA',
            ),

        );

        $table = $this->table('lp_featured_home');
        $table->insert($data)
              ->save();

    }
}
