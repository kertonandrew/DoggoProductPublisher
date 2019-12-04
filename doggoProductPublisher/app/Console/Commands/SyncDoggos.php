<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Utils\DogApiHelper;
use App\Utils\ShopifyApiHelper;

class SyncDoggos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doggos:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add products to Doggo Store';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ShopifyApiHelper $shopifyApiHelper, DogApiHelper $dogApiHelper)
    {
        $dogs = $dogApiHelper->extractAllAndStore();
    }
}
