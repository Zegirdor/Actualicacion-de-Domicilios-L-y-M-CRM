<?php
function jsonformat($res)
{
	$strCadena='';
	$intTotalCampos = pg_num_fields($res);
	$strCadena=$strCadena.'[';
	while($row=pg_fetch_array($res))
	{
		$strCadena=$strCadena.'{';
		for($j=0; $j<$intTotalCampos; $j++)
		{
			$strNombreCampo=pg_field_name($res, $j);
			$strCadena=$strCadena.'"'.$strNombreCampo.'":"'.trim(utf8_encode($row[$j])).'"';
			$strCadena=$strCadena.',';
		}
		$strCadena= substr($strCadena, 0, -1);
		$strCadena=$strCadena.'},';
	}
	$strCadena= substr($strCadena, 0, -1);
	$strCadena=$strCadena.']';
	
	return $strCadena;
}
?>