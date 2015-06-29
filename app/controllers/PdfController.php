<?php

/*
	Generiranje PDF-a dekompozicije
*/

class PdfController extends BaseController {

	public function generate($id) {
		$sch = Session::get('sch');
		$pk = Session::get('pk');
		$fd = Session::get('fd');
		$dcmp = Session::get('dcmp');

		$len = count($dcmp);

		$html = "<html>
		<head>
			<title>Dekompozicija</title>
			<link rel='stylesheet' href='" . public_path() . "\pdf_boot.css'>
			<link rel='stylesheet' href='" . public_path() . "\pdf_font.css'>
		</head>
		<body>
		<div class='wrapper'>
			<img src='" . public_path() . "\slika.png' />
			<div class='naslov'>Dekompozicija</div>
			<hr>
			<div class='shema'>Shema:<i> " . $sch->rschema . "</i></div>
				<div class='kljucevi'>Primarni kljuc(evi):</div><ul>";
					foreach ($pk as $key) {
						$html .= "<li>" . $key->pr_key . "</li>";
					}
			$html .= "</ul>
				<div class='ovisnosti'>Funkcijske ovisnosti:</div><ul>";
				foreach ($fd as $dep) {
					$html .= "<li>" . $dep->fd_L . "  ->  " . $dep->fd_R . "</li>"; 
				}
			$html .= "</ul>
				<div class='dekompozicija'>Dekompozicija:</div><ul id='dcmp'>";
					$i = 1;
					foreach ($dcmp as $dep)	
						$html .= $dep . "  ";

			$html .= "</ul>
						<div class='footer'>
							<hr>
							<a href='http://baze.vfdesign.org' target='_blank'>Baze.VFdesign.org</a>
						</div>
					</div>
					</body>
				</html>";

	return PDF::load($html, 'A4', 'portrait')->show('Dekompozicija');
	}
}