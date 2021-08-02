<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddFieldsToCouponMst extends AbstractMigration
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
        $table = $this->table('lp_coupon_mst');
        $table->addColumn('sales_rep_id', 'integer', ['null' => true,'default' => null])
              ->addColumn('limit_all', 'integer', ['default' => 30])
              ->addColumn('limit_user', 'integer', ['default' => 3])
              ->addForeignKey('sales_rep_id', 'lp_user_mst', 'user_id_pk',['delete'=> 'SET_NULL', 'update'=> 'CASCADE'])
              ->update();

        $data = $this->fetchAll('SELECT `user_id_pk` FROM lp_user_mst WHERE `role_id_fk` = 3');

        $insert_coupon_data = array();

        foreach ($data as $key => $value) {
            //Create Reffral code
            $referral_code = 'REF'.str_pad($value['user_id_pk'], 5, "0", STR_PAD_LEFT);

            $result_select = $this->fetchRow('SELECT * FROM `lp_coupon_mst` WHERE coupon_code="'.$referral_code.'"');

            if($result_select && !empty($result_select['coupon_id_pk'])) {
                $this->query("UPDATE `lp_coupon_mst` SET `sales_rep_id`=".$value['user_id_pk']." WHERE `coupon_id_pk`=".$result_select['coupon_id_pk']);
            }
            else {
                

                    $tmp_array = array();
                    $tmp_array['coupon_code'] = $referral_code;
                    $tmp_array['coupon_name'] = $referral_code;
                    $tmp_array['coupon_descr'] = 'Coupon for rererral program';
                    $tmp_array['start_date'] = date('Y-m-d');
                    $tmp_array['end_date'] = null;
                    $tmp_array['uses_per_user'] = 10;
                    $tmp_array['coupon_amt'] = 0;
                    $tmp_array['sales_rep_id'] = $value['user_id_pk'];
                    $insert_coupon_data[] = $tmp_array;
                


            }
        }
        if(count($insert_coupon_data)) {

            $table = $this->table('lp_coupon_mst');
                    $table->insert($insert_coupon_data)
                    ->save();
        }
    }
}
