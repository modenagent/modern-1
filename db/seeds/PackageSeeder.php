<?php


use Phinx\Seed\AbstractSeed;

class PackageSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $package_data = [
            [
                'package'           =>'buyer',
                'title'             =>'Buyer Report',
                'price'             =>3,
                'price_per_month'   =>15,
                'is_active'         =>1,
                'created_at'        =>date('Y-m-d H:i:s'),
                'updated_by'        =>0     
            ],
            [
                'package'           =>'seller',
                'title'             =>'Seller Report',
                'price'             =>3,
                'price_per_month'   =>15,
                'is_active'         =>1,  
                'created_at'        =>date('Y-m-d H:i:s'),
                'updated_by'        =>0
            ],
            [
                'package'           =>'marketupdate',
                'title'             =>'Market Update Report',
                'price'             =>3,
                'price_per_month'   =>20,
                'is_active'         =>1,  
                'created_at'        =>date('Y-m-d H:i:s'),
                'updated_by'        =>0
            ],
            [
                'package'           =>'registry',
                'title'             =>'Registry Report',
                'price'             =>3,
                'price_per_month'   =>20,
                'is_active'         =>1,  
                'created_at'        =>date('Y-m-d H:i:s'),
                'updated_by'        =>0
            ],
            [
                'package'           =>'all',
                'title'             =>'All Reports',
                'price'             =>3,
                'price_per_month'   =>25,
                'is_active'         =>1,  
                'created_at'        =>date('Y-m-d H:i:s'),
                'updated_by'        =>0
            ],

        ];

        $package = $this->table('lp_packages');
        $package->insert($package_data)
              ->save();
    }
}
