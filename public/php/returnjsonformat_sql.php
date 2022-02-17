<?php
function jsonformat($res,$campos)
{
	$arraycampos = explode(" ", $campos);
	$strCadena='';
	$intTotalCampos = sqlsrv_num_fields($res);
	$strCadena=$strCadena.'[';
	while($row=sqlsrv_fetch_array($res))
	{
		$strCadena=$strCadena.'{';
		$intContador=0;
		for($j=0; $j<$intTotalCampos; $j++)
		{
			$strNombreCampo=$arraycampos[$j];
			$strCadena=$strCadena.'"'.$strNombreCampo.'":"'.$row[$j].'"';
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