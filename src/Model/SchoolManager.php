<?php

namespace App\Model;

use PDO;

class SchoolManager extends AbstractManager
{
    public const TABLE = 'school';

    public function selectAllAndStudents(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT school.id, school.name, school.address, student.id as idstudent, student.fisrtname, student.lastname FROM ' . self::TABLE .
            ' LEFT JOIN student ON school.id=student.school_id'
        ;

        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

//[
//  'name' => 'Poudlar',
//  'address' => 'Londres'
//]
    public function insert(array $school): void
    {
        $query = 'INSERT INTO ' . self::TABLE .
            ' (name, address) VALUES (:name, :address)'
        ;

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':name', $school['name']);
        $stmt->bindValue(':address', $school['address']);

        $stmt->execute();
    }
}
