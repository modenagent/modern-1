<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Listing Pitch Report</title>
    <style media="all">
    *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}

@page { sheet-size: A4; }
@page bigger { sheet-size: 215.9mm 279.4mm; }
@page toc { sheet-size: A4; }


    @page .pdf-wrapper{margin:auto; color:#646466;}
    body{font-family:bariol; font-size:16px; color:#646466; max-width:100%;}
    body{
  -webkit-print-color-adjust:exact;
}
    h1{margin:0 .65in; font-weight:normal; padding:50px 0 0; color:#f15d3e; font-size:46px; line-height:46px;}
    .sub-head{font-size:22px; line-height:normal; padding:0 .65in 50px;}
    .index-content .sub-head{padding-bottom:150px;}
    h2{margin:0; padding:1.27in .65in .4in; font-weight:normal; color:#9e9fa3; font-size:32px; line-height:40px;}
    h2 b{font-weight:bold; color:#f15d3e; line-height:34px; font-size:56px; letter-spacing:-2.5px;}
    h3{font-weight:normal; color:#000; margin-bottom:10px;}
    h4{font-weight:300; text-transform:uppercase; font-size:20px; margin:0 0 5px;}
    .full-img{width:100%;}

    .area-sales-analysis .full-img{margin-bottom:30px;}
    .inner-content{margin:0 .66in;}
    .area-sales-analysis .inner-content, .sales-comparables .inner-content, .estimated-value-range .inner-content{margin:0 .75in;}
    .aerial-view p{margin:0;}
    .aerial-view .full-img{margin-top:30px;}
    .aerial-view h3{padding:50px 0 15px; margin:0; font-weight:bold;}
    img{max-width:100%;}
    .index, .index li{margin:0; padding:0; list-style:none; font-size:18px;}
    .index{padding-right:20px; margin-right:20px;  text-align:right; width:6.73in;}

    .index{padding-left:20px; border-left:2px solid #f15d3e; text-align:right; }
    .index li{padding:10px 0;}
    table{margin-bottom:20px;}
    table.list-table{font-size:16px;}
    table.list-table tr:nth-child(2n) td{background-color:#f5f7f8;}
    table.list-table tr:nth-child(2n+1) td{background-color:#fff;}
    .grey-bg{background-color:#f5f7f8; color:#000; -webkit-print-color-adjust: exact;}
    .red-title{color:#f15d3e; font-weight:bold;}
    .red-t-border{border-top:2px solid #f15d3e;}
    .grey-t-border, .grey-t-border td{border-top:1px solid #d9dbe0;}
    .agent-info-wrapper{padding:.5in 0; display:table; width:100%;}
    .agent-details{width:50%; display:block; float:left;}
    .agent-pic, .agent-info{float:left;}
    .agent-pic{width:125px; overflow:hidden; margin-left:.65in; border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px;}
    .agent-pic img{width:125px; height:auto; border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px;}
    .agent-info{font-size:14px; padding-left:15px;}
    .agent-info b{font-size:18px;}
    .agent-card{width:50%; text-align:right; display:block; float:right;}
    .agent-card .card-img{margin-right:.65in;}
    .clearfix:after,.clearfix:before{display:table;content:" ";}
    .footer{background-color:#f15d3e; -webkit-print-color-adjust: exact; font-size:22px; color:#fff; display:table; width:100%; padding:0 .68in;}
    .footer b{font-weight:bold; font-size:20px;}
    .f-left{text-align:left; display:block; width:50%; float:left;}
    .f-right{text-align:right; display:block; width:50%; float:right; padding-top:11px;}
    @media print
{
    * {-webkit-print-color-adjust:exact;}
}
    </style>
  </head>
  <body>
    <div class="pdf-wrapper">
                <!-- Intro -->
                <h2>LISTING PROPOSAL<br><b><?php echo $property->PropertyProfile->SiteAddress ; ?></b><br><?php echo $property->PropertyProfile->SiteCity; ?>, <?php echo $property->PropertyProfile->SiteState ; ?> <?php echo $property->PropertyProfile->SiteZip; ?></h2>
                <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/map-top.jpg" alt=""/></div>
                <div class="agent-info-wrapper">
                  <div class="agent-details">
                    <div class="agent-pic">
                      <img src="<?php echo base_url().$user['profile_image']; ?>" width="125" style="width:125px; height:auto;" alt=""/>
                    </div>
                    <div class="agent-info">
                      <b><?php echo $user['fullname']; ?></b><br>
                      <?php echo $user['title']; ?><br>
                      CA BRE#<?php echo $user['licenceno']; ?><br>
                      Direct: <?php echo $user['phone']; ?><br>
                      <?php echo $user['email']; ?><br>
                      <?php echo $user['website']; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="agent-details">
                      <div class="agent-pic">
                        <img src="<?php echo base_url().$user['profile_image']; ?>" width="125" style="width:125px; height:auto;" alt=""/>
                      </div>
                      <div class="agent-info">
                        <b><?php echo $user['fullname']; ?></b><br>
                        <?php echo $user['title']; ?><br>
                        CA BRE#<?php echo $user['licenceno']; ?><br>
                        Direct: <?php echo $user['phone']; ?><br>
                        <?php echo $user['email']; ?><br>
                        <?php echo $user['website']; ?>
                      </div>
                      <div class="clearfix"></div>
                  </div>

                  <div class="clearfix"></div>
                </div>
                <pagebreak type="NEXT-EVEN" pagenumstyle="1" />
                <!-- Intro End -->
          
                <!-- Page 2 -->
                <div class="index-content">
                  <h1>CONTENTS</h1>
                  <div class="sub-head">What is in your listing proposal</div>
                  <ul class="index">
                    <li> aerial snaphot &nbsp;&nbsp;<span>&nbsp;3&nbsp;</span></li>
                    <li>property information &nbsp;&nbsp;<span>&nbsp;4&nbsp;</span></li>
                    <li>area sales analysis &nbsp;&nbsp;<span>&nbsp;5&nbsp;</span></li>
                    <li>sales comparables &nbsp;&nbsp;<span>&nbsp;6-8&nbsp;</span></li>
                    <li>estimated sales price &nbsp;&nbsp;<span>&nbsp;9&nbsp;</span></li>
                    <li>selling roadmap &nbsp;&nbsp;<span>&nbsp;10&nbsp;</span></li>
                    <li>how buyers find homes &nbsp;&nbsp;<span>&nbsp;11&nbsp;</span></li>
                    <li>pricing correctly &nbsp;&nbsp;<span>&nbsp;12&nbsp;</span></li>
                    <li>average days on market &nbsp;&nbsp;<span>&nbsp;13&nbsp;</span></li>
                    <li>marketing action plan &nbsp;&nbsp;<span>&nbsp;14&nbsp;</span></li>
                    <li>analyze & optimize &nbsp;&nbsp;<span>&nbsp;15&nbsp;</span></li>
                    <li>negotiating offers &nbsp;&nbsp;<span>&nbsp;16&nbsp;</span></li>
                    <li>committment to you &nbsp;&nbsp;<span>&nbsp;17&nbsp;</span></li>
                  </ul>
                  <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 2 end -->
          
                <!-- page 3 -->
                <div class="aerial-view">
                  <h1>AERIAL VIEW</h1>
                  <div class="sub-head">Area we analyzed</div>
                  <div class="inner-content">
                    <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/map.jpg" alt="" style="width:6.9in; height:5.4in;" /></div>
                    <h3><b>Why a 2-Mile Radius?</b></h3>
                    <p>A 2-Mile radius gives the ideal range to accurately research properties that either have been sold or are actively listed and are similar to yours in regards to the number of bedrooms, bathrooms, living area (sqft), and property lot size.</p>
                  </div>
                  <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 3 end -->
            
                <!-- page 4 -->
                <div class="your-property">
                  <h1>YOUR PROPERTY </h1>
                  <div class="sub-head">Overview of your property</div>
                  <div class="inner-content">
                    
                    <h4>OWNER, ADDRESS &amp; LEGAL DESCRIPTION</h4>
                    <table width="100%" border="0" cellspacing="0" cellpadding="6" class="list-table">
                      <tr>
                          <td colspan="2">Primary Owner: <?php echo $property->PropertyProfile->PrimaryOwnerName ; ?></td>
                      </tr>
                      <tr bgcolor="#f8f8f8 ">
                          <td colspan="2" bgcolor="#f8f8f8">Secondary Owner: <?php echo $property->PropertyProfile->PrimaryOwnerName ; ?></td>
                      </tr>
                      <tr>
                          <td colspan="2">Site Address: <?php echo $property->PropertyProfile->SiteAddress.', '. $property->PropertyProfile->SiteCity.', '. $property->PropertyProfile->SiteState ; ?></td>
                      </tr>
                      <tr bgcolor="#f8f8f8">
                          <td colspan="2" bgcolor="#f8f8f8">Mailing Address: <?php echo $property->PropertyProfile->MailAddress.', '. $property->PropertyProfile->MailCity.', '. $property->PropertyProfile->MailState ; ?></td>
                      </tr>
                      <tr>
                          <td width="50%">APN: <?php echo $property->PropertyProfile->APN; ?> </td>
                          <td width="50%">Country Name: San Bernardino</td>
                      </tr>
                      <tr bgcolor="#f8f8f8">
                          <td bgcolor="#f8f8f8">Census Tract: <?php echo $property->PropertyProfile->CensusTract; ?></td>
                          <td bgcolor="#f8f8f8">Housing Tract #: <?php echo $property->PropertyProfile->HousingTract; ?></td>
                      </tr>
                      <tr>
                          <td>Lot Number: 11</td>
                          <td>Page Grid:</td>
                      </tr>
                      <tr>
                        <td colspan="2"> Brief Legal Description:<br>
                          <p>&nbsp;</p>
                          <p>&nbsp;</p></td>
                      </tr>
                    </table>
                    
                    <h4>BEDS, BATHS, &amp; SQUARE FOOTAGE</h4>
                    <table width="100%" border="0" cellspacing="0" cellpadding="6" class="list-table">
                        <tr>
                            <td width="34%">Bedrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Bedrooms; ?></td>
                            <td width="33%">Year Built: <?php echo $property->PropertyProfile->PropertyCharacteristics->YearBuilt; ?></td>
                            <td width="33%">Square Feet: <?php echo $property->PropertyProfile->PropertyCharacteristics->BuildingArea; ?></td>
                        </tr>
                        <tr bgcolor="#f8f8f8">
                            <td width="34%" bgcolor="#f8f8f8">Bathrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Baths; ?></td>
                            <td width="33%" bgcolor="#f8f8f8">Garage: <?php echo $property->PropertyProfile->PropertyCharacteristics->GarageNumCars; ?></td>
                            <td width="33%" bgcolor="#f8f8f8">Lot Size: <?php echo $property->PropertyProfile->PropertyCharacteristics->LotSize; ?></td>
                        </tr>
                        <tr>
                            <td width="34%">Partial Bath: 2</td>
                            <td width="33%">Fireplace: <?php echo $property->PropertyProfile->PropertyCharacteristics->Fireplace1; ?></td>
                            <td width="33%"># of Units: <?php echo $property->PropertyProfile->PropertyCharacteristics->NumUnits; ?></td>
                        </tr>
                        <tr bgcolor="#f8f8f8">
                            <td width="34%" bgcolor="#f8f8f8">Total Rooms: <?php echo sizeof($property->PropertyProfile->PropertyCharacteristics->TotalRooms); ?></td>
                            <td width="33%" bgcolor="#f8f8f8">Pool/Spa: <?php echo $property->PropertyProfile->PropertyCharacteristics->Pool; ?></td>
                            <td width="33%" bgcolor="#f8f8f8">Zoning: <?php echo $property->PropertyProfile->PropertyCharacteristics->Zoning; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">Property Type: N/A</td>
                        </tr>
                        <tr bgcolor="#f8f8f8">
                            <td colspan="3" bgcolor="#f8f8f8">Use Code: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></td>
                        </tr>
                    </table>
                      
                    <h4>ASSESSED VALUE &amp; TAX DETAILS</h4>
                    <table width="100%" border="0" cellspacing="0" cellpadding="6" class="list-table">
                        <tr>
                            <td width="50%">Assessed Value: <?php echo $property->PropertyProfile->AssessmentTaxInfo->AssessedValue; ?></td>
                            <td width="50%">Tax Amount: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxAmount; ?></td>
                        </tr>
                        <tr bgcolor="#f8f8f8">
                            <td width="50%" bgcolor="#f8f8f8">Land Value: <?php echo $property->PropertyProfile->AssessmentTaxInfo->LandValue; ?></td>
                            <td width="50%" bgcolor="#f8f8f8">Tax Status: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxStatus; ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Improvement Value: <?php echo $property->PropertyProfile->AssessmentTaxInfo->ImprovementValue; ?></td>
                            <td width="50%">Tax Rate Area: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxRateArea; ?></td>
                        </tr>
                        <tr bgcolor="#f8f8f8">
                            <td width="50%" bgcolor="#f8f8f8">% Improvement: <?php echo $property->PropertyProfile->AssessmentTaxInfo->PercentImproved; ?>%</td>
                            <td width="50%" bgcolor="#f8f8f8">Tax Year: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxYear; ?></td>
                        </tr>
                    </table>

                  </div>
                    <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 4 end -->
                
                <!-- page 5 -->
                <div class="area-sales-analysis">
                  <h1>AREA SALES ANALYSIS</h1>
                  <div class="sub-head">Sales in the past 12 months</div>
                  <div class="inner-content">
                    <div class="full-img"><img src="https://chart.googleapis.com/chart?cht=bvs&chd=t:<?php echo $areaSalesAnalysis['chart']['series']; ?>&chs=700x400&chl=<?php echo $areaSalesAnalysis['chart']['date']; ?>&chbh=60&chco=<?php echo $areaSalesAnalysis['chart']['color']; ?>&chds=a&chxt=y" alt="" style="margin:auto; width:100%; height:3.31in;" /></div>
                    <h4 style="text-align:center;">MONTHLY SALES OVERVIEW</h4>
                    <table width="100%" border="0" cellspacing="0" cellpadding="6">
                      <tr>
                        <td width="20%"></td>
                        <td width="20%" class="red-title">YOUR PROPERTY</td>
                        <td width="20%" class="red-title">LOW</td>
                        <td width="20%" class="red-title">MEDIAN</td>
                        <td width="20%" class="red-title">HIGH</td>
                      </tr>
                      


                      <tr class="grey-t-border">
                          <td width="20%" >DISTANCE</td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%">BLDG/LIVING AREA:</td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaLivingAreaLow']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaLivingAreaMedian']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaLivingAreaHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%" >PRICE PER SQFT:</td>
                          <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootLow']; ?></td>
                          <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootLow']; ?></td>
                          <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootMedian']; ?></td>
                          <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%">YEAR BUILT:</td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaYearMedian']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaYearHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%" >LOT SIZE:</td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSizeLow']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSizeMedian']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSizeHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%">BEDROOMS:</td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaLotSizeHigh']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaBedroomsLow']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaBedroomsMedian']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaBedroomsHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%" >BATHS:</td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaBedroomsHigh']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaBathsLow']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaBathsMedian']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaBathsHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%">STORIES:</td>
                          <td width="20%"><?php echo $areaSalesAnalysis['stories']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['stories']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['stories']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['stories']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%" >POOL:</td>
                          <td width="20%"><?php echo $areaSalesAnalysis['propertyPool']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['propertyPool']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['propertyPool']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['propertyPool']; ?></td>
                      </tr>
                      <tr>
                        <td class="red-t-border"><b>SALES PRICE:</b></td>
                        <td class="red-t-border"><b>S265,000</b></td>
                        <td class="red-t-border"><b>S265,000</b></td>
                        <td class="red-t-border"><b>S270,000</b></td>
                        <td class="red-t-border"><b>S325,000</b></td>
                      </tr>

                    </table>
                  </div>
                  <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 5 end -->
                  
                <!-- page 6 -->
                <div class="sales-comparables">
                    <h1>SALES COMPARABLES</h1>
                    <div class="sub-head">Properties that have recently sold.</div>
                    <div class="inner-content">
                      <table width="100%" border="0" cellspacing="0" cellpadding="8">
                        <?php

                          foreach ($areaSalesAnalysis['comparable'] as $key => $item) {
                        ?>
                          
                          <tr>
                            <td width="40%">
                            
                            <table width="100%" border="0" cellspacing="5" cellpadding="5" style="font-family:Helvetica, Arial, sans-serif; font-size:14px;">
                  
                              <tr>
                                  <td colspan="2">
                                    <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=18&size=250x80&maptype=satellite&markers=color:yellow%7Clabel:S%7C<?php echo $item['Latitude'].','.$item['Longitude']; ?>" width="250" height="80"  alt=""/>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="-webkit-print-color-adjust: exact; background:#f15d3e -webkit-print-color-adjust: exact; color:#fff; font-size:18px;" bgcolor="#f15d3e">Sale Price:</td>
                                  <td bordercolor="#f15d3e" style="border:1px solid #f15d3e; font-size:18px;"><?php echo $item['Price']; ?></td>
                                
                              </tr>
                            </table>

                            </td>
                            <td width="60%">
                              
                            <table width="100%" border="0" cellspacing="5" cellpadding="5" style="font-family:Helvetica, Arial, sans-serif; font-size:14px;">
                  
                                   <tr>
                                      
                                      <td bgcolor="#f8f8f8">Unit Type</td>
                                      <td bgcolor="#f8f8f8">Dist.</td>
                                      <td bgcolor="#f8f8f8">Sqft.</td>
                                      <td bgcolor="#f8f8f8">$/Sqft</td>
                                    </tr>
                                    <tr>
                                      
                                      <td>N/A</td>
                                      <td><?php echo $item['Distance']; ?></td>
                                      <td><?php echo $item['SquareFeet']; ?></td>
                                      <td>$<?php echo $item['Price']; ?></td>
                                      
                                    </tr>
                                    <tr>
                                      
                                      <td bgcolor="#f8f8f8">Bed/Bath</td>
                                      <td bgcolor="#f8f8f8">Year Blt</td>
                                      <td bgcolor="#f8f8f8">Lot Area</td>
                                      <td bgcolor="#f8f8f8">Pool</td>
                                    </tr>
                                    <tr>
                                     
                                      <td><?php echo $item['Beds']; ?>/<?php echo $item['Baths']; ?></td>
                                      <td><?php echo $item['Year']; ?></td>
                                      <td><?php echo $item['LotSize']; ?></td>
                                      <td><?php echo $item['Pool']; ?></td>
                                    </tr>
                                    
                                  
                                
                              </table>
                            </td>
                          </tr>

                          <tr>
                              <td colspan="2">
                                <table>
                                      <td width="10%">&nbsp;</td>
                                      <td width="20%"style="border-bottom:1px solid #f15d3e;">&nbsp;</td>
                                      <td width="20%"style="border-bottom:1px solid #f15d3e;">&nbsp;</td>
                                      <td width="20%"style="border-bottom:1px solid #f15d3e;">&nbsp;</td>
                                      <td width="20%" style="border-bottom:1px solid #f15d3e;">&nbsp;</td>
                                      <td width="10%">&nbsp;</td>
                                  
                                </table>
                              </td>
                                      
                          </tr>
                                    
                         
                        <?php
                          }

                        ?>

                      </table>
                    </div>
                    <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 6 end -->
                    
                <!-- page 7  Reated Data Removed page 7-->
                <!-- page 7 end -->
                      
                <!-- page 8 -->
                <!-- page 8 end -->
                        
                <!-- page 9 -->
                <div class="estimated-value-range">
                          <h1>ESTIMATED VALUE RANGE</h1>
                          <div class="sub-head">Based on recent comparable sales</div>
                          <div class="inner-content">
                            <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/map.jpg" alt="" style="width:100%; height:3.31in;" /></div><br><br>
                            <p style="text-align:center;">A FEW FACTORS THAT HELP DETERMINE YOUR HOMES SALES PRICE</p>
                            <div><img src="<?php echo base_url(); ?>pdf/images/factor.png" width="100%" alt=""/><br><br>
                              <br>
                            <img src="<?php echo base_url(); ?>pdf/images/high-low.png" width="100%" alt=""/></div>
                          </div>
                          <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 9 end -->

                <!-- page 10 -->
                <div class="WHAT’S-NEXt">
                          <h1>WHAT’S NEX</h1>
                          <div class="sub-head">Does it help?</div>
                          <div class="inner-content">
                            <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/wht-next.png" alt="" style="width:100%; " /></div>
                            
                          </div>
                          <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 10 end -->
                        
                <!-- page 11 -->
                <div class="HOW-BUYERS-FIND-A-HOME ">
                          <h1>HOW BUYERS FIND A HOME </h1>
                          <div class="sub-head">Does it help?</div>
                          <div class="inner-content">
                            <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/fnd-a-home.png" alt="" style="width:100%; height:4.447in; " /></div>
                            <p >Most buyers now begin their search online either at home, on their break at work, but more often than not on their mobile device.  Since more than 80% of buyers begin their home search online they are simultaneously taking the opportunity to educate themselves on the buying process. So today’s buyer is now more informed than every but will still rely on a realtor to guide them through the transaction. The typical home buyer takes about 3 months to purchase his home which means they have been looking for 2 months before your decided to sell your home</p>
                     
                            <table width="100%" border="0" cellspacing="0" cellpadding="8" valign="top">
                              
                              <tbody>
                                <tr>
                                  <td width="60%">
                                    <h4><b >“ Home Shoppers Rely on Agents and Open Houses to Bring Their Online Research Into the Real World “
                                    </b></h4>
                                    <p>With all this valuable data we are going to take advantage and are going to place your property where it’s going to gain maximum exposure to prospective buyers. </p>
                                    <td width="40%" >
                             <table width="100%" cellspacing="0" cellpadding="0" border="0" valign="top">
                                        <tbody>
                                        <tr>
                                        <td align="left" valign="top">
                                
                                     <img src="<?php echo base_url(); ?>pdf/images/place-2.png" alt=""  style="margin-bottom:-150px" />
                                      <br>
                                      <table width="90%" align="center"  cellspacing="5" cellpadding="5" border="0" valign="top" >
                                        <tbody>
                                          <tr><td align="left" >  <h4  style="color: rgb(233, 93, 65);  font-size: 15px;">First Time Vs. Repeat Buyers </h4></td></tr>
                                          <tr><td><p style="  font-size: 12px;">First-time buyers: 38% <br>
                                        Median age of first-time buyers: 31<br>
                                        Median age of repeat buyers: 52<br>
                                        Median income of first-time buyers: $64,400<br>
                                        Median income of repeat buyers: $96,000
                                      </p></td></tr>
                                        </tbody>

                                      </table>
  
                                      </td></tr>
                                      </tbody></table>

                                     
                                  
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                              
                          </div>
                          <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 11 end -->

                <!-- page 12 -->
                <div class="PRICING-CORRECTLY ">
                            <h1>PRICING CORRECTLY</h1>
                            <div class="sub-head">What you should consider</div>
                            <div class="inner-content">
                              <p>Days on market has a direct correlation with a buyers interest level in your property. Depending on the geographic area of your home the number of days that your home is on the market can vary. Currently the market is in an upswing and the shortage of inventory is leading to homes flying off the market. Currently the market is in an upswing and the shortage of inventory is leading to homes flying off the market. Currently the market is in an upswing and the shortage of inventory is leading to homes flying off the market.
                              </p>
                              <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/pricing-money.png" alt="" style="width:100%;  " /></div><br>
                              
                              <table width="100%" border="0" cellspacing="0" cellpadding="8">
                                
                                <tbody>
                                  <tr>
                                    <td width="50%">
                                      <h4><b >2. DOES IT HELP? </b></h4>
                                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and industry,</p>
                                    </td>
                                    <td width="50%">
                                      <h4><b >2. DOES IT HELP?</b></h4>
                                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and industry, </p>
                                    </td>
                                    
                                  </tr>
                                </tbody>
                              </table>
                              
                            </div>
                            <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 12 end -->

                <!-- page 12 -->
                <div class="days-in-market ">
                            <h1>AVERAGE DAYS ON MARKET</h1>
                            <div class="sub-head">What you should consider</div>
                            <div class="inner-content">


                              <table width="100%" cellspacing="0" cellpadding="8" border="0" style="margin-bottom:-20px;">
                                
                                <tbody>
                                  <tr>
                                    <td width="40%" align="center" valign="top" >
                                      
                                      <table width="100%" cellspacing="0" cellpadding="0" border="0" valign="top" >
                                        <tr>
                                          <td align="center" valign="top" height="250px"><img src="<?php echo base_url(); ?>pdf/images/bg-round.png" style="margin-bottom:-200px;">
                                          <span style=" color:#fff;font-size: 120px; height: 250px;line-height: 2;" >66</span></td>
                                        </tr>
                                        <tr>
                                        <td align="center" valign="top">
                                        <br>
                                      <h4>Avg. Days On Market</h4>
                                      </td></tr>
                                      </table>
                                    
                                       
                                      
                                     
                                    </td>
                                    <td width="60%">
                                    <p>Days on market has a direct correlation with a buyers interest level in your property. Depending on the geographic area of your home the number of days that your home is on the market can vary. Currently the market is in an upswing and the shortage of inventory is leading to homes flying off the market.<br>
                                    There are a few factors that come into play when attempting to determine how long it will take these factors are: 
                                    <br>     <br>
                                   </p><table width="100%" cellspacing="0" cellpadding="8" border="0">
                                      <thead style=" -webkit-print-color-adjust: exact; color:#4c4d4f; font-weight: bold;">
                                        <tr bgcolor="#e7e7e8">
                                          <th  style="-webkit-print-color-adjust: exact;">Market</th> <th  style="-webkit-print-color-adjust: exact;">Season</th> <th  style="-webkit-print-color-adjust: exact;">Economy</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td align="center" style="font-size:12px; border:  1px solid rgb(221, 221, 221);">A market can be a geographic location or type of housing. So if a certain excletic neighborhood is deemed desirable that create demand which will lead to homes being sold quickly.
                                         </td>
                                         <td align="center" style=" font-size:12px; border: 1px solid rgb(221, 221, 221);">When someone is looking to pack up and move they typically would do so in good weather. So if your home is listed during the winter or the rainy season this may add to days on market.
                                         </td>
                                         <td align="center" style="font-size:12px; border: 1px solid rgb(221, 221, 221);">
                                          When interest rates are low the typical median home price tends to rise. During this time motivated buyers take less time to commit to a home which leads to less time on market and quicker sales
                                         </td>


                                        </tr>
                                      </tbody>
                                    </table>
                                          <p></p> 
                                    </td>
                                    
                                  </tr>
                                </tbody>
                              </table>

                              <div class="full-img" style=" position:relative;"><img src="<?php echo base_url(); ?>pdf/images/day-market.png" alt="" style="width:100%;  " /></div><br>
                              
                          
                              
                            </div>
                            <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 12 end -->

                <!-- page 13 -->
                <div class="marketing-plan ">
                            <h1>MARKETING ACTION PLAN </h1>
                            <div class="sub-head">Getting Started</div>
                            <div class="inner-content">


                             

                              <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/action-plan.png" alt="" style="width:100%;  " /></div><br>
                              
                          
                              
                            </div>
                            <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 13 end -->

                <!-- page 14 -->
                <div class="marketing-plan ">
                            <h1>MARKETING ACTION PLAN </h1>
                            <div class="sub-head">Getting Started</div>
                            <div class="inner-content">
                              <p>When your property first hits the market the entire audience which consists of realtors, prospective buyers, and sellers all place eyes on your listing. They all make rapid judgements to as to it’s price, condition, and location. How they first perceive it will determine the viewing activity over the next few weeks. If we receive no viewings we are facing the possibility that  that market as a whole is rejecting the value proposition of your listing. Our solution? Reduce the price.</p>

                              <p>Reducing the price on your home is never an easy call but often time is a necessary one might need to be made in order to get your home sold. Many homeowners feel that they are giving up hard won equity that they have built but a slight reduction can help avoid problems down the line. The question is – When is the best time? How long do you wait from the time your home is placed on the market until you consider adjusting the sales price. The rule of thumb is about 30-45 days. </p>

                             

                              <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/listing-ex.png" alt="" style="width:100%;  " /></div><br>
                              
                          
                              <p>Joe and Jane went from being very competitively priced to being the highest property in their price range. From a buyer’s perspective, their home now offers the worst value proposition in the marketplace.
                              </p>
                            </div>
                            <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 14 end -->

                <!-- page 15 -->
                <div class="NEGOTIATING-OFFERS ">
                            <h1>NEGOTIATING OFFERS</h1>
                            <div class="sub-head">Does it help?</div>
                            <div class="inner-content">

                                <table width="100%" cellspacing="0" cellpadding="8" border="0">
                                  
                                  <tbody>
                                    <tr>
                                      <td width="60%">
                                        
                                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                        </p>
                                         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                        </p>
                                         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                                        </p>


                                      </td>
                                      <td width="40%"> <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/agent-offer.png" alt="" style="width:100%;  " /></div></td>
                                    </tr>
                                  </tbody>
                                </table>

                            </div>
                            <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 15 end -->


                <!-- page 16 -->
                <div class="TYPICAL-TRANSACTION  ">
                            <h1>TYPICAL TRANSACTION </h1>
                            <div class="sub-head">Does it help?</div>
                            <div class="inner-content">
                              <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/typ-trans.png" alt="" style="width:100%;  " /></div>
                                

                            </div>
                            <pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 16 end -->

                <!-- page 16 -->
                <div class="TYPICAL-TRANSACTION  ">
                            <h1>A PROMISE TO MY CLIENTS </h1>
                            <div class="sub-head">Does it help?</div>
                            <div class="inner-content">
                               <p style="font-size:18px; color:#f15d3e;">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and Lorem Ipsum is simply dummy text of the</p>

                               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and </p>

                               <p align="right"><img src="<?php echo base_url(); ?>pdf/images/sign.png" width="50%"  /></p>
                                      

                            </div>
                       
                </div>
                <!-- page 16 end -->


    </div>
  </body>
</html>
