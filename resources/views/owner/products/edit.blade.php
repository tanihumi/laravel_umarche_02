<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="post" action="{{ route('owner.products.update', ['product' => $product->id ]) }}" >
                    @csrf
                    <div class=" -m-2">

                    <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">商品名</label>
                            <input type="text" id="name" name="name"  value="{{ $product->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                            <label for="information" class="leading-7 text-sm text-gray-600">商品情報</label>
                            <textarea  id="information" name="information" rows="10"  required  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $product->information }}</textarea>
                            <x-input-error :messages="$errors->get('information')" class="mt-2" />
                        </div>
                    </div>

                    <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                            <label for="price" class="leading-7 text-sm text-gray-600">価格</label>
                            <input type="number" id="price" name="price"  value="{{ $product->price }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                    </div>

                    <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                            <label for="sort_order" class="leading-7 text-sm text-gray-600">表示順</label>
                            <input type="number" id="sort_order" name="sort_order"  value="{{ $product->sort_order }}"  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                        </div>
                    </div>

                    <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                            <label for="current_quantity" class="leading-7 text-sm text-gray-600">現在の在庫</label>
                            <input type="hidden" id="current_quantity" name="current_quantity"  value="{{ $quantity }}" >
                            <div class="w-full bg-gray-100 bg-opacity-50 rounded text-base outline-none text-gray-700 py-1 px-3 leading-8" >{{ $quantity }}</div> 
                        </div>
                    </div>

                    <div class="p-2 w-1/2 mx-auto">
                            <div class="relative flex justify-around">
                                <div><input type="radio" name="type" value="1" class="mr-2"  checked >追加</div>
                                <div><input type="radio" name="type" value="2" class="mr-2" >削減</div>
                            </div>
                    </div>

                    <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                            <label for="quantity" class="leading-7 text-sm text-gray-600">数量</label>
                            <input type="quantity" id="quantity" name="quantity"  value="0" required  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <span class="text-sm">0～99の範囲で入力してください</span>
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>
                    </div>

                    <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                        <label for="shop_id" class="leading-7 text-sm text-gray-600">販売する店舗</label>
                        <select name="shop_id" id="shop_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> 
                            @foreach ($shops as $shop )
                            <option value="{{ $shop->id}}" @if($shop->id === $product->shop_id) selected @endif> 
                                {{ $shop->name }} 
                            </option> 
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                        <label for="category" class="leading-7 text-sm text-gray-600">カテゴリー</label>
                        <select name="category" id="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> 
                            @foreach($categories as $category) 
                                    <optgroup label="{{ $category->name }}"> 
                                        @foreach($category->secondary as $secondary) 
                                            <option value="{{ $secondary->id}}" @if( $secondary->id === $product->secondary_category_id ) selected @endif> 
                                                {{ $secondary->name }} 
                                            </option> 
                                        @endforeach 
                            @endforeach 
                        </select>
                        </div>
                    </div>

                    <x-select-image :images="$images" currentId="{{$product->image1}}" currentImage="{{$product->imageFirst->filename ?? ''}}"  name="image1"></x-select-image>
                    <x-select-image :images="$images" currentId="{{$product->image2}}" currentImage="{{$product->imageSecond->filename ?? ''}}" name="image2"></x-select-image>
                    <x-select-image :images="$images" currentId="{{$product->image3}}" currentImage="{{$product->imageThird->filename ?? ''}}" name="image3"></x-select-image>
                    <x-select-image :images="$images" currentId="{{$product->image4}}" currentImage="{{$product->imageForth->filename ?? ''}}" name="image4"></x-select-image>
                    <div data-micromodal-trigger=""></div>

                    <div class="p-2 w-1/2 mx-auto">
                            <div class="relative flex justify-around">
                                <div><input type="radio" name="is_selling" value="1" class="mr-2"   @if( $product->is_selling === 1 ){ checked } @endif >販売中</div>
                                <div><input type="radio" name="is_selling" value="0" class="mr-2"   @if( $product->is_selling === 0 ){ checked } @endif >停止中</div>
                            </div>
                    </div>

                        <div class="p-2 w-full mt-4 flex justify-around">
                            <button type="button" onclick="location.href='{{ route('owner.products.index') }}'" class=" bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                            <button type="submit" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
                        </div>
                    </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    'use strict' 
    const images = document.querySelectorAll('.image') //全てのimageタグを取得  
    images.forEach(image => { // 1つずつ繰り返す 
      image.addEventListener('click', function(e){  // クリックしたら 
        const imageName = e.target.dataset.id.substr(0, 6) //data-idの6文字 
        const imageId = e.target.dataset.id.replace(imageName + '_', '') // 6文字カット 
        const imageFile = e.target.dataset.ﬁle 
        const imagePath = e.target.dataset.path 
        const modal = e.target.dataset.modal 

        // サムネイルと input type=hiddenのvalueに設定 
        document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile 
        document.getElementById(imageName + '_hidden').value = imageId 
        MicroModal.close(modal); //モーダルを閉じる 
      }) 
    })
</script>    
</x-app-layout>
