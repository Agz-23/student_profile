<?php
include_once("../../db.php");
require('vendor/autoload.php');

$faker = Faker\Factory::create('en_PH');

$database = new Database();
$connection = $database->getConnection();

$data = array();

// generate 15 records
for ($i = 1; $i <= 15; $i++) {
    array_push($data, $faker->unique()->province);
}

print_r($data);

try {
    $connection->beginTransaction();

    $sql = "INSERT INTO province(name) VALUES (:name)";
    $stmt = $connection->prepare($sql);

    foreach ($data as $row) {
        $stmt->bindParam(':name', $row);
        $stmt->execute();
    }

    $connection->commit();
} catch (PDOException $e) {
    // Handle the exception, rollback the transaction if needed
    $connection->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
