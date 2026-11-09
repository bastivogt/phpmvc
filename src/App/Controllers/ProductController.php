<?php
namespace App\Controllers;
use App\Models\ProductModel;



class ProductController {
    public function index() {
        $productModel = new ProductModel();
        $products = $productModel->getProducts();
        d($products);
        return view('Product/index', [
            'products' => $products,
            'title' => 'Products'
        ]);

    }


    public function show($id) {
        $id = (int)$id;
        $productModel = new ProductModel();
        $product = $productModel->getProductById($id);
        if (!$product) {
            notFound();
        }
        d($product);
        return view('Product/show', [
            'product' => $product, 
            'title' => $product['name']
        ]);
    }

    public function create() {
        return view('Product/create', [
            'title' => 'Create Product', 
            'errors' => []
        ]);
    }
    
    public function store() {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';

        if (empty($name) || empty($description)) {
            return view('Product/create', [
                'title' => 'Create Product',
                'errors' => ['Name and description are required.'],
                'product' => [
                    'name' => $name,
                    'description' => $description
                ]
            ]);
        }

        $productModel = new ProductModel();
        $productModel->createProduct([
            'name' => $name,
            'description' => $description
        ]);

        redirect('/products');
    }   
}