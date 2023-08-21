<?php
    $availableCompareAble = sizeof($areaSalesAnalysis['comparable']);
    $rangeOfSales['avaiProperty'] = 0;
    $rangeOfSales['sQFootage']=0;
    $rangeOfSales['avgNoOfBeds'] = 0;
    $rangeOfSales['avgNoOfBaths'] = 0;
    $minRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
    $maxRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
    // echo "<pre>";
    // print_r($areaSalesAnalysis);die;
    foreach ($areaSalesAnalysis['comparable'] as $key => $cpmrebl) {
        if($key>8){
            break;
        }
        $cpmrebl['BuildingArea'] = !empty($cpmrebl['BuildingArea']) ? $cpmrebl['BuildingArea'] :  0;
        $cpmrebl['Beds'] = !empty($cpmrebl['Beds']) ? $cpmrebl['Beds'] :  0;
        $cpmrebl['Baths'] = !empty($cpmrebl['Baths']) ? $cpmrebl['Baths'] :  0;
        $rangeOfSales['avaiProperty']++;
        $rangeOfSales['sQFootage']+= $cpmrebl['BuildingArea'];
        $rangeOfSales['avgNoOfBeds']+= $cpmrebl['Beds'];
        $rangeOfSales['avgNoOfBaths'] += $cpmrebl['Baths'];

        if($minRange> $cpmrebl['PriceRate']){
            $maxRange= $cpmrebl['PriceRate'];
        }

        if($maxRange< $cpmrebl['PriceRate']){
            $maxRange= $cpmrebl['PriceRate'];
        }
    }

    $rangeOfSales['sQFootage'] = $rangeOfSales['sQFootage']/$rangeOfSales['avaiProperty'];
    $rangeOfSales['avgNoOfBeds'] = $rangeOfSales['avgNoOfBeds']/$rangeOfSales['avaiProperty'];
    $rangeOfSales['avgNoOfBaths'] = $rangeOfSales['avgNoOfBaths']/$rangeOfSales['avaiProperty'];
    $no_of_pages =0 ;
    $no_of_pages = intval($availableCompareAble/3) ;
    
    if(($no_of_pages*3)<$availableCompareAble) {
        $no_of_pages++;
    }
    
    if($no_of_pages>3) {
        $no_of_pages=3;
    } else {

    } 

    $no_of_pages+=5;
    $_priceMinRange = round($areaSalesAnalysis['priceMinRange']);
    $_priceMaxRange = round($areaSalesAnalysis['priceMaxRange']);
    $rangeDiff= (int)$_priceMaxRange - (int)$_priceMinRange;
    $_sliderStartPoint = (int)$_priceMinRange - round($rangeDiff/8);
    $_sliderEndPoint = (int)$_priceMaxRange + round($rangeDiff/8);

?>
<div class="site-wrapper">
    <section class="article-wrapper">
        <div class="article-container">
            <div class="article-block">
                <div class="entry-content">
                    <h1>Makeup Essentials</h1>
                    <p>The ultimate guide to creating the ultimate makeup collection.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="tabs-wrapper">
        <div class="tabs-container">
            <div class="tabs-block">
                <div id="tabs-section" class="tabs">
                    <ul class="tab-head">
                        <?php 
                        $firstPage = $pageList[0];
                        foreach($titleList as $key => $val) { ?>
                        <li>
                            <a href="#tab-<?= $key ?>" class="tab-link <?= ($firstPage == $key) ? 'active' : '';?>">  <span class="tab-label"><?= $val ?></span></a>
                        </li>
                        <?php } ?>
                        <!-- <li>
                            <a href="#tab-2" class="tab-link"> <span class="material-icons tab-icon">visibility</span> <span class="tab-label">Foundation</span></a>
                        </li>
                        <li>
                            <a href="#tab-3" class="tab-link"> <span class="material-icons tab-icon">settings_input_hdmi</span> <span class="tab-label">BB Cream</span></a>
                        </li>
                        <li>
                            <a href="#tab-4" class="tab-link"> <span class="material-icons tab-icon">build</span> <span class="tab-label">Concealer</span></a>
                        </li>
                        <li>
                            <a href="#tab-5" class="tab-link"> <span class="material-icons tab-icon">toll</span> <span class="tab-label">Blush</span></a>
                        </li>
                        <li>
                            <a href="#tab-6" class="tab-link"> <span class="material-icons tab-icon">toll</span> <span class="tab-label">Test</span></a>
                        </li> -->
                    </ul>
                    
                    <?php 
                    // print_r($pageList);die;
                    foreach($pageList as $key => $val) { ?>
                    <section id="tab-<?= $val ?>" class="tab-body entry-content <?= ($seller_theme == 2) ? 'section-theme-2' : '';?>  <?= ($firstPage == $val) ? 'active active-content' : '';?>">
                    <?php 
                        if ($seller_theme == 2) {
                            $data = array();

                            if ($val == 11 || $val == 10) {
                                $comparable = isset($areaSalesAnalysis['comparable']) && !empty($areaSalesAnalysis['comparable']) ? $areaSalesAnalysis['comparable'] : array();

                                if (isset($comparable) && !empty($comparable)) {
                                    list($comparable_1, $comparable_2) = array_chunk($comparable, 4, true);
                                    if ($val == 10 && (isset($comparable_1) && !empty($comparable_1))) {
                                        $data['comparables'] = $comparable_1;
                                    }
                                    
                                    if ($val == 11 && (isset($comparable_2) && !empty($comparable_2))) {
                                        $data['comparables'] = $comparable_2;
                                        $val = 10;
                                    }
                                }
                            } elseif ($val == 11) {
                                $data = $rangeOfSales;
                                // $this->load->view('reports/english/seller/2/pages/11', $data);
                            }
                            $this->load->view('reports/english/seller/2/pages/' . $val, $data);
                        } else if ($seller_theme == 3) {
                            $data = array();

                            if ($val == 9 || $val == 10) {
                                $comparable = isset($areaSalesAnalysis['comparable']) && !empty($areaSalesAnalysis['comparable']) ? $areaSalesAnalysis['comparable'] : array();

                                if (isset($comparable) && !empty($comparable)) {
                                    list($comparable_1, $comparable_2) = array_chunk($comparable, 4, true);
                                    if ($val == 9 && (isset($comparable_1) && !empty($comparable_1))) {
                                        $data['comparables'] = $comparable_1;
                                    }
                                    
                                    if ($val == 10 && (isset($comparable_2) && !empty($comparable_2))) {
                                        $data['comparables'] = $comparable_2;
                                        $val = 9;
                                    }
                                }
                            } elseif ($val == 11) {
                                $data = $rangeOfSales;
                                // $this->load->view('reports/english/seller/2/pages/11', $data);
                            }
                            $this->load->view('reports/english/seller/3/pages/' . $val, $data);
                        } else {
                            if ($val == 1) {
                                $this->load->view('reports/english/seller/pages/1');
                            }
                            
                            if ($val == 2) {
                                $this->load->view('reports/english/seller/pages/2');
                            }
                            if ($val == 3) {
                                $this->load->view('reports/english/seller/pages/4');
                            }
                            if ($val == 4) {
                                $this->load->view('reports/english/seller/pages/5');
                            }
                            if ($val == 5) {
                                $this->load->view('reports/english/seller/pages/5b');
                            }
                            if ($val == 6) {
                                $this->load->view('reports/english/seller/pages/5c');
                            }
                            if ($val == 8) {
                                $this->load->view('reports/english/seller/pages/5e',$rangeOfSales);
                            }
                            if ($val == 9) {
                                $this->load->view('reports/english/seller/pages/5h', $customization_pages_data['9']);
                            }
                            if ($val == 10) {
                                $this->load->view('reports/english/seller/pages/5f', $customization_pages_data['10']);
                            }
                            if ($val == 11) {
                                $this->load->view('reports/english/seller/pages/5g', $customization_pages_data['11']);
                            }
                            if ($val == 12) {
                                $this->load->view('reports/english/seller/pages/5k', $customization_pages_data['12']);
                            }
                            if ($val == 13 || $val == 14 || $val == 15 ) {
                                $this->load->view('reports/english/seller/pages/6');
                            }
                            if ($val == 13) {
                                $this->load->view('reports/english/seller/pages/6c', $customization_pages_data['13']);
                            }
                            if ($val == 14) {
                                $this->load->view('reports/english/seller/pages/6d', $customization_pages_data['14']);
                            }
                            if ($val == 15) {
                                $this->load->view('reports/english/seller/pages/6e', $customization_pages_data['15']);
                            }
                            if ($val == 16) {
                                $this->load->view('reports/english/seller/pages/6f', $customization_pages_data['16']);
                            }
                            if ($val == 17) {
                                $this->load->view('reports/english/seller/pages/6g', $customization_pages_data['17']);
                            }
                            if ($val == 18) {
                                $this->load->view('reports/english/seller/pages/9d', $customization_pages_data['18']);
                            }
                            if ($val == 19) {
                                $this->load->view('reports/english/seller/pages/11b', $customization_pages_data['19']);
                            }
                            if ($val == 20) {
                                $this->load->view('reports/english/seller/pages/15');
                            }
                        }
                    ?>
                    </section>
                    <?php } ?>
                    <!-- <section id="tab-2" class="tab-body entry-content">
                        <h2>Foundation</h2>
                        <p>Foundation is probably the hardest part of your makeup routine to get right, as you not only have to consider the type of coverage you want (i.e. sheer/natural, medium, or full), but also your skin type and undertones.</p>
                        <p>If you are new to wearing foundation or aren’t sure what type/shade is right for you, I’d highly recommend going to your nearest Sephora, MAC, or department store and have a makeup artist help you pick out one that matches your complexion and fits your coverage needs. It’s also a good idea to request a sample if you want to see how a formula feels on your skin before buying.</p>
                    </section>

                    <section id="tab-3" class="tab-body entry-content">
                        <h2>BB Cream</h2>
                        <p>Personally, I prefer BB cream to regular foundation, as I find it to be much more natural-looking. It is a great option if you’re looking for something that has skincare benefits such as moisturizing or priming (some BB creams have primer built in).</p>
                        <p>In addition, if you are new to the makeup world, a good BB cream is an even better place to start than foundation, as it feels lighter on the skin, is hard to overdo, and can be applied with your fingers.</p>
                    </section>

                    <section id="tab-4" class="tab-body entry-content">
                        <h2>Concealer</h2>
                        <p>If you have acne, dark circles, or any kind of discoloration, concealer is a must-have.</p>
                        <p>Concealers come in full-coverage and sheerer-coverage formulations, and which one you should choose depends on how much you’re trying to cover up.</p>
                        <p>When choosing a concealer for acne and/or discoloration, find a shade that is as close as possible to your foundation/BB cream shade for the most natural look.</p>
                    </section>

                    <section id="tab-5" class="tab-body entry-content">
                        <h2>Blush</h2>
                        <p>Putting on blush can have a huge effect on your overall look, and I personally never leave it out of my makeup routine. Blush is especially necessary if you’re wearing a foundation with more opaque coverage, which can sometimes leave your complexion looking a little bit flat.</p>
                        <p>Blush comes in powder, gel, and cream formulations, with powder being the most popular. Recently, though, cream and gel blush have become very popular as well.</p>
                    </section>
                    <section id="tab-6" class="tab-body entry-content">
                        <h2>Blush</h2>
                        <p>Putting on blush can have a huge effect on your overall look, and I personally never leave it out of my makeup routine. Blush is especially necessary if you’re wearing a foundation with more opaque coverage, which can sometimes leave your complexion looking a little bit flat.</p>
                        <p>Blush comes in powder, gel, and cream formulations, with powder being the most popular. Recently, though, cream and gel blush have become very popular as well.</p>
                    </section> -->
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="credits"><a href="https://htmlcssfreebies.com/vertical-tabs-css/" target="_blank">Vertical Tabs CSS</a> by HTMLCSSFreebies.</div>
    </footer>
</div>