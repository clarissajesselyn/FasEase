<?php

namespace App\Http\Controllers\Item;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserItemController extends Controller
{
    public function index($slug){
        $category = Category::where('slug', $slug)
            ->where('organization_id', auth()->user()->organization_id)
            ->firstOrFail();
            
        $datas = Item::where('category_id', $category->id)->get();
        return view('item.item-page-user', compact('datas', 'category'));
    }
}
