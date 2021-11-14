<?php

namespace Database\Seeders;

use App\Models\Tweet;
use Illuminate\Database\Seeder;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $body = ['lorem', 'ipsum', 'dolor', 'sit', 'jamet'];
        foreach ($body as $b) {
            Tweet::create([
                'user_id' => 1,
                'body' => $b
            ]);
        }
    }
}
