<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{
    public function calculateHash() {
        $createdAt = $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s');
        $hash = hash('sha256', $this->index . $createdAt . $this->previous_hash . $this->data);
        return $hash;
    }

    public static function isBlockchainValid() {
        $blocks = Blocks::orderBy('index')->get();
    
        for ($i = 1; $i < count($blocks); $i++) {
            $currentBlock = $blocks[$i];
            $previousBlock = $blocks[$i - 1];
    
            // Check if the hash of the block is correct
            if ($currentBlock->hash !== $currentBlock->calculateHash()) {
                return false;
            }
    
            // Check if the previous_hash of the current block matches the hash of the previous block
            if ($currentBlock->previous_hash !== $previousBlock->hash) {
                return false;
            }
        }
    
        return true;
    }
    
    use HasUuids;
}
