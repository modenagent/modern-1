<?php


use Phinx\Seed\AbstractSeed;

class SellerTemplatesSeeder extends AbstractSeed
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
        $data = [
            [
                'template_icon'    => 'assets/images/report/seller/1.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/2.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/3.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/4.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/5.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/6.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/7.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/8.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/9.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/10.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/11.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/12.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/13.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/14.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/15.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/16.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/17.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/18.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/19.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
            [
                'template_icon'    => 'assets/images/report/seller/20.jpg',
                'created' => date('Y-m-d H:i:s'),
            ],
        ];

        $posts = $this->table('lp_seller_report_templates');
        $posts->insert($data)
              ->save();
    }
}
