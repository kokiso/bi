<?php
	try {
		$hostname = 'localhost';
		$dbname = 'BI';
		$username = 'sa';
		$pw = 'a1111111';
		$pdo = new PDO ('sqlsrv:Server=localhost;Database=BI',$username,$pw);
	} catch (PDOException $e) {
		echo 'Erro de Conexão ' . $e->getMessage() . '\n';
		exit;
	}
	var_dump($pdo);
	$query = $pdo->prepare('select Coluna FROM nome_tabela');
	$query->execute();

	for($i=0; $row = $query->fetch(); $i++){
	echo $i.' – '.$row['Coluna'].'<br/>';
	}

	unset($pdo);
	unset($query);
?>