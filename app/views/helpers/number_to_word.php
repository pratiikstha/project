<?php
/**
 * NumberToWordHelper Helper.
 * @author Rubim Shrestha
 * 
 * Numeric Valut into Words (English and Nepali)
 */

class NumberToWordHelper extends AppHelper {

	var $space = ' ';
	var $plural = 's';
	
	var $words = array (
						'0'  => array('eng' => '', 					'nep' => ''),
						'1'  => array('eng' => 'One', 				'nep' => 'एक'),
						'2'  => array('eng' => 'Two', 				'nep' => 'दुई'),
						'3'  => array('eng' => 'Three', 			'nep' => 'तीन'),
						'4'  => array('eng' => 'Four', 				'nep' => 'चार'),
						'5'  => array('eng' => 'Five', 				'nep' => 'पाँच'),
						'6'  => array('eng' => 'Six', 				'nep' => 'छ'),
						'7'  => array('eng' => 'Seven', 			'nep' => 'सात'),
						'8'  => array('eng' => 'Eight', 			'nep' => 'आठ'),
						'9'  => array('eng' => 'Nine', 				'nep' => 'नौ'),
						'10' => array('eng' => 'Ten', 				'nep' => 'दश'),
						'11' => array('eng' => 'Eleven', 			'nep' => 'एघार'),
						'12' => array('eng' => 'Twelve', 			'nep' => 'बाह्र'),
						'13' => array('eng' => 'Thirteen', 			'nep' => 'तेह्र'),
						'14' => array('eng' => 'Fourteen', 			'nep' => 'चौध'),
						'15' => array('eng' => 'Fifteen', 			'nep' => 'पन्ध्र'),
						'16' => array('eng' => 'Sixteen', 			'nep' => 'सोह्र'),
						'17' => array('eng' => 'Seventeen', 		'nep' => 'सत्र'),
						'18' => array('eng' => 'Eighteen', 			'nep' => 'अठाह्र'),
						'19' => array('eng' => 'Ninteen', 			'nep' => 'उन्नाईस'),
						'20' => array('eng' => 'Twenty', 			'nep' => 'बीस'),
						'21' => array('eng' => 'Twenty One', 		'nep' => 'एक्काईस'),
						'22' => array('eng' => 'Twenty Two', 		'nep' => 'बाईस'),
						'23' => array('eng' => 'Twenty Three', 		'nep' => 'तेईस'),
						'24' => array('eng' => 'Twenty Four', 		'nep' => 'चौबिस'),
						'25' => array('eng' => 'Twenty Five', 		'nep' => 'पच्चीस'),
						'26' => array('eng' => 'Twenty Six', 		'nep' => 'छब्बीस'),
						'27' => array('eng' => 'Twenty Seven', 		'nep' => 'सत्ताईस'),
						'28' => array('eng' => 'Twenty Eight', 		'nep' => 'अठ्ठाईस'),
						'29' => array('eng' => 'Twenty Nine', 		'nep' => 'उनन्तीस'),
						'30' => array('eng' => 'Thirty', 			'nep' => 'तीस'),
						'31' => array('eng' => 'Thirty One', 		'nep' => 'एकतीस'),
						'32' => array('eng' => 'Thirty Two', 		'nep' => 'बत्तीस'),
						'33' => array('eng' => 'Thirty Three', 		'nep' => 'तेत्तीस'),
						'34' => array('eng' => 'Thirty Four', 		'nep' => 'चौंतीस'),
						'35' => array('eng' => 'Thirty Five', 		'nep' => 'पैंतीस'),
						'36' => array('eng' => 'Thirty Six', 		'nep' => 'छत्तीस'),
						'37' => array('eng' => 'Thirty Seven', 		'nep' => 'सैंतीस'),
						'38' => array('eng' => 'Thirty Eight', 		'nep' => 'अठ्तीस'),
						'39' => array('eng' => 'Thirty Nine', 		'nep' => 'उन्नचालीस'),
						'40' => array('eng' => 'Forty', 			'nep' => 'चालीस'),
						'41' => array('eng' => 'Forty One', 		'nep' => 'एकचालीस'),
						'42' => array('eng' => 'Forty Two', 		'nep' => 'बयालीस'),
						'43' => array('eng' => 'Forty Three', 		'nep' => 'त्रिचालीस'),
						'44' => array('eng' => 'Forty Four', 		'nep' => 'चौवालीस'),
						'45' => array('eng' => 'Forty Five', 		'nep' => 'पैंतालीस'),
						'46' => array('eng' => 'Forty Six', 		'nep' => 'छयालीस'),
						'47' => array('eng' => 'Forty Seven', 		'nep' => 'सत्चालीस'),
						'48' => array('eng' => 'Forty Eight', 		'nep' => 'अठ्चालीस'),
						'49' => array('eng' => 'Forty Nine', 		'nep' => 'उनन्चास'),
						'50' => array('eng' => 'Fifty', 			'nep' => 'पचास'),
						'51' => array('eng' => 'Fifty One', 		'nep' => 'एकाउन्न'),
						'52' => array('eng' => 'Fifty Two', 		'nep' => 'बाउन्न'),
						'53' => array('eng' => 'Fifty Three', 		'nep' => 'त्रिपन्न'),
						'54' => array('eng' => 'Fifty Four', 		'nep' => 'चौवन्न'),
						'55' => array('eng' => 'Fifty Five', 		'nep' => 'पचपन्न'),
						'56' => array('eng' => 'Fifty Six', 		'nep' => 'छपन्न'),
						'57' => array('eng' => 'Fifty Seven', 		'nep' => 'सन्ताउन्न'),
						'58' => array('eng' => 'Fifty Eight', 		'nep' => 'अन्ठाउन्न'),
						'59' => array('eng' => 'Fifty Nine', 		'nep' => 'उन्नसाठ्ठी'),
						'60' => array('eng' => 'Sixty', 			'nep' => 'साठ्ठी'),
						'61' => array('eng' => 'Sixty One', 		'nep' => 'एकसठ्ठी'),
						'62' => array('eng' => 'Sixty Two', 		'nep' => 'बैसठ्ठी'),
						'63' => array('eng' => 'Sixty Three', 		'nep' => 'त्रिसठ्ठी'),
						'64' => array('eng' => 'Sixty Four', 		'nep' => 'चौसठ्ठी'),
						'65' => array('eng' => 'Sixty Five', 		'nep' => 'पैँसठ्ठी'),
						'66' => array('eng' => 'Sixty Six', 		'nep' => 'छैसठ्ठी'),
						'67' => array('eng' => 'Sixty Seven', 		'nep' => 'सत्सठ्ठी'),
						'68' => array('eng' => 'Sixty Eight', 		'nep' => 'अठसठ्ठी'),
						'69' => array('eng' => 'Sixty Nine', 		'nep' => 'उनान्सत्तरी'),
						'70' => array('eng' => 'Seventy', 			'nep' => 'सत्तरी'),
						'71' => array('eng' => 'Seventy One', 		'nep' => 'एकहत्तर'),
						'72' => array('eng' => 'Seventy Two', 		'nep' => 'बहत्तर'),
						'73' => array('eng' => 'Seventy Three', 	'nep' => 'त्रिहत्तर'),
						'74' => array('eng' => 'Seventy Four', 		'nep' => 'चौहत्तर'),
						'75' => array('eng' => 'Seventy Five', 		'nep' => 'पचहत्तर'),
						'76' => array('eng' => 'Seventy Six', 		'nep' => 'छयत्तर'),
						'77' => array('eng' => 'Seventy Seven', 	'nep' => 'सतत्तर'),
						'78' => array('eng' => 'Seventy Eight', 	'nep' => 'अठहत्तर'),
						'79' => array('eng' => 'Seventy Nine', 		'nep' => 'उनासी'),
						'80' => array('eng' => 'Eighty', 			'nep' => 'अस्सी'),
						'81' => array('eng' => 'Eighty One', 		'nep' => 'एकासी'),
						'82' => array('eng' => 'Eighty Two', 		'nep' => 'बयासी'),
						'83' => array('eng' => 'Eighty Three', 		'nep' => 'त्रियासी'),
						'84' => array('eng' => 'Eighty Four',		'nep' => 'चौरासी'),
						'85' => array('eng' => 'Eighty Five', 		'nep' => 'पचासी'),
						'86' => array('eng' => 'Eighty Six', 		'nep' => 'छयासी'),
						'87' => array('eng' => 'Eighty Seven', 		'nep' => 'सतासी'),
						'88' => array('eng' => 'Eighty Eight', 		'nep' => 'अठासी'),
						'89' => array('eng' => 'Eighty Nine', 		'nep' => 'उनान्नब्बे'),
						'90' => array('eng' => 'Ninety', 			'nep' => 'नब्बे'),
						'91' => array('eng' => 'Ninety One', 		'nep' => 'एकानब्बे'),
						'92' => array('eng' => 'Ninety Two', 		'nep' => 'बयानब्बे'),
						'93' => array('eng' => 'Ninety Three', 		'nep' => 'त्रियानब्बे'),
						'94' => array('eng' => 'Ninety Four', 		'nep' => 'चौरानब्बे'),
						'95' => array('eng' => 'Ninety Five', 		'nep' => 'पन्चानब्बे'),
						'96' => array('eng' => 'Ninty Six', 		'nep' => 'छयानब्बे'),
						'97' => array('eng' => 'Ninty Seven', 		'nep' => 'सन्तानब्बे'),
						'98' => array('eng' => 'Ninty Eight', 		'nep' => 'अन्ठानब्बे'),
						'99' => array('eng' => 'Ninty Nine', 		'nep' => 'उनान्सय'),
					);
	var $commaIndex = array (
						'0' => array('eng' => 'Hundred', 'nep' => 'सय'),
						'1' => array('eng' => 'Thousand', 'nep' => 'हजार'),
						'2' => array('eng' => 'Lakh', 'nep' => 'लाख'),
						'3' => array('eng' => 'Crore', 'nep' => 'करोड'),
						'4' => array('eng' => 'Arab', 'nep' => 'अर्ब'),
					);

	//1,00,00,00,00,000
	function convert($number, $format = 'nep') {
		list($rupees, $paisa) = explode(".", $number);
		$val = $this->commaSeparatedValue($rupees);
		$valArray = explode (',', $val);
		$valArray = array_reverse($valArray);

		if(intval($paisa) > 0) {
			$retString = ($format == 'eng')? 'and ' . $this->words[$paisa]['eng'] . ' paisa only.' : 'रूपैयाँ ' . $this->words[$paisa]['nep'] .' पैसा मात्र ।';
		} else {
			$retString = ($format == 'eng')? ' only.' : ' मात्र ।';
		}

		$hundredsValue = intVal($valArray[0]);
		if ($hundredsValue != 0) {
			$text = '';
			if ($hundredsValue > 100) {
				$text = $this->words[($hundredsValue/100)][$format] . $this->space . $this->commaIndex[0][$format];
				if ($hundredsValue/100 > 1 && $format == 'eng') {
					$text .= $this->plural; 
				}
				$retString = $text . $this->space . $this->words[($hundredsValue%100)][$format] . $this->space . $retString;
			} else if ($hundredsValue == 100) {
				$retString = $this->words[($hundredsValue/100)][$format] . $this->space . $this->commaIndex[0][$format] . $this->space . $retString;
			} else {
				$retString = $this->words[$hundredsValue][$format] . $this->space . $retString;
			}
		}

		for ($i = 1; $i < count($valArray); $i++) {
			$numericVal = intval($valArray[$i]);
			if ($numericVal != 0) {
				$text = $this->words[$numericVal][$format] . $this->space . $this->commaIndex[$i][$format];
				if ($valArray[$i] > 1 && $format == 'eng') {
					$text .= $this->plural; 
				}
				$retString = $text . $this->space . $this->space . $retString;
			}
		}
		return $retString;
	}

	function commaSeparatedValue($number) {
		$patterns = "/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/";
		$replace = "\\1,";
		$number = preg_replace($patterns, $replace, $number);
		return $number;
	}
}
