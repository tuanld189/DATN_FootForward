<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProvineRepositoryInterface; // Import the interface
use App\Models\Province;

/**
 * Class ProvinceRepository
 * @package App\Repositories
 */

class ProvinceRepository implements ProvineRepositoryInterface // Correct the interface name
{
    public function all(){
        return Province::all();
    }
}
