@foreach($eagerProducts as $product)
    <tr>
        <th style="width: 70px">
            <button type="button" class="btn badge-danger text-white btn-sm p-1" data-toggle="modal"
                    data-target="#removeFromCart{{$product->id}}">
                <i class=" lni lni-cart-full"></i> @lang('mainFrontend.Delete')
            </button>
            @push('modal') @include('frontend.partials.cart-modal') @endpush
        </th>
        <td>
            <a href="{{route('showProduct',['slug'=>$product->slug])}}">
                <x-product-img :product=$product></x-product-img>
            </a>
        </td>
        <td><a href="{{route('showProduct',['slug'=>$product->slug])}}"> {{$product->title}}
                <span class="text-success">
                    @if($product->discount_price)
                        <span class="text-decoration-line-through text-danger">{{$product->price}}
                            @lang('mainFrontend.Currency')
                        </span>
                        <span style="font-size: 11pt;" class="font-normal d-inline"> {{$productCountValues[$product->id]}} ×</span>
                        {{number_format($product->discount_price)}} @lang('mainFrontend.Currency')
                    @else
                        <span style="font-size: 11pt;" class="font-normal d-inline"> {{$productCountValues[$product->id]}} ×</span>
                        {{number_format($product->price)}} @lang('mainFrontend.Currency')
                    @endif
                </span>
            </a>
        </td>
        <td style="width: 65px;">
	        <a wire:click="removeFromCart({{ $product->id .", 'single'"}})"
	           class="btn badge-danger text-white btn-sm m-1 {{($productCountValues[$product->id]===1)?'d-none':''}}">
		        <i class="lni lni-minus"></i>
	        </a>
	        @if($productCountValues[$product->id] === 1)
		        <button data-target="#removeFromCart{{$product->id}}" data-toggle="modal"
		           class="btn badge-danger text-white btn-sm m-1" type="button">
			        <i class="lni lni-minus"></i>
		        </button>
	        @endif
            <a wire:click="addToCart({{ $product->id }})"
               class="btn badge-success text-white btn-sm m-1">
                <i class="lni lni-plus"></i>
            </a>
        </td>
    </tr>
@endforeach
