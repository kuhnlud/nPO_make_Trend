<?php 
require '/mustache.php-master/src/Mustache/Autoloader.php';

Mustache_Autoloader::register();
$m = new Mustache_Engine;


define('Tpl_Trend', 'Trend_Tpl.ch.xml');


define('Trends_Para', 'TREND.csv');


$chr=file_get_contents('templates/chr.tpl');
$rcc=file_get_contents('templates/rcc.tpl');
$xml=file_get_contents('templates/xml.tpl');

$Tpl_Trend=file_get_contents(Tpl_Trend);

$Data_UBS = csv_to_array(Trends_Para);

$Trend_Array = anordered_Trend_Format($Data_UBS);

foreach ($Trend_Array as $key => $value) {
/*	if(isset($value[0]["Tag_Unit"])){
		echo utf8_decode($value[0]["Tag_Unit"]);
	}*/
	//print_r($value);
	$name=array();
	$path_data_name_xml = 'render/'.$key.'.chr.xml';
	$path_data_name_chr = 'render/'.$key.'.chr';
	$path_data_name_rcc = 'render/'.$key.'.chr.rcc';

	$name["Trend_Name"]=$key;

	$chr_file = $m->render($chr, $name);

	file_put_contents($path_data_name_chr, $chr_file);
	file_put_contents($path_data_name_rcc, $rcc);


	$para = [
		"Trend_Name" => $key,
		"data" => $value,
/*		"utf8_dec" => function($t){
			return $t;
		}*/
	];	

	$data = $m->render($Tpl_Trend, $para);

	file_put_contents($path_data_name_xml, $data);

}

/*
*->Ancienne Version avec plusieurs Template pour .chr.xml:
*->Header, Tag_List, Footer
*/

/*foreach ($Trend_Array as $key => $value) {

	$name=array();
	$path_data_name_xml = 'render/'.$key.'.chr.xml';
	$path_data_name_chr = 'render/'.$key.'.chr';
	$path_data_name_rcc = 'render/'.$key.'.chr.rcc';

	$name["Trend_Name"]=$key;

	$chr_file = $m->render($chr, $name);

	file_put_contents($path_data_name_chr, $chr_file);
	file_put_contents($path_data_name_rcc, $rcc);	

	$data = $m->render($Tpl_Trend_Header, $name);

	file_put_contents($path_data_name_xml, $data,FILE_APPEND);

	$para = [
		"data" => $value
	];

	$Trend_TagList = $m->render($Tpl_Trend_TagList, $para);

	file_put_contents($path_data_name_xml, $Trend_TagList,FILE_APPEND);	
	file_put_contents($path_data_name_xml, $Tpl_Trend_footer,FILE_APPEND);

}*/


/*
*->Fonction permettant de retourner un tableau charger avec les valeur du fichier CSV passer en Argument,
*->Et avec les "key" égale à la première ligne du tableau CSV.
*@PARAM: $filename: nom du tableau CSV.
*@PARAM: délimiter: délimiter pour splitter le tableau CSV(";" par défaut).
*/

function csv_to_array($filename, $delimiter = ';')
{
    if(!file_exists($filename) || !is_readable($filename))
    	return FALSE;

    $header = NULL;
	$data = array();

	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
	    while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
	    {
	        if(!$header)
	            $header = $row;
	        else
	            $data[] = array_combine($header, $row);
	    }
	    fclose($handle);
	}

	return $data;

}

/*
*->Fonction permettant de retourner un tableau de tableau avec à chaque fois [le nom du trend] = [Tableau contenant la TagList sous forme->
*->de tableau(une ligne du CSV = un Tableau)]
*@PARAM: $trend: tableau.
*/

function anordered_Trend_Format($trend){

	$reformat = array();
	$trend_formated = array();
	$other = array();

	foreach ($trend as $key => $value) {

		if (!in_array($value["Trend_Name"],$reformat )) {
			$trend_formated[$value["Trend_Name"]] = array();
			$trend_formated[$value["Trend_Name"]][] = $value;
			array_push($reformat, $value["Trend_Name"]);
		}
		else{
			array_push($trend_formated[$value["Trend_Name"]], $value);
		}

	}

	return $trend_formated;

}

?>
