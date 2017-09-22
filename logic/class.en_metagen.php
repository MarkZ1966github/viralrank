<?php


/******************************************************************
Projectname:   smart meta Generator
Version:       0.1
Author:        saeed arab sheybani
Last modified:  2008/11/13
Copyright (C): 2006 Ver Pangonilo, All Rights Reserved

* GNU General Public License (Version 2, June 1991)
*
* This program is free software; you can redistribute
* it and/or modify it under the terms of the GNU
* General Public License as published by the Free
* Software Foundation; either version 2 of the License,
* or (at your option) any later version.
*
* This program is distributed in the hope that it will
* be useful, but WITHOUT ANY WARRANTY; without even the
* implied warranty of MERCHANTABILITY or FITNESS FOR A
* PARTICULAR PURPOSE. See the GNU General Public License
* for more details.
Description:
Generat meta for «keywords»
this class automaticaly extrac kewords from a html pag
by remove html tags(excepting comments)
how do it :
1-	remove common words (in this class persian words you can replace english words or...)
from list and by intelligence
2-remove unintelligible words same as «tehhhfjrl» or «*****»
3-you can define priority words ; in this case if class find (priority words) in text extract its immediately
4- other smart options for example ignore small words when occurred so many '
5-	in smae conditions ;The Priority Words come from bigger words
******************************************************************/
class metagen {

	//declare variables
	var $body;//main text-page
	var $common= array();//must common words
	var $bodyArr= array();//array from words in main txtx page
	var $encoding;
	//minimum word length for inclusion into the single word
	//metakeys
	var $wordLengthMin;
	var $metakeyLengthMax;
	var $firstCheck= array();

	var $addFirst=array();
	function metagen($params, $encoding)
	{
		//get parameters
		$this->body =  $params['content'];
		$this->remove_htm();
		$this->encoding = $encoding;
		mb_internal_encoding($encoding);
		$this->replace_chars();
		$this->first_check = array();
		$this->analyze_words();
		// single word
		$this->wordLengthMin  = $params['min_word_length'];
		if($params['metakeyLengthMax']<1)$params['metakeyLengthMax']=10;
		if($params['metakeyLengthMax']>50)$params['metakeyLengthMax']=50;
		$this->metakeyLengthMax  = $params['metakeyLengthMax'] ;
		//common words , you can complate its
		$this->common=array('january' , 'february'  , 'march' , 'april' , 'may' , 'june' , 'july' , 'august' , 'september' , 'october' , 'november' , 'december' , 'reply' , 'sunday' , 'monday'  , 'tuesday' , 'wednesday' , 'thursday' , 'friday' , 'saturday' , 'viralrank' , 'swarmsports' , 'categories'  , 'wordpress' , 'archives' , 'leave'  , 'recent' , 'comments' ,'able' , 'about'  , 'across' , 'after' , 'all' , 'almost' , 'also' , 'among' , 'and' , 'any' , 'are' , 'because' , 'been' , 'but' , 'can' , 'cannot' , 'could' , 'dear' , 'did' , 'does' , 'either' , 'else' , 'ever' , 'every' , 'for' , 'from' , 'get' , 'got' , 'had' , 'has' , 'have' , 'her' , 'hers' , 'him' , 'his' , 'how' , 'however' , 'into' , 'its' , 'just' , 'least' , 'let' , 'like' , 'likely' , 'may' , 'might' , 'most' , 'must' , 'neither' , 'nor' , 'not' , 'off' , 'often' , 'only' , 'other' , 'our' , 'own' , 'rather' , 'said' , 'say' , 'says' , 'she' , 'should' , 'since' , 'some' , 'than' , 'that' , 'the' , 'their' , 'them' , 'then' , 'there' , 'these' , 'they' , 'this' , 'tis' , 'too' , 'twas' , 'wants' , 'was' , 'were' , 'what' , 'when' , 'where' , 'which' , 'while' , 'who' , 'whom' , 'why' , 'will' , 'with' , 'would' , 'yet' , 'you' , 'your'  , 'tagged' , 'post' , 'posted' , 'anytime' , 'hopefully', 'commentsemail');


	}

	function array_except( )  {
		$extra = $this->firstCheck;
		// Take two one-dimensional array, step through the $this->common looking for
		// each element of the $this->firstCheck. If any of the elements in the $this->firstCheck
		// are available  in the $this->common, remove them.

		if (!is_array($this->common))
		return false;

		$exception = (is_array($extra)) ? $extra : array($extra);

		for ($i = 0; $i < sizeof($exception); $i++) {
			if (array_search($exception[$i], $this->common)!==0){
				unset ($this->common[array_search($exception[$i], $this->common)]) ;
			}

		}



	}
	function generate(){
		$h =99;//a big number
		$this->array_except();
		if(is_array($this->firstCheck)){
			foreach ($this->firstCheck as $val) {


				if(!in_array($val, $this->addFirst) and  !in_array($val, $this->common))


				$this->addFirst[$val] = $h++;
				//				$this->common[] = $val;

			}
		}elseif(!empty($this->firstCheck)){
			$this->addFirst[$this->firstCheck] = $h++;
			//			$this->common[] = $this->firstCheck;
		}

	}

	//then replace common html tags.
	function replace_chars()
	{
		//convert all characters to lower case
		$content = mb_strtolower($this->body);
		//$content = mb_strtolower($content, "UTF-8");
		//$content = mb_strtolower($content, "iso-8859-1");
		$content = strip_tags($content);

		$punctuations = array(',', ')', '(', '.', "'", '"',
		'<', '>', ';', '!', '?', '/', '-',
		'_', '[', ']', ':', '+', '=', '#',
		'$', '&quot;', '&copy;', '&gt;', '&lt;',
		chr(10), chr(13), chr(9));

		$content = str_replace($punctuations, " ", $content);
		// replace multiple gaps
		$this->body = preg_replace('/ {2,}/si', " ", $content);

		
	}
	function reapet_character_check($str){
		$manstr = $str;
		$substr0 =substr($str, 0, 1);
		$substr1 =substr($str, 1, 1);
		$substr2 =substr($str, 2, 1);
		while ($str = substr($str , 1)) {


			$substr0 =substr($str, 0, 1);
			$substr1 =substr($str, 1, 1);
			$substr2 =substr($str, 2, 1);
			if (isset($substr0,$substr1,$substr2) and ($substr0==$substr1 and $substr2==$substr1)) {
				return '';
			}

		}
		return $manstr;
	}
	//single words META KEYWORDS
	function analyze_words()
	{
		//list of commonly used words
		// this can be edited to suit your needs
		//remove some commomn caracters

		$trans = array("http" => "","'" => "",":" => "","&#1548;" => "","*" => "",":" => "","–" => " ", '"' => "",'.'=>' ','&#1548;'=>' ',','=>' ',' &#1608; '=>' ',' &#1575;&#1586; '=>" ",'&#1610;'=>'&#1740;','&#1607;&#1575;&#1740;'=>'','&#1607;&#1575;&#1610;'=>'','&#1610;'=>'&#1740;');
		$this->body = strtr($this->body, $trans);
		$trans = array("  " => " ", '*' => "");
		$this->body = strtr($this->body, $trans);
		$this->bodyArr = explode(" ", $this->body);


		//create an array out of the site body
	}

	function keymetagen()
	{
		$this->generate();
		$imploded = '';
		$i = 0;
		$wordOccuredMin = 10;//count ccured in main text page
		$wordOccuredMin_sorted_arr =array();
		while ($i<$this->metakeyLengthMax ) {

			$wordOccuredMin--;
			if(!$wordOccuredMin)break;
			switch ($wordOccuredMin) {
				case 9:
				case 8:
				case 7:$baseWordLengthMin = 5 ;break;
				case 6:
				case 5:
				case 4:$baseWordLengthMin = 4 ;	break;
				case 3:
				case 2:	$baseWordLengthMin = 3 ;
				break;

				default:$baseWordLengthMin = 2 ;
				break;
			}
			if($baseWordLengthMin<$this->wordLengthMin)$baseWordLengthMin = $this->wordLengthMin;

			$k = array();
			//iterate inside the array
			foreach( $this->bodyArr as $key=>$val ) {
				//delete single or two letter words and
				//Add it to the list if the word is not
				//contained in the common words list.


				$check_val = $this->reapet_character_check($val);
				if(!empty($check_val)){
					if(mb_strlen(trim($val)) >= $baseWordLengthMin  && !in_array(trim($val), $this->common)  && !is_numeric(trim($val)) && $i < $this->metakeyLengthMax) {

						$k[] = trim($val);
					}}

			}

			//count the words
			$k = array_count_values($k);
			//sort the words from
			//highest count to the
			//lowest.

			$occur_filtered = $this->occure_filter($k, $wordOccuredMin);
			if(!empty($this->addFirst)){
				foreach ($this->addFirst as $key_add =>$value_add) {
					$pos = strrpos( $this->body, $key_add);

					if($pos===false)
					$this->common[] = $key_add;
					else{
						$occur_filtered[$key_add] = $value_add;
						$this->common[] = $key_add;
					}

				}
				$this->addFirst =null;

			}
			arsort($occur_filtered);
			$count_arr = count($occur_filtered);
			$add= $this->metakeyLengthMax - $i;
			$i += $count_arr;

			foreach ($occur_filtered as $key_filtered =>$val_filtered) {
				if(!in_array(trim($key_filtered), $this->common))
				$this->common[] = $key_filtered;
			}

			if($i>=$this->metakeyLengthMax){
				while($wordOccuredMin_sorted = array_shift($wordOccuredMin_sorted_arr)){
					foreach ($occur_filtered as $occur_filtered_key => $occur_filtered_val) {
						if(mb_strlen(trim($occur_filtered_key)) >= $wordOccuredMin_sorted  ) {
							$occur_last[$occur_filtered_key] = trim($occur_filtered_val);
						}

					}
				}




				//				$occur_last = $occur_filtered;

				$occur_filtered = array_slice($occur_last, 0, $add);


				unset($occur_last);
			}
			if(count($occur_filtered)){
				$wordOccuredMin_sorted_arr[] = 	$wordOccuredMin;

				$imploded .= $this->implode(", ", $occur_filtered);
				unset($occur_filtered);
			}


			//release unused variables
			unset($k);

			if($count_arr>$this->metakeyLengthMax){

				$i = $this->metakeyLengthMax;

			}
		}

		//initialize array


		return $imploded;
	}


		function remove_htm(){

		$this->body = preg_replace('/<div\b[^>]*>((?:.|\s)*?)<\/div>/i','${1}',$this->body );#exclude script or script tags

		$this->body = preg_replace('/<script\b[^>]*>((?:.|\s)*?)<\/script>/i','',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<iframe\b[^>]*>((?:.|\s)*?)<\/iframe>/i','',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<style\b[^>]*>((?:.|\s)*?)<\/style>/i','',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<form\b[^>]*>((?:.|\s)*?)<\/form>/i','',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<img\b[^>]*>/i','',$this->body );#exclude script or script tags

		$this->body = preg_replace('/<b\b[^>]*>((?:.|\s)*?)<\/b>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<strong\b[^>]*>((?:.|\s)*?)<\/strong>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<h1\b[^>]*>((?:.|\s)*?)<\/h1>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<h2\b[^>]*>((?:.|\s)*?)<\/h2>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<h3\b[^>]*>((?:.|\s)*?)<\/h3>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<h4\b[^>]*>((?:.|\s)*?)<\/h4>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<font\b[^>]*>((?:.|\s)*?)<\/font>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<span\b[^>]*>((?:.|\s)*?)<\/span>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<table\b[^>]*>((?:.|\s)*?)<\/table>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<legend\b[^>]*>((?:.|\s)*?)<\/legend>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<tbody\b[^>]*>((?:.|\s)*?)<\/tbody>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<tr\b[^>]*>((?:.|\s)*?)<\/tr>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<td\b[^>]*>((?:.|\s)*?)<\/td>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<th\b[^>]*>((?:.|\s)*?)<\/th>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<center\b[^>]*>((?:.|\s)*?)<\/center>/i','${1}',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<frameset\b[^>]*>((?:.|\s)*?)<\/frameset>/i','${1}',$this->body );#exclude script or script tags

		$this->body = preg_replace('/<br\b[^>]*>/i',' ',$this->body );#exclude script or script tags

		$this->body = preg_replace('/<center\b[^>]*>/i','',$this->body );#exclude script or script tags
		$this->body = preg_replace('/<hr\b[^>]*>/i','',$this->body );#exclude script or script tags

		$this->body = preg_replace('/[\r\n\t\s]+/s', ' ', $this->body);#new lines, multiple spaces/tabs/newlines



		$this->body = preg_replace('#/\*.*?\*/#', '', $this->body);#comments



		$this->body = preg_replace('/[\s]*([\{\},;:])[\s]*/', '\1', $this->body);#spaces before and after marks



		$this->body = preg_replace('/^\s+/', '', $this->body);#spaces on the begining
		$this->body = preg_replace('/([A-Z*!@*#%&_]?[0-9]+[A-Z]?)\b/i', '', $this->body);#latin and numeric
		$this->body = preg_replace('/(http:\/\/www\.)+(([0-9a-z]{1}[0-9a-z-]*)\.+)*([0-9a-z]{1}[0-9a-z-]{0,56})+([a-z]{2,6}|[a-z]{2}.[a-z]{2,6})+(\/)?(([0-9a-z-~`!@#$%&amp;^_+=_\.\?])+(\/)?)*/i', '', $this->body);#spaces on the
	}

	function occure_filter($array_count_values, $min_occur)
	{
		$occur_filtered = array();
		foreach ($array_count_values as $word => $occured) {
			if ($occured >= $min_occur) {
				$occur_filtered[$word] = $occured;
			}
		}

		return $occur_filtered;
	}

	function implode($gule, $array)
	{
		$c = "";
		foreach($array as $key=>$val) {
			@$c .= $key.$gule;
		}
		return $c;
	}
}
?>