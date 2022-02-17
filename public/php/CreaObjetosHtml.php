<?php 
include 'odbcUtilities.php';

	function ReturnHtmlCombo($strConexion,$strQuery,$strId)
	{
		$Html.="<select id='$strId'> ";
		$regCombo=executeEscalar($strConexion,$strQuery);
		while($row=pg_fetch_array($regCombo))
		{ 
		 $Html.="<option value='$row[0]'>$row[1]</option>";
		}
		$Html.="</select>";
		return $Html;
	}
	
	
	function ReturnHtmlFormulario($strConexion,$strFormulario)
	{
		$strQuery="select html_label,fn_regresaFormatoObjetohtml(html,a.idTipoObjeto::int2,nombreidobjeto,maximocaracteres::int2,anchoobjeto::int2) as html_Object from cat_Formularios a left join table_catTipoObjeto b on (a.idTipoObjeto=b.idTipoObjeto) where upper(nombreforma)=upper('$strFormulario') and flaghtmldinamico=1 order by ordenobjeto";
		$regFormulario=executeEscalar($strConexion,$strQuery);
		$Html.='<table border="0"><td  align="right" style="width: 250px"> ';
		while($row=pg_fetch_array($regFormulario))
		{ 
		 $Html.='<tr>
					<td  align="right" style="width: 130px">
						'.$row[0].'
					</td>
					<td  align="left" style="width: 300px">
						'.$row[1].'
					</td>
				</tr>';
		}
		$Html.='</td></table>';	
		return $Html;
	}
	
	
	function ReturnHtmlMenuTree($strConexion,$strMenu)
	{
		$strQuery="select fn_regresaMenuhtml('$strMenu')";
		$reg=executeEscalar($strConexion,$strQuery);
		$row=pg_fetch_array($reg);	
		$Html=$row[0];
		return $Html;
	}
	
	
	function ReturnHtmlHorizontalMenu($strConexion,$strMenu,$intUsuario,$intIdSistema)
	{
		$strQuery="select fn_regresamenuhtmlhorizontal2('$strMenu',$intUsuario,$intIdSistema)";
		$reg=executeEscalar($strConexion,$strQuery);
		$row=pg_fetch_array($reg);	
		$Html=$row[0];
		return $Html;
	}
?>