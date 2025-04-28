<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = Contact::all();
        foreach ($contacts as $contact) {
            Field::factory(3)->create([
                'contact_id' => $contact->id,
            ]);
        }
    }
}
