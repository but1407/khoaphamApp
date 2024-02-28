<?php
 
namespace App\Http\View\Composers;
 
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;

 
class CartComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct(
        
    ) {}

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $carts = Session::get('carts');
        if (is_null($carts)) $carts =[];

        $productId = array_keys($carts);

        $products = Product::select('id', 'name', 'price', 'price_sale', 'feature_image_path')
            ->where('status', 1)
            ->whereIn('id', $productId)
            ->get();
        $view->with('carts',$products);
        $view->with('qty',$carts);


    }
}