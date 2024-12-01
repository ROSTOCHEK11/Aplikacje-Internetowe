<?php
namespace App\Model;

use App\Service\Config;

class Creature
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $description = null;
    private ?int $lifespan = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Creature
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Creature
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Creature
    {
        $this->description = $description;
        return $this;
    }

    public function getLifespan(): ?int
    {
        return $this->lifespan;
    }

    public function setLifespan(?int $lifespan): Creature
    {
        $this->lifespan = $lifespan;
        return $this;
    }

    public static function fromArray(array $array): Creature
    {
        $creature = new self();
        $creature->fill($array);
        return $creature;
    }

    public function fill(array $array): Creature
    {
        if (isset($array['id']) && !$this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['name'])) {
            $this->setName($array['name']);
        }
        if (isset($array['description'])) {
            $this->setDescription($array['description']);
        }
        if (isset($array['lifespan'])) {
            $this->setLifespan($array['lifespan']);
        }
        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM creatures';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $creatures = [];
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $creatures[] = self::fromArray($row);
        }
        return $creatures;
    }

    public static function find($id): ?Creature
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM creatures WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        return $row ? self::fromArray($row) : null;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (!$this->getId()) {
            $sql = 'INSERT INTO creatures (name, description, lifespan) VALUES (:name, :description, :lifespan)';
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'name' => $this->getName(),
                'description' => $this->getDescription(),
                'lifespan' => $this->getLifespan(),
            ]);
            $this->setId($pdo->lastInsertId());
        } else {
            $sql = 'UPDATE creatures SET name = :name, description = :description, lifespan = :lifespan WHERE id = :id';
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'name' => $this->getName(),
                'description' => $this->getDescription(),
                'lifespan' => $this->getLifespan(),
                'id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'DELETE FROM creatures WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $this->getId()]);

        $this->setId(null);
        $this->setName(null);
        $this->setDescription(null);
        $this->setLifespan(null);
    }
}
