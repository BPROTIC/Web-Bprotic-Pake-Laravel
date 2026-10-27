<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\View\View;

class PublicProductController extends Controller
{
    public function index(): View
    {
        $products = Product::published()->paginate(12);
        $whatsapp = Setting::get('commerce_whatsapp', Setting::get('site_phone', ''));
        return view('public.products.index', compact('products', 'whatsapp'));
    }
}
