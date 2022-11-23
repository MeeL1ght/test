<?php

namespace Moi\App\Models;

use Moi\App\Lib\Model;
use Throwable;

class Product extends Model
{
    private ?int $id;
    private ?string $name;
    private ?int $price;
    private ?int $status;

    public function __construct()
    {
        parent::__construct();

        $this->id     = null;
        $this->name   = null;
        $this->price  = null;
        $this->status = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status = 1): void
    {
        $this->status = $status;
    }

    public function createProduct(): void
    {
        try {
            $this->query(
                "INSERT INTO products (name, price, status)
                VALUES(
                  '{$this->name}',
                  {$this->price},
                  {$this->status}
                )"
            );
        } catch (Throwable $error) {
            error_log($error->getMessage());
        }
    }

    public function getProducts(): array|false|null
    {
        try {
            $queryResult = $this->query(
                'SELECT id, name, price FROM products WHERE status = 1'
            );

            $data = $this->getData($queryResult);

            return $data;
        } catch (Throwable $error) {
            error_log($error->getMessage());
        }
    }

    public function removeProduct(int $id): void
    {
        try {
            $this->query(
                "UPDATE products SET status = 0 WHERE id = {$id}"
            );
        } catch (Throwable $error) {
            error_log($error->getMessage());
        }
    }

    public function removeProducts(): void
    {
        try {
            $this->query("UPDATE products SET status = 0");
        } catch (Throwable $error) {
            error_log($error->getMessage());
        }
    }
};
