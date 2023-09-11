<?php

namespace MyStore;

use PDO;

class CarModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getProperties(): array | false
    {
        $query = $this->db->prepare("SELECT `name`, `year-made`, `zero-sixty`, `price`, `brand` FROM `cars`");
        $query->execute();
        return $query->fetchAll();
    }
}
