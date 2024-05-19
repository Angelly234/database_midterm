<?php

namespace Database\Seeders;

use App\Models\Blocks;
use Illuminate\Database\Seeder;
use App\Models\Block; // Import the Block model

class GenesisBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the genesis block
        $genesisBlockData = [
            'index' => 0,
            'previous_hash' => null, // No previous hash for the genesis block
            'hash' => md5(uniqid(rand(), true)), // Generating a fake hash for the genesis block
            'sender_address' => 'system', // Typically, the sender address for the genesis block is 'system'
            'receiver_address' => 'initial_miner', // The receiver address for the genesis block could be the initial miner
            'data' => 'Genesis Block', // A descriptive message for the genesis block
            // Add any other fields you need for the genesis block
        ];        

        // Insert the genesis block into the blocks table
        Blocks::create($genesisBlockData);
    }
}
