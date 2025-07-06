<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Hash;


class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
            
        public function run()
        {
            $user1 = User::create([
                'name' => 'Alice',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
            ]);

            $user2 = User::create([
                'name' => 'Bob',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
            ]);

            ChatMessage::create([
                'sender_id' => $user1->id,
                'receiver_id' => $user2->id,
                'message' => 'Hello Bob!',
            ]);

            ChatMessage::create([
                'sender_id' => $user2->id,
                'receiver_id' => $user1->id,
                'message' => 'Hi Alice!',
            ]);
        }

}
