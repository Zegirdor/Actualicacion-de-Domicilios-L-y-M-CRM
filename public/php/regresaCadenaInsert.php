<?php	
	function returnCadenaInsert($connection,$Query,$strServerType,$strTable)
	{
		$strCadena="";
		$strQuery="";
		if($strServerType=="SQLSERVER")
		{
			$res= sqlsrv_query($connection,$Query);
			$intTotalCampos = sqlsrv_num_fields ($res);
			while($row=sqlsrv_fetch_array($res))
			{		
				$strCadena.="insert into $strTable values(";
				for($j=0; $j<$intTotalCampos; $j++)
				{
					$strCadena.="'".$row[$j]."',";
				}
				
				$strCadena= substr($strCadena, 0, -1);
				$strCadena.=");";
				$strQuery.=$strInsertTabla.$strCadena;
				
				$strCadena="";
			}
			return $strQuery;
		}
		else
		{
			$res= pg_Exec($connection,$Query);
			$intTotalCampos = pg_num_fields ($res);
			while($row=pg_fetch_array($res))
			{		
				$strCadena.="insert into $strTable values(";
				for($j=0; $j<$intTotalCampos; $j++)
				{
					$strCadena.="'".$row[$j]."',";
				}
				
				$strCadena= substr($strCadena, 0, -1);
				$strCadena.=");";
				$strQuery.=$strInsertTabla.$strCadena;
				
				$strCadena="";
			}
			return $strQuery;
		}
	}
?>