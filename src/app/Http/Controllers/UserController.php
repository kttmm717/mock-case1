<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;
use App\Models\Item;
use App\Models\SoldItem;

class UserController extends Controller
{
    public function mypage(Request $request) {
        $user = User::find(Auth::id());
        if($request->page === 'sell') {
            $items = Item::where('user_id', Auth::id())->get();
        }else {
            $items = SoldItem::where('user_id', Auth::id())->get()->map(function($sold_item) {
                return $sold_item->item;
            });
        }
        return view('mypage', compact('items', 'user'));
    }
    public function profileView() {
        $user = User::find(Auth::id());
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('profile', compact('user', 'profile'));
    }
    public function profileCreate(ProfileRequest $request) {
        $img = $request->file('img_url');
        if(isset($img)) {
            $img_url = Storage::disk('local')->put('public/img', $img);
        }else {
            $img_url = '';
        }

        $profile = Profile::where('user_id', Auth::id())->first();

        if(isset($profile)) {
            $profile->update([
                'user_id' => Auth::id(),
                'img_url' => $img_url,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building ?? null,
            ]);
        }else {
            Profile::create([
                'user_id' => Auth::id(),
                'img_url' => $img_url,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building ?? null,
            ]);
        }
        return redirect('/');
    }
}
