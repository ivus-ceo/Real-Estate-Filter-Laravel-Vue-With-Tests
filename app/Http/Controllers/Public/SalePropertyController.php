<?php

namespace App\Http\Controllers\Public;

use App\DTOs\Pages\Public\SalePropertyPageDTO;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class SalePropertyController extends Controller
{
    private SalePropertyPageDTO $salePropertyPageDTO;

    public function __construct(SalePropertyPageDTO $salePropertyPageDTO)
    {
        $this->salePropertyPageDTO = $salePropertyPageDTO;
    }

    public function index()
    {
        return Inertia::render('Home/Index', $this->salePropertyPageDTO->toArray());
    }
}
