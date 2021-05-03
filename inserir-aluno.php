<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$pdo = \Alura\Pdo\Infrastructure\Persistence\ConnectionCreator::createConnection();

$student = new Student(
    null,
    "Raissa Viana",
    new \DateTimeImmutable('1995-07-15')
);

$name = $student->name();

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name,:birth_date);";
$statement = $pdo->prepare($sqlInsert);
$statement->bindParam(':name', $name); //passando por referencia
$statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d')); //passando por valor

$name = 'Novo Nome'; //caso passado por referencia, é alterado mesmo já que já tenha sido passado

if($statement->execute()){
    echo "Aluno incluído";
}
