<?php

namespace App\Http\Controllers\Public;

use App\DTOs\Pages\Public\RentPropertyPageDTO;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class RentPropertyController extends Controller
{
    private RentPropertyPageDTO $rentPropertyPageDTO;

    public function __construct()
    {
        $this->rentPropertyPageDTO = new RentPropertyPageDTO();
    }

    public function index()
    {
        return Inertia::render('Home/Index', $this->rentPropertyPageDTO->toArray());
    }
}
