<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\ShopifyApiHelper;

class ShopifyApiController extends Controller
{
    protected $shopifyApiHelper;

    public function __construct(ShopifyApiHelper $shopifyApiHelper)
    {
    	$this->shopifyApiHelper = $shopifyApiHelper;
    }

    public function index()
    {
       return $this->shopifyApiHelper->index();
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();
        return $this->shopifyApiHelper->create($data);
    }

}
