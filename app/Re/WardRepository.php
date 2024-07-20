<?php
namespace App\Repositories;

use App\Repositories\Interfaces\WardRepositoryInterface; // Import the interface
use App\Models\Ward;

/**
 * Class WardRepository
 * @package App\Repositories
 */

class WardRepository implements WardRepositoryInterface // Correct the interface name
{
    public function all(){
        return Ward::all();
    }
}
