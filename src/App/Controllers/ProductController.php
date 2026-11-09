<?php
namespace App\Controllers;
use App\Models\ProductModel;



class ProductController {
    public function index() {
        $productModel = new ProductModel();
        $products = $productModel->getProducts();
        d($products);
        return view('Product/index', ['products' => $products]);

    }


    public function show($id) {
        $id = (int)$id;
        $productModel = new ProductModel();
        $product = $productModel->getProductById($id);
        if (!$product) {
            notFound();
        }
        d($product);
        return view('Product/show', ['product' => $product]);
    }
}