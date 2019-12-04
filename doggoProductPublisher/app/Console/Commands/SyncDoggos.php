<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Generator as Faker;
use App\Utils\DogApiHelper;
use App\Utils\ShopifyApiHelper;
use App\DogProduct;
use App\DogProductVariant;
use App\DogProductImage;
use App\Http\Resources\DogProductResource;


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
    public function handle(ShopifyApiHelper $shopifyApiHelper, DogApiHelper $dogApiHelper, Faker $faker)
    {
        $dogs = $dogApiHelper->extractAllAndStore();

        dump($dogs);

        $dogs->each(function ($dog) use ($faker){

            dump($dog);

            $dogProduct = DogProduct::create([
                'title' => $dog->name,
                'body_html' => $faker->sentence,
                'vendor' => "Big Dog AK",
                'product_type' => "Dog"
            ]);

            // Add image to product
            DogProductImage::create([
                'dog_product_id' => $dogProduct->id,
                'src' => $dog->imageUrl
            ]);

            // Add variants
            foreach ($dog->subBreeds as $subBreed) {

                DogProductVariant::create([
                    'dog_product_id' => $dogProduct->id,
                    'price' => $faker->randomNumber(2),
                    'option1' => $subBreed->name,
                    'sku' => $faker->isbn10
                ]);
            }

            $dogProduct = DogProduct::find($dogProduct->id);

            dd($dogProduct->toArray());
        });
    }
}
