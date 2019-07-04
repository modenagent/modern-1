  <?php 
    //Nearby School Data
    $school = array();
    foreach($property->PublicSchoolsReport->Schools->School as $_school) {
        if(!isset($school['elementary']) && (string)$_school->HighestGrade=="Grade 5") {
           $type = 'elementary';
        } else if(!isset($school['middle']) && (string)$_school->HighestGrade=="Grade 8") {
            $type = 'middle';
        } else if(!isset($school['high']) && (string)$_school->HighestGrade=="Grade 12") {
            $type = 'high';
        } else {
            continue;
        }
        $school[$type]['name'] = (string)$_school->SchoolName;
        $school[$type]['distance'] = (string)$_school->Distance;
        $school[$type]['address'] = (string)$_school->SchoolAddress;
        $school[$type]['city'] = (string)$_school->SchoolCity;
        $school[$type]['lowest_grade'] = (string)$_school->LowestGrade;
        $school[$type]['highest_grade'] = (string)$_school->HighestGrade;
        $school[$type]['student_teacher_ratio'] = (string)$_school->StudentTeacherRatio;
        $school[$type]['total_enrolled'] = (string)$_school->TotalEnrolled;
    }
    foreach($property->PrivateSchoolsReport->Schools->School as $_school) {
        if(isset($school['private'])) break;
        $school['private']['name'] = (string)$_school->SchoolName;
        $school['private']['distance'] = (string)$_school->Distance;
        $school['private']['address'] = (string)$_school->SchoolAddress;
        $school['private']['city'] = (string)$_school->SchoolCity;
        $school['private']['lowest_grade'] = (string)$_school->LowestGrade;
        $school['private']['highest_grade'] = (string)$_school->HighestGrade;
        $school['private']['student_teacher_ratio'] = (string)$_school->StudentTeacherRatio;
        $school['private']['total_enrolled'] = (string)$_school->TotalEnrolled;
        if(isset($_school->Affiliation)) $school['private']['affiliation'] = (string)$_school->Affiliation;
        if(isset($_school->Gender)) $school['private']['gender'] = (string)$_school->Gender;
        if(isset($_school->SchoolPhone)) $school['private']['phone'] = (string)$_school->SchoolPhone;
        if(isset($_school->PreschoolMembership) && (int)$_school->PreschoolMembership==0) {
            $school['private']['preschool'] = "Yes";
        } else {
            $school['private']['preschool'] = "No";
        }
    }
    foreach($property->NeighborhoodDemographics->MedianAge->DemographicsInfoItems->DemoInfoItem as $demoInfo) {
        if((string)$demoInfo->Description=="Male Ratio") {
           $male_female_ration['male'] = (string)$demoInfo->ZipTotal;
        } else if((string)$demoInfo->Description=="Female Ratio") {
           $male_female_ration['female'] = (string)$demoInfo->ZipTotal;
        } else if(in_array((string)$demoInfo->Description, array(2000,2009,2014))) {
           $household_income = (string)$demoInfo->ZipTotal;
        }
    }
    foreach($property->NeighborhoodDemographics->MedianHouseholdIncome->DemographicsInfoItems->DemoInfoItem as $demoInfo) {
        if(in_array((string)$demoInfo->Description, array(2000,2009,2014))) {
           $household["income"] = (string)$demoInfo->ZipTotal;
           $household["year"] = (string)$demoInfo->Description;
        }
    }

  ?>
    
  


      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BUYERS PROPOSAL</title>
<style type="text/css" >
body{ margin:0; padding:0;}
h1, h2, h3, h4, h5, h6, h7{ margin:0; padding:0;}

.cf:before, .cf:after {content:"";display:table;}
.cf:after {clear:both;}
.cf {zoom:1;}

/* page-1 */
.page-1{}
	/* pg-1-header */
	.page-1 .pg-1-header{ padding:62px 50px 30px 50px;}
	.page-1 .pg-1-header h2{ font-size:42px; font-family:museosansrounded-300-7h; color:<?php echo $theme ?>;}
	.page-1 .pg-1-header h1{ font-size:70px; font-family: museosansrounded-900-7g; color: #c0cace; letter-spacing:-0.6px; line-height:52px;}
	
	/* pg-1-map */
	.page-1 .pg-1-map{ text-align:center; margin:0 0 50px 0;}
	
	/* pg-1-clients */
	.page-1 .pg-1-clients{ margin:0 50px 10px 50px;width:100%;}
	.page-1 .pg-1-clients .client-name{ letter-spacing:0.7px; font-size:21px; font-family:museosansrounded-900-7g; color:#636466; padding:0 7px;}
	.page-1 .pg-1-clients .client-detail{ font-family:museosansrounded-300-7h; color:#636466; font-size:18px; padding:0 7px;}
	
	/* pg-1-footer */
	.pg-1-footer{ background:<?php echo $theme ?>; padding:25px 50px; clear:both; margin:0;}
    .pg-1-footer .fwrape{ font-size:21px; font-family:museosansrounded-300-7h; color:#fff;}
	

/* page-2 */
.page-2{}
	/* pg-2-header */
	.page-2 .pg-2-header{ padding:70px 50px 40px 50px;}
	.page-2 .pg-2-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-2 .pg-2-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-2-content */
	.page-2 .pg-2-content{ padding:-5px 30px 0px 30px;font-family:museosansrounded-300-7h; font-size:18px; color:#818285;line-height:44px; }

/* page-3 */
.page-3{}
	/* pg-3-header */
	.page-3 .pg-3-header{ padding:70px 50px 0 50px;}
	.page-3 .pg-3-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-3 .pg-3-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	.page-3 .pg-3-header h3{ font-size:47px; font-family:noterapersonaluseonly-6i; color:#231f20; line-height:130px;}
	
	/* pg-2-content */
	.page-3 .pg-3-content{ padding:0px 50px 20px 50px;}
	.page-3 .pg-3-content .page-3-detail{ font-family:museosansrounded-300-7h; font-size:18px; color:#818285; padding:0;}

/* page-4 */
.page-4{}
	/* pg-4-header */
	.page-4 .pg-4-header{ padding:50px 50px 0 50px;}
	.page-4 .pg-4-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-4 .pg-4-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-4-content */
	.page-4 .pg-4-content{ padding:30px 70px 90px 70px;}
	.page-4 .pg-4-content h4{ font-size:22px; font-family:museosansrounded-900-7g; color:#818285; line-height:40px;}
	.page-4 .pg-4-content .page-4-table-main{ margin:0 0 30px 0; }
	.page-4 .pg-4-content .page-4-table-main .tbl-text{ font-family:museosansrounded-300-7h; font-size:14px; color:#818285; line-height:20px; padding:5px 0px 5px 5px;}

/* page-5 */
.page-5{}
	/* pg-5-header */
	.page-5 .pg-5-header{ padding:70px 50px 0 50px;}
	.page-5 .pg-5-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-5 .pg-5-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-5-content */
	.page-5 .pg-5-content{ padding:50px 50px 50px 50px;}
	.page-5 .pg-5-content .page-5-map{ margin:0 0 45px 0; text-align:center;}
	.page-5 .pg-5-content .page-5-map-detail{ font-family:museosansrounded-300-7h; font-size:18px; color:#818285; line-height:23px; margin-top:30px;}
	.page-5 .pg-5-content .page-5-map-detail h3{ font-family:museosansrounded-900-7g; font-size:22px; color:#76777b;; line-height:23px; padding-top:30px; padding-bottom:20px;}

/* page-6 */
.page-6{}
	/* pg-6-header */
	.page-6 .pg-6-header{ padding:70px 50px 0 50px;}
	.page-6 .pg-6-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-6 .pg-6-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-6-content */
	.page-6 .pg-6-content{ padding:75px 50px 90px 50px;}
	.page-6 .pg-6-content .percent-table{ background:#c2cbce; margin:0 0 45px 0; padding:17px 0;}
	.page-6 .pg-6-content .percent-4block{ padding:45px 0; clear:both;}
	.page-6 .pg-6-content .percent-4block .percent-4block-title{ font-family: museosansrounded-900-7g; font-size:19px; text-align:center; padding:0; line-height:30px; color:#818285;}

/* page-7 */
.page-7{}
	/* pg-7-header */
	.page-7 .pg-7-header{ padding:60px 50px 0 50px;}
	.page-7 .pg-7-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-7 .pg-7-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	.page-7 .pencil{ margin:25px 0;}
	
	/* pg-7-content */
	.page-7 .pg-7-content{ padding:0px 50px 50px 50px;}
	.page-7 .pg-7-content .nearby-table{ margin:0 0 30px 0;}
	.page-7 .pg-7-content .nearby-table .nearby-table-title{ font-family: museosansrounded-900-7g; font-size:16px; padding:14px 0 8px 0; color:<?php echo $theme ?>;}
	.page-7 .pg-7-content .nearby-table .tbl-text{ font-family:museosansrounded-300-7h; font-size:16px; color:#818285; line-height:20px; padding:0 5px;}

/* page-8 */
.page-8{}
	/* pg-8-header */
	.page-8 .pg-8-header{ padding:70px 50px 0 50px;}
	.page-8 .pg-8-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-8 .pg-8-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-7-content */
	.page-8 .pg-8-content{ padding:70px 50px 70px 50px;}
	.page-8 .pg-8-content .loan-title-area{ background:#bcb8ad; -webkit-border-top-left-radius: 20px; -webkit-border-top-right-radius: 20px; -moz-border-radius-topleft: 20px; -moz-border-radius-topright: 20px; border-top-left-radius: 20px; border-top-right-radius: 20px; padding:38px 0; margin:0 0 40px 0;}
	.page-8 .pg-8-content .loan-title-area .loan-title{ font-family: museosansrounded-900-7g; font-size:38px; color:#fff; text-align:center;}
	.page-8 .pg-8-content .loan-title-area .loan-subtitle{ font-family: museosansrounded-300-7h; font-size:23px; color:#605c50; text-align:center;}
	.page-8 .pg-8-content .loan-graph-area{ margin:0 0 50px 0; clear:both;}
	.page-8 .pg-8-content .loan-graph-area .loan-graph{ width:33%; float:left;}
	.page-8 .pg-8-content .loan-graph-area .loan-graph .year-fix-area{ -webkit-border-top-left-radius: 15px; -webkit-border-top-right-radius: 15px; -moz-border-radius-topleft: 15px; -moz-border-radius-topright: 15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background:#49718b; border-bottom:#fff 2px solid; padding:13px 0; font-family: bariol-bold-6p; font-size:20px; color:#fff; text-align:center; letter-spacing:1px; margin:0 11px;}
	
	.page-8 .pg-8-content .loan-graph-area .loan-graph .year-fix-area-gry{ -webkit-border-top-left-radius: 15px; -webkit-border-top-right-radius: 15px; -moz-border-radius-topleft: 15px; -moz-border-radius-topright: 15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background:#bcb8ad; border-bottom:#fff 2px solid; padding:13px 0; font-family: bariol-bold-6p; font-size:20px; color:#fff; text-align:center; letter-spacing:1px; margin:0 11px;}
	
	.page-8 .pg-8-content .loan-graph-area .loan-graph .year-fix-area-lt-blue{ -webkit-border-top-left-radius: 15px; -webkit-border-top-right-radius: 15px; -moz-border-radius-topleft: 15px; -moz-border-radius-topright: 15px; border-top-left-radius: 15px; border-top-right-radius: 15px; background:#c7d6e4; border-bottom:#fff 2px solid; padding:13px 0; font-family: bariol-bold-6p; font-size:20px; color:#fff; text-align:center; letter-spacing:1px; margin:0 11px;}
	
	.page-8 .pg-8-content .loan-graph-area .loan-graph .year-price-green{ background:#a5cd3a; line-height:60px; font-family: bariol-bold-6p; font-size:28px; color:#fff; text-align:center; margin:0 11px;}
	.page-8 .pg-8-content .loan-graph-area .loan-graph .year-graph-image{ padding:45px 0; text-align:center;}
	.page-8 .pg-8-content .loan-graph-area .loan-graph .year-graph-bottom-blue{ -webkit-border-top-left-radius: 15px; -webkit-border-bottom-right-radius: 15px; -moz-border-radius-topleft: 15px; -moz-border-radius-bottomright: 15px; border-top-left-radius: 15px; border-bottom-right-radius: 15px; background:#49718b; padding:10px 5px;  margin:0 11px;}
	
	
	.page-8 .pg-8-content .loan-graph-area .loan-graph .year-graph-bottom-gry{ -webkit-border-top-left-radius: 15px; -webkit-border-bottom-right-radius: 15px; -moz-border-radius-topleft: 15px; -moz-border-radius-bottomright: 15px; border-top-left-radius: 15px; border-bottom-right-radius: 15px; background:#bcb8ad; padding:10px 5px;  margin:0 11px;}
	
	
	.page-8 .pg-8-content .loan-graph-area .loan-graph .year-graph-bottom-lt-gry{ -webkit-border-top-left-radius: 15px; -webkit-border-bottom-right-radius: 15px; -moz-border-radius-topleft: 15px; -moz-border-radius-bottomright: 15px; border-top-left-radius: 15px; border-bottom-right-radius: 15px; background:#c7d6e4; padding:10px 5px;  margin:0 11px;}
	
	.page-8 .pg-8-content .loan-graph-area .loan-graph .grph-price-title{font-family: museosansrounded-300-7h; font-size:18px; color:#fff; line-height:23px;}
	.page-8 .pg-8-content .loan-graph-area .loan-graph .grph-price-title-price{font-family: bariol-bold-6p; font-size:18px; color:#fff; line-height:23px;}

/* page-9 */
.page-9{}
	/* pg-9-header */
	.page-9 .pg-9-header{ padding:70px 50px 0 50px;}
	.page-9 .pg-9-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-9 .pg-9-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-9-content */
	.page-9 .pg-9-content{ padding:40px 50px;}
	.page-9 .pg-9-content .pg9-blk{ width:50%; float:left;}
	.page-9 .pg-9-content .pg9-detail-area{ margin:0 30px 20px 0;}
	.page-9 .pg-9-content .pg9-detail-area .pg9-desc{ font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;}
	.page-9 .pg-9-content .pg9-pit-image{ text-align:center;}
	.page-9 .pg-9-content .pg9-fixprice{ font-family: museosansrounded-900-7g; font-size:16px; color:#fff; border-bottom:#fff 2px solid; line-height:54px; text-align:center; background:#a6cd3a; width:325px;}
	.grph-prx img{ width:100%; height:auto; float:left;}

/* page-10 */
.page-10{}
	/* pg-10-header */
	.page-10 .pg-10-header{ padding:50px 50px 0 50px;}
	.page-10 .pg-10-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-10 .pg-10-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-10-content */
	.page-10 .pg-10-content{ padding:70px 60px 70px 60px;}
	.page-10 .pg-10-content .pg10-row{ margin:0 0 10px 0; clear:both;}

/* page-11 */
.page-11{}
	/* pg-11-header */
	.page-11 .pg-11-header{ padding:60px 50px 0 50px;}
	.page-11 .pg-11-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-11 .pg-11-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-11-content */
	.page-11 .pg-11-content{ padding:30px 50px;}
	.page-11 .pg-11-content .pg11-row{ margin:0 0 10px 0; clear:both;}

/* page-12 */
.page-12{}
	/* pg-12-header */
	.page-12 .pg-12-header{ padding:60px 50px 50px 50px;}
	.page-12 .pg-12-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-12 .pg-12-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-12-content */
	.page-12 .pg-12-content{padding:20px 40px;}
	.page-12 .pg-12-content .pg12-blk{ width:50%; float:left;}
	.page-12 .pg-12-content .pg12-blk .pg12-blk-row{ margin:0 0 10px 0; clear:both;}

/* page-13 */
.page-13{}
	/* pg-13-header */
	.page-13 .pg-13-header{ padding:60px 50px 0 50px;}
	.page-13 .pg-13-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-13 .pg-13-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-11-content */
	.page-13 .pg-13-content{ padding:15px 50px;}
	.page-13 .pg-13-content .pg13-short-desc{ margin:0 0 20px 0; font-size:16px; font-family:museosansrounded-300-7h; color:#76777b;}
	.page-13 .pg-13-content .pg13-blk{ width:50%; float:left;}
	.page-13 .pg-13-content .pg13-blk .pg13-blk-row{ margin:0 0 20px 0; clear:both;}
	.page-13 .pg-13-content .pg13-blk .pg13-blk-row .pg13-blk-row-title-area{ background:<?php echo $theme ?>; -webkit-border-top-left-radius: 12px; -webkit-border-top-right-radius: 12px; -moz-border-radius-topleft: 12px; -moz-border-radius-topright: 12px; border-top-left-radius: 12px; border-top-right-radius: 12px; margin:0 10px;}
	.page-13 .pg-13-content .pg13-blk .pg13-blk-row .pg13-blk-row-detail-area{ background:#f4f4f4; -webkit-border-bottom-right-radius: 12px; -webkit-border-bottom-left-radius: 12px; -moz-border-radius-bottomright: 12px; -moz-border-radius-bottomleft: 12px; border-bottom-right-radius: 12px; border-bottom-left-radius: 12px; padding:15px; clear:both; margin:0 10px;}

/* page-14 */
.page-14{}
	/* pg-14-header */
	.page-14 .pg-14-header{ padding:70px 50px 0 50px;}
	.page-14 .pg-14-header h1{ font-size:55px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-14 .pg-14-header h2{ font-size:28px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-11-content */
	.page-14 .pg-14-content{ padding:50px 50px;}
	.page-14 .pg-14-content .pg14-short-desc{ margin:0 0 30px 0; font-size:16px; font-family:museosansrounded-300-7h; color:#76777b;}
	.page-14 .pg-14-content .pg14-center-text{ font-family: museosansrounded-900-7g; color:#ffffff; font-size:16px;}
	.page-14 .pg-14-content .pg14-blue-bg{ background:#87abc1; font-family: museosansrounded-900-7g; font-size:18px; line-height:50px; margin:0 20px; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; color:#fff;}
	.page-14 .pg-14-content .pg14-subtitle-text{ font-family: museosansrounded-900-7g; color:#818285; font-size:18px; margin:0 22px;}

/* page-15 */
.page-15{}
	/* pg-15-header */
	.page-15 .pg-15-header{ padding:60px 50px 0 50px;}
	.page-15 .pg-15-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-15 .pg-15-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-11-content */
	.page-15 .pg-15-content{ padding:40px 50px 0 50px;}
	.page-15 .pg-15-content .pg15-desc{ margin:0 0 10px 0; font-size:15px; font-family: museosansrounded-300-7h; color:#76777b;line-height: 19px;}
	.page-15 .pg-15-content .pg15-desc span{ font-family: museosansrounded-900-7g; color:#818285; font-size:16px;}
	
	
	/* page-9a */
.page-9{}
	/* pg-9-header */
	.page-9a .pg-9a-header{ padding:70px 50px 0 50px;}
	.page-9a .pg-9a-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-9a .pg-9a-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-9-content */
	.page-9a .pg-9a-content{ padding:40px 50px;}
	.page-9a .pg-9a-content .pg9a-blk{ width:50%; float:left;}
	.page-9a .pg-9a-content .pg9a-blk li{ font-size:14.10px; line-height: 220%; letter-spacing:; font-family:museosansrounded-300-7h; color:#818285; }
	.page-9a .pg-9a-content .pg9a-short-desc{ margin:0 0 20px 0; font-size:16px; font-family:museosansrounded-300-7h; color:#76777b;}
	.page-9a .pg-9a-content .pg9a-detail-area{ margin:0 30px 20px 0;}
	.page-9a .pg-9a-content .pg9a-detail-area .pg9-desc{ font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;}
	.page-9a .pg-9a-content .pg9a-pit-image{ text-align:center;}
	.page-9a .pg-9a-content .pg9a-fixprice{ font-family: museosansrounded-900-7g; font-size:16px; color:#fff; border-bottom:#fff 2px solid; line-height:54px; text-align:center; background:#a6cd3a; width:325px;}
	.grph-prx img{ width:100%; height:auto; float:left;}
	
	/* page-11a */
.page-11a{}
	/* pg-11a-header */
	.page-11a .pg-11a-header{ padding:60px 50px 0 50px;}
	.page-11a .pg-11a-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-11a .pg-11a-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-11a-content */
	.page-11a .pg-11a-content{ padding:30px 50px;}
	.page-11a .pg-11a-content .pg11a-row{ margin:0 0 10px 0; clear:both;}
	.page-11a .pg-11a-content .pg11a-short-desc{ margin:0 0 20px 0; font-size:16px; font-family:museosansrounded-300-7h; color:#76777b;}
	.page-11a .pg-11a-content .supp-text{font-family:museosansrounded-300-7h; font-size:14px; color:#76777b; margin-bottom:10px;}
	
</style>
</head>

<body>
    <htmlpagefooter name="MyFooter1" style="margin:0;">
    
      <div class="pg-1-footer cf" style="margin:0;">
          <table class="fwrape" width="100%">
            <tr>
                <td width="80%" align="left">
                  <?php echo $property->PropertyProfile->SiteAddress.', '.$property->PropertyProfile->SiteCity.', '.$property->PropertyProfile->SiteState ; ?>
                </td>
                <td width="20%" align="right">
                  Page {PAGENO}
                </td>
            </tr>
          </table>
      </div>      
    

    </htmlpagefooter>
    
<article>
    <div class="page-1">
		<div class="pg-1-header">
        	<h2>BUYERS REPORT</h2>
            <h1><?php echo $property->PropertyProfile->SiteAddress ; ?></h1>
            <h2><?php echo $property->PropertyProfile->SiteCity; ?>, <?php echo $property->PropertyProfile->SiteState ; ?> <?php echo $property->PropertyProfile->SiteZip; ?></h2>
        </div><!-- .pg-1-header -->
		<div class="pg-1-map"><img width="750px;" src="assets/images/pg1-map.png" alt="" style="background-color:<?php echo $theme ?>;" /></div><!-- .pg-1-map -->
        <table class="pg-1-clients cf">
            <tr>
                <td>
			<table width="350" border="0" align="left" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="64px" rowspan="2" align="center" valign="middle"><?php if($user['profile_image'] != '' && $user['profile_image'] != 'no'):?><img src="<?php echo base_url().$user['profile_image']; ?>" style="max-height:115px; height:115px;" alt="" /><?php endif; ?></td>
                    <td width="245" class="client-name"><?php echo $user['fullname']; ?></td>
                </tr>
                <tr>
                    <td width="245" align="left" valign="middle" class="client-detail"><?php echo $user['title']; ?><br />CA BRE#<?php echo $user['licenceno']; ?><br />Direct: <?php echo $user['phone']; ?><br /><?php echo $user['email']; ?><br /><?php echo $user['website']; ?></td>
                </tr>
                <?php if($partner): ?>
                <tr>
                    <td colspan="2" align="left" valign="top"><?php if($user['company_logo'] != ''):?><img src="<?php echo base_url().$user['company_logo']; ?>" style="height:75px;max-width:185px;padding-top: 5px;"  alt="Logo Image"/><?php endif; ?></td>
                </tr>
                <?php endif; ?>
                </table>
                </td>
                <td <?php echo (!$partner)?'valign="bottom"':''; ?>>
            <table width="350" border="0" align="right" cellpadding="0" cellspacing="0">
            <?php if($partner): ?>
            <tr>
            <td width="245" align="right" valign="top" class="client-name"><?php echo $partner['fullname']; ?></td>
            <td rowspan="2" align="right" width="64px" valign="top"><img src="<?php echo base_url().$partner['profile_image']; ?>"   style="max-height:115px; height:115px;" alt=""/></td>
            </tr>
            <tr>
            <td width="245" align="right" valign="top" class="client-detail"><?php echo $partner['title']; ?><br />NMLS#<?php echo $partner['licenceno']; ?><br />Direct: <?php echo $partner['phone']; ?><br /><?php echo $partner['email']; ?><br /><?php echo $partner['website']; ?></td>
            </tr>
            <tr>
            <td colspan="2" align="right" valign="top"><?php if($partner['company_image']): ?><img src="<?php echo base_url().$partner['company_image']; ?>" style="height:75px; max-width:185px;padding-top: 5px;"  alt="Logo Image"/><?php endif; ?></td>
            </tr>
            <?php else: ?>
                <tr>
                    <td colspan="2" align="right" valign="top"><?php if($user['company_logo'] != ''):?><img src="<?php echo base_url().$user['company_logo']; ?>" style="max-width:200px;padding-bottom: 10px;"  alt="Logo Image"/><?php endif; ?></td>
                </tr>
            <?php endif; ?>
            </table>
            
        </td></tr>
            
        </table>
      </div><!-- .pg-1-clients -->
    <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-1 -->
</article>
<article>
	<div class="page-2">
		<div class="pg-2-header">
        	<h1>CONTENTS</h1>
            <h2>What is in your listing proposal</h2>
        </div><!-- .pg-2-header -->
        <div class="pg-2-content cf">
        	<table class="pg-2-content cf" width="500" border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right" valign="middle" class="table-text">deciding to buy</td>
                    <td width="28px" rowspan="17" ></td>
                    <td width="1px" rowspan="17" bgcolor="#818285"></td>
                    <td width="70" align="center" valign="top" class="table-text">3</td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">aerial view of neighborhood</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">4</div></td>
                </tr>
				<tr>
                  <td align="right" valign="middle"><div class="table-text">prospective property</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">5</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">neighborhood statistics</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">6</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">neighboring schools</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">7</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">mortgage payment explained</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">8</div></td>
                </tr>
				
				 <tr>
                  <td align="right" valign="middle"><div class="table-text">property taxes</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">9</div></td>
                </tr>
				 <tr>
                  <td align="right" valign="middle"><div class="table-text">supplemental taxes</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">10</div></td>
                </tr>
				  <tr>
                  <td align="right" valign="middle"><div class="table-text">benefits of extra payments</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">11</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">home buying process</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">12</div></td>
                </tr>
				<tr>
                  <td align="right" valign="middle"><div class="table-text">who pays what</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">13</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">home loan process</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">14</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">loan checklist</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">15</div></td>
                </tr>
				<tr>
                  <td align="right" valign="middle"><div class="table-text">property vesting</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">16</div></td>
                </tr>
				<tr>
                  <td align="right" valign="middle"><div class="table-text">home warranty info</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">17</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">parties involved</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">18</div></td>
                </tr>
          
                <tr>
                  <td align="right" valign="middle"><div class="table-text">common terms</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">19</div></td>
                </tr>
                </table>

      </div><!-- .pg-2-content -->
	<sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-2 -->
</article>
<article>
	<div class="page-3">
		<div class="pg-3-header">
        	<h1>DECIDING TO BUY</h1>
            <h2>The first step</h2>
            <h3>Congratulations</h3>
        </div><!-- .pg-3-header -->
        <div class="pg-3-content cf">
        	<div class="page-3-detail">We wanted to congratulate you on taking the first steps towards homeownership. For many this 
is a monumental period in their lives. Whether this is your first home purchase or your second 
you can rest assured that you are in excellent hands. Our goal is to keep you in the loop of every 
detail regarding your transaction. For this very reason we have prepared this 
buyer&rsquo;s proposal report that is a great point of reference to better understand the home buying process. <br /><br />
We look forward to the closing of your transaction. <br />
<?php echo $user['fullname']; ?></div><!-- .page-3-detail -->
		</div><!-- .pg-3-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-3 -->
</article>
<article>
	<div class="page-5">
		<div class="pg-5-header">
        	<h1>AERIAL VIEW</h1>
            <h2>Of your future neighborhood</h2>
        </div><!-- .pg-5-header -->
        <div class="pg-5-content cf">
            <div class="full-img">
                      <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=663x519&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:f15d3e%7Clabel:S%7C<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>" alt="" style="width:6.9in; height:5.4in;" /></div>
            <div class="page-5-map-detail">
			<h3>Why a 2-Mile Radius</h3>
			This is an aerial view of the neighborhood in which you prospective property is located.
This will give you the opportunity to get a birds eye view of any local parks, major streets,
& highways.</div><!-- .page-5-map-detail -->
		</div><!-- .pg-5-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-5 -->
</article>
<article style="">
	<div class="page-4">
		<div class="pg-4-header">
        	<h1>PROSPECTIVE PROPERTY</h1>
            <h2>Overview of your property.</h2>
        </div><!-- .pg-4-header -->
        <div class="pg-4-content cf">
        	<h4>OWNER, ADDRESS & LEGAL DESCRIPTION</h4>
            <div class="page-4-table-main cf">
				<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td class="tbl-text">Primary Owner: <?php echo $primary_owner; ?></td>
                    </tr>
                    <tr>
                    <td bgcolor="#d1d2d4" class="tbl-text">Secondary Owner: <?php echo $secondary_owner; ?></td>
                    </tr>
                    <tr>
                    <td class="tbl-text">Site Address: <?php echo $property->PropertyProfile->SiteAddress.', '. $property->PropertyProfile->SiteCity.', '. $property->PropertyProfile->SiteState.' '.$property->PropertyProfile->SiteZip; ?></td>
                    </tr>
                    <tr>
                    <td bgcolor="#d1d2d4" class="tbl-text">Mailing Address: <?php echo $property->PropertyProfile->MailAddress.', '. $property->PropertyProfile->MailCity.', '. $property->PropertyProfile->MailState.' '.$property->PropertyProfile->MailZip; ?></td>
                    </tr>
                    <tr>
                    <td>
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="50%" class="tbl-text">APN : <?php echo $property->PropertyProfile->APN; ?></td>
                            <td width="50%" class="tbl-text">County Name: <?php echo $property->SubjectValueInfo->CountyName; ?></td>
                          </tr>
                          <tr>
                            <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Census Tract: <?php echo $property->PropertyProfile->CensusTract; ?></td>
                            <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Housing Tract #: <?php echo $property->PropertyProfile->HousingTract; ?></td>
                          </tr>
                          <tr>
                            <td width="50%" class="tbl-text">Lot Number: <?php echo $property->PropertyProfile->LotNumber; ?></td>
                            <td width="50%" class="tbl-text">Page Grid:<?php echo $property->PropertyProfile->TBMGrid; ?></td>
                          </tr>
						</table>

                    </td>
                    </tr>
                    <tr>
                    <td bgcolor="#d1d2d4" class="tbl-text">Brief Legal Description:<br>
                            <p><?php echo $property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription; ?></p></td>
                    </tr>
				</table>
            </div><!-- .page-4-table-main -->
        	<h4>BEDS, BATHS, & SQUARE FOOTAGE</h4>
            <div class="page-4-table-main cf">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td>
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="33%" class="tbl-text">Bedrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Bedrooms; ?></td>
                            <td width="33%" class="tbl-text">Year Built: <?php echo $property->PropertyProfile->PropertyCharacteristics->YearBuilt; ?></td>
                            <td width="33%" class="tbl-text">Square Feet: <?php echo $property->PropertyProfile->PropertyCharacteristics->BuildingArea; ?></td>
                          </tr>
                          <tr bgcolor="#d1d2d4">
                            <td width="33%" class="tbl-text">Bathrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Baths; ?></td>
                            <td width="33%" class="tbl-text">Garage: <?php echo $property->PropertyProfile->PropertyCharacteristics->GarageNumCars; ?></td>
                            <td width="33%" class="tbl-text">Lot Size: <?php echo $property->PropertyProfile->PropertyCharacteristics->LotSize; ?></td>
                          </tr>
                          <tr>
                            <td width="33%" class="tbl-text">Partial Bath: 0</td>
                            <td width="33%" class="tbl-text">Fireplace: <?php echo $property->PropertyProfile->PropertyCharacteristics->Fireplace; ?></td>
                            <td width="33%" class="tbl-text"># of Units: <?php echo $property->PropertyProfile->PropertyCharacteristics->NumUnits; ?></td>
                          </tr>
                          <tr bgcolor="#d1d2d4">
                            <td width="33%" class="tbl-text">Total Rooms: <?php echo sizeof($property->PropertyProfile->PropertyCharacteristics->TotalRooms); ?></td>
                            <td width="33%" class="tbl-text">Pool/Spa: <?php echo $property->PropertyProfile->PropertyCharacteristics->Pool; ?></td>
                            <td width="33%" class="tbl-text">Zoning: <?php echo trim($property->PropertyProfile->PropertyCharacteristics->Zoning); ?></td>
                          </tr>
						</table>
                    </td>
                    </tr>
                    <tr>
                    <td class="tbl-text">Property Type: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></td>
                    </tr>
                    <tr>
                    <td bgcolor="#d1d2d4" class="tbl-text">Use Code: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></td>
                    </tr>
				</table>
            </div><!-- .page-4-table-main -->
        	<h4>ASSESSED VALUE & TAX DETAILS</h4>
            <div class="page-4-table-main cf">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" class="tbl-text"><div class="tbl-text">Assessed Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->AssessedValue; ?></td>
                    <td width="50%" class="tbl-text"><div class="tbl-text">Tax Amount: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxAmount; ?></td>
                  </tr>
                  <tr>
                    <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Land Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->LandValue; ?></td>
                    <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Tax Status: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxStatus; ?></td>
                  </tr>
                  <tr>
                    <td width="50%" class="tbl-text">Improvement Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->ImprovementValue; ?></td>
                    <td width="50%" class="tbl-text">Tax Rate Area: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxRateArea; ?>%</td>
                  </tr>
                  <tr>
                    <td width="50%" bgcolor="#d1d2d4" class="tbl-text">% Improvement: <?php echo $property->PropertyProfile->AssessmentTaxInfo->PercentImproved; ?>%</td>
                    <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Tax Year: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxYear; ?></td>
                  </tr>
                </table>
            </div><!-- .page-4-table-main -->
		</div><!-- .pg-4-content -->
<!--	<sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />-->
    </div><!-- .page-4 -->
</article>
<article>
	<div class="page-6">
		<div class="pg-6-header">
        	<h1>NEIGHBORHOOD STATS</h1>
            <h2>A little insight</h2>
        </div><!-- .pg-6-header -->
   	  	<div class="pg-6-content cf">
        	<div class="percent-table cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="8">
                  <tr>
                    <td width="10%" align="center" valign="middle" style="font-family: museosansrounded-900-7g; font-size:28px; color:#65696b;"><?php echo $male_female_ration['female'] ?></td>
                    <td width="20%" align="center" valign="middle"><img src="assets/images/pg6-percent-1.png" alt="" style="width:127px" /></td>
                    <td width="10%" align="center" valign="middle" style="font-family: museosansrounded-900-7g; font-size:28px; color:#65696b;"><?php echo $male_female_ration['male'] ?></td>
                    <td width="60%" align="center" valign="top"><div style="font-family: museosansrounded-900-7g; font-size:22px; text-align:center; padding:30px 0 8px 0; color:#65696b;">Male to Female Ratio</div><div style="font-family: museosansrounded-300-7h; text-align:center; color:#65696b; font-size:18px;">These figures represent the male to female ratio in your neighborhood. The housing census is taken every 10 years so depending on the time of this report these figures can be slightly different.</div></td>
                  </tr>
                </table>
        </div><!-- .percent-table -->
        	<div class="percent-table cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="8">
                  <tr>
                      <td width="60%" align="center" valign="top"><div style="font-family: museosansrounded-900-7g; font-size:22px; text-align:center; padding:30px 0 8px 0; color:#65696b;">Avg. Household Income</div><div style="font-family: museosansrounded-300-7h; text-align:center; color:#65696b; font-size:18px;">The figure to the right represents the average household income within your perspective neighborhood. This information is gathered from the household census that is taken every 10 years.</div></td>
                    <td width="10%" align="center" valign="middle" style="font-family: museosansrounded-900-7g; font-size:28px; color:#65696b;"></td>
                    <td width="20%" align="center"  valign="middle" style="font-family: museosansrounded-900-7g; font-size:28px; color:#65696b;"><?php echo $household['income']?></td>
                    <td width="10%" align="center" valign="middle" style="font-family: museosansrounded-900-7g; font-size:28px; color:#65696b;"></td>
                  </tr>
				</table>
          </div><!-- .percent-table -->
            <div class="percent-4block">
            	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td width="25%" align="center" valign="top" class="percent-4block-title">Avg. Sale Price</td>
                    <td width="25%" align="center" valign="top" class="percent-4block-title">Avg. Sqft</td>
                    <td width="25%" align="center" valign="top" class="percent-4block-title">Avg. Beds</td>
                    <td width="25%" align="center" valign="top" class="percent-4block-title">Avg. Baths</td>
                  </tr>
                  <tr>
                    <td width="25%" align="center" valign="top"><img src="assets/images/avg-1.png" alt="" /></td>
                    <td width="25%" align="center" valign="top"><img src="assets/images/avg-2.png" alt="" /></td>
                    <td width="25%" align="center" valign="top"><img src="assets/images/avg-3.png" alt="" /></td>
                    <td width="25%" align="center" valign="top"><img src="assets/images/avg-4.png" alt="" /></td>
                  </tr>
                  <tr>
                    <td width="25%" align="center" valign="top" class="percent-4block-title">$<?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue; ?></td>
                    <td width="25%" align="center" valign="top" class="percent-4block-title"><?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianLivingArea; ?></td>
                    <td width="25%" align="center" valign="top" class="percent-4block-title"><?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianNumBeds; ?> Beds</td>
                    <td width="25%" align="center" valign="top" class="percent-4block-title"><?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianNumBaths; ?> Baths</td>
                  </tr>
              </table>

        </div><!-- .percent-4block -->
  	  </div><!-- .pg-6-content -->
	<sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-6 -->
</article>
<article>
	<div class="page-7">
		<div class="pg-7-header">
        	<h1>NEARBY SCHOOLS</h1>
            <h2>A little insight</h2>
            <div class="pencil"><img src="assets/images/pg7-pencil.png" alt="" width="350" /></div>
        </div><!-- .pg-7-header -->
   	  	<div class="pg-7-content cf">
		<div class="nearby-table cf">
       		<div class="nearby-table-title">ELEMENTARY</div><!-- .nearby-table-title -->
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="25%" align="right" valign="middle" class="tbl-text">School Name:</td>
              <td width="30%" align="left" valign="middle" class="tbl-text"><?php echo $school['elementary']['name'] ?></td>
              <td width="20%" align="right" valign="middle" class="tbl-text">Distance:</td>
              <td width="25%" align="left" valign="middle" class="tbl-text"><?php echo $school['elementary']['distance'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Address:</td>
              <td width="30%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['elementary']['address'] ?></td>
              <td width="20%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">City:</td>
              <td width="25%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['elementary']['city'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" class="tbl-text">Lowest Grade:</td>
              <td width="30%" align="left" valign="middle" class="tbl-text"><?php echo $school['elementary']['lowest_grade'] ?></td>
              <td width="20%" align="right" valign="middle" class="tbl-text">Highest Grade:</td>
              <td width="25%" align="left" valign="middle" class="tbl-text"><?php echo $school['elementary']['highest_grade'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Student/Teacher Ratio:</td>
              <td width="30%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['elementary']['student_teacher_ratio'] ?></td>
              <td width="20%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Total Enrolled:</td>
              <td width="25%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['elementary']['total_enrolled'] ?></td>
            </tr>
          </table>
          </div><!-- .nearby-table -->
          <div class="nearby-table cf">
       		<div class="nearby-table-title">JUNIOR HIGHSCHOOL</div><!-- .nearby-table-title -->
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="25%" align="right" valign="middle" class="tbl-text">School Name:</td>
              <td width="30%" align="left" valign="middle" class="tbl-text"><?php echo $school['middle']['name'] ?></td>
              <td width="20%" align="right" valign="middle" class="tbl-text">Distance:</td>
              <td width="25%" align="left" valign="middle" class="tbl-text"><?php echo $school['middle']['distance'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Address:</td>
              <td width="30%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['middle']['address'] ?></td>
              <td width="20%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">City:</td>
              <td width="25%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['middle']['city'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" class="tbl-text">Lowest Grade:</td>
              <td width="30%" align="left" valign="middle" class="tbl-text"><?php echo $school['middle']['lowest_grade'] ?></td>
              <td width="20%" align="right" valign="middle" class="tbl-text">Highest Grade:</td>
              <td width="25%" align="left" valign="middle" class="tbl-text"><?php echo $school['middle']['highest_grade'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Student/Teacher Ratio:</td>
              <td width="30%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['middle']['student_teacher_ratio'] ?></td>
              <td width="20%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Total Enrolled:</td>
              <td width="25%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['middle']['total_enrolled'] ?></td>
            </tr>
          </table>
          </div>
          <div class="nearby-table cf">
       		<div class="nearby-table-title">HIGH SCHOOL</div><!-- .nearby-table-title -->
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="25%" align="right" valign="middle" class="tbl-text">School Name:</td>
              <td width="30%" align="left" valign="middle" class="tbl-text"><?php echo $school['high']['name'] ?></td>
              <td width="20%" align="right" valign="middle" class="tbl-text">Distance:</td>
              <td width="25%" align="left" valign="middle" class="tbl-text"><?php echo $school['high']['distance'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Address:</td>
              <td width="30%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['high']['address'] ?></td>
              <td width="20%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">City:</td>
              <td width="25%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['high']['city'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" class="tbl-text">Lowest Grade:</td>
              <td width="30%" align="left" valign="middle" class="tbl-text"><?php echo $school['high']['lowest_grade'] ?></td>
              <td width="20%" align="right" valign="middle" class="tbl-text">Highest Grade:</td>
              <td width="25%" align="left" valign="middle" class="tbl-text"><?php echo $school['high']['highest_grade'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Student/Teacher Ratio:</td>
              <td width="30%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['high']['student_teacher_ratio'] ?></td>
              <td width="20%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Total Enrolled:</td>
              <td width="25%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['high']['total_enrolled'] ?></td>
            </tr>
          </table>
          </div>
          <div class="nearby-table cf">
       		<div class="nearby-table-title">PRIVATE SCHOOL</div><!-- .nearby-table-title -->
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="25%" align="right" valign="middle" class="tbl-text">School Name:</td>
              <td width="30%" align="left" valign="middle" class="tbl-text"><?php echo $school['private']['name'] ?></td>
              <td width="20%" align="right" valign="middle" class="tbl-text">Distance:</td>
              <td width="25%" align="left" valign="middle" class="tbl-text"><?php echo $school['private']['distance'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Address:</td>
              <td width="30%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['private']['address'] ?></td>
              <td width="20%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">City:</td>
              <td width="25%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['private']['city'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" class="tbl-text">Lowest Grade:</td>
              <td width="30%" align="left" valign="middle" class="tbl-text"><?php echo $school['private']['lowest_grade'] ?></td>
              <td width="20%" align="right" valign="middle" class="tbl-text">Highest Grade:</td>
              <td width="25%" align="left" valign="middle" class="tbl-text"><?php echo $school['private']['highest_grade'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Student/Teacher Ratio:</td>
              <td width="30%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['private']['student_teacher_ratio'] ?></td>
              <td width="20%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Total Enrolled:</td>
              <td width="25%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['private']['total_enrolled'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" class="tbl-text">Phone Number:</td>
              <td width="30%" align="left" valign="middle" class="tbl-text"><?php echo $school['private']['phone'] ?></td>
              <td width="20%" align="right" valign="middle" class="tbl-text">Gender:</td>
              <td width="25%" align="left" valign="middle" class="tbl-text"><?php echo $school['private']['gender'] ?></td>
            </tr>
            <tr>
              <td width="25%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Affiliation:</td>
              <td width="30%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['private']['affiliation'] ?></td>
              <td width="20%" align="right" valign="middle" bgcolor="#d1d2d4" class="tbl-text">Preschool:</td>
              <td width="25%" align="left" valign="middle" bgcolor="#d1d2d4" class="tbl-text"><?php echo $school['private']['preschool'] ?></td>
            </tr>
          </table>
          </div>
  	  	</div><!-- .pg-7-content -->
	<sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article style="display:none;">
	<div class="page-8">
		<div class="pg-8-header">
        	<h1>ESTIMATED PAYMENT</h1>
            <h2>Payment & Financing Options</h2>
        </div><!-- .pg-8-header -->
   	  	<div class="pg-8-content cf">
			<div class="loan-title-area cf">
            	<div class="loan-title">LOAN COMPARISON</div><!-- .loan-title -->
                <div class="loan-subtitle">PURCHASE PRICE: $425,000</div><!-- .loan-subtitle -->
            </div><!-- .loan-title-area -->
            <div class="loan-graph-area cf">
            	<div class="loan-graph">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="year-fix-area">30 Year Fixed<br />(3.5% Down)<br />FHA</td>
                      </tr>
                      <tr>
                        <td><div class="year-price-green">$2100</div></td>
                      </tr>
                      <tr>
                        <td><div class="year-graph-image"><img src="assets/images/pg8-graph.png" alt=""  /></div></td>
                      </tr>
                      <tr>
                        <td><div class="year-graph-bottom-blue">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr>
                                <td width="50%"><div class="grph-price-title">Purchase Price</div></td>
                                <td width="50%"><div class="grph-price-title-price">$350,000</div></td>
                              </tr>
                              <tr>
                                <td width="50%"><div class="grph-price-title">Down Payment</div></td>
                                <td width="50%"><div class="grph-price-title-price">$35,000</div></td>
                              </tr>
                              <tr>
                                <td width="50%"><div class="grph-price-title">Loan Amount</div></td>
                                <td width="50%"><div class="grph-price-title-price">$315,000</div></td>
                              </tr>
                              <tr>
                                <td width="50%"><div class="grph-price-title">Interest Rate</div></td>
                                <td width="50%"><div class="grph-price-title-price">4.0%</div></td>
                              </tr>
                            </table>

                        </div></td>
                      </tr>
                    </table>
                </div><!-- .loan-graph -->
            	<div class="loan-graph">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div class="year-fix-area-gry">30 Year Fixed<br />(3.5% Down)<br />FHA</div></td>
                      </tr>
                      <tr>
                        <td><div class="year-price-green">$2100</div></td>
                      </tr>
                      <tr>
                        <td><div class="year-graph-image"><img src="assets/images/pg8-graph.png" alt="" /></div></td>
                      </tr>
                      <tr>
                        <td><div class="year-graph-bottom-gry">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr>
                                <td width="50%"><div class="grph-price-title">Purchase Price</div></td>
                                <td width="50%"><div class="grph-price-title-price">$350,000</div></td>
                              </tr>
                              <tr>
                                <td width="50%"><div class="grph-price-title">Down Payment</div></td>
                                <td width="50%"><div class="grph-price-title-price">$35,000</div></td>
                              </tr>
                              <tr>
                                <td width="50%"><div class="grph-price-title">Loan Amount</div></td>
                                <td width="50%"><div class="grph-price-title-price">$315,000</div></td>
                              </tr>
                              <tr>
                                <td width="50%"><div class="grph-price-title">Interest Rate</div></td>
                                <td width="50%"><div class="grph-price-title-price">4.0%</div></td>
                              </tr>
                            </table>

                        </div></td>
                      </tr>
                    </table>
                </div><!-- .loan-graph -->
            	<div class="loan-graph">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div class="year-fix-area-lt-blue">30 Year Fixed<br />(3.5% Down)<br />FHA</div></td>
                      </tr>
                      <tr>
                        <td><div class="year-price-green">$2100</div></td>
                      </tr>
                      <tr>
                        <td><div class="year-graph-image"><img src="assets/images/pg8-graph.png" alt="" /></div></td>
                      </tr>
                      <tr>
                        <td><div class="year-graph-bottom-lt-gry">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                              <tr>
                                <td width="50%"><div class="grph-price-title" style="color:#6e6b6e !important;">Purchase Price</div></td>
                                <td width="50%"><div class="grph-price-title-price" style="color:#6e6b6e !important;">$350,000</div></td>
                              </tr>
                              <tr>
                                <td width="50%"><div class="grph-price-title" style="color:#6e6b6e !important;">Down Payment</div></td>
                                <td width="50%"><div class="grph-price-title-price" style="color:#6e6b6e !important;">$35,000</div></td>
                              </tr>
                              <tr>
                                <td width="50%"><div class="grph-price-title" style="color:#6e6b6e !important;">Loan Amount</div></td>
                                <td width="50%"><div class="grph-price-title-price" style="color:#6e6b6e !important;">$315,000</div></td>
                              </tr>
                              <tr>
                                <td width="50%"><div class="grph-price-title" style="color:#6e6b6e !important;">Interest Rate</div></td>
                                <td width="50%"><div class="grph-price-title-price" style="color:#6e6b6e !important;">4.0%</div></td>
                              </tr>
                            </table>

                        </div></td>
                      </tr>
                    </table>
                </div><!-- .loan-graph -->
            </div><!-- .loan-graph-area -->
  	  	</div><!-- .pg-8-content -->
<!--            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />-->
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-9">
		<div class="pg-9-header">
        	<h1>PAYMENT EXPLAINED</h1>
            <h2>Payment & Financing Options</h2>
        </div><!-- .pg-9-header -->
   	  	<div class="pg-9-content cf">
			<div class="pg9-blk cf">
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">PRINCIPAL & INTEREST :</span><span style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;"> $1,603</span><br />
This is the portion of your payment that goes
to pay down the balance that you borrowed.
If you opt for a fixed-rate loan, your monthly
payment will not change over the loan term,
but the makeup of your payment will change.
In the early years of your loan, you mostly pay
interest, but gradually you will begin to pay
more of the principal. The interest you pay is the cost of borrowing
money.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">Insurance :</span><span style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;"> $102</span><br />
You will pay one year of homeowner&rsquo;s insurance
premiums at your home settlement as
part of your closing costs, and then your lender
will collect one-twelfth of your annual insurance
premium in this account with each mortgage
payment. While most lenders require you
to pay your homeowner&rsquo;s insurance this way.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">Taxes :</span><span style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;"> $364</span><br />
Your lender usually requires an escrow account
and will collect one-twelfth of your annual
property tax bill in this account with each
mortgage payment.</div></div><!-- .pg9-detail-area -->

            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">PMI :</span><span style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;"> $139</span><br />
Your lender usually requires an escrow account
and will collect one-twelfth of your annual
property tax bill in this account with each
mortgage payment</div></div><!-- .pg9-detail-area -->
            </div><!-- .pg9-blk -->
			<div class="pg9-blk cf">
                            <div class="pg9-pit-image"><img src="assets/images/pg9-pit.png" alt="" width="325"/></div><!-- .pg9-pit-image -->
                <div class="pg9-fixprice">Sample Loan: 30-year fixed, 4.54% APR</div><!-- .pg9-fixprice -->
                <div class="grph-prx"><img src="assets/images/pg9-prices.png" style="background-color:<?php echo $theme ?>;" alt="" width="325"/></div>
            </div><!-- .pg9-blk -->
  	  	</div><!-- .pg-9-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-9">
		<div class="pg-9-header">
        	<h1>PROPERTY TAXES</h1>
            <h2>Payment & Financing Options</h2>
        </div><!-- .pg-9-header -->
   	  	<div class="pg-9-content cf">
			<div class="pg9-blk cf">
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">Impound Account Vs. Direct</span><br />
This is the portion of your payment that goes
to pay down the balance that you borrowed.
If you opt for a fixed-rate loan, your monthly
payment will not change over the loan term,
but the makeup of your payment will change.
In the early years of your loan, you mostly pay
interest, but gradually you will begin to pay
more of the principal.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">Impound Accounts</span><br />
You will pay one year of homeowner&rsquo;s insurance
premiums at your home settlement as
part of your closing costs, and then your lender
will collect one-twelfth of your annual insurance
premium in this account with each mortgage
payment. While most lenders require you
to pay your homeowner&rsquo;s insurance this way.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">Property Tax Due Dates</span><br />
Your lender usually requires an escrow account
and will collect one-twelfth of your annual
property tax bill in this account with each
mortgage payment.<br><br>**Penalties for deliquency are 10% on date of delinquency, plus $10.00 for deliquent 2nd installment. Thereafter, 1.5% per
month of original tax amount until paid.<br><br>
Property may be sold at public auction after 5 years of delinquency.</div></div><!-- .pg9-detail-area -->
            
            </div><!-- .pg9-blk -->
			<div class="pg9-blk cf">
                <div class="grph-prx"><img src="assets/images/pt.png" style="background-color:<?php echo $theme ?>;" alt="" width="325"/></div>
            </div><!-- .pg9-blk -->
  	  	</div><!-- .pg-9-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-9">
		<div class="pg-9-header">
        	<h1>SUPPLEMENTAL TAXES</h1>
            <h2>Payment & Financing Options</h2>
        </div><!-- .pg-9-header -->
   	  	<div class="pg-9-content cf">
			<div class="pg9-blk cf">
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">When This Came Into Effect</span><br />
The Supplemental Real Property Tax Law was signed by the Governor
in July of 1983 and is part of an ambitious drive to aid California’s
schools. This property tax revision is expected to produce over $300
million per year in revenue for schools.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">How Supplemental Taxes Affect You</span><br />
If you don’t plan on buying new property or undertaking any new
construction, this new tax will not affect you at all. But, if you do wish
to do either of the two, you will be required to pay a supplemental
property tax which can become a lien against your property if not paid
by the required due date.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">Billing: When & How</span><br />
“When” is not easy to predict. You could be billed in as few as three
weeks, or it could take over six months. “When” also depends on
the individual county and the workload of the County Assessor, the
County Controller/Auditor and the County Tax Collector. The assessor
will appraise your property and advise you of the new supplemental
assessment amount. The County will then calculate the amount of the
supplemental tax and the tax collector will mail you a supplemental
tax bill.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">What Comes on The Bill</span><br />
The supplemental tax bill will identify, among other things, the
following information: the amount of the supplemental tax and the
date on which the taxes will become delinquent.</div></div><!-- .pg9-detail-area -->
            </div><!-- .pg9-blk -->
			<div class="pg9-blk cf">
                            <div class="pg9-pit-image"><img src="assets/images/sb.jpg" alt="" width="325"/></div><!-- .pg9-pit-image -->
            </div><!-- .pg9-blk -->
  	  	</div><!-- .pg-9-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-14">
		<div class="pg-14-header">
        	<h1>PAYING OFF EARLY</h1>
            <h2>Benefits of 1 extra payment</h2>
        </div><!-- .pg-14-header -->
    	<div class="pg-14-content cf">
       	  <div class="pg14-short-desc">Making one additional mortgage payment a year can save you thousands of dollars and help you pay off your loan in less time.</div><!-- .pg14-short-desc -->
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                  <td width="40%" align="center" valign="middle">
                      <table width="95%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td width="90%" align="center" valign="middle" class="pg14-blue-bg">12 Monthly Payments/Year</td>
                        </tr>
                      </table>
                  </td>
                <td width="20%" align="center" valign="middle" bgcolor="#b4b6ba" class="pg14-center-text"><div style="line-height:50px;font-size:16px;">Repayment Example</div></td>
                <td width="40%" align="center" valign="middle">
                    <table width="95%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td width="90%" align="center" valign="middle" class="pg14-blue-bg">13 Payments/Year</td>
                        </tr>
                      </table>
                </td>
              </tr>
              <tr>
                <td width="40%" align="center" valign="middle" class="pg14-subtitle-text">12 Payments each year will put your total loan cost at $455,088</td>
                <td width="20%" align="center" valign="middle" bgcolor="#b4b6ba" style="border-bottom:#fff 1px solid;" class="pg14-center-text"><div  style="line-height:65px;">FACTORS</div></td>
                <td width="40%" align="center" valign="middle" class="pg14-subtitle-text">1 additional payments each year will save you $55,990 and reduce your term by 6 years</td>
              </tr>
              <tr>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="60%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818225; line-height:65px;">$200,000</div></td>
                        	<td width="40%" align="center" valign="middle"  bgcolor="#a5cd3a" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                        </tr>
                    </table>
                </td>
                <td width="20%" align="center" valign="middle" bgcolor="#b4b6ba" style="border-bottom:#fff 1px solid;">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td width="100%" align="center" valign="middle"><img src="assets/images/pg14-icon-1.png" alt="" height="45" /></td>
                        </tr>
                        <tr>
                        	<td width="100%" align="center" valign="middle" class="pg14-center-text"><div  style="line-height:20px;">Original Loan</div></td>
                        </tr>
                    </table>
                </td>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="40%" align="center" valign="middle"  bgcolor="#49718b" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                        	<td width="60%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818285; line-height:65px;">$200,000</div></td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="50%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818285; line-height:65px;">30-Yr Fixed</div></td>
                        	<td width="50%" align="center" valign="middle"  bgcolor="#a5cd3a" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                        </tr>
                    </table>
                </td>
                <td width="20%" align="center" valign="middle" bgcolor="#b4b6ba" style="border-bottom:#fff 1px solid;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td width="100%" align="center" valign="middle"><img src="assets/images/pg14-icon-2.png" alt="" height="45" /></td>
                        </tr>
                        <tr>
                        	<td width="100%" align="center" valign="middle" class="pg14-center-text"><div  style="line-height:20px;">Term</div></td>
                        </tr>
                    </table></td>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="50%" align="center" valign="middle"  bgcolor="#49718b" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                        	<td width="50%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818285; line-height:65px;">30-Yr Fixed</div></td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="75%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818285; line-height:65px;">6.5 %</div></td>
                        	<td width="25%" align="center" valign="middle"  bgcolor="#a5cd3a" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                        </tr>
                    </table>
                </td>
                <td width="20%" align="center" valign="middle" bgcolor="#b4b6ba" style="border-bottom:#fff 1px solid;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td width="100%" align="center" valign="middle"><img src="assets/images/pg14-icon-3.png" alt="" height="45" /></td>
                        </tr>
                        <tr>
                        	<td width="100%" align="center" valign="middle" class="pg14-center-text"><div  style="line-height:20px;">Interest Rate</div></td>
                        </tr>
                    </table></td>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="25%" align="center" valign="middle"  bgcolor="#49718b" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                        	<td width="75%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818285; line-height:65px;">6.5%</div></td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="98%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818285; line-height:65px;">$1,264</div></td>
                        	<td width="2%" align="center" valign="middle"  bgcolor="#a5cd3a" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                        </tr>
                    </table>
                </td>
                <td width="20%" align="center" valign="middle" bgcolor="#b4b6ba" style="border-bottom:#fff 1px solid;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td width="100%" align="center" valign="middle"><img src="assets/images/pg14-icon-4.png" alt="" height="45" /></td>
                        </tr>
                        <tr>
                        	<td width="100%" align="center" valign="middle" class="pg14-center-text"><div style="line-height:20px;font-size: 15px;">Monthly Payment</div></td>
                        </tr>
                    </table></td>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="2%" align="center" valign="middle"  bgcolor="#49718b" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                       	  <td width="98%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818285; line-height:65px;">$1,264</div></td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="45%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818285; line-height:65px;">$255,088</div></td>
                        	<td width="55%" align="center" valign="middle"  bgcolor="#a5cd3a" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                        </tr>
                    </table>
                </td>
                <td width="20%" align="center" valign="middle" bgcolor="#b4b6ba" style="border-bottom:#fff 1px solid;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td width="100%" align="center" valign="middle"><img src="assets/images/pg14-icon-5.png" alt="" height="45" /></td>
                        </tr>
                        <tr>
                        	<td width="100%" align="center" valign="middle" class="pg14-center-text"><div style="line-height:20px;">Total Interest</div></td>
                        </tr>
                    </table></td>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="55%" align="center" valign="middle"  bgcolor="#49718b" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"></td>
                       	  <td width="45%" align="center" valign="middle"><div style="font-family: museosansrounded-300-7h; font-size:22px; color:#818285; line-height:65px;">$199,088</div></td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td width="40%" align="center" valign="middle"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="10%" align="center" valign="middle"></td>
                        	<td width="90%" align="center" valign="middle"  bgcolor="#a5cd3a" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"><div style="font-family: museosansrounded-900-7g; font-size:28px; color:#fff; text-align:left; padding:0 0 0 15px; line-height:65px;">$455,088</div></td>
                        </tr>
                    </table></td>
                <td width="20%" align="center" valign="middle" bgcolor="#b4b6ba"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                            <td width="100%" align="center" valign="middle"><img src="assets/images/pg14-icon-6.png" alt="" height="45" /></td>
                        </tr>
                        <tr>
                        	<td width="100%" align="center" valign="middle" class="pg14-center-text"><div style="line-height:20px;">After 30 Years</div></td>
                        </tr>
                    </table></td>
                <td width="40%" align="center" valign="middle">
                	<table width="90%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td width="90%" align="center" valign="middle"  bgcolor="#49718b" style=" -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px;"><div style="font-family: museosansrounded-900-7g; font-size:28px; color:#fff; text-align:right; padding:0 15px 0 0; line-height:65px;">$399,088</div></td>
                       	  <td width="10%" align="center" valign="middle"></td>
                        </tr>
                    </table>
                </td>
              </tr>
            </table>

  	  	</div><!-- .pg-14-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-10">
		<div class="pg-10-header">
        	<h1>HOME BUYING PROCESS</h1>
            <h2>Payment & Financing Options</h2>
        </div><!-- .pg-10-header -->
    	<div class="pg-10-content cf">
			<div class="pg10-row cf">
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                      <td width="10%" align="center" valign="middle" bgcolor="#3f3f3f"><img src="assets/images/pg10-icon-1.png" alt="" width="70" /></td>
                    <td width="80%" align="left" valign="top" bgcolor="#3f3f3f">
                    	<div style="font-family: museosansrounded-900-7g; font-size:20px; color:#ffffff;">Meet With A Real Estate Professional</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:19px; color:#ffffff; margin:0; padding:0;">Discuss the type of home you&rsquo;re looking for, including style, price, and location.</p>
                    </td>
                    <td width="10%" align="right" valign="middle" bgcolor="#ffffff"><img src="assets/images/pg10-arrow-4.png" align="" width="114" /></td>
                  </tr>
                </table>

      </div><!-- .pg10-row -->
			<div class="pg10-row cf">
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td width="10%" align="left" valign="middle" bgcolor="#ffffff"><img src="assets/images/pg10-arrow-5.png" alt="" width="114" /></td>
                    <td width="80%" align="right" valign="top" bgcolor="#545454">
                    	<div style="font-family: museosansrounded-900-7g; font-size:20px; color:#ffffff;">Get Pre-Approved</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:19px; color:#ffffff; margin:0; padding:0;">You will need pay stubs, W2s, and bank statements. Knowing what you can afford is critical.</p>
                    </td>
                    <td width="10%" align="center" valign="middle" bgcolor="#545454"><img src="assets/images/pg10-icon-2.png" align=""  width="70"/></td>
                  </tr>
                </table>

      </div><!-- .pg10-row -->
      		
            <div class="pg10-row cf">
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td width="10%" align="center" valign="middle" bgcolor="#696969"><img src="assets/images/pg10-icon-3.png" alt="" width="70" /></td>
                    <td width="80%" align="left" valign="top" bgcolor="#696969">
                    	<div style="font-family: museosansrounded-900-7g; font-size:20px; color:#ffffff;">Search for Homes</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:19px; color:#ffffff; margin:0; padding:0;">The fun part! Your agent will schedule showings and help you find the perfect home.</p>
                    </td>
                    <td width="10%" align="right" valign="middle" bgcolor="#ffffff"><img src="assets/images/pg10-arrow-6.png" align="" width="114" /></td>
                  </tr>
                </table>

      </div><!-- .pg10-row -->
			<div class="pg10-row cf">
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td width="10%" align="left" valign="middle" bgcolor="#ffffff"><img src="assets/images/pg10-arrow-7.png" alt="" width="114px" /></td>
                    <td width="80%" align="right" valign="top" bgcolor="#7e7e7e">
                    	<div style="font-family: museosansrounded-900-7g; font-size:20px; color:#ffffff;">Make An Offer</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:19px; color:#ffffff; margin:0; padding:0;">Your agent will prepare the offer based on the price and terms you choose.</p>
                    </td>
                    <td width="10%" align="center" valign="middle" bgcolor="#7e7e7e"><img src="assets/images/pg10-icon-4.png" align="" width="70" /></td>
                  </tr>
                </table>

      </div><!-- .pg10-row -->
      		
            <div class="pg10-row cf">
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td width="10%" align="center" valign="middle" bgcolor="#939393"><img src="assets/images/pg10-icon-5.png" alt="" width="70" /></td>
                    <td width="80%" align="left" valign="top" bgcolor="#939393">
                    	<div style="font-family: museosansrounded-900-7g; font-size:20px; color:#ffffff;">Negotiation and Contract</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:19px; color:#ffffff; margin:0; padding:0;">It may take a few tries to get it just right, but hang in there. You&rsquo;re on your way.</p>
                    </td>
                    <td width="10%" align="right" valign="middle" bgcolor="#ffffff"><img src="assets/images/pg10-arrow-8.png" align="" width="114" /></td>
                  </tr>
                </table>

      </div><!-- .pg10-row -->
			<div class="pg10-row cf">
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td width="10%" align="left" valign="middle" bgcolor="#ffffff"><img src="assets/images/pg10-arrow-9.png" alt="" width="114" /></td>
                    <td width="80%" align="right" valign="top" bgcolor="#a8a8a8">
                    	<div style="font-family: museosansrounded-900-7g; font-size:20px; color:#ffffff;">Under Contract</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:19px; color:#ffffff; margin:0; padding:0;">You and the seller have agreed to the price and terms. The home is effectively held for you until closing.</p>
                    </td>
                    <td width="10%" align="center" valign="middle" bgcolor="#a8a8a8"><img src="assets/images/pg10-icon-6.png" align=""  width="70"/></td>
                  </tr>
                </table>

      </div><!-- .pg10-row -->
      		
            <div class="pg10-row cf">
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td width="10%" align="center" valign="middle" bgcolor="#bdbdbd"><img src="assets/images/pg10-icon-7.png" alt=""  width="60" /></td>
                    <td width="80%" align="left" valign="top" bgcolor="#bdbdbd">
                    	<div style="font-family: museosansrounded-900-7g; font-size:20px; color:#ffffff;">Final Details</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:19px; color:#ffffff; margin:0; padding:0;">Perform due diligence, order the appraisal, conduct an inspection, and review terms with the lender</p>
                    </td>
                    <td width="10%" align="right" valign="middle" bgcolor="#ffffff"><img src="assets/images/pg10-arrow-10.png" align=""  width="114" /></td>
                  </tr>
                </table>

      </div><!-- .pg10-row -->
			<div class="pg10-row cf">
       	    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td width="10%" align="left" valign="middle" bgcolor="<?php echo $theme ?>">&nbsp;</td>
                  <td width="80%" align="right" valign="top" bgcolor="<?php echo $theme ?>">
           	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:#ffffff;">Closings</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:17px; color:#ffffff; margin:0; padding:0;">This is the transfer of funds and ownership. A title
company typically will facilitate the closing.</p>
                    </td>
                    <td width="10%" align="center" valign="middle" bgcolor="<?php echo $theme ?>"><img src="assets/images/pg10-icon-8.png" align="" width="70" /></td>
                  </tr>
                </table>

      </div><!-- .pg10-row -->
  	  	</div><!-- .pg-10-content -->
        <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-11">
		<div class="pg-11-header">
        	<h1>HOME LOAN PROCESS</h1>
            <h2>Payment & Financing Options</h2>
        </div><!-- .pg-11-header -->
    	<div class="pg-11-content cf">
        	<div class="pg11-row cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td width="10%" align="center" valign="middle"><img src="assets/images/pg11-icon-1.png" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top">
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">Pre-Qualification</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:15px; color:#76777b; margin:0; padding:0;">By pre-qualifying you, your Mortgage Specialist can give you an idea right from the beginning of just how much home you can afford. This will tell you the price range of the homes you should be looking at.</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
        	<div class="pg11-row cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td width="10%" align="center" valign="middle"><img src="assets/images/pg11-icon-2.png" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top">
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">Mortgage Application</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:15px; color:#76777b; margin:0; padding:0;">The application is the beginning of the formal loan process. The applicant completes a
mortgage application with the Mortgage Professional and supplies all of the required information
and documentation for processing</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
        	<div class="pg11-row cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td width="10%" align="center" valign="middle"><img src="assets/images/pg11-icon-3.png" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top">
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">The Loan Estimate</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:15px; color:#76777b; margin:0; padding:0;">The Loan Estimate provides you with important information, including the estimated interest
rate, monthly payment, and total closing costs for the loan. The Loan Estimate also</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
        	<div class="pg11-row cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td width="10%" align="center" valign="middle"><img src="assets/images/pg11-icon-4.png" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top">
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">Loan Processing</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:15px; color:#76777b; margin:0; padding:0;">After completing your application the your loan officer will submit your application to the
loan processor, who will compile the file, order the appraisal and gather any additional
information and verification.</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
        	<div class="pg11-row cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td width="10%" align="center" valign="middle"><img src="assets/images/pg11-icon-5.png" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top">
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">Required Documents</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:15px; color:#76777b; margin:0; padding:0;">Prepare for your appointments by making copies of your essential paperwork for each
lender. You will need your Social Security number and driver&rsquo;s license, the past two years of
W-2s and one month&rsquo;s pay stubs to verify income. If you are self-employed, you will need</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
        	<div class="pg11-row cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td width="10%" align="center" valign="middle"><img src="assets/images/pg11-icon-6.png" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top">
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">Loan Underwriting</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:15px; color:#76777b; margin:0; padding:0;">Once the processor has put together a complete package with all verifications and documentation,
the file is sent to the lender. The underwriter is responsible for determining
whether the package is deemed an acceptable loan.</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
        	<div class="pg11-row cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                    <td width="10%" align="center" valign="middle"><img src="assets/images/pg11-icon-7.png" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top">
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">Closing Disclosure</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:15px; color:#76777b; margin:0; padding:0;">Your loan officer will provide you with a copy of the Closing Disclosure at least 3 business
days before you sign your mortgage loan documents. This document discloses the actual
dollar amounts you will pay for the various fees and services associated with the closing of
your mortgage loan.</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
        	<div class="pg11-row cf">
            	<table width="100%" border="0" cellspacing="0" cellpadding="4">
                  <tr>
                      <td width="10%" align="center" valign="middle"><img src="assets/images/pg11-icon-8.png" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top">
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">Closing Time</div>
                        <p style="font-family: museosansrounded-300-7h; font-size:15px; color:#76777b; margin:0; padding:0;">At the closing, the lender &ldquo;funds&rdquo; the loan with a cashier&rsquo;s check, draft or wire to the selling
party in exchange for the title to the property. This is the point at which the borrower has
completed the loan process and the transaction is &ldquo;closed&rdquo;.</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
  	  	</div><!-- .pg-11-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-13">
		<div class="pg-13-header">
        	<h1>LOAN CHECKLIST</h1>
            <h2>Some needed items</h2>
        </div><!-- .pg-13-header -->
    	<div class="pg-13-content cf">
        	<div class="pg13-short-desc">Making one additional mortgage payment a year 
can save you thousands of dollars and help 
you pay off your loan in less time.</div><!-- .pg13-short-desc -->
			<div class="pg13-blk cf">
       	    	<div class="pg13-blk-row cf">
                	<div class="pg13-blk-row-title-area" style="margin-left:0">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td width="80%" align="left" valign="middle">
                            	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:#fff; line-height:50px; margin:0 0 0 20px;">Income</div>
                            </td>
                            <td width="20%" align="center" valign="middle"><img src="assets/images/pg13-icon-1.png" alt="" height="42"/></td>
                          </tr>
                        </table>
              		</div><!-- .pg13-blk-row-title-area -->
                    <div class="pg13-blk-row-detail-area cf" style="margin-left:0">
                    	<div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 20px 10px 10px; padding:0;"><span style="font-family: museosansrounded-900-7g; color:#76777b;">Qualifying Income</span> - Must have 2 years of income history to qualify.</div>
                        <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 0 0 15px; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> W2, self employed or 1099 employee</div>
                        <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 0 0 15px; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Self Employed? Net Income is used</div>
                        <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 0 10px 15px; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Not self employed? Gross Income is Used</div>
                    	<div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 20px 10px 15px; padding:0;"><span style="font-family: museosansrounded-900-7g; color:#76777b;">Rental Income</span> - Must have 2 years of rental income to qualify.</div>
                    	<div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 20px 10px 15px; padding:0;"><span style="font-family: museosansrounded-900-7g; color:#76777b;">Other forms:</span> Social Security, commission, car allowances, child support, interest and dividend income.</div>
                    </div><!-- .pg13-blk-row-detail-area -->
              </div><!-- .pg13-blk-row -->
       	    	<div class="pg13-blk-row cf">
                	<div class="pg13-blk-row-title-area" style="margin-left:0">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td width="80%" align="left" valign="middle">
                            	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:#fff; line-height:50px; margin:0 0 0 25px;">Credit</div>
                            </td>
                            <td width="20%" align="center" valign="middle"><img src="assets/images/pg13-icon-2.png" alt="" height="42"/></td>
                          </tr>
                        </table>
              		</div><!-- .pg13-blk-row-title-area -->
                    <div class="pg13-blk-row-detail-area cf" style="margin-left:0">
                    	<div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 20px 10px 10px; padding:0;"><span style="font-family: museosansrounded-900-7g; color:#76777b;">Qualifying Income</span> - Must have 2 years of income history to qualify.</div>
                        <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 0 0 25px; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> W2, self employed or 1099 employee</div>
                        <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 0 0 25px; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Self Employed? Net Income is used</div>
                        <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 0 10px 25px; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Not self employed? Gross Income is Used</div>
                    	<div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 20px 10px 10px; padding:0;"><span style="font-family: museosansrounded-900-7g; color:#76777b;">Rental Income</span> - Must have 2 years of rental income to qualify.</div>
                    	<div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 20px 10px 10px; padding:0;"><span style="font-family: museosansrounded-900-7g; color:#76777b;">Other forms:</span> Social Security, commission, car allowances, child support, interest and dividend income.</div>
                    </div><!-- .pg13-blk-row-detail-area -->
              </div><!-- .pg13-blk-row -->
            </div><!-- .pg13-blk -->
			<div class="pg13-blk cf">
       	    	<div class="pg13-blk-row cf">
                	<div class="pg13-blk-row-title-area" style="margin-right:0">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td width="80%" align="left" valign="middle">
                            	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:#fff; line-height:50px; margin:0 0 0 25px;">Assets</div>
                            </td>
                            <td width="20%" align="center" valign="middle"><img src="assets/images/pg13-icon-4.png" alt="" height="42" /></td>
                          </tr>
                        </table>
              		</div><!-- .pg13-blk-row-title-area -->
                    <div class="pg13-blk-row-detail-area cf" style="margin-right:0">
                    	<div style="font-family: museosansrounded-300-7h; font-size:18px; color:#76777b;  margin:0 20px 15px 10px; padding:0;"><span style="font-family: museosansrounded-900-7g; color:#76777b;">The following assets may be resources for your down payment and must be verified by your lender.</span></div>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="50%" align="left" valign="top">
                           	  <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Savings/Checking</div>
                                <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> IRA&rsquo;s, 401k&rsquo;s,</div>
                                <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Stocks and Bonds</div>
                                <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Savings Bonds</div>
                                <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 0 10px 0; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Gift Funds</div>
                            </td>
                            <td width="50%" align="left" valign="top">
                            	<div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Sale of Property</div>
                                <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Sale of Real Estate</div>
                                <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Collateralized Loan</div>
                                <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Grants</div>
                            </td>
                          </tr>
                        </table>

                    	<div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 20px 21px 10px; padding:0;"><br /><br /></div>
                   <br></div><!-- .pg13-blk-row-detail-area -->
              </div><!-- .pg13-blk-row -->		
       	    	<div class="pg13-blk-row cf">
                	<div class="pg13-blk-row-title-area" style="margin-right:0">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td width="80%" align="left" valign="middle">
                            	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:#fff; line-height:50px; margin:0 0 0 25px;">Employment</div>
                            </td>
                              <td width="20%" align="center" valign="middle"><img src="assets/images/pg13-icon-3.png" alt="" height="42"/></td>
                          </tr>
                        </table>
              		</div><!-- .pg13-blk-row-title-area -->
      <div class="pg13-blk-row-detail-area cf" style="margin-right:0">
                    	<div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 20px 15px 10px; padding:0;"><span style="font-family: museosansrounded-900-7g; color:#76777b;">Employment history of at least 2 years</span></div>
                        <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 0 0 25px; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Education might count as history</div>
                        <div style="font-family: museosansrounded-300-7h; font-size:16px; color:#76777b;  margin:0 0 10px 25px; padding:0; line-height:25px;"><img src="assets/images/pg13-check-1.png" alt="" width="16" style="margin:0 0 -4px 0;"/> Self-Employment must be greater than 2 years with the same business.<br /><br /><br /><br /><br /><br /><br /></div>
                    </div><!-- .pg13-blk-row-detail-area -->
              <br> </div><!-- .pg13-blk-row -->
            </div><!-- .pg13-blk -->
  	  	</div><!-- .pg-13-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-9a">
		<div class="pg-9a-header">
        	<h1>WHO PAYS WHAT</h1>
            <h2>Payment & Financing Options</h2>
        </div><!-- .pg-9a-header -->
   	  	<div class="pg-9a-content cf">
		        	<div class="pg9a-short-desc">The costs and charges of a
Southern California real estate transaction are fully negotiable between the Buyer and Seller through their respective agents.
The negotiated terms will be set forth accordingly in the Purchase Agreement.</div><br><!-- .pg13-short-desc -->
			<div class="pg9a-blk cf">
			  <div class="pg9a-pit-image"><img src="assets/images/tsp.png" style="background-color:<?php echo $theme ?>;" alt="" width="325"/></div><!-- .pg9a-pit-image -->
            	<div class="pg9a-detail-area"><div class="pg9a-desc"><span style="font-family: museosansrounded-300-7h; font-size:17px; color:#818285;">Can Generally Expect To Pay:</span><br>
<ul>

<li>Real Estate Broker’s commission</li>
<li>Current Or past due Property Taxes</li>
<li>Prorated taxes, Interest, Rent, or HOA dues
 </li>
<li style="line-height: 100%;" >Payoff of all loans, liens and judgments
of record against the property</li>
<li> Loan fees required by Buyer’s lender
</li>
<li style="line-height: 100%;">Homeowners Association transfer fee,
document fee and demand fee</li><br>
<li li style="line-height: 100%;">Termite inspection reports and cost for
repairs</li>
<li>Home warranty plan</li>
<li>Title insurance premium for Owner’s Policy</li>
<li>Escrow fee (Seller’s portion) </li>
<li style="line-height: 100%;" >Document preparation fee for Grant Deed
and other recordable document(s)</li>
<li>Notary Public fees</li>
<li>Documents recording charges</li>
<li>County Transfer Tax </li>
<li>City Transfer Tax (varies by city) </li>
</ul>
</div></div><!-- .pg9a-detail-area -->
            	
            
            </div><!-- .pg9a-blk -->
			<div class="pg9a-blk cf">
			 <div class="pg9a-pit-image"><img src="assets/images/tbp.png" style="background-color:<?php echo $theme ?>;" alt="" width="325"/></div><!-- .pg9a-pit-image -->
            	<div class="pg9a-detail-area"><div class="pg9a-desc"><span style="font-family: museosansrounded-300-7h; font-size:17px; color:#818285;">Can Generally Expect To Pay:</span><br>
<ul>

<li style="line-height: 100%;">Prorated taxes, interest, rent, HOA dues
(could be credit or debit)</li><br>
<li style="line-height: 100%;">Payable taxes (not yet delinquent) required
to be paid in advance by lender</li>
<li>Inspection fees</li>
<li style="line-height: 100%;">New financing costs, fees, prepaid interest
and impounds, if any (except those costs to
be paid by Seller, as required by Lender or
as negotiated in Purchase Agreement) or
assumption costs if existing financing is to
be assumed by Buyer</li><br>
<li style="line-height: 100%;">Hazard insurance premium - year paid in
advance</li>
<li>Title insurance premium for Lender’s Policy</li>
<li>Escrow fee (Buyer’s portion) </li>
<li>Document preparation fee</li>
<li>Notary Public fees </li>
<li>Document recording charges</li>

</ul>
</div></div><!-- .pg9a-detail-area -->
            	
            
            </div><!-- .pg9a-blk -->
  	  	</div><!-- .pg-9-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-11a">
		<div class="pg-11a-header">
        	<h1>PROPERTY VESTING</h1>
            <h2>How to take ownership of your property</h2>
        </div><!-- .pg-11-header -->
    	<div class="pg-11a-content cf">
		<div class="pg11a-short-desc">Real property is among the most valuable of assets, the question of how parties take ownership of their property is of great importance. The form of ownership taken—the vesting of title—will determine who may sign various documents involving the property and future rights of the parties to the transaction. These rights involve such matters as: real property taxes, income taxes, inheritance and gift taxes, transferability of title and exposure to creditor’s claims. Also, how title is vested can have significant probate implications in the event of death.</div><br><!-- .pg13-short-desc -->
        	<div class="pg11a-row cf">
            	<table width="100%" border="0" class="supp-text" cellspacing="0" cellpadding="4">
                  <tr class="supp-text">
                    <td width="10%" align="center" valign="top"><img src="assets/images/sole.png" style="background-color:<?php echo $theme ?>;" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top" class="supp-text" >
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">SOLE OWNERSHIP</div>
                        <p class="supp-text">1.	A Single Man or Woman, an Unmarried Man or Woman or a Widow or Widower: A man or woman who is not legally married or in a domestic partnership.</p>
						<p class="supp-text">2.	A Married Man or Woman as His or Her Sole and Separate Property: A married man or woman who wishes to acquire title in his or her name alone.</p>
						<p class="supp-text">3.	A Domestic Partner as His or Her Sole and Separate Property: A domestic partner who wishes to acquire title in his or her name alone.</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
        	<div class="pg11a-row cf">
            	<table width="100%" border="0" class="supp-text" cellspacing="0" cellpadding="4">
                  <tr class="supp-text">
                    <td width="10%" align="center" valign="top"><img src="assets/images/co.png" style="background-color:<?php echo $theme ?>;" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top" class="supp-text">
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">CO-OWNERSHIP</div>
                        <p class="supp-text">1. Community Property: A form of vesting title to property owned together by married persons or by domestic partners.</p>
						<p class="supp-text">2.	Community Property with Right of Survivorship: A form of vesting title to property owned together by spouses or by domestic partners. This form of holding title shares many of the characteristics of community property but adds the benefit of the right of survivorship similar to title held in joint tenancy.</p>
						<p class="supp-text">3.	Joint Tenancy: A form of vesting title to property owned by two or more persons, who may or may not be married or domestic partners, in equal interests, subject to the right of survivorship in the surviving joint tenant(s).</p>
						<p class="supp-text">4.	Tenancy in Common: A form of vesting title to property owned by any two or more individuals in undivided fractional interests. These fractional interests may be unequal in quantity or duration and may arise at different times.</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->
        	<div class="pg11a-row cf">
            	<table width="100%" border="0" class="supp-text" cellspacing="0" cellpadding="4">
                  <tr class="supp-text">
                    <td width="10%" align="center" valign="top"><img src="assets/images/trust.png" style="background-color:<?php echo $theme ?>;" alt="" width="50" /></td>
                    <td width="90%" align="left" valign="top" class="supp-text" >
                    	<div style="font-family: museosansrounded-900-7g; font-size:18px; color:<?php echo $theme ?>;">OTHER WAYS OF VESTING</div>
                        <p class="supp-text">1.Corporation</p>
						<p class="supp-text">2.Partnership</p>
						<p class="supp-text">3.Trustees of a Trust</p>
						<p class="supp-text">4.Limited Liability Companies ( LLC )</p><br>
						<p >*In cases of corporate, partnership, LLC or trust ownership - required documents may include corporate articles and bylaws, partnership agreements, LLC operating agreements and trust agreements and/or certificates.</p>
                    </td>
                  </tr>
                </table>

            </div><!-- .pg11-row -->




 
  	  	</div><!-- .pg-11-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
<article>
	<div class="page-9">
		<div class="pg-9-header">
        	<h1>HOME WARRANTY INFO</h1>
            <h2>Payment & Financing Options</h2>
        </div><!-- .pg-9-header -->
   	  	<div class="pg-9-content cf">
			<div class="pg9-blk cf">
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">What Is a Home Warranty</span><br />
A home warranty is a service contract that covers the repair or replacement of important home system components and appliances that break down over time. A home warranty can help save you money.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">What Does it Cover</span><br />
Items available for home warranty coverage may include: central air conditioning systems, central heating systems, kitchen appliances, clothes washer and dryer, plumbing system, electrical system and roof leaks. Many of these items are covered based on the home warranty plan that you choose.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">Home Warranty Vs. Home Insurance</span><br />
Home Insurance covers what might happen, but if your A/C, refrigerator, or heating system went out, who would you call? Unlike most homeowners insurance, a Home Warranty covers what will happen like the inevitable breakdowns of major home system components and appliances that wear out over time.</div></div><!-- .pg9-detail-area -->
            	<div class="pg9-detail-area"><div class="pg9-desc"><span style="font-family: museosansrounded-900-7g; font-size:18px; color:#818285;">How Does it Work</span><br />
When an appliance breaksdown just call for service. That's It.</div></div><!-- .pg9-detail-area -->
            </div><!-- .pg9-blk -->
			<div class="pg9-blk cf">
                            <div class="pg9-pit-image"><img src="assets/images/hwap.png" style="background-color:<?php echo $theme ?>;" alt="" width="325"/></div><!-- .pg9-pit-image -->
            </div><!-- .pg9-blk -->
  	  	</div><!-- .pg-9-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>

<article>
	<div class="page-12">
		<div class="pg-12-header">
        	<h1>PARTIES INVOLVED</h1>
            <h2>Payment & Financing Options</h2>
        </div><!-- .pg-12-header -->
    	<div class="pg-12-content cf">
        	<div class="pg12-blk cf">
            	<div class="pg12-blk-row">
                	<table width="100%" border="0" style="margin-bottom:40px;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%" align="center" valign="middle"><img src="assets/images/pg12-icon-1.png" alt="" /></td>
                        <td width="80%" align="left" valign="top">
                        	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:<?php echo $theme ?>; margin:0 20px 0 10px;">BUYERS AGENT</div>
                        	<p style="font-family: museosansrounded-300-7h; font-size:17px; color:#76777b;  margin:0 20px 0 10px; padding:0;">Buyer&rsquo;s agents specialize in
searching out, locating and negotiating
the purchase of property
on behalf of a buyer.</p>
                        </td>
                      </tr>
                    </table>

                </div><!-- .pg12-blk-row -->
            	<div class="pg12-blk-row">
                	<table width="100%" border="0" style="margin-bottom:40px;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%" align="center" valign="middle"><img src="assets/images/pg12-icon-3.png" alt="" /></td>
                        <td width="80%" align="left" valign="top">
                        	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:<?php echo $theme ?>; margin:0 20px 0 10px;">LOAN OFFICER</div>
                        	<p style="font-family: museosansrounded-300-7h; font-size:17px; color:#76777b;  margin:0 20px 0 10px; padding:0;">A loan officer is a representative
of a bank or other financial institution.
They help customers
identify their borrowing options
and help them understand the
terms of their loan.</p>
                        </td>
                      </tr>
                    </table>

                </div><!-- .pg12-blk-row -->
            	<div class="pg12-blk-row">
                	<table width="100%" border="0" style="margin-bottom:40px;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%" align="center" valign="middle"><img src="assets/images/pg12-icon-5.png" alt="" /></td>
                        <td width="80%" align="left" valign="top">
                        	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:<?php echo $theme ?>; margin:0 20px 0 10px;">HOME INSPECTOR</div>
                        	<p style="font-family: museosansrounded-300-7h; font-size:17px; color:#76777b;  margin:0 20px 0 10px; padding:0;">A home inspector objectively
and independently provides
a comprehensive analysis of
a home&rsquo;s major systems and
components.</p>
                        </td>
                      </tr>
                    </table>

                </div><!-- .pg12-blk-row -->
            	<div class="pg12-blk-row">
                	<table width="100%" border="0" style="margin-bottom:40px;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%" align="center" valign="middle"><img src="assets/images/pg12-icon-7.png" alt="" /></td>
                        <td width="80%" align="left" valign="top">
                        	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:<?php echo $theme ?>; margin:0 20px 0 10px;">ESCROW OFFICER</div>
                        	<p style="font-family: museosansrounded-300-7h; font-size:17px; color:#76777b;  margin:0 20px 0 10px; padding:0;">An escrow is a non-biased third
party who works with all participants
to facilitate a successful
closing of a real estate transaction.
At closing, the closing
officer will collect the purchase
money funds from the buyer and
lender as well as the settlement
costs from each party.</p>
                        </td>
                      </tr>
                    </table>

                </div><!-- .pg12-blk-row -->
            </div><!-- .pg12-blk -->
        	<div class="pg12-blk cf">
            	<div class="pg12-blk-row">
                	<table width="100%" border="0" style="margin-bottom:40px;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%" align="center" valign="middle"><img src="assets/images/pg12-icon-2.png" alt="" /></td>
                        <td width="80%" align="left" valign="top">
                        	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:<?php echo $theme ?>; margin:0 20px 0 10px;">LISTING AGENT</div>
                        	<p style="font-family: museosansrounded-300-7h; font-size:17px; color:#76777b;  margin:0 20px 0 10px; padding:0;">A listing agent or broker forms
a legal relationship with the
homeowner to sell the
property.</p>
                        </td>
                      </tr>
                    </table>

                </div><!-- .pg12-blk-row -->
            	<div class="pg12-blk-row">
                	<table width="100%" border="0" style="margin-bottom:40px;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%" align="center" valign="middle"><img src="assets/images/pg12-icon-4.png" alt="" /></td>
                        <td width="80%" align="left" valign="top">
                        	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:<?php echo $theme ?>; margin:0 20px 0 10px;">INSURANCE AGENT</div>
                        	<p style="font-family: museosansrounded-300-7h; font-size:17px; color:#76777b;  margin:0 20px 0 10px; padding:0;">An insurance agent helps a
homebuyer determine the
homeowner&rsquo;s protection coverage
needed and then finds the
right insurance policy to fit those
needs.</p>
                        </td>
                      </tr>
                    </table>

                </div><!-- .pg12-blk-row -->
            	<div class="pg12-blk-row">
                	<table width="100%" border="0" style="margin-bottom:40px;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%" align="center" valign="middle"><img src="assets/images/pg12-icon-6.png" alt="" /></td>
                        <td width="80%" align="left" valign="top">
                        	<div style="font-family: museosansrounded-900-7g; font-size:22px; color:<?php echo $theme ?>; margin:0 20px 0 10px;">TITLE COMPANY</div>
                        	<p style="font-family: museosansrounded-300-7h; font-size:17px; color:#76777b;  margin:0 20px 0 10px; padding:0;">A closing or title agent performs
title searches to ensure a clear
title so a title insurance policy
can be issued. In some states
they are able to facilitate the
transfer of real estate.</p>
                        </td>
                      </tr>
                    </table>

                </div><!-- .pg12-blk-row -->
            	<div class="pg12-blk-row">
                	<table width="100%" border="0" style="margin-bottom:40px;" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="20%" align="center" valign="middle"><img src="assets/images/pg12-icon-8.png" alt="" /></td>
                        <td width="80%" align="left" valign="top">
                        	<div style="font-family: museosansrounded-900-7g; font-size:28px; color:<?php echo $theme ?>; margin:0 20px 0 10px;">APPRAISER</div>
                        	<p style="font-family: museosansrounded-300-7h; font-size:17px; color:#76777b;  margin:0 20px 0 10px; padding:0;">An escrow is a non-biased third
party who works with all participants
to facilitate a successful
closing of a real estate transaction.
At closing, the closing
officer will collect the purchase
money funds from the buyer and
lender as well as the settlement
costs from each party.</p>
                        </td>
                      </tr>
                    </table>

                </div><!-- .pg12-blk-row -->
            </div><!-- .pg12-blk -->
  	  	</div><!-- .pg-12-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>

<article>




<article>
	<div class="page-15">
		<div class="pg-15-header">
        	<h1>COMMON TERMS</h1>
            <h2>Transaction Lingo & Terms</h2>
        </div><!-- .pg-15-header -->
    	<div class="pg-15-content cf">
       	  <div class="pg15-desc"><span>Contingencies -</span> A contingency is a condition that must be met before the contract between the buyer and the seller becomes legally binding.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Closing Costs -</span> Closing costs are the various fees, charges and taxes needed to (A) originate a mortgage loan and (B) transfer a property from seller to buyer.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Closing Disclosure -</span> A Closing Disclosure is a five-page form that provides final details about the mortgage loan you have selected. It includes the loan terms, your projected monthly payments, and how much you will pay in fees and other costs to get your mortgage (closing costs).</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Days on Market -</span> (DOM) stands for Days on market and it tells you how long a home has been for sale.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Disclosures -</span> The making known of a fact that had previously been hidden. For example, a home seller must disclose major physical defects in a house within his or her knowledge.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Earnest Money Deposit -</span> The earnest money deposit is the money you provide along with your offer on a house as a show of good faith.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Fixed Rate vs. Adjustable Rate Mortgages -</span> A fixed rate mortgage has the same interest rate throughout the life of the loan. An adjustable rate mortgage has a variable interest rate that changes after a predetermined amount of years.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Hazard Insurance: -</span> A form of insurance in which the insurance company protects the insured from specified losses, such as fire, windstorm and the like.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Loan Estimate -</span> The form provides you with important information, including the estimated interest rate,monthly payment, and total closing costs for the loan.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Offers and Contracts -</span> Once you find the right home, you&rsquo;ll make an offer on the property with the help of an agent or attorney. If the seller counters your original offer, it&rsquo;s usually because they want more money or a faster timeline for closing the deal, at which point you&rsquo;ll have to negotiate. When submitting an offer, it&rsquo;s a good idea to add a personal touch by including a cover letter that explains why you want to buy the home.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Pre-approval Letter -</span> Used by a lender to give you an idea of the mortgage amount for which you qualify for</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Title Insurance -</span> Helps protect the homeowner and buyer from fraud or forging of documents that directly affect ownership interest of the property.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>PITI:</span> Principal, interest, taxes and insurance -- the primary components of a monthly mortgage payment.</div><!-- .pg15-desc -->
       	  <div class="pg15-desc"><span>Underwriting -</span> The process of evaluating a loan application to determine if it meets the lender&rsquo;s standards.</div><!-- .pg15-desc -->
        </div><!-- .pg-15-content -->
    </div><!-- .page-7 -->
    <sethtmlpagefooter name="MyFooter1" value="on" />
</article>
</body>
</html>