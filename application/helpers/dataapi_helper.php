<?php 


require_once('library/SetaPDF/Autoload.php'); // library for filling in PDF text fields
require_once('jpgraph/jpgraph.php'); // library for generating visuals
require_once('fpdf.php'); 
require_once('fpdi.php'); 
require_once('jpgraph/jpgraph_bar.php'); // library for creating charts
require_once('jpgraph/jpgraph_line.php');
require_once('jpgraph/jpgraph_pie.php');

ini_set('memory_limit', '450M');

function sortproperty($a, $b) {
			  $d1 = strtotime($a['Date']);
			  $d2 = strtotime($b['Date']);
			  if ($d1 == $d2) {
			  	if($a['SquareFeet']==$b['SquareFeet']){
			    	return 0;
			  	}
			  	return ($a['SquareFeet'] > $b['SquareFeet']) ? -1 : 1;
			  }
			  return ($d1> $d2) ? -1 : 1;
}


function getPlat($platData, $pdfID) {
	$platDecoded = base64_decode((string)$platData);
	$im = imagecreatefromstring($platDecoded);
	if ($im !== false) {
	    //header('Content-Type: image/png');
	    $platFile = 'files/temps/plat' . $pdfID .  '.png';
	    imagepng($im, $platFile);
	    imagedestroy($im);
	    return $platFile;
	}
	else {
		return '';
	}
}

function resize_image($file, $maxWidth, $maxHeight) {
	// resizes images proportionally to be under specified width and height
    list($width, $height) = getimagesize($file);
    $jpgFile = substr_replace($file, 'jpeg', -3);
    $ratio = min($maxWidth/$width, $maxHeight/$height);
	if ($ratio < 1) {
		$newWidth = $ratio * $width;
		$newHeight = $ratio * $height;
	}
	else {
		$newWidth = $width;
		$newHeight = $height;
	}
	$fileType = strtolower(substr($file, -3));
	if ($fileType == 'peg' || $fileType == 'jpg') {
		$src = imagecreatefromjpeg($file);
	    $dst = imagecreatetruecolor($newWidth, $newHeight);
	    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	    imagedestroy($src);
	    imagejpeg($dst, $file);
	    imagedestroy($dst);
	}
	elseif ($fileType == 'png') {
		$src = imagecreatefrompng($file);
	    $dst = imagecreatetruecolor($newWidth, $newHeight);
	    imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));
   	    imagealphablending($dst, false);
        imagesavealpha($dst, true);
	    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	    imagepng($dst, $file);
	}  
	elseif ($fileType == 'gif') {
		$src = imagecreatefromgif($file);
		$dst = imagecreatetruecolor($newWidth, $newHeight);
		imagecolortransparent($dst, imagecolorallocatealpha($dst, 255, 255, 255, 127));
   	    imagealphablending($dst, false);
        imagesavealpha($dst, true);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); 
		imagegif($dst, $file);
	}  
}

function changeGIF($file) {
	if (strtolower(substr($file, -3)) == 'gif') {
		$path = substr_replace($file, 'jpeg', -3);
	}
	else {
		$path = $file;
	}
	return $path;
}


function formatDate($date) {
	// Make dates readable, e.g., change '20131225' to '12/25/2013'
	if (empty($date)) {
		return '';
	}
	$year = substr($date, 0, 4);
	$month = substr($date, 4, 2);
	if ($month[0] == '0') {
		$month = $month[1];
	}
	$day = substr($date, 6, 2); 
	if ($day[0] == '0') {
		$day = $day[1];
	}
	$cleanDate = $month . '/' . $day . '/' . $year;
	return $cleanDate;
}


function formatName($name) {
	// Order names, e.g., change 'Smith, John' to 'John Smith'
	if (empty($name)) {
		return '';
	}
	if (strpos($name, ';') !== false) {
		return $name;
	}
	$names = explode(", ", $name);
	$name = $names[1] . " " . $names[0];
	return $name;
}


function properCase($pronoun) {
	// Assign proper case to pronouns, e.g., change JOHN SMITH to John Smith
	// PHP's typical solution, ucfirst(strtolower($last_name)), lowercases letters after apostraphes (e.g., Patrick O'connell)
	$pronoun = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($pronoun))));
	$pronoun = str_replace('Ca,', 'CA,', $pronoun); // State in addresses should be capitalized
	return $pronoun; 
}


function dollars($dollarAmount) {
	// Prepend '$' symbol to figures that represent price
	if ((string)$dollarAmount == '') {
		return '';
	}
	if ($dollarAmount == '0') {
		return '0';
	}

	else {
		return '$' . $dollarAmount;
	}
}


function toPercent($num) {
	// Convert .197 to 19.7%
	if ($num == '') {
		return $num;
	}
	$percent = (float)$num * 100;
	$percent .= '%';
	return $percent; 
}

function shorten($element) {
	// Shorten text elements too long to fit on PDF
	$parts = explode(' ', $element);
	if (count($parts) > 4) {
		return '';
	} 
	else {
		return $element;
	}
}


function shortenLegal($element) {
	// Shorten legal descriptinos too long to fit on PDF
	$parts = explode("City", $element, 2);
	return $parts[0];
}

function legalShort($legal) {
	$legal = str_replace('  ', ' ', $legal);
	return $legal;
}


function cleanLegal($legal) {
	// Make the legal descriptions more readable
	$legal = str_replace(':', ': ', $legal);
	return $legal;
}

function minMaxArray($housingTrait, $query, $reportArray) {
 // Find min, median and max values for area property characteristics
 $areaRange = array();
 $lowestHighest = array();
 foreach ($reportArray as $sale) {
  $areaRange[] = (float)($sale[$housingTrait]);   
 }
 $areaRange = array_filter($areaRange);
 if (empty($areaRange)) {
  return 'N/A';
 }
 else {
  switch ($query) {
   case 'min':
    $value = min($areaRange);
    break;
   case 'max':
    $value = max($areaRange);
    break;
   case 'median':
    rsort($areaRange); 
             $middle = round(count($areaRange) / 2); 
             $value = $areaRange[$middle-1];
             break;
        }
  return $value;
 }
}

function minMax($housingTrait, $query, $report187) {
	// Find min, median and max values for area property characteristics
	$areaRange = array();
	$lowestHighest = array();
	foreach ($report187->ComparableSalesReport->ComparableSales->ComparableSale as $sale) {
		$areaRange[] = (float)($sale->$housingTrait);   
	}
	$areaRange = array_filter($areaRange);
	if (empty($areaRange)) {
		return 'N/A';
	}
	else {
		switch ($query) {
			case 'min':
				$value = min($areaRange);
				break;
			case 'max':
				$value = max($areaRange);
				break;
			case 'median':
				rsort($areaRange); 
            	$middle = round(count($areaRange) / 2); 
            	$value = $areaRange[$middle-1];
            	break;
        }
		return $value;
	}
}

function poolFrequency($report187) {
	$numHouses = 0;
	$pools = 0;
	foreach ($report187->ComparableSalesReport->ComparableSales->ComparableSale as $sale) {
		$hasPool = $sale->Pool;
		if ($hasPool == 'Yes') {
			$pools ++;
		}
		$numHouses ++;
		}
	if ($numHouses == 0) {
		return '';
	}
	$poolPercent = 100 * ($pools/$numHouses);
	return $poolPercent;
}


function createMap($report187) {
	$mapRequest = 'http://maps.googleapis.com/maps/api/staticmap?size=660x660&maptype=hybrid&sensor=false&markers=color:red|';
	$propertyLat = (string)$report187->PropertyProfile->PropertyCharacteristics->Latitude[0];
	$propertyLong = (string)$report187->PropertyProfile->PropertyCharacteristics->Longitude[0];
	$mapRequest .= $propertyLat . ',' . $propertyLong . '&';
	for ($i = 1; $i <= 2; $i ++) {
		$mapRequest .= 'markers=color:blue|label:' . $i . '|';
		$lat = (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$i - 1]->Latitude;
		$long = (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$i -1]->Longitude;
		$mapRequest .= $lat . ',' .$long . '&';
	}
	return $mapRequest;
}

function calculateDistance($neighborAddress, $neighborCity, $neigborState, $address, $propertyCity, $propertyState) {
	// returns distance between two adresses
	$distanceRequest = 'http://maps.googleapis.com/maps/api/distancematrix/xml?origins=' . $address .'+' .$propertyCity . '+' . $propertyState . '&destinations=' . $neighborAddress . '+' . $neighborCity . '+' . $neighborState . '&sensor=false';
	//$rep187 = urldecode($rep187);
	$distanceXML = simplexml_load_file($distanceRequest);
	$distance = $distanceXML->row->element->distance->text;
	$distance = str_replace(' m', ' meters', $distance);
	return $distance;
}

function num($val) {
	// Make values compatible with JPGraphs e.g., converts '$8,000' to 7000
	$val = str_replace('$', '', $val);
	$val = str_replace(',', '', $val);
	$val = intval($val);
	return $val;
}

function makePie($vals, $labels, $chartTitle, $chartNum) {
	// create pie charts
	$data = $vals;

	// Create the Pie Graph. 
	$graph = new PieGraph(400,350);

	$theme_class="DefaultTheme";

	//$graph->SetTheme(new $theme_class());

	// Set A title for the plot
	$graph->title->Set($chartTitle);
	$graph->SetBox(true);

	// Create
	$p1 = new PiePlot($data);

	$graph->Add($p1);

	$legends = $labels; 
	$p1->SetLegends($legends);

	$p1->ShowBorder();
	$p1->SetColor('black');
	$p1->SetSliceColors(array('#F17CB0', '#B2912F', '#B276B2', '#DECF3F', '#F15854','#5DA5DA','#FAA43A','#60BD68', '#4D4D4D'));

	$graph->title->Set($chartTitle);
	$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

	$fileName = "files/temps/chart" . $chartNum . ".png";
	$graph->img->Stream($fileName);
	return $fileName;
}

function createChart($vals, $labels, $chartTitle, $chartNum, $decimal, $dollar) {


	// Create the graph. These two calls are always required
	
	if ($chartNum == '3') {
		$graph = new Graph(490,290,'auto');
	}
	elseif ($chartNum == '4') {
		$graph = new Graph(600,350,'auto');
	}
	else  {
		$graph = new Graph(370,265,'auto');
	}
	$graph->SetScale("textint");
	$graph->SetBox(false);
	$graph->SetMargin(60,33,30,20);

	$graph->ygrid->SetFill(false);
	$graph->xaxis->SetTickLabels($labels);
	$graph->yaxis->HideLine(false);
	$graph->yaxis->HideTicks(true,false);

	$b1plot = new BarPlot($vals[0]);

	if (count($vals) > 1) {
		$b2plot = new BarPlot($vals[1]);
		$gbplot = new GroupBarPlot(array($b1plot,$b2plot));
	}

	else {
		$b2plot = false;
		$gbplot = new GroupBarPlot(array($b1plot));
	}

	// ...and add it to the graPH
	$graph->Add($gbplot);
	$graph->SetShadow();
	if ($dollar) {
		$graph->yaxis->SetLabelFormat('$%s');
	}
	$graph->yaxis->SetLabelFormatCallback("number_format");

	//#FF5C15  orange
	//#00A6DC bright blue
	// #00405E blue
	

	$b1plot->SetColor("white");
	if ($chartNum == '3') {
		$b1plot->SetFillColor("#aeaeae");
	}
	else {
	$b1plot->SetFillColor("#475F77");
	}
	$b1plot->value->Show();

	//$labelType = $dollar ? '$%d' : '%d';

	if ($b2plot) {
		$b2plot->SetColor("white");
		$b2plot->SetFillColor("#D74B4B");
		$b2plot->value->Show();
	}

	if (!$decimal) {
		$b1plot->value->SetFormat('%d');
		$b1plot->value->SetFormatCallback("number_format");
		if ($b2plot) {
			$b2plot->value->SetFormat('%d');
			$b2plot->value->SetFormatCallback("number_format");
		}
	}

	$graph->title->Set($chartTitle);
	$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

	$fileName = "files/temps/chart" . $chartNum . ".png";
	$graph->img->Stream($fileName);
	return $fileName;
}


function borrowers($buyers) {
	$names = explode("; ", $buyers);
	return $names;
}

function schoolFill($i, $j, $schoolType, $reportItems, $report187) {
	$reportItems['schoolName' . $i] = properCase($report187->$schoolType->Schools->School[$j]->SchoolName[0]);
	$reportItems['schoolAddress' . $i] = $report187->$schoolType->Schools->School[$j]->SchoolAddress[0];
	$reportItems['schoolGradeLow' . $i] = $report187->$schoolType->Schools->School[$j]->LowestGrade[0];
	$reportItems['schoolGradeHigh' . $i] = $report187->$schoolType->Schools->School[$j]->HighestGrade[0];
	$reportItems['schoolRatio' . $i] = $report187->$schoolType->Schools->School[$j]->StudentTeacherRatio[0];
	$reportItems['schoolDistance' . $i] = $report187->$schoolType->Schools->School[$j]->Distance[0];
	$reportItems['schoolCity' . $i] = properCase($report187->$schoolType->Schools->School[$j]->SchoolCity[0]);
	$reportItems['schoolEnrolled' . $i] = $report187->$schoolType->Schools->School[$j]->TotalEnrolled[0];
	if ($i == '4') {
		$reportItems['schoolAffiliation' . $i] = $report187->$schoolType->Schools->School[$j]->Affiliation[0];
		$reportItems['schoolGender' . $i] = $report187->$schoolType->Schools->School[$j]->Gender[0];
		$reportItems['schoolPhone' . $i] = $report187->$schoolType->Schools->School[$j]->SchoolPhone[0];
		$preschool = $report187->$schoolType->Schools->School[$j]->PreschoolMembership[0];
		$preStatus = (intval($preschool) > 0 ? 'Yes' : 'No');
		$reportItems['schoolPreschool' . $i] = $preStatus;
	}
	return $reportItems;
}


function monthsBetween($startDate, $endDate) {
    $retval = "";

    // Assume mm-dd-YYYY - as is common MYSQL format
    $splitStart = explode('/', $startDate);
    $splitEnd = explode('/', $endDate);

    if (is_array($splitStart) && is_array($splitEnd)) {
        $difYears = $splitEnd[2] - $splitStart[2];
        $difMonths = $splitEnd[0] - $splitStart[0];
        $difDays = $splitEnd[1] - $splitStart[1];

        $retval = ($difDays > 0) ? $difMonths : $difMonths - 1;
        $retval += $difYears * 12;
    }
    return $retval;
}

 ?>

