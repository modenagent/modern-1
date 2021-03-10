<?php


use Phinx\Seed\AbstractSeed;

class WidgetReportContent extends AbstractSeed
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
                'report_type'    => 'seller',
                'language'    => 'english',
                'page_no'    => '12',
                'page_title'    => 'Pricing Correctly',
                'data'    => '{"title":{"value":"Pricing Correctly","limit":50,"type":"text"},"sub_title":{"value":"Selling Faster by Setting the Right Price","limit":85,"type":"text"},"content":{"value":"At any given time, there are plenty of buyers in the market looking for newly listed properties. As your agent, I want to make sure to help you attract as many buyers as possible. One thing that can hinder this is setting the price too high. The key to getting your home sold as quickly as possible is to price it correctly from day 1. Many sellers have the tendency to want to list their home at a higher sales price than advised because they hope to increase their profi t or they assume that buyers always make low off ers so it’s good to start high","limit":700,"type":"textarea"},"paragraph_1_title":{"value":"1. On Market Longer","limit":50,"type":"text"},"paragraph_1_content":{"value":"Properties that are over priced tend to stay on the market significantly longer than those that are priced to sell.","limit":150,"type":"textarea"},"paragraph_2_title":{"value":"2. Price Reduction","limit":50,"type":"text"},"paragraph_2_content":{"value":"Overpriced properties will most certainly need to do at least 1 price reduction to regenerate interest in your property.","limit":150,"type":"textarea"},"paragraph_3_title":{"value":"3. Lost Time","limit":50,"type":"text"},"paragraph_3_content":{"value":"Time lost in waiting for an offer can be time spent accepting offers, conducting inspections & opening escrow.","limit":150,"type":"textarea"},"paragraph_4_title":{"value":"4. Stigma Developed","limit":50,"type":"text"},"paragraph_4_content":{"value":"As buyers see the property advertised over and over again, they will start wondering if there\'s something wrong with it.","limit":150,"type":"textarea"}}',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'report_type'    => 'seller',
                'language'    => 'english',
                'page_no'    => '13',
                'page_title'    => 'Average Days On Market',
                'data'    => '{"title":{"value":"Average Days On Market","limit":50,"type":"text"},"sub_title":{"value":"How Long Will It Take to Sell Your Home","limit":85,"type":"text"},"content":{"value":"Days on market has a direct correlation with a buyers interest level in your property. Depending on the geographic area of your home. The number of days that your home is on the market can vary. Currently the market is in an upswing and the shortage of inventory is leading to homes flying off the market. There are a few factors that come into play when attempting to determine how long it will take these factors are","limit":700,"type":"textarea"},"paragraph_1_title":{"value":"Market","limit":50,"type":"text"},"paragraph_1_content":{"value":"Can be a geographic location or type of housing. So if a certain eclectic neighborhood is deemed desirable, that creates demand which will lead to homes being sold quickly.","limit":150,"type":"textarea"},"paragraph_2_title":{"value":"Season","limit":50,"type":"text"},"paragraph_2_content":{"value":"When someone is looking to pack up and move they typically would do so in good weather. So if your home is listed during the winter or the rainy season this may add to days on market.","limit":150,"type":"textarea"},"paragraph_3_title":{"value":"Economy","limit":50,"type":"text"},"paragraph_3_content":{"value":"When interest rates are low the typical median home price tends to rise. During this time motivated buyers take less time to commit to a home which leads to less time on market and quicker sales.","limit":150,"type":"textarea"},"point_1":{"value":"Days on Market"},"point_2":{"value":"Buyer Interest"}}',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'report_type'    => 'seller',
                'language'    => 'english',
                'page_no'    => '14',
                'page_title'    => 'Digital Marketing Plan',
                'data'    => '{"title":{"value":"Digital Marketing Plan","limit":50,"type":"text"},"sub_title":{"value":"Our Marketing Strategy","limit":85,"type":"text"},"content":{"value":"Other agents may have a digital strategy of posting your house on social media and then rel on other agents to expose your house to buyers. I have an entire digital marketing strategy where I will:\n\n1) ADVERTISE your property, via paid ads on Facebook, Instagram, Google and all real estate sites (think zillow, realtor.com, etc.)\n\n2) Cultivate lists of people who have shown interest in a home like yours, where they work, where they live currently and more to run personalized ads on online platforms.","limit":700,"type":"textarea"},"paragraph_1_title":{"value":"Email and Social Media Marketing:","limit":50,"type":"text"},"paragraph_1_content":{"value":"I offer marketing prowess to help get more buyers’ eyes on your house. I will digitally market, via email and social media, your house to hundreds of local buyers, through these marketing effort:\n\n","limit":150,"type":"textarea"},"para_1_point_1_title":{"value":"I will market your house via email blasts to buyers who have shown interest in homes like yours","limit":150,"type":"text"},"para_1_point_2_title":{"value":"I will run digital ads on Facebook and Instagram to hundreds of local buyers looking for a home just like yours","limit":150,"type":"text"},"para_1_point_3_title":{"value":"Marketing reports that show the results of my ads of your house on social media and through email blasts","limit":150,"type":"text"},"paragraph_2_title":{"value":"Video Social Media Ads:","limit":150,"type":"text"},"paragraph_2_content":{"value":"I will run beautiful, professionally produced videos ads on social media to get the attention of potential buyers. I offer you:\n\n","limit":150,"type":"textarea"},"para_2_point_1_title":{"value":"Professionally produced video ads run to hundreds of potential buyers on Facebook and Instagram","limit":150,"type":"text"},"para_2_point_2_title":{"value":"I can run ads for all stages of the listing (Just Listed, Open Houses, Price Reduced, and Active Listing) this way your home is always in front of potential buyers with the latest information.","limit":150,"type":"text"},"para_2_point_3_title":{"value":"As the ads run I will deliver an impressive seller report that continually updates with up to the minute results","limit":150,"type":"text"}}',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'report_type'    => 'seller',
                'language'    => 'english',
                'page_no'    => '15',
                'page_title'    => 'Social Proof',
                'data'    => '{"title":{"value":"Social Proof","limit":50,"type":"text"},"sub_title":{"value":"We Have the Technology and the Numbers","limit":85,"type":"text"},"content":{"value":"We are able to connect instantly with a worldwide audience, with no worry of timezone or language barriers. It is estimated that there are arouund 3.48 billion people using social networks across the world in 2021.\n\nWe digitally market international, using social media to reach a list of countries that grows every day.","limit":700,"type":"textarea"},"paragraph_1_title":{"value":"@hometownerealestate","limit":50,"type":"text"},"paragraph_1_point_1":{"value":"7,000+ Fans","limit":50,"type":"text"},"paragraph_1_point_2":{"value":"568,000 Link Clicks a Month","limit":50,"type":"text"},"paragraph_1_point_3":{"value":"212,000 Impressions Per Month","limit":50,"type":"text"},"paragraph_1_point_4":{"value":"323 Engaged Users Daily","limit":50,"type":"text"},"paragraph_1_point_5":{"value":"24 Post Interactions Per Day","limit":50,"type":"text"},"paragraph_2_title":{"value":"@hometownerealestate","limit":50,"type":"text"},"paragraph_2_point_1":{"value":"8,000+ Followers","limit":50,"type":"text"},"paragraph_2_point_2":{"value":"2,400 Impressions Per Month","limit":50,"type":"text"},"paragraph_2_point_3":{"value":"31% Engagement Rate","limit":50,"type":"text"},"paragraph_2_point_4":{"value":"13 Post Interactions Per Day","limit":50,"type":"text"},"paragraph_2_point_5":{"value":"Global Reach","limit":50,"type":"text"},"paragraph_3_title":{"value":"Online","limit":50,"type":"text"},"paragraph_3_point_1":{"value":"30,000 Searching Buyers","limit":50,"type":"text"},"paragraph_3_point_2":{"value":"7,193 Unique Quarterly Website Visitors","limit":50,"type":"text"},"paragraph_3_point_3":{"value":"3,400 Page Views a Month","limit":50,"type":"text"}}',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'report_type'    => 'seller',
                'language'    => 'english',
                'page_no'    => '16',
                'page_title'    => 'The Sellers Roadmap',
                'data'    => '{"title":{"value":"The Sellers Roadmap","limit":50,"type":"text"},"sub_title":{"value":"Meet With a Real Estate Professional","limit":85,"type":"text"},"content":{"value":"There’s no commitment required on your part for the initial meeting. It will be educational and help you identify your next steps. ","limit":700,"type":"textarea"},"paragraph_1_title":{"value":"Establish a Price","limit":50,"type":"text"},"paragraph_1_content":{"value":"Your agent will provide a market analysis, which will help you set an asking price.","limit":150,"type":"textarea"},"paragraph_2_title":{"value":"Strategic Pricing","limit":50,"type":"text"},"paragraph_2_content":{"value":"As diffi cult as it may be, it’s important to review the market analysis and consider your home price objectively","limit":150,"type":"textarea"},"paragraph_3_title":{"value":"Prepare Your Home","limit":50,"type":"text"},"paragraph_3_content":{"value":"View your home through the eyes of the buyer and ask yourself what you’d expect. Your agent will off er some useful suggestions.","limit":150,"type":"textarea"},"paragraph_4_title":{"value":"List It For Sale","limit":50,"type":"text"},"paragraph_4_content":{"value":"When everything is in place your agent will put your home on the open market. It’s critical you make it as easy as possible for potential buyers to view your home.","limit":150,"type":"textarea"},"paragraph_5_title":{"value":"Showings","limit":50,"type":"text"},"paragraph_5_content":{"value":"Potential buyers may ask to see your home on short notice. It’s best if you can accomodate these requests, you never want to miss a potential sale.","limit":150,"type":"textarea"}}',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'report_type'    => 'seller',
                'language'    => 'english',
                'page_no'    => '17',
                'page_title'    => 'The Sellers Roadmap',
                'data'    => '{"title":{"value":"Congratulations","limit":50,"type":"text"},"sub_title":{"value":"You’ve Successfully Sold Your Home!","limit":85,"type":"text"},"paragraph_1_title":{"value":"Offers & Negotiation","limit":50,"type":"text"},"paragraph_1_content":{"value":"If everything goes well, a buyer and (most often the agent who represents them) will present your agent with an offer.","limit":150,"type":"textarea"},"paragraph_2_title":{"value":"Choosing an Offer","limit":50,"type":"text"},"paragraph_2_content":{"value":"Your agent will present the benefits and risks of each offer. You will have the opportunity to either accept or counter any offer based on it’s merits.","limit":150,"type":"textarea"},"paragraph_3_title":{"value":"Under Contract","limit":50,"type":"text"},"paragraph_3_content":{"value":"At this point you and the buyer have agreed to all of the terms of the off er and both parties have signed the agreements.","limit":150,"type":"textarea"},"paragraph_4_title":{"value":"Final Details","limit":50,"type":"text"},"paragraph_4_content":{"value":"While under contract, the buyer will work with their mortgage provider to fi nalize the loan and perform other due diligence.","limit":150,"type":"textarea"},"paragraph_5_title":{"value":"Inspection","limit":50,"type":"text"},"paragraph_5_content":{"value":"The buyer will usually perform a physical inspection of the home. They may even ask you to make certain repairs. Your agent will explain all of your options regarding the inspection.","limit":150,"type":"textarea"},"paragraph_6_title":{"value":"Closing","limit":50,"type":"text"},"paragraph_6_content":{"value":"This is the transfer of funds and ownership. Depending on when the buyer moves into the home, you will need to be all packed up and ready to move.","limit":150,"type":"textarea"}}',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'report_type'    => 'seller',
                'language'    => 'english',
                'page_no'    => '18',
                'page_title'    => 'Analyze & Optimize',
                'data'    => '{"title":{"value":"Analyze & Optimize","limit":50,"type":"text"},"sub_title":{"value":"Review selling price","limit":85,"type":"text"},"content":{"value":"When your property first hits the market the entire audience which consists of realtors, prospective buyers, and sellers all place eyes on your listing. They all make rapid judgments as to it\'s price, current condition, and location. How they first perceive it will determine the viewing activity over the next few weeks. If we receive no viewings initially, we are facing the possibility that that market as a whole is rejecting the value proposition of your listing. Our solution? Reduce the price. \n\nReducing the price of your home is never an easy call but often times is a necessity one that might need to be made in order to get your home sold. Many homeowners feel that they are giving up hard earned equity that has been gained. In reality, a slight reduction can help avoid problems down the line. The question is, When is the best time? From the time the property is first placed on the market the rule of thumb is 30-45 days.","limit":1000,"type":"textarea"},"table_1_title":{"value":"At Listing Time","limit":50,"type":"text"},"table_2_title":{"value":"After Price Reduction","limit":50,"type":"text"},"footer_content":{"value":"Joe and Jane went from being very competitively priced to being the highest property in their price range. From a buyer\'s perspective, their home now offers the worst value proposition in the marketplace.","limit":250,"type":"textarea"}}',
                'created_at' => date('Y-m-d H:i:s'),
            ], 
            [
                'report_type'    => 'seller',
                'language'    => 'english',
                'page_no'    => '19',
                'page_title'    => 'A Promise to My Clients',
                'data'    => '{"title":{"value":"A Promise to my Clients","limit":50,"type":"text"},"sub_title":{"value":"My duties to you","limit":85,"type":"text"},"content":{"value":"As your real estate agent, in addition to any duties or commitments set forth in our listing agreement, my fiduciary duties to you include but are not limited to:","limit":300,"type":"textarea"},"point_1_title":{"value":"Loyalty","limit":50,"type":"text"},"point_1_content":{"value":"Loyalty is my first and foremost duty to you. This means that I must act with your best interest in mind, to the exclusion of all other interests including my own.","limit":300,"type":"textarea"},"point_2_title":{"value":"Confidentiality","limit":50,"type":"text"},"point_2_content":{"value":"As your agent I am obligated to safeguard your confidence and secrets. I therefore, must keep confidential any information that might weaken your bargaining position if it were revealed.","limit":300,"type":"textarea"},"point_3_title":{"value":"Disclosure","limit":50,"type":"text"},"point_3_content":{"value":"As your agent, I am responsible to disclose to you, all relevant and material information that I know might affect your ability to obtain the highest price and best terms in the sale of your property.","limit":300,"type":"textarea"},"point_4_title":{"value":"Obedience","limit":50,"type":"text"},"point_4_content":{"value":"As your agent, I am bound to obey promptly and efficiently all lawful instructions that you give me pertaining to the sale of your property.","limit":300,"type":"textarea"},"point_5_title":{"value":"Reasonable care & diligence","limit":50,"type":"text"},"point_5_content":{"value":"To assist you in your real estate transaction, the standard of care expected of me, by you, should be that of a competent real estate professional.","limit":300,"type":"textarea"},"point_6_title":{"value":"Accounting","limit":50,"type":"text"},"point_6_content":{"value":"As your realtor, I am bound to safeguard any money, deeds, or other documents you entrust to me, related to your real estate transaction.","limit":300,"type":"textarea"}}',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $posts = $this->table('lp_widget_report_content');
        $posts->insert($data)
              ->save();
    }
}
