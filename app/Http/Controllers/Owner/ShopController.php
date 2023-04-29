<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Closure;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function (Request $request, Closure $next) {

            //dd($request->route()->parameter('shop'));
            //dd(Auth::id());

            $id = $request->route()->parameter('shop'); //shopのid取得
            if(!is_null($id)) { // null判定
                $shopsOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopsOwnerId; // キャスト 文字列→数値に型変換
                $ownerId = Auth::id();

                if($shopId !== $ownerId) { // 同じでなかったら
                    abort(404); // 404画面表示
                }
            }

            return $next($request);
        });
    }

    public function index()
    {
        $ownerId = Auth::id();
        $shops = Shop::where('owner_id', $ownerId)->get();

        return view('owner.shops.index', compact('shops'));

    }

    public function edit(string $id)
    {
        $shop = Shop::findOrFail($id);

        return view('owner.shops.edit', compact('shop'));

    }

    public function update(Request $request, string $id)
    {
        $imageFile = $request->image; //一時保存
        if(!is_null($imageFile) && $imageFile->isValid()) {
            Storage::putFile('public/shops', $imageFile);
        }

        return redirect()->route('owner.shops.index');

    }
}
