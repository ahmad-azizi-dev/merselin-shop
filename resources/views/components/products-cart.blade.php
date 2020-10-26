@foreach($eagerProducts as $product)
    <tr>
        <th style="width: 70px">
            <a wire:click="removeFromCart({{ $product->id }})"
               class="btn badge-danger text-white btn-sm p-1">
                <i class=" lni lni-cart-full"></i>
                @lang('mainFrontend.Delete')
            </a>
        </th>
        <td>
            <x-product-img :product=$product></x-product-img>
        </td>
        <td><a href="#"> {{$product->title}}
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
               class="btn badge-danger text-white btn-sm m-1">
                <i class="lni lni-minus"></i>
            </a>
            <a wire:click="addToCart({{ $product->id }})"
               class="btn badge-success text-white btn-sm m-1">
                <i class="lni lni-plus"></i>
            </a>
        </td>
    </tr>
@endforeach
