<!-- Header -->
<div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img src="{{asset('/public/assets/back-end/img/most-popular-product.png')}}" alt="">
        {{__('most_popular_products')}}
    </h4>
</div>
<!-- End Header -->

<!-- Body -->
<div class="card-body">
    @if($most_rated_products)
        <div class="row">
            <div class="col-12">
                <div class="grid-card-wrap">
                    @foreach($most_rated_products as $key=>$item)
                        @php($product=\App\Model\Product::find($item['product_id']))
                        @if(isset($product))
                            <div class="cursor-pointer grid-card basic-box-shadow" onclick="location.href=''">
                                <div class="">
                                    <img class="avatar avatar-bordered border-gold avatar-60 rounded" src="{{asset('storage/app/public/product/thumbnail')}}/{{$product['thumbnail']}}"
                                        onerror="this.src='{{asset('public/assets/back-end/img/160x160/img2.jpg')}}'"
                                        alt="{{$product->name}} image">
                                </div>
                                <div class="fz-12 title-color text-center">
                                    {{isset($product)?substr($product->name,0,30) . (strlen($product->name)>20?'...':''):'not exists'}}
                                </div>
                                <div class="d-flex align-items-center gap-1 fz-10">
                                    <span class="rating-color d-flex align-items-center font-weight-bold gap-1">
                                        <i class="tio-star"></i>
                                        {{round($item['ratings_average'],2)}}
                                    </span>
                                    <span class="d-flex align-items-center gap-10">
                                        ({{$item['total']}} {{__('reviews')}})
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            <p class="text-muted">{{__('no_Top_Selling_Products')}}</p>
            <img class="w-75" src="{{asset('/public/assets/back-end/img/no-data.png')}}" alt="">
        </div>
    @endif
</div>
<!-- End Body -->
