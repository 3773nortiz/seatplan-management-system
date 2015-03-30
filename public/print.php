<?php

$url = $_POST['url'];
$genName = uniqid();
$fileName = dirname(__FILE__) . '/pdf/Reports-'.$genName.'.pdf';
$baseUrl ='http://spms.amaers.tk/';

$output  = 'phantomjs --ignore-ssl-errors=true "' . dirname(__FILE__) . 'assets/js/rasterize.js"  "' . $url . '"  "' . $baseUrl.'pdf/Reports-'.$genName.'.html' .'" "' . $fileName . '"';
var_dump($output);
// exec($output);
            
if (file_exists($fileName)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($fileName));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fileName));
    readfile($fileName);
    exit;
}
?>