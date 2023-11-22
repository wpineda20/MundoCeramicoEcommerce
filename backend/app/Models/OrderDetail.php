<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    private $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function format()
    {
        $product = $this->getProduct($this->product_id);

        return [
            'product' => $product['product'],
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }

    public function getProduct($productId)
    {
        try {
            $response = Http::get(getenv('URL_API_EPCOM') . "/products/$productId");

            if ($response->successful()) {
                $data = $response->json(); // Retrieve the response data as JSON
            } else {
                // Handle the error response
                $statusCode = $response->status();
                $errorMessage = $response->body();

                // Handle the error accordingly
                return [
                    'success' => false,
                    'product' => null
                ];
            }

            return [
                'success' => true,
                'product' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'product' => null
            ];
        }
    }
}
