<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ticket_categories')->insert([
            ['name' => 'Technical Issue'],
            ['name' => 'Billing'],
        ]);

        DB::table('ticket_tags')->insert([
            ['name' => 'Urgent'],
            ['name' => 'Bug'],
        ]);

        DB::table('tickets')->insert([
            ['user_id' => 1, 'subject' => 'Website issue', 'description' => 'Cannot access site', 'status' => 'open', 'priority' => 'high', 'created_at' => now()],
        ]);
    }
}

