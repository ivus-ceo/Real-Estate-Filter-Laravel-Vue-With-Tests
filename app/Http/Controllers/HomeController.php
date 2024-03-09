<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Pages\HomePageService;
use Inertia\Inertia;

class HomeController extends Controller
{
    private HomePageService $pageService;

    public function __construct(HomePageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index()
    {
        return Inertia::render('Home/Index', $this->pageService->index());
    }
}
