<?php
namespace App\Repositories;

use App\Repositories\Interfaces\DistrictRepositoryInterface; // Import the interface
use App\Models\District;

/**
 * Class DistrictRepository
 * @package App\Repositories
 */

class DistrictRepository implements DistrictRepositoryInterface // Correct the interface name
{
    public function all(){
        return District::all();
    }
}
