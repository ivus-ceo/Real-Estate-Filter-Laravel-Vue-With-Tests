<?php

namespace App\Http\Controllers\Public;

use App\DTOs\Pages\Public\SalePropertyPageDTO;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class SalePropertyController extends Controller
{
    public function __construct(
        private readonly SalePropertyPageDTO $salePropertyPageDTO
    )
    {}

    public function index()
    {
        return Inertia::render('Home/Index', $this->salePropertyPageDTO->toArray());
    }
}
