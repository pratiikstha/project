<?php

App::import('Vendor','tcpdf'); 
$tcpdf = new TCPDF();
$tcpdf->setHeaderFont(array("freesans",'',40)); 
$tcpdf->AddPage(); 


//$tcpdf->Cell(0,14, "Hello World", 0,1,'L');
$tcpdf->Cell(0,14, "रुबिम ルビムシュレックWorld", 0,1,'L');  
echo $tcpdf->Output('filename.pdf', 'D');  