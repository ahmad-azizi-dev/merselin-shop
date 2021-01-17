<div>

    @include('frontend.partials.SidebarWrapper')

    <x-loading></x-loading>
	<input id="wishlistStatus" type="hidden" value="{{in_array($product->id, $wishlistProducts, true)}}">

    <div class="page-content-wrapper mt-0">
        <div class="product-description pb-3">

            <!-- Add To Cart-->
            <div class="cart-form-wrapper bg-white mb-3 py-3">
                <div class="container">
                    <form wire:submit.prevent="" class="cart-form">
                        @if(!in_array($product->id, $cartProducts))
                            <a wire:click="addToCart({{ $product->id }})"
                               class="btn badge-success text-white mx-5">
                                <i class="lni lni-cart"></i>
                                @lang('product.addCart')
                            </a>
                        @else
                            <div class="order-plus-minus d-flex align-items-center ">
                                <a wire:click="addToCart({{ $product->id }})"
                                   class="btn badge-success text-white btn-sm m-1 ">
                                    <i class="lni lni-plus"></i>
                                </a>
                                <input class="form-control cart-quantity-input" type="text"
                                       value="{{$productCountValues[$product->id]}}">
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
                            </div>
		                    <button type="button" class="btn badge-danger text-white mx-4" data-toggle="modal"
		                            data-target="#removeFromCart{{$product->id}}">
			                    <i class=" lni lni-cart-full"></i> @lang('mainFrontend.Delete')
		                    </button>
                        @endif
	                    @push('modal') @include('frontend.partials.cart-modal') @endpush
                    </form>
                </div>
            </div>

            <!-- Product Specification-->
            <div class="p-specification bg-white mb-3 py-3">
                <div class="container">
                    <h6>@lang('product.specifications')</h6>
                    <div> {!!$product->description!!} </div>
                </div>
            </div>
	
	        <!-- Product َAttributes-->
	        <div class="p-specification bg-white mb-3 py-3">
		        <div class="container">
			        <h6>@lang('product.attributes')</h6>
			        <div>
				        <table class="table table-sm table-striped mt-3">
					        <tbody>
					        @foreach($attributesGroup as $key=>$value)
					        <tr>
						        <td>{{$key}}</td>
						        <td>
							        <ul>
								        @foreach($value as $attributesValue)
								            <li style="list-style: circle">{{$attributesValue}}</li>
								        @endforeach
							        </ul>
						        </td>
					        </tr>
					        @endforeach
					        </tbody>
				        </table>
			        </div>
		        </div>
	        </div>
	        
            <!-- Rating & Review Wrapper-->

            <!-- Ratings Submit Form-->
            <div class="ratings-submit-form bg-white py-3">
                <div class="container">
                    <h6>@lang('product.submitReview')</h6>
                    <form action="#" method="">
                        <div class="stars mb-3">
                            <input class="star-1" type="radio" name="star" id="star1">
                            <label class="star-1" for="star1"></label>
                            <input class="star-2" type="radio" name="star" id="star2">
                            <label class="star-2" for="star2"></label>
                            <input class="star-3" type="radio" name="star" id="star3">
                            <label class="star-3" for="star3"></label>
                            <input class="star-4" type="radio" name="star" id="star4">
                            <label class="star-4" for="star4"></label>
                            <input class="star-5" type="radio" name="star" id="star5">
                            <label class="star-5" for="star5"></label><span></span>
                        </div>
                        <textarea class="form-control mb-3" id="comments" name="comment" cols="30" rows="10"
                                  data-max-length="200" placeholder="@lang('product.writeReview')"></textarea>
                        <button class="btn btn-sm btn-primary" type="submit">
                            @lang('product.saveReview')
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
	@stack('product-modal')
</div>
