<img src="{{ url('/').'/storage/photos/'. $product->medias->whereIn('original_name',['1.jpg','1.png'])
->pluck('path')->get(0) }}" alt="{{$product->title}}">
