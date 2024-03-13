<?php

namespace App\Http\Controllers;

use App\DTOs\Pages\HomePageDTO;
use Illuminate\Http\Request;
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
