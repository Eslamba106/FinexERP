<div class="col-sm-6 col-lg-3">
    <!-- Business Analytics Card -->
    <div class="business-analytics">
        <h5 class="business-analytics__subtitle">{{__('total_Sale')}}</h5>
        <h2 class="business-analytics__title">{{ $data['total_sale'] ?? "Es" }}</h2>
        <img src="{{asset('/public/assets/back-end/img/total-sale.png')}}" class="business-analytics__img" alt="">
    </div>
    <!-- End Business Analytics Card -->
</div>
<div class="col-sm-6 col-lg-3">
    <!-- Business Analytics Card -->
    <div class="business-analytics">
        <h5 class="business-analytics__subtitle">{{__('total_Stores')}}</h5>
        <h2 class="business-analytics__title">{{ $data['store'] ?? "Es" }}</h2>
        <img src="{{asset('/public/assets/back-end/img/total-stores.png')}}" class="business-analytics__img" alt="">
    </div>
    <!-- End Business Analytics Card -->
</div>
<div class="col-sm-6 col-lg-3">
    <!-- Business Analytics Card -->
    <div class="business-analytics">
        <h5 class="business-analytics__subtitle">{{__('total_Products')}}</h5>
        <h2 class="business-analytics__title">{{ $data['product'] ?? "Es" }}</h2>
        <img src="{{asset('/public/assets/back-end/img/total-product.png')}}" class="business-analytics__img" alt="">
    </div>
    <!-- End Business Analytics Card -->
</div>
<div class="col-sm-6 col-lg-3">
    <!-- Business Analytics Card -->
    <div class="business-analytics">
        <h5 class="business-analytics__subtitle">{{__('total_Customers')}}</h5>
        <h2 class="business-analytics__title">{{ $data['customer'] ?? "Es" }}</h2>
        <img src="{{asset('/public/assets/back-end/img/total-customer.png')}}" class="business-analytics__img" alt="">
    </div>
    <!-- End Business Analytics Card -->
</div>


<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_pending" href="">
        <div class="order-stats__content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/public/assets/back-end/img/pending.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('pending')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$data['pending'] ?? "Es"}}
        </span>
    </a>
    <!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_confirmed" href="">
        <div class="order-stats__content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/public/assets/back-end/img/confirmed.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('confirmed')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$data['confirmed'] ?? "Es"}}
        </span>
    </a>
    <!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_packaging" href="">
        <div class="order-stats__content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/public/assets/back-end/img/packaging.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('packaging')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$data['processing'] ?? "Es"}}
        </span>
    </a>
    <!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3">
    <!-- Card -->
    <a class="order-stats order-stats_out-for-delivery" href="">
        <div class="order-stats__content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/public/assets/back-end/img/out-of-delivery.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('out_for_delivery')}}</h6>
        </div>
        <span class="order-stats__title">
            {{$data['out_for_delivery'] ?? "Es"}}
        </span>
    </a>
    <!-- End Card -->
</div>



<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_delivered cursor-pointer" onclick="location.href=''">
        <div class="order-stats__content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/public/assets/back-end/img/delivered.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('delivered')}}</h6>
        </div>
        <span class="order-stats__title">{{$data['delivered'] ?? "Es"}}</span>
    </div>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_canceled cursor-pointer" onclick="location.href=''">
        <div class="order-stats__content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/public/assets/back-end/img/canceled.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('canceled')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$data['canceled'] ?? "Es"}}</span>
    </div>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_returned cursor-pointer" onclick="location.href=''">
        <div class="order-stats__content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/public/assets/back-end/img/returned.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('returned')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$data['returned'] ?? "Es"}}</span>
    </div>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="order-stats order-stats_failed cursor-pointer" onclick="location.href=''">
        <div class="order-stats__content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <img width="20" src="{{asset('/public/assets/back-end/img/failed-to-deliver.png')}}" alt="">
            <h6 class="order-stats__subtitle">{{__('failed_to_delivery')}}</h6>
        </div>
        <span class="order-stats__title h3">{{$data['failed'] ?? "Es"}}</span>
    </div>
</div>
