<!-- Header -->
<div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img src="{{asset('/public/assets/back-end/img/top-customers.png')}}" alt="">
        {{__('top_customer')}}
    </h4>
</div>
<!-- End Header -->

<!-- Body -->
<div class="card-body">
    @if($top_customer)
        <div class="grid-card-wrap">
            @foreach($top_customer as $key=>$item)
                @if(isset($item->customer))
                    <div class="cursor-pointer"
                         onclick="location.href=''">
                        <div class="grid-card basic-box-shadow">
                            <div class="text-center">
                                <img class="avatar rounded-circle avatar-lg"
                                     onerror="this.src='{{asset('public/assets/back-end/img/160x160/img1.jpg')}}'"
                                     src="{{asset('storage/app/public/profile/'.$item->customer->image??'')}}">
                            </div>

                            <h5 class="mb-0">{{$item->customer['f_name']??'Not exist'}}</h5>

                            <div class="orders-count d-flex gap-1">
                                <div>{{__('orders')}} : </div>
                                <div>{{$item['count']}}</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center">
            <p class="text-muted">{{__('no_Top_Selling_Products')}}</p>
            <img class="w-75" src="{{asset('/public/assets/back-end/img/no-data.png')}}" alt="">
        </div>
    @endif
</div>
<!-- End Body -->
