<?php

$availableCompareAble = sizeof($areaSalesAnalysis['comparable']);
$sQFootage = 0;
$avgNoOfBeds = 0;
$avgNoOfBaths = 0;
$minRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
$maxRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
foreach ($areaSalesAnalysis['comparable'] as $key => $cpmrebl) {
    if ($key > 8) {
        break;
    }

    if ($minRange > $cpmrebl['PriceRate']) {
        $maxRange = $cpmrebl['PriceRate'];
    }

    if ($maxRange < $cpmrebl['PriceRate']) {
        $maxRange = $cpmrebl['PriceRate'];
    }
}

$priceMinRange = ($minRange - round(($minRange * 5 / 100), 2) / 1000);
$priceMaxRange = ($maxRange + round(($maxRange * 5 / 100), 2) / 1000);

$no_of_pages = 0;

$no_of_pages = intval($availableCompareAble / 3);
if (($no_of_pages * 3) < $availableCompareAble) {
    $no_of_pages++;
}
if ($no_of_pages > 3) {
    $no_of_pages = 3;
} else {

}
$no_of_pages += 5;

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Listing Pitch Report</title>
    <style media="all">
*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
/*@page { sheet-size: A4; margin: 0; padding: 0;}*/
/*@page bigger { sheet-size: 215.9mm 279.4mm; }*/
/*@page toc { sheet-size: A4; }*/
/*@page .pdf-wrapper{margin:auto; color:#646466;}*/

body{font-family:bariol; font-size:16px; color:#646466; max-width:100%;}
body{
-webkit-print-color-adjust:exact;
margin: 0; padding: 0;
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
/*.index, .index li{margin:0; padding:0; list-style:none; font-size:18px;}
.index{padding-right:20px; margin-right:20px;  text-align:right; width:6.73in;}
.index{padding-left:20px;  text-align:right; }*/
.index {line-height: 2;}

    table{margin-bottom:20px;}
    table.list-table{font-size:14px;}
    table.list-table tr:nth-child(2n) td{background-color:#f5f7f8;}
    table.list-table tr:nth-child(2n+1) td{background-color:#fff;}
    .grey-bg{background-color:#f5f7f8; color:#000; -webkit-print-color-adjust: exact;}
    .red-title{color:#f15d3e; font-weight:bold;}
    .red-t-border{border-top:2px solid #f15d3e;}
     .red-b-border{border-top:2px solid #f15d3e;}
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

    <htmlpagefooter name="MyFooter1">

    <table width="100%" border="0"   cellspacing="0" cellpadding="0" align="center" style=" background-color:#f15d3e; ">
      <tr>
        <td bg="#f15d3e" >
          <table width="89%" border="0" cellspacing="0" cellpadding="15" style="max;height:50px;overflow:hidden; " align="center">
            <tr>
              <td align="left" width="50%" bgcolor="#f15d3e" style="font-ize:38px;color:#fff;">
                <strong >Listing Proposal</strong>

                <div style=" position:relative; left:10;"><?php echo $property->PropertyProfile->SiteAddress; ?></div>
              </td>
              <td align="right" bgcolor="#f15d3e" style="color:#fff; margin-right:90px;  overflow:hidden;">
                Page {PAGENO}
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

  </htmlpagefooter>

  <htmlpagefooter name="MyFooter2">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color:#084887; display:none;">

    </table>

  </htmlpagefooter>


    <div class="pdf-wrapper">
                <!-- Intro -->
                <h2>LISTING PROPOSAL<br><b><?php echo $property->PropertyProfile->SiteAddress; ?></b><br><?php echo $property->PropertyProfile->SiteCity; ?>, <?php echo $property->PropertyProfile->SiteState; ?> <?php echo $property->PropertyProfile->SiteZip; ?></h2>
                <div class="full-img">
                  <img src="<?php echo base_url(); ?>pdf/images/map-top.jpg" alt="" style="width:100%"/>

                </div>
                <div class="map-marker" style="position:relative;width: 100%;margin-top: -340px; margin-bottom: 220px;text-align: center;"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                   width="90px" height="110px" viewBox="0 0 300.000000 416.000000"
                   preserveAspectRatio="xMidYMid meet">
                  <metadata>
                  Created by potrace 1.10, written by Peter Selinger 2001-2011
                  </metadata>
                  <g transform="translate(0.000000,416.000000) scale(0.100000,-0.100000)"
                  fill="#f15d3e" stroke="none">
                  <path d="M1340 4148 c-596 -66 -1122 -534 -1284 -1142 -54 -202 -64 -402 -27
                  -540 102 -379 531 -1129 1156 -2021 182 -261 308 -435 315 -435 7 0 328 452
                  476 670 627 922 966 1555 1014 1894 11 76 -4 253 -32 371 -135 579 -572 1034
                  -1123 1170 -173 42 -322 52 -495 33z m280 -832 c252 -45 459 -227 536 -470
                  114 -363 -84 -746 -451 -868 -59 -19 -90 -23 -205 -23 -115 0 -146 4 -205 23
                  -338 112 -540 452 -471 791 76 374 425 613 796 547z"/>
                  </g>
                  </svg>
                </div>
                <div class="agent-info-wrapper">
                  <div class="agent-details">
                    <div class="agent-pic">
                      <img src="<?php echo base_url() . $user['profile_image']; ?>" width="125" style="width:125px; height:auto;" alt=""/>
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
                  <?php if ($partner) {?>

                  <div class="agent-details">
                      <div class="agent-pic">
                        <img src="<?php echo base_url() . $partner['profile_image']; ?>" width="125" style="width:125px; height:auto;" alt=""/>
                      </div>
                      <div class="agent-info">
                        <b><?php echo $partner['fullname']; ?></b><br>
                        <?php echo $partner['title']; ?><br>
                        CA BRE#<?php echo $partner['licenceno']; ?><br>
                        Direct: <?php echo $partner['phone']; ?><br>
                        <?php echo $partner['email']; ?><br>
                        <?php echo $partner['website']; ?>
                      </div>
                      <div class="clearfix"></div>
                  </div>

                  <?php } else {
    ?>

                  <div class="agent-details">
                      <div class="agent-pic" style="margin-left:130px;">
                        <img src="<?php echo base_url() . $user['company_logo']; ?>" width="125" style="width:125px; height:auto;" alt=""/>
                      </div>
                      <div class="clearfix"></div>
                  </div>

                  <?php
}?>

                  <div class="clearfix"></div>
                </div>

                <sethtmlpagefooter name="MyFooter2" value="on"  show-this-page="0"/>
                <pagebreak type="NEXT-EVEN" pagenumstyle="1" />
                <!-- Intro End -->

                <!-- Page 2 -->
                <div class="index-content">
                  <h1>CONTENTS</h1>
                  <div class="sub-head">What is in your listing proposal <?php echo $minRange . '&nbsp;&nbsp;&nbsp;' . $maxRange; ?></div>

                  <table width="50%" align="right" cellpadding="10" cellspacing="0 ">
                    <tr class="index">
                      <td width7"60%" align="right"> aerial snaphot</td>

                      <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; 3</span></td>
                    </tr>
                     <tr class="index">
                     <td width="70%" align="right">property information</td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; 4</span></td>
                    </tr>

                      <tr class="index">
                     <td width="70%" align="right"> area sales analysis </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; 5</span></td>
                    </tr>

                      <tr class="index">
                     <td width="70%" align="right"> sales comparables </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; 6-<?php echo $no_of_pages++; ?></span></td>
                    </tr>

                      <tr class="index">
                     <td width="70%" align="right"> estimated sales price </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; <?php echo $no_of_pages++; ?></span></td>
                    </tr>

                      <tr class="index">
                     <td width="70%" align="right">selling roadmap</td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; <?php echo $no_of_pages++; ?></span></td>
                    </tr>

                      <tr class="index">
                     <td width="70%" align="right"> how buyers find homes </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; <?php echo $no_of_pages++; ?></span></td>
                    </tr>

                      <tr class="index">
                     <td width="70%" align="right"> pricing correctly </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; <?php echo $no_of_pages++; ?></span></td>
                    </tr>

                      <tr class="index">
                     <td width="70%" align="right">average days on market </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; <?php echo $no_of_pages++; ?></span></td>
                    </tr>

      <tr class="index">
                     <td width="70%" align="right"> marketing action plan </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; <?php echo $no_of_pages++; ?></span></td>
                    </tr>

      <tr class="index">
                     <td width="70%" align="right"> analyze & optimize </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; <?php echo $no_of_pages++; ?></span></td>
                    </tr>

      <tr class="index">
                     <td width="70%" align="right"> negotiating offers </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; <?php echo $no_of_pages++; ?></span></td>
                    </tr>

      <tr class="index">
                     <td width="70%" align="right"> committment to you </td>

                       <td width="30%">&nbsp;&nbsp;<span style="padding-left: 20px;border-left: 2px solid #f15d3e;" >&nbsp;&nbsp; <?php echo $no_of_pages++; ?></span></td>
                    </tr>



                  </table>

                  <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 2 end -->

                <!-- page 3 -->
                <div class="aerial-view">
                  <h1>AERIAL VIEW</h1>
                  <div class="sub-head">Area we analyzed</div>
                  <div class="inner-content">
                    <div class="full-img">
                    <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=663x519&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:f15d3e%7Clabel:S%7C<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>" alt="" style="width:6.9in; height:5.4in;" /></div>
                    <h3><b>Why a 2-Mile Radius?</b></h3>
                    https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=663x519&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:f15d3e%7Clabel:S%7C<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>
                    <p>A 2-Mile radius gives the ideal range to accurately research properties that either have been sold or are actively listed and are similar to yours in regards to the number of bedrooms, bathrooms, living area (sqft), and property lot size.</p>
                  </div>
                  <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
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
                          <td colspan="2">Primary Owner: <?php echo $property->PropertyProfile->PrimaryOwnerName; ?></td>
                      </tr>
                      <tr bgcolor="#f8f8f8 ">
                          <td colspan="2" bgcolor="#f8f8f8">Secondary Owner: <?php echo $property->PropertyProfile->PrimaryOwnerName; ?></td>
                      </tr>
                      <tr>
                          <td colspan="2">Site Address: <?php echo $property->PropertyProfile->SiteAddress . ', ' . $property->PropertyProfile->SiteCity . ', ' . $property->PropertyProfile->SiteState; ?></td>
                      </tr>
                      <tr bgcolor="#f8f8f8">
                          <td colspan="2" bgcolor="#f8f8f8">Mailing Address: <?php echo $property->PropertyProfile->MailAddress . ', ' . $property->PropertyProfile->MailCity . ', ' . $property->PropertyProfile->MailState; ?></td>
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
                    <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 4 end -->

                <!-- page 5 -->
                <div class="area-sales-analysis">
                  <h1>AREA SALES ANALYSIS</h1>
                  <div class="sub-head">Sales in the past <?php echo $areaSalesAnalysis['totalMonthsReport']; ?> months</div>
                  <div class="inner-content">
                    <div class="full-img">
<?php
$series = $areaSalesAnalysis['chart']['series'];
$date = $areaSalesAnalysis['chart']['date'];
$color = $areaSalesAnalysis['chart']['color'];
$chartImageUrl = "https://quickchart.io/chart?cht=bvs&chd=t:$series&chs=700x400&chl=$date&chbh=40,30,45&chco=$color&chds=a&chxt=y";

/** Check chart image exist or not */
$headers = get_headers($chartImageUrl);
$httpStatus = intval(substr($headers[0], 9, 3));

// Check if the HTTP status code indicates success (200 OK)
if ($httpStatus === 200) {?>
    <img src="<?=$chartImageUrl?>"  alt="graph" style="margin:auto; width:100%; height:3.31in;">
<?php }?>
                      <!-- Google chart image api deprecated so we have implemented quickchart.io as an alternative  -->
                      <!-- <img src="https://chart.googleapis.com/chart?cht=bvs&chd=t:<?php echo $areaSalesAnalysis['chart']['series']; ?>&chs=700x400&chl=<?php echo $areaSalesAnalysis['chart']['date']; ?>&chbh=30,20,35&chco=<?php echo $areaSalesAnalysis['chart']['color']; ?>&chds=a&chxt=y" alt="" style="margin:auto; width:100%; height:3.31in;" /> -->
                    </div>

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
                          <td width="20%" ><?php echo 0; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaMinRadius']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaMedianRadius']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaMaxRadius']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%">LIVING AREA:</td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaLivingArea']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaLivingAreaLow']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaLivingAreaMedian']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaLivingAreaHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%" >PRICE PER SQFT:</td>
                          <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFoot']; ?></td>
                          <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootLow']; ?></td>
                          <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootMedian']; ?></td>
                          <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%">YEAR BUILT:</td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaYear']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaYearMedian']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaYearHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%" >LOT SIZE:</td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSize']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSizeLow']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSizeMedian']; ?></td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSizeHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%">BEDROOMS:</td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaBedrooms']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaBedroomsLow']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaBedroomsMedian']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['areaBedroomsHigh']; ?></td>
                      </tr>
                      <tr class="grey-t-border">
                          <td width="20%" >BATHS:</td>
                          <td width="20%" ><?php echo $areaSalesAnalysis['areaBaths']; ?></td>
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
                          <td width="20%"><?php echo $areaSalesAnalysis['propertyPoolLow']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['propertyPoolMedian']; ?></td>
                          <td width="20%"><?php echo $areaSalesAnalysis['propertyPoolHign']; ?></td>
                      </tr>
                      <tr>
                        <td class="red-t-border"><b>SALES PRICE:</b></td>
                        <td class="red-t-border"><b>$<?php echo $areaSalesAnalysis['propertySalePrice']; ?></b></td>
                        <td class="red-t-border"><b>$<?php echo $areaSalesAnalysis['propertySalePriceLow']; ?></b></td>
                        <td class="red-t-border"><b>$<?php echo $areaSalesAnalysis['propertySalePriceMedian']; ?></b></td>
                        <td class="red-t-border"><b>$<?php echo $areaSalesAnalysis['propertySalePriceLowHigh']; ?></b></td>
                      </tr>

                    </table>
                  </div>
                  <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 5 end -->

                <!-- page 6 -->
               <!--  <div class="sales-comparables">
                    <h1>SALES COMPARABLES</h1>
                    <div class="sub-head">Properties that have recently sold.</div>
                    <div class="inner-content">
                      <table width="100%" border="0" cellspacing="0" cellpadding="8"> -->
                        <?php

$avaiProperty = 0;
foreach ($areaSalesAnalysis['comparable'] as $key => $item) {
    $sQFootage += $item['SquareFeet'];
    $avgNoOfBeds += $item['Beds'];
    $avgNoOfBaths += $item['Baths'];
    if ($key > 8) {
        break;
    }
    ?>

                        <?php
if (($key % 3) == 0 && $key > 0) {

        echo '</table>
                                                                </div>
                                                                <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                                                </div>

                                                                ';
    }
    if (($key % 3) == 0) {

        echo '<div class="sales-comparables">
                                                      <h1>SALES COMPARABLES</h1>
                                                      <div class="sub-head">Properties that have recently sold.</div>
                                                      <div class="inner-content">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="8">
                                                  ';
    }
    ?>

                          <tr>
                            <td width="30%">

                            <table width="100%" border="0" cellspacing="2" cellpadding="2" style="font-family:Helvetica, Arial, sans-serif; font-size:14px;">

                              <tr>
                                  <td colspan="2">
                                    <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=12&size=180x100&maptype=roadmap&markers=color:f15d3e%7Clabel:S%7C<?php echo $item['Latitude'] . ',' . $item['Longitude']; ?>"
                                    style="width:2.23in; height:1.3in;"   alt=""/>

                                  </td>
                              </tr>
                              <tr>
                                  <td style="-webkit-print-color-adjust: exact; background:#f15d3e -webkit-print-color-adjust: exact; color:#fff; font-size:12px;  height:0.30in; " bgcolor="#f15d3e"> &nbsp;&nbsp;Sale Price:</td>
                                  <td bordercolor="#f15d3e" style="border:1px solid #f15d3e; font-size:12px;"><?php echo $item['Price']; ?></td>

                              </tr>
                            </table>

                            </td>
                            <td width="70%" >

                            <table width="100%" border="0" cellspacing="2" cellpadding="5" style=" font-size:18px; text-align:center;" >
                                  <tr>
                                      <td align="left" colspan="4"><b><?php echo $item['Address']; ?></b></td>
                                  </tr>
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
                                        <td  width="100%" colspan="2">
                                          <table  width="100%" border="0" cellspacing="2" cellpadding="5" >
                                            <tr>
                                              <td width="3%"></td>
                                              <td class="red-b-border" style="line-height: 0.5;" width="94%"  ></td>
                                              <td width="3%"></td>
                                            </tr>
                                          </table>
                                        </td>

                          </tr>


                        <?php

    $avaiProperty++;
}
$sQFootage = $sQFootage / $avaiProperty;

$avgNoOfBeds = $avgNoOfBeds / $avaiProperty;
$avgNoOfBaths = $avgNoOfBaths / $avaiProperty;
?>

                      </table>
                    </div>
                    <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
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
                            <div class="full-img"><img src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=663x420&maptype=satelite&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:f15d3e%7Clabel:S%7C<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude . ',' . $property->PropertyProfile->PropertyCharacteristics->Longitude; ?>" alt="" style="width:100%; height:3.31in;" /></div><br><br>
                            <p style="text-align:center;">A FEW FACTORS THAT HELP DETERMINE YOUR HOMES SALES PRICE</p>
                            <div style='background: url("<?php echo base_url(); ?>pdf/images/factor.png") 50% 0 no-repeat;'>
                            <img src="<?php echo base_url(); ?>pdf/images/factor.png" width="100%" alt=""/>
                            <table width="100%" cellspacing="0" cellpadding="8" border="0" style="margin-top:-100px;">
                              <tbody>
                                <tr>
                                  <td align="center" width="33%"><h3 style="font-size:48px; font-weight:bold; color:#fff;"><?php echo round($availableCompareAble, 2); ?></h3></td>
                                  <td align="center" width="33%"><h3 style="font-size:48px; font-weight:bold; color:#fff;"><?php echo round($sQFootage, 2); ?></h3></td>
                                  <td align="center" width="33%"><h3 style="font-size:48px; font-weight:bold; color:#fff;"><?php echo round($avgNoOfBeds, 2); ?></h3></td>
                                  <td align="center" width="33%"><h3 style="font-size:48px; font-weight:bold; color:#fff;"><?php echo round($avgNoOfBaths, 2); ?></h3></td>
                                </tr>
                              </tbody>
                            </table>
                            <br><br>
                              <br>
                            <img src="<?php echo base_url(); ?>pdf/images/high-low.png" width="100%" alt=""/></div>
                            <table width="100%" cellspacing="0" cellpadding="8" border="0" style="margin-top:-40px;">
                              <tbody>
                                <tr>
                                  <td align="left" width="50%"><h3 style="font-size:35px; font-weight:bold; color:#f15d3e;">
                                    $<?php

echo $priceMinRange . 'K'; ?></h3>
                                  </td>
                                  <td align="right" width="50%">
                                    <h3 style="font-size:35px; font-weight:bold; color:#f15d3e;">
                                      $<?php

echo $priceMaxRange . 'K';
?>
                                    </h3>
                                  </td>
                                </tr>
                              </tbody>
                            </table>

                          </div>
                          <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                </div>
                <!-- page 9 end -->

                <!-- page 10 -->
                      <div class="WHAT’S-NEXt">
                        <h1>WHAT’S NEX</h1>
                        <div class="sub-head">Presentation road map</div>
                        <div class="inner-content">
                          <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/wht-next.png" alt="" style="width:100%; " /></div>

                        </div>
                        <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                        </div>
                        <!-- page 10 end -->

                        <!-- page 11 -->
                        <div class="HOW-BUYERS-FIND-A-HOME ">
                          <h1>HOW BUYERS FIND A HOME </h1>
                          <div class="sub-head">Places they look most.</div>
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
                                <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                </div>
                                <!-- page 11 end -->
                                <!-- page 12 -->
                                <div class="PRICING-CORRECTLY ">
                                  <h1>PRICING CORRECTLY</h1>
                                  <div class="sub-head">Selling faster by setting the right price</div>
                                  <div class="inner-content" style="margin-top:-20px">
                                    <p>At any given time, there are plenty of buyers in the market looking for newly listed properties. As your agent I
                                    want to make sure to help you attract as many buyers as possible. One thing that can hinder this is setting the price too high. The key to getting your home sold as quickly as possible is to price it correctly from day 1. Many sellers have the tendency to want to list their home at a higher sales price than advised because; they hope to increase their profit or they assume that buyers always make low offers so it’s good to start high.
                                    </p>
                                    <div class="full-img" align="center"><img src="<?php echo base_url(); ?>pdf/images/pricing-money.png" alt="" style="width:90%;  " /></div><br>

                                    <table width="100%" border="0" cellspacing="0" cellpadding="8">

                                      <tbody>
                                        <tr>
                                          <td width="50%">
                                            <h4 style="color:#f15d3e;"><b  >1. On Market Longer </b></h4>
                                            <p>Properties that are over priced tend to stay on the market
                                            significantly longer than those that are priced to sell.</p>
                                          </td>
                                          <td width="50%">
                                             <h4 style="color:#f15d3e;"><b >3. Lost Time</b></h4>
                                            <p>Time lost in waiting for an offer can be time spent accepting
                                              offers, conducting inspections & opening escrow.</p>
                                          </td>

                                        </tr>

                                        <tr>
                                          <td width="50%">
                                             <h4 style="color:#f15d3e;"><b >2. Price Reduction</b></h4>
                                            <p>Overpriced properties will most certainly need to do atleast
                                              1 price reduction to regenerate interest in your property. </p>
                                          </td>
                                          <td width="50%">
                                             <h4 style="color:#f15d3e;"><b >4. Stigma Developed</b></h4>
                                            <p>As buyers see the property advertised over and over again,
they will start wondering if there’s something wrong with it.</p>
                                          </td>

                                        </tr>
                                      </tbody>
                                    </table>

                                  </div>
                                  <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                  </div>
                                  <!-- page 12 end -->
                                  <!-- page 12 -->
                                  <div class="days-in-market ">
                                    <h1>AVERAGE DAYS ON MARKET</h1>
                                    <div class="sub-head">How long will it take to sell your home.</div>
                                    <div class="inner-content">
                                      <table width="100%" cellspacing="0" cellpadding="8" border="0" style="margin-top:-20px;">

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
                                                  <p>Days on market has a direct correlation with a buyers interest level
                                                      in your property. Depending on the geographic area of your home
                                                      the number of days that your home is on the market can vary.
                                                      Currently the market is in an upswing and the shortage of
                                                      inventory is leading to homes flying off the market
                                                    <br>         <br>
                                                    There are a few factors that come into play when attempting to
                                                    determine how long it will take these factors are    <br>      <br>
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
                                        <div class="full-img" style=" position:relative;"><img src="<?php echo base_url(); ?>pdf/images/day-market.png" alt="" style="width:90%; margin-top:-47px;" /></div><br>



                                      </div>
                                      <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                      </div>
                                      <!-- page 12 end -->
                                      <!-- page 13 -->
                                      <div class="marketing-plan ">
                                        <h1>MARKETING ACTION PLAN </h1>
                                        <div class="sub-head">Getting maximum exposure for your home.</div>
                                        <div class="inner-content">
                                 <!--          <table width="100%" cellpadding="10" cellspacing="10">
                                            <tbody>
                                              <tr>
                                                <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home1.png" alt="" style="width:80%;  " /></td>
                                                <td width="20%">
                                                  <h4>Professional Photos</h4>
                                                  <p>Great pictures make great
                                                    first impressions. We’ll take
                                                    great photos to help us
                                                  showcase your home.</p>
                                                </td>
                                                <td width="20% " align="center"></td>
                                                <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home8.png" alt="" style="width:80%;  " /></td>
                                                 <td width="20%">
                                                <h4>Open House</h4>
                                                <p>Will schedule open house(s)
                                                  to help prospective buyers
                                                  & agents see your property
                                                in person.</p>
                                              </td>
                                            </tr>
                                              <tr>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home2.png" alt="" style="width:80%;  " /></td>
                                                 <td width="20%">

                                                  <h4>Luxury Yard Sign</h4>
                                                  <p>Yard signs are important
                                                      marketing tools that are
                                                      used on nearly 80% of all
                                                      homes on the market.</p>
                                                </td>
                                                 <td width="20%"></td>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home9.png" alt="" style="width:80%;  " /></td>
                                                  <td width="20%">
                                                <h4>Broker Preview</h4>
                                                <p>Will network with brokers to
                                                  showcase your property to
                                                  them so they can market it
                                                  to their network of buyers</p>
                                              </td>
                                            </tr>
                                             <tr>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home3.png" alt="" style="width:80%;  " /></td>
                                                 <td width="20%">
                                                  <h4>Property Brochure</h4>
                                                  <p>An elegant brochure for
                                                      prospective buyers that contains
                                                      property information
                                                      and vibrant pictures</p>
                                                </td>
                                                 <td width="20%"></td>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home10.png" alt="" style="width:80%;  " /></td>
                                                  <td width="20%">
                                                <h4>Marketing E-Blast</h4>
                                                <p>Will create an email campaign
                                                  that will alert our network
                                                  of prospective buyers
                                                  that your home is available</p>
                                              </td>
                                            </tr>

                                             <tr>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home4.png" alt="" style="width:80%;  " /></td>
                                                 <td width="20%">
                                                  <h4>Property Website</h4>
                                                  <p>A sure way to help your
                                                    property get the attention
                                                    it needs to sell quickly.<br>
                                                    *Optional</p>
                                                </td>
                                                 <td width="20%"></td>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home11.png" alt="" style="width:800%;  " /></td>
                                                  <td width="20%">
                                                <h4>Just Listed Mailing</h4>
                                                <p>Will create and mail out
                                                  just-listed postcards to the
                                                  nearest 500 homes surrounding
                                                  your property</p>
                                              </td>
                                            </tr>


                                            <tr>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home5.png" alt="" style="width:80%;  " /></td>
                                                 <td width="20%">
                                                  <h4>Submit to MLS</h4>
                                                  <p>Will place your property on
                                                      the MLS the largest Real
                                                      Estate Agent & Broker networking
                                                      in the nation.</p>
                                                </td>
                                                 <td width="20%"></td>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home12.png" alt="" style="width:80%;  " /></td>
                                                  <td width="20%">
                                                <h4>Home Staging</h4>
                                                <p>Will work with you to create
                                                    great curb appeal and get
                                                    your home in the best-selling
                                                    shape possible.</p>
                                              </td>
                                            </tr>

                                            <tr>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home6.png" alt="" style="width:80%;  " /></td>
                                                 <td width="20%">
                                                  <h4>Online Exposure</h4>
                                                  <p>Will showcase your home
                                                    on the largest buyer networks
                                                    in the nation; Trulia,
                                                    Zillow, Redfin, & Realtor.com</p>
                                                </td>
                                                 <td width="20%"></td>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home13.png" alt="" style="width:80%;  " /></td>
                                                 <td width="20%">
                                                <h4>In-office Networking</h4>
                                                <p>Will network with fellow real
                                                  estate agents in our office
                                                  to market your property to
                                                  their prospective buyers.</p>
                                              </td>
                                            </tr>

                                                 <tr>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home6.png" alt="" style="width:80%;  " /></td>
                                                 <td width="20%">
                                                  <h4>Just Listed Flyers</h4>
                                                  <p>Will create just listed flyers
                                                    that will used to inform
                                                    prospective buyers in your
                                                    neighborhood.</p>
                                                </td>
                                                 <td width="20%"></td>
                                                 <td width="20%" align="center"><img src="<?php echo base_url(); ?>pdf/images/mar-home13.png" alt="" style="width:80%;  " /></td>
                                                  <td width="20%">
                                                <h4>Family & Friends</h4>
                                                <p>Will work with you to contact
                                                  your closes friends &
                                                  family who might be interested
                                                  in buying your home.</p>
                                              </td>
                                            </tr>



                                          </tbody>
                                        </table> -->
                                        <div class="full-img" style="position:relative;">

              <img src="<?php echo base_url(); ?>pdf/images/action-plan.png" alt=""/ width="100%">





      </div>





                                      </div>
                                      <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                      </div>
                                      <!-- page 13 end -->
                                      <!-- page 14 -->
                                      <div class="marketing-plan ">
                                        <h1>ANALYZE & OPTIMIZE </h1>
                                        <div class="sub-head">Review selling price</div>
                                        <div class="inner-content">
                                          <p>When your property first hits the market the entire audience which consists of realtors, prospective buyers, and  sellers all place eyes on your listing. They all make rapid judgements to as to it’s price, condition, and location. How they first perceive it will determine the viewing activity over the next few weeks. If we receive no viewings  we are facing the possibility that that market as a whole is rejecting the value proposition of your listing. Our
                                          solution? Reduce the price.</p>
                                          <p>Reducing the price on your home is never an easy call but often time is a necessary one might need to be made in order to get your home sold. Many homeowners feel that they are giving up hard won equity that they have built but a slight reduction can help avoid problems down the line. The question is – When is the best time? How long do you wait from the time your home is placed on the market until you consider adjusting the sales price. The rule of thumb is about 30-45 days. </p>

                                          <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/listing-ex.png" alt="" style="width:100%;  " /></div><br>


                                          <p>Joe and Jane went from being very competitively priced to being the highest property in their price range. From a buyer’s perspective, their home now offers the worst value proposition in the marketplace.
                                          </p>
                                        </div>
                                        <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                        </div>
                                        <!-- page 14 end -->
                                        <!-- page 15 -->
                                        <div class="NEGOTIATING-OFFERS ">
                                          <h1>NEGOTIATING OFFERS</h1>
                                          <div class="sub-head">Keeping things on your terms.</div>
                                          <div class="inner-content">
                                            <table width="100%" cellspacing="0" cellpadding="8" border="0" style="font-size:16px;">

                                              <tbody>
                                                <tr>
                                                 <!--  <td width="60%" valign="top">

                                                    <p style="font-size:16px;">In a perfect world, every homebuyer and every home seller would get exactly the deal they want for their real estate transaction. In reality, the best deals are the ones in which each side feels they got most of what they wanted and didn’t have to up too much
                                                    </p>
                                                    <br>
                                                    <br>
                                                    <p style="font-size:16px;">The negotiating portion of a real estate transaction can be exciting, frustrating, and tedious. As a seller you want to get you feel your home is worth and I want to help make that happen. My qualifications will help keep the negotiating terms in your favor.
                                                    </p>
                                                    <p style="font-size:16px;">The goal is to make sure you avoid pitfalls that many sellers are faced when selling their home. The most common are:</p>
                                                    <p style="font-size:16px;">
                                                    <ul>
                                                      <li>Not making buyers are qualified</li>
                                                      <li>Not understanding contract forms</li>
                                                      <li>Failing .to disclose material facts regarding the property</li>
                                                      <li>Setting up contingencies</li>
                                                      <li>Handling the buyers deposit</li>
                                                    </ul>
                                                    </p>
                                                    <br>
                                                    <h3 style=" font-weight: bold;">“ The thing to remember about negotiating is that its not where you start but rather where you finish. “</h3>
                                                  </td> -->
                                                  <td width="100%" align="right"> <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/agent-offer.png" alt="" style="width:100%;  " /></div></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                          </div>
                                          <!-- page 15 end -->
                                          <!-- page 16 -->
                                          <div class="TYPICAL-TRANSACTION  ">
                                            <h1>TYPICAL TRANSACTION </h1>
                                            <div class="sub-head">What you should expect moving forward.</div>
                                            <div class="inner-content">
                                              <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/typ-trans.png" alt="" style="width:100%;  " /></div>

                                            </div>
                                            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                            </div>
                                            <!-- page 16 end -->
                                            <!-- page 16 -->
                                            <div class="TYPICAL-TRANSACTION  ">
                                              <h1>A PROMISE TO MY CLIENTS </h1>
                                              <div class="sub-head">My duties to you</div>
                                              <div class="inner-content">
                                                <p style="font-size:18px; color:#f15d3e;">“As your real estate agent i am held under law to owe you certain specific duties, in addition to any duties or obligations set forth in our listing agreement my fiduciary duties to you include:”</p>

                                                <p><span style="font-size:18px;" >Loyalty</span><br>Loyalty is one of the most fundamental fiduciary duties owed by me to you. This duty obligates me to act at all times solely your best interest and exclude of all other interests, including my own self-interest.</p>

<p><span style="font-size:18px;" >Confidentiality</span><br>As your agent I am obligated to safeguard your confidence and secrets. I therefore, must keep confidential any information that might weaken your bargaining position if it were revealed.</p>

<p><span style="font-size:18px;" >Disclosure</span><br>As your agent I am obligated to disclose to you all relevant and material information
that I know might affect the seller’s ability to obtain the highest price and best terms in the sale of his property. </p>

<p><span style="font-size:18px;" >Obedience</span><br>As your agent I am obligated to obey promptly and efficiently all lawful instructions that you give me pertaining to the sale of your property. However, this duty plainly does not include an obligation to obey any unlawful instructions</p>

<p><span style="font-size:18px;" >Reasonable care and diligence</span><br>As your agent I am obligated to use reasonable care and diligence in pursuing your real estate affairs. The standard of care expected by me to you is that of a competent real estate professional.</p>

<p><span style="font-size:18px;" >Accounting</span><br>As your agent I am obligated to account for all money or property belonging to you
that is entrusted to you. This duty compels me to safeguard any money, deeds, or other
documents entrusted to me that relate to your transactions or affairs.</p>

                                                <p align="right"><img src="<?php echo base_url(); ?>pdf/images/sign.png" width="30%"  /></p>

                                              </div>

                                            </div>
                                            <!-- page 16 end -->
                                          </div>
                                        </body>
                                      </html>