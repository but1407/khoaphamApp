<?php
 
namespace App\Http\View\Composers;
 
use App\Models\Category;
use Illuminate\View\View;
use App\Repositories\UserRepository;

 
class MenuComposer
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
        $categories =  Category::select('id','name','parent_id')->where('status',1)->orderByDesc('id')->get();
        $view->with('categories',$categories);
    }
}