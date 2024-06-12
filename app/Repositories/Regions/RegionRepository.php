<?php

namespace App\Repositories\Regions;

use App\Models\Region;
use App\Repositories\BaseRepository;

final class RegionRepository extends BaseRepository implements RegionRepositoryInterface
{
    public function __construct(
        Region $region
    )
    {
        parent::__construct($region);
    }
}
