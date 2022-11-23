<?php

namespace Moi\App\Controllers;

use Moi\App\Lib\Controller;
use Moi\App\Models\Product;

class ProductController extends Controller
{
    public function createProduct(): void
    {
        $name  = $this->post('product_name');
        $price = $this->post('product_price');

        if (!is_null($name) && !is_null($price)) {
            $data = ['data' => []];
            $product = new Product();

            $product->setName($name);
            $product->setPrice($price);
            $product->setStatus(1);

            $product->createProduct();

            $data['data'] = [
                'status'  => 201,
                'message' => 'OK'
            ];
        } else {
            $data['data'] = [
                'status'  => 500,
                'message' => 'Oops!'
            ];
        }

        $json = json_encode($data);

        print_r($json);
    }

    public function getProducts(): void
    {
        $product  = new Product();
        $products = $product->getProducts();

        if (!is_null($products)) {
            $data = ['data' => []];

            foreach ($products as $row) {
                $product->setId($row['id']);
                $product->setName($row['name']);
                $product->setPrice($row['price']);

                $data['data'][] = [
                    'id'     => $product->getId(),
                    'name'   => $product->getName(),
                    'price'  => $product->getPrice()
                ];
            }

            $data['status']  = 200;
            $data['message'] = 'OK';
        } else {
            $data['status']  = 500;
            $data['message'] = 'Oops!';
        }

        $json = json_encode($data);

        print_r($json);
    }

    public function removeProduct(int $id): void
    {
        $product = new Product();

        $product->setId($id);

        $product->removeProduct(
            $product->getId()
        );
    }

    public function removeProducts(): void
    {
        $product = new Product();
        $product->removeProducts();
    }
};
