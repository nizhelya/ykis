<?php
require "vendor/autoload.php";

use Dompdf\Dompdf;

//generate some PDFs!
$dompdf = new Dompdf();

$html = <<<'ENDHTML'
<html>
 <body>
  <h1>Hello Dompdf</h1>
 </body>
</html>
ENDHTML;
$dompdf->loadHtml($html);
$dompdf->render();
//$dompdf->stream();
$dompdf->stream("/var/www/html/ykis/vendor/hello.pdf");
?>