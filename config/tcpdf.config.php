<?php
$pdf = new sfTCPDF();
$pdf->SetCreator('Premier NOA');
$pdf->SetAuthor('Premier NOA');
$pdf->SetTitle('Resumen de cuotas');
$pdf->SetSubject('Informe');
$pdf->SetKeywords('Premier NOA');
$pdf->SetHeaderData('launiversal_negro.jpg', '18', 'PREMIER NOA S.R.L.', "Servicios empresariales\nTel/Fax: (0341) 6791831 - LIMA 1422\n2000 Rosario - Santa Fe - Argentina");
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', '7'));
$pdf->SetMargins(PDF_MARGIN_LEFT, '19', '10'); //margen del contenido
$pdf->SetHeaderMargin('5'); //margen del membrete
$pdf->SetFooterMargin('15');
$pdf->AddPage();
?>
