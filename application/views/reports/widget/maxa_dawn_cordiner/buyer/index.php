<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;500;600;700&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <?php 
        for ($i=1; $i <= 24 ; $i++) 
        { 
            if(in_array($i, $pdfPages) || true)
            {
                $report_id = $i;

                $data = array();                

                $this->load->view('reports/widget/'.$report_dir_name.'/buyer/pages/'.$report_id,$data);
            }
        }
    ?>
</body>
</html>