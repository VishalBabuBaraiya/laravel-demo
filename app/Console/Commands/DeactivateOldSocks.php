<?php

namespace App\Console\Commands;
use DB;
use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;

class DeactivateOldSocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:deactivate-old-socks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate products in the Socks category that are older than 2 years';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twoYearsAgo = Carbon::now()->subYears(2);
        $products = Product::whereHas('category', function ($query) {
            $query->where('name', 'Socks');
        })->where('created_at', '<', $twoYearsAgo)
          ->get();

        if ($products->isEmpty()) {
            $this->info("No old Socks products found.");
            return 0;
        }

        $updatedCount = 0;

        foreach ($products as $product) {
            if (!$product->active) {
                $this->info("Product '{$product->name}' is already inactive.");
            } else {
                $product->update(['active' => false]);
                $updatedCount++;
                $this->info("Deactivated product '{$product->name}'.");
            }
        }

        $this->info("Total deactivated products: $updatedCount.");
        return 0;
    }
}
