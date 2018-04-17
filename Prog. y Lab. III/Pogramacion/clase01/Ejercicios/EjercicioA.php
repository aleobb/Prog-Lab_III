<?php
	$varUno = 1;
	$varDos = 2;
	$varTres = 3;
	$resultado;
	
	if($varUno >= $varDos && $varTres)
		$resultado = $varUno;
	if($varDos >= $varUno && $varTres)
		$resultado = $varDos;
	//if($varTres >= $varDos && $varUno)
		$resultado = $varTres;

	echo "$resultado";
?>