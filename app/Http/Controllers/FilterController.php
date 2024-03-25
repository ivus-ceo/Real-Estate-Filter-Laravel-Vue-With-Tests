<?php

namespace App\Http\Controllers;

use App\DTOs\Pages\FilterPageDTO;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilterController extends Controller
{
    private FilterPageDTO $filterPageDTO;

    public function __construct(FilterPageDTO $filterPageDTO)
    {
        $this->filterPageDTO = $filterPageDTO;
    }

    public function index()
    {
        return Inertia::render('Home/Index', $this->filterPageDTO->toArray());
    }
}
