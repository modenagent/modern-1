<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTestimonialTable extends AbstractMigration
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
        $table = $this->table('lp_testimonial');
        $table->addColumn('content', 'text')
              ->addColumn('name', 'string')
              ->create();

        $data = array(
            array(
                'content'=>'Excellent. They walked me through the entire home selling process. From the list of things to repair, the importance of staging and daily contact once the for sale sign went up.',
                'name'=>'Richard & Susan'
                
            ),
            array(
                'content'=>'As a first time home buyer he was very patient with all of our questions and took time to explain the process every step of the way. Always willing to show us any property we were interested at a time the worked best for our schedules. Overall very friendly and helpful. I am so glad he was able to help us find our first home with very little stress, I will definitely be recommending him to family and friends.',
                'name'=>'Lance & Amanda'
            ),
            array(
                'content'=>'Showed us a bunch of homes for months until we found the right one. Gave us a ton of contacts to help us throughout the process. And even now after the home has already been closed on he is still helping with any problems or questions we have. Extremely helpful and knowledgeable in any facet of home buying/owning.',
                'name'=>'Allison & Eli'
            ),
            array(
                'content'=>'They were a great team and extremely helpful with selling my house quickly. I was able to do everything online with them. They facilitated repairs and getting rid of things in the house. This was so helpful since I live out of the area.',
                'name'=>'Mario & Courtney'
            )
        );

        $table = $this->table('lp_testimonial');
        $table->insert($data)
              ->save();
    }
}
