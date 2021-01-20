<?php
/*
require_once 'lib/html5lib/Parser.php';
require_once 'lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'lib/php-svg-lib/src/autoload.php';
require_once 'src/Autoloader.php';
require_once 'autoload.inc.php';

Dompdf\Autoloader::register();
use Dompdf\Dompdf;

$dompdf = new Dompdf();
// $html = file_get_contents('http://is.yuzhny.com/info/osmd.php?adrec=961d71213eb2143b4306c262acec341492db2b87');
$html = file_get_contents('<p>kjkjkjkjkjkjkjkjk</p>');
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("codex",array("Attachment"=>0));
*/
require_once 'autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;


// instantiate and use the dompdf class
$dompdf = new Dompdf();

//to put other html file
$html = file_get_contents('http://is.yuzhny.com/info/osmd.php?adrec=961d71213eb2143b4306c262acec341492db2b87');
$html .= '<style type="text/css">.hideforpdf { display: none; }</style>';
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Legal', 'Landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("codex",array("Attachment"=>0));

?><a class="hideforpdf" href="generatepdf.php?action=download" target="_blank">Download PDF</
