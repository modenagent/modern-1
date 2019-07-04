<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/buyer/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/reports/english/buyer/css/main.css") ?>">
</head>

<body>
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
    $neighbor = array();
    foreach($property->NeighborhoodDemographics->MedianAge->DemographicsInfoItems->DemoInfoItem as $demoInfo) {
        if((string)$demoInfo->Description=="Male Ratio") {
           $neighbor['male_ratio'] = (string)$demoInfo->ZipTotal;
        } else if((string)$demoInfo->Description=="Female Ratio") {
           $neighbor['female_ratio'] = (string)$demoInfo->ZipTotal;
        } else if(in_array((string)$demoInfo->Description, array(2000,2009,2014))) {
           $neighbor['household_income'] = (string)$demoInfo->ZipTotal;
        }
    }

  ?>
<style type="text/css">
    .theme-bg
    {
        background-color: <?php echo $theme ?>;
    }
    .theme-clr
    {
        color: <?php echo $theme ?>;
    }
    .underline::after,.page9a .payment-table .left-col .progress-bar, .page9a .payment-table .right-col .progress-bar,.top-banner-left,.page10 .agreement-col .points li::before{
        background-color: <?php echo $theme ?>;   
    }
    .page6 .page-content .insights .right-insight .gender-block .perc, .page6 .page6-content .insights .right-insight .gender-block .perc,.page7 .two-grid-wrapper .text-block-condensed h2 span p,.page9a .payment-table .left-col .total-amount .dolla-sign, .page9a .payment-table .right-col .total-amount .dolla-sign{
        color: <?php echo $theme ?>;   
    }
</style>   
 <style type="text/css" media="print">
    div.container
    {
        page-break-after: always;
        page-break-inside: avoid;
    }
</style> 

<style type="text/css">
.box-div h3:after {
	color: <?php echo $theme ?>;
}

.Squarearea p:before {
	color: <?php echo $theme ?>;
}
	
</style>   
    
    <?php  
    if($partner && count($partner)>1) {
        $this->load->view('reports/english/buyer/pages/1');
        $this->load->view('reports/english/buyer/pages/1_multiagent');
    } else if($partner && count($partner)==1) {
        $this->load->view('reports/english/buyer/pages/1_agent');
    } else {
        $this->load->view('reports/english/buyer/pages/1');
    }
    $this->load->view('reports/english/buyer/pages/3');
    $this->load->view('reports/english/buyer/pages/4');
    $this->load->view('reports/english/buyer/pages/5');
    $this->load->view('reports/english/buyer/pages/6',$neighbor);
    $this->load->view('reports/english/buyer/pages/6_a',array("school"=>$school));
    ?>
</body>

</html>
