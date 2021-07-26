@extends('layouts.crud.show')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('marketplace_shop') }}
        @endslot
    @endcomponent
@endsection

@section('css')
    <style type="text/css">
        .badge {
            font-size: 8px;
        }

        .sku-item .label, .sku-item .add-to-cart {
            font-size: small;
            font-weight: 600;
        }

        .sku-item .add-to-cart {
        }

        .img-radio {
            max-height: 100px;
            margin: 5px auto;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .selected-radio > img {
            opacity: .45;
        }

        .selected-radio .middle {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @component('components.box',['box_class'=>'box-success'])
                <div class="text-center">
                    <img src="{{ $product->image }}" class="img-responsive img-fluid" alt="Product Image"/>
                </div>
                <div class="text-center">
                    <h2>
                        @if($product->discount)
                            <del>{{ \Payments::currency($product->regular_price) }}</del>
                        @endif
                        {!! $product->price !!}
                    </h2>
                    <h4><b>{!! $product->present('plain_name') !!}</b></h4>

                    <h4>{{ $product->caption }}</h4>
                </div>
                <div style="">
                   {!! $product->description !!}
               </div>
                
                <div class="text-center">
                {!! $product->getCustom('colour')  !!}
                </div>
                <div class="text-center">
                {!! $product->getCustom('condition')  !!}
                </div>
                <div class="text-center">
               {!! $product->getCustom('printed')  !!} 
                </div>
                <div class="text-center">
                {!! $product->getCustom('material')  !!}
                </div>
                 <div class="text-center" >
                            <b>Size</b>

                           <b> <div id="shoes_size_women" class="hidden">
                           {!! $product->getCustom('shoes_size_women')  !!}
                            </div></b>

                            <b> <div id="shoes_size_men" class="hidden">
                           {!! $product->getCustom('shoes_size_men')  !!}
                            </div></b>

                            <b> <div id="shoes_size_kids" class="hidden">
                           {!! $product->getCustom('shoes_size_kids')  !!}
                            </div></b>

                            <b><div id="cloth_size_international_value" class="hidden">
                           {!! $product->getCustom('cloth_size_international_value')  !!}
                            </div></b>

                            <div id="bag_size" class="hidden">
                         
                            <b>Width : </b>{!! $product->getCustom('width')  !!}<br>
                            <b>Height : </b>{!! $product->getCustom('height')  !!}<br>
                            <b>Depth : </b>{!! $product->getCustom('depth')  !!}
                            </div>
                            
                </div>
                
        
                
            @endcomponent
        </div>
        <div class="col-md-4">
            @component('components.box',['box_class'=>'box-success'])
                {!! Form::open(['url'=>'cart/'.$product->hashed_id.'/add-to-cart','method'=>'POST','class'=> 'ajax-form','data-page_action'=>"updateCart"]) !!}
                @if(!$product->isSimple)
                    @foreach($product->activeSKU as $sku)
                        @if($loop->index%2 == 0)
                            <div class="row">
                                @endif
                                <div class="col-md-6 text-center">
                                    <img src="{{ asset($sku->image) }}" class="img-responsive img-fluid img-radio">
                                    <div class="middle">
                                        <div class="text text-success"><i class="fa fa-check fa-4x"></i></div>
                                    </div>
                                    <div>
                                        {!! !$sku->options->isEmpty() ? $sku->present('options'):'' !!}
                                    </div>
                                    @if($sku->stock_status == "in_stock")
                                        <button type="button"
                                                class="btn btn-block btn-sm btn-default btn-secondary btn-radio m-t-5">
                                            <b>{!! \Payments::currency($sku->price)  !!}</b>
                                        </button>
                                    @else
                                        <button type="button"
                                                class="btn btn-block btn-sm m-t-5 btn-danger">
                                            <b>@lang('Marketplace::labels.shop.out_stock')</b>
                                        </button>

                                    @endif

                                    

                                    <input type="checkbox" id="left-item" name="sku_hash" value="{{ $sku->hashed_id }}"
                                           class="hidden disable-icheck"/>
                                </div>
                                @if($lastLoop = $loop->index%2 == 1)
                            </div>
                        @endif
                    @endforeach
                    @if(!$lastLoop)</div>@endif
        @else
            <input type="hidden" name="sku_hash" value="{{ $product->activeSKU(true)->hashed_id }}"/>
        @endif
        <div class="form-group">
            <span data-name="sku_hash"></span>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                {!! CoralsForm::number('quantity','Marketplace::attributes.shop.quantity', false, 1, ['min' => 1]) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if($product->globalOptions->count())
                    {!! $product->renderProductOptions('global_options' ) !!}
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if($product->external_url)
                    <a href="{{ $product->external_url }}" target="_blank" class="btn btn-default btn-block m-t-10 "
                       title="Buy Product">
                        <i class="fa fa-fw fa-cart-plus" aria-hidden="true"></i> @lang('Marketplace::labels.shop.buy')
                    </a>
                @elseif($product->isSimple && $product->activeSKU(true)->stock_status != "in_stock")
                    <button type="button"
                            class="btn btn-block btn-sm m-t-5 btn-danger">
                        <b>@lang('Marketplace::labels.shop.out_stock')</b>
                    </button>
                @else
                    {!! CoralsForm::formButtons('Marketplace::labels.shop.add_cart',['class'=>'btn btn-default btn-block m-t-10 add-to-cart'], ['show_cancel'=>false]) !!}

                    <a role="button" class="modal-load  btn btn-default btn-block m-t-10 add-to-cart" data-toggle="modal" data-target="make_offer" href="{{url('marketplace/products/'.$product->hashed_id.'/make_counter_offer'),}}"  > @lang('Marketplace::labels.shop.make_offer')</a>
                    
                @endif
            </div>
        </div>

        {{ Form::close() }}
        @endcomponent
    </div>
    @if($product->getMedia('marketplace-product-gallery')->count())
        <div class="col-md-4">
            @component('components.box')
                @include('Marketplace::products.gallery',['product'=>$product,'editable'=>false])
            @endcomponent
        </div>
    @endif
@endsection

@section('js')
    @parent
    @include('Marketplace::cart.cart_script')

    <script type="application/javascript">
        $(document).ready(function () {
            var categories = <?php echo json_encode($product->categories); ?>;
            var mainCategory;
            var baseCategories = <?php echo json_encode($baseCategories); ?>;
            var i;
            for ( i = 0; i < categories.length; i++) {
                if( categories[i]['name']=='Men'|| categories[i]['name']=='Women' || categories[i]['name']=='Kids' ){
                        mainCategory = categories[i]['name'];
                        console.log(mainCategory);

                    }
                   
                    if( categories[i]['name']=='Bag' || (typeof categories[i]['parent_id'] !== typeof undefined && categories[i]['parent_id'] == baseCategories['Bag'])){
                        console.log('Bag '+categories[i]['name']);

                        $('#shoes_size_women').addClass('hidden');
                        $('#shoes_size_men').addClass('hidden');
                        $('#shoes_size_kids').addClass('hidden');
                        $('#cloth_size_international_value').addClass('hidden');
                        $('#bag_size').removeClass('hidden');

                        
                    }else if(categories[i]['name']=='Shoes' || categories[i]['parent_id'] == baseCategories['Shoes'] ){
                      console.log('Shoes '+categories[i]['name']);
                    if( mainCategory == "Men"){
                        console.log(mainCategory);
                        $('#shoes_size_women').addClass('hidden');
                        $('#shoes_size_kids').addClass('hidden');
                        $('#shoes_size_men').removeClass('hidden');
                    }
                    else if(mainCategory == "Women"){
                      
                        $('#shoes_size_men').addClass('hidden');
                        $('#shoes_size_kids').addClass('hidden');
                        $('#shoes_size_women').removeClass('hidden');
                    }
                    else if(mainCategory == "Kids"){
                      
                      $('#shoes_size_men').addClass('hidden');
                      $('#shoes_size_women').addClass('hidden');
                      $('#shoes_size_kids').removeClass('hidden');
                  }
           
                        
                        $('#cloth_size_international_value').addClass('hidden');
                        $('#bag_size').addClass('hidden');

                    }else if(categories[i]['name']=='Clothing' || categories[i]['parent_id'] == baseCategories['Clothing']){
                        console.log('Clothing '+categories[i]['name']);
                      $('#cloth_size_international_value').removeClass('hidden');
                        $('#bag_size').addClass('hidden');
                        $('#shoes_size_men').addClass('hidden');
                        $('#shoes_size_women').addClass('hidden');
                        $('#shoes_size_kids').addClass('hidden');
                   
                    }else{
                        $('#cloth_size_international_value').addClass('hidden');
                        $('#bag_size').addClass('hidden');
                        $('#shoes_size_men').addClass('hidden');
                        $('#shoes_size_women').addClass('hidden');
                        $('#shoes_size_kids').addClass('hidden');
                    }
                   
                     }
          
        })
        </script>
@endsection