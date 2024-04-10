<?php

namespace App\Http\Controllers\Public;

use App\DTOs\Pages\Public\HomePageDTO;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HomeController extends Controller
{
    private HomePageDTO $homePageDTO;

    public function __construct(HomePageDTO $homePageDTO)
    {
        $this->homePageDTO = $homePageDTO;
    }

    public function index()
    {
        return Inertia::render('Home/Index', $this->homePageDTO->toArray());
    }
}
