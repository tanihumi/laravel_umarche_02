<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Closure;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function (Request $request, Closure $next) {

            $id = $request->route()->parameter('image'); //shopのid取得
            if(!is_null($id)) { // null判定
                $imagesOwnerId = Image::findOrFail($id)->owner->id;
                $imageId = (int)$imagesOwnerId; // キャスト 文字列→数値に型変換

                if($imageId !== Auth::id()) { // 同じでなかったら
                    abort(404); // 404画面表示
                }
            }

            return $next($request);
        });
    }
    public function index()
    {
        $images = Image::where('owner_id', Auth::id())
        ->orderBy('updated_at', 'desc')
        ->paginate(20);

        return view('owner.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UploadImageRequest $request)
    {
        $imageFiles = $request->file('files');
        if(!is_null($imageFiles)) {
            foreach($imageFiles as $imageFile) {
                $fileNameToStore = ImageService::upload($imageFile, 'products');
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameToStore,
                ]);
            }
        }

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像登録を実施しました', 'status' => 'info']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = Image::findOrFail($id);

        return view('owner.images.edit', compact('image'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['string', 'max:50'],
        ]);

        $image= Image::findOrFail($id);
        $image->title = $request->title;
        $image->save();

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像情報を更新しました', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Image::findOrFail($id);

        $imageInProducts = Product::where('image1', $image->id)
        ->orWhere('image2', $image->id)
        ->orWhere('image3', $image->id)
        ->orWhere('image4', $image->id)
        ->get();

        if($imageInProducts) {

            $imageInProducts->each(function ($product) use ($image) {

                if($product->image1 === $image->id) {
                    $product->image1 = null;
                    $product->save();
                }
                if($product->image2 === $image->id) {
                    $product->image2 = null;
                    $product->save();
                }
                if($product->image3 === $image->id) {
                    $product->image3 = null;
                    $product->save();
                }
                if($product->image4 === $image->id) {
                    $product->image4 = null;
                    $product->save();
                }

            });
        }

        $filePath = 'public/products/' . $image->filename;



        if(Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        Image::findOrFail($id)->delete();

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像を削除しました',
        'status' => 'alert']);
    }
}
