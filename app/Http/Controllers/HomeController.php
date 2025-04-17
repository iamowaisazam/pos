<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\newsletter;
use App\Models\Attribute;
use App\Models\Value;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Page;
use App\Models\ProductCollection;
use App\Models\Variation;
use App\Models\VariationAttribute;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Part\HtmlPart;
use Illuminate\Support\Facades\App;


class HomeController extends Controller
{

    /*
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
 
    
}
