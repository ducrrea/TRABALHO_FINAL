<?php 
$host = 'localhost';
$db =  'pastelaria';
$user = 'postgres';
$pass = 'postgres';

try {
	$conexao = new PDO(
    	"pgsql:host=$host;
		dbname=$db",
    	$user,
    	$pass
	);

	//echo "Conexão com Postgres realizada com sucesso!";
} catch (PDOException $e) {
	echo "Erro na conexão: " . $e->getMessage();
}
?>