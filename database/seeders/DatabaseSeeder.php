<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Address::factory()->count(20)->create();

        Invoice::factory()
            ->count(50)->state(new Sequence(
                fn (Sequence $sequence) => ['address_id' => Address::all()->random()],
            ))->hasItems(rand(0, 3))->create();


    }
}
