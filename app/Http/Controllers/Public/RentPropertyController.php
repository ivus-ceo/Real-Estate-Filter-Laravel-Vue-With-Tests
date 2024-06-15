<?php

namespace App\Http\Controllers\Public;

use App\DTOs\Pages\Public\RentPropertyPageDTO;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class RentPropertyController extends Controller
{
    public function __construct(
        private readonly RentPropertyPageDTO $rentPropertyPageDTO
    )
    {}

    public function index()
    {
        return Inertia::render('Home/Index', $this->rentPropertyPageDTO->toArray());
    }
}
