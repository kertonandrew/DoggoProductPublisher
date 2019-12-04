<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\DogApiHelper;

class DogApiController extends Controller
{
    protected $dogApiHelper;

    public function __construct(DogApiHelper $dogApiHelper)
    {
    	$this->dogApiHelper = $dogApiHelper;
    }

    // Maily used for testing - the work is done via scheduled jobs
    public function extractAllAndStore($count = 5)
    {
        return $this->dogApiHelper->extractAllAndStore($count);
    }
}
