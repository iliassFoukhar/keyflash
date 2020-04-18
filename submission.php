<?php
try {
$dbh = new PDO('mysql:host=localhost;port=3308;dbname=typerr', "root", "");
$dbh->exec("SET character_set_connection = 'utf8'");
$dbh->exec("SET NAMES 'UTF8'");
$name = $_POST["nom"];
$wpm =  $_POST["wpm"];
$cpm = $_POST["cpm"];
$err = $_POST["err"];
$data = [
   'name' => $name,
   'wpm' => $wpm,
   'cpm' => $cpm,
   'err' => $err,
];
$sql = "INSERT INTO score (name, wpm, cpm, err) VALUES (:name, :wpm, :cpm,:err)";
$stmt= $dbh->prepare($sql);
$stmt->execute($data);
if($stmt){
  header("location: index.php");
}
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>
