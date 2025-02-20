<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryItem;
use App\Http\Requests\ItemRequest;
use App\Models\Like;

class ItemController extends Controller
{
    public function index(Request $request) {
        $page = $request->query('page', 'best');
        $search = $request->query('search');
        $query = Item::query();
        $query->where('user_id', '!=', Auth::id());
        //条件が1つ(ログイン中ユーザー)なのでwhereメソッド

        if($page === 'mylist') {
            $query->whereIn('id', function($query) { //条件が複数なのでwhereIn
                $query->select('item_id')
                      ->from('likes')
                      ->where('user_id', auth()->id());
            });
        }
        if($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        $items = $query->get();
        return view('index',compact('items', 'search'));
    }

    public function detail($item_id) {
        $item = Item::find($item_id);
        return view('detail', compact('item'));
    }
    public function sellView() {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', compact('categories', 'conditions'));
    }
    public function sellCreate(ItemRequest $request) {
        $img = $request->file('img_url');
        $img_url = Storage::disk('local')->put('public/img', $img);

        $item = Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'img_url' => $img_url,
            'user_id' => Auth::id(),
            'condition_id' => $request->condition_id
        ]);

        foreach($request->categories as $category_id) {
            CategoryItem::create([
                'item_id' => $item->id,
                'category_id' => $category_id
            ]);
        }
        return redirect('/');
    }
}
