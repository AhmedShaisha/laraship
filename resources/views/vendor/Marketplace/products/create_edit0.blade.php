@extends('layouts.crud.create_edit')

@section('css')
    {!! \Html::style('assets/corals/plugins/nestable/select2totree.css') !!}
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('marketplace_product_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
            
                {!! CoralsForm::openForm($product) !!}
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">@lang('Marketplace::labels.product.abstract')</a></li>
                    <li><a data-toggle="tab" href="#menu1">@lang('Marketplace::labels.product.information')</a></li>
                    <li><a data-toggle="tab" href="#menu2">@lang('Marketplace::labels.product.file_and_photos')</a></li>
                    <li><a data-toggle="tab" href="#menu3">@lang('Marketplace::labels.product.condition_and_price')</a></li>
                  </ul>
                  
                  
                <div class="tab-content">
                     <div id="home" class="tab-pane fade in active">
                        <br>
                        <div class="row">
                        <div class="col-md-6">
                      
                        {!! CoralsForm::select('categories[]','Marketplace::attributes.product.categories',\Marketplace::getCategoriesList($product->exists?$product->categories()->pluck('id')->toArray():[],[],$mainCategories) , true, null,$product->admin_approved=='accepted'?['readonly']:['multiple'=>false,'id'=>'mainCategory'], 'select2-tree') !!}
                        </div>
                     </div>

                      <div class="row">
                        <div class="col-md-6">
                            {!! CoralsForm::text('name','Marketplace::attributes.product.name',true,$product->name,$product->admin_approved=='accepted'?['readonly']:[]) !!}
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">
                            {!! CoralsForm::textarea('caption','Marketplace::attributes.product.caption',true,$product->caption,$product->admin_approved=='accepted'?['readonly']:['help_text'=>'',]) !!}
                        </div>
                     </div>

                    <div class="row">
                      <div class="col-md-6" >
                            {!! CoralsForm::select('brand_id','Marketplace::attributes.product.brand', \Marketplace::getBrandsList(),false,null,$product->admin_approved=='accepted'?['readonly']:['id'=>'brand_id'],$product->exists?'select':'select2') !!}
                         <div class="hidden" id="other_brand">
                         {{--   {!! CoralsForm::customField($product,'other_brand',$fieldClass = 'col-md-12')!!} --}}
                         </div>
                            {!! CoralsForm::radio('status','Corals::attributes.status',true, trans('Corals::attributes.status_options')) !!}
                    </div>
                    
                    @php
                      $catArray= \Marketplace::getCategoriesList($product->exists?$product->categories()->pluck('id')->toArray():[],$mainCategories);
                        @endphp
                    <div class="col-md-6" >
                        {!! CoralsForm::select('categories[]','Marketplace::attributes.product.product_type',$catArray , true, null,$product->admin_approved=='accepted'?['readonly']:['multiple'=>false,'id'=>'baseCategories'], 'select2-tree') !!}                       
                       
                    {{-- hana--}}
                        {{-- CoralsForm::select('tax_classes[]','Marketplace::attributes.product.tax_classes', \Payments::getTaxClassesList(), false, null,['multiple'=>true], 'select2') --}}
                        {{-- CoralsForm::text('demo_url','Marketplace::attributes.product.demo_url',false,$product->exists? $product->demo_url:'' ,[] ) !!}

                        {!! \Store::getStoreFields($product) --}}
                          
                    </div>
                    </div>
                        <a class="btn btn-primary btnNext" >@lang('Corals::labels.next')</a>
                    
                </div>

                <div id="menu1" class="tab-pane fade">
                      <br>
                    <div class="row">
                        <div class="col-md-12">
                       
                        
                        {{--    {!! CoralsForm::customField($product,'material',$fieldClass = 'col-md-4')!!} --}}
                       
                    
                        {{--   {!! CoralsForm::customField($product,'printed',$fieldClass = 'col-md-4')!!} --}}
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-12">
                        {{--  {!! CoralsForm::customField($product,'colour',$fieldClass = 'col-md-4')!!}  --}}
                      </div> 
                    </div>  

                    <div id="bag_size" class="hidden">
                      <div class="row">
                        <div class="col-md-12">
                        {{--  {!! CoralsForm::customField($product,'width',$fieldClass = 'col-md-4')!!} --}}
                        {{--  {!! CoralsForm::customField($product,'height',$fieldClass = 'col-md-4')!!} --}}
                        {{--   {!! CoralsForm::customField($product,'depth',$fieldClass = 'col-md-4')!!}  --}}
                        </div> 
                      </div>  
                    </div>


                    <div id="cloth_size_international_value" class="hidden">
                      <div class="row">
                        <div class="col-md-12">
                        {{--    {!! CoralsForm::customField($product,'cloth_size_international_value',$fieldClass = 'col-md-4')!!} --}}
                        </div>
                     </div>
                    </div>


                    <div id="shoes_size_women" class="hidden">
                      <div class="row">
                        <div class="col-md-12">
                        {{--    {!! CoralsForm::customField($product,'shoes_size_women',$fieldClass = 'col-md-4')!!} --}}
                        </div> 
                      </div> 
                    </div>

                    <div id="shoes_size_men" class="hidden">
                      <div class="row">
                        <div class="col-md-12">
                        {{--   {!! CoralsForm::customField($product,'shoes_size_men',$fieldClass = 'col-md-4')!!} --}}
                        </div> 
                      </div>  
                     </div>

                    <div id="shoes_size_kids" class="hidden">
                      <div class="row">
                        <div class="col-md-12">
                        {{--   {!! CoralsForm::customField($product,'shoes_size_kids',$fieldClass = 'col-md-4')!!} --}}
                        </div> 
                      </div>  
                    </div>
                <div >
                </div>
                      <a class="btn btn-primary btnPrevious" >@lang('Corals::labels.previous')</a>
                      <a class="btn btn-primary btnNext" >@lang('Corals::labels.next')</a>
                      
                </div>

                <div id="menu2" class="tab-pane fade">
                      <br>
                     
                      <div class="row">
                        <div class="col-md-6">
                        {{--    {!! CoralsForm::customField($product,'place_of_purchase',$fieldClass='inline-block')!!} --}}
                        </div>
                      </div>
                      {{-- 
                     <div class="row">
                        <div class="col-md-12">
                            {!! CoralsForm::checkbox('shipping[enabled]', 'Marketplace::attributes.product.shippable', $product->shipping['enabled']) !!}
                            <div class="row" id="shipping" style="{{ !$product->shipping['enabled']?'display:none':'' }}">
                                 <div class="col-md-3">
                                    {!! CoralsForm::number('shipping[width]','Marketplace::attributes.product.width',false,null,['help_text'=>\Settings::get('marketplace_shipping_dimensions_unit','in'),'min'=>0]) !!}
                                 </div>
                                 <div class="col-md-3">
                                   {!! CoralsForm::number('shipping[height]','Marketplace::attributes.product.height',false,null,['help_text'=>\Settings::get('marketplace_shipping_dimensions_unit','in'),'min'=>0]) !!}
                                 </div>
                                 <div class="col-md-3">
                                    {!! CoralsForm::number('shipping[length]','Marketplace::attributes.product.length',false,null,['help_text'=>\Settings::get('marketplace_shipping_dimensions_unit','in'),'min'=>0]) !!}
                                 </div>
                                 <div class="col-md-3">
                                    {!! CoralsForm::number('shipping[weight]','Marketplace::attributes.product.weight',false,null,['help_text'=>\Settings::get('marketplace_shipping_weight_unit','oz'),'min'=>0]) !!}
                                 </div>
                            </div>
                        </div>
                     </div>
                      --}}
                    {{--   
                    <div class="row">
                        <div class="col-md-12">
                           {!! CoralsForm::checkbox('external', 'Marketplace::attributes.product.external', $product->external_url, 1,['onchange'=>"toggleExternalURL();",'help_text'=>'Marketplace::attributes.product.help_external']) !!}
                            <div id="external_section" style="display: {{ $product->external_url ? "block":"none" }}">
                                {!! CoralsForm::text('external_url','Marketplace::attributes.product.external_url',false,null) !!}
                            </div>
                        </div>
                    </div>
                      --}}
                      <div class="row">
                        <div class="col-md-12">
                        {{--add --}}
                        {!! CoralsForm::label('proofOrigin','Marketplace::labels.product.proof_of_origin', false, ) !!}
                        {{--add --}}
                        <span class="not-required">@lang('Marketplace::labels.product.optional')</span>
                        <br>
                        <span class="in3">@lang('Marketplace::labels.product.certificate')</span>
                        <p>@lang('Marketplace::labels.product.infoDownload')</p>
                        
                            @include('Marketplace::products.partials.downloadable', ['model' => $product])
                        </div>
                    </div>
                       
                     
                    @if (\Store::isStoreAdmin())
                        <div class="row">
                            <div class="col-md-6">
                                {!! \CoralsForm::checkbox('is_featured', 'Marketplace::attributes.product.is_featured', $product->is_featured) !!}
                              @if($product)
                               <input type='hidden' name='slug' value="{{$product->slug}}">
                               @else 
                               <input type='hidden' name='slug' value="">
                               @endif
                                {!! CoralsForm::select('tags[]','Marketplace::attributes.product.tags', \Marketplace::getTagsList(),false,null,['class'=>'tags','multiple'=>true], 'select2') !!}
                            </div>
                        </div>
                      {{--
                        <div class="row">
                            <div class="col-md-12">
                                {!! CoralsForm::checkbox('private_content_pages', 'Marketplace::attributes.product.private_content_page', count($product->posts), 1,['onchange'=>"togglePremuimContent();"]) !!}
                            </div>
                        </div>
                        <div class="row" id="product_pages" style="display: {{ count($product->posts) ? "block":"none" }}">
                            <div class="col-md-12">
                                {!! CoralsForm::select('posts[]','Marketplace::attributes.product.posts', [], false, null,
                                ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                                'model'=>\Corals\Modules\CMS\Models\Content::class,
                                'columns'=> json_encode(['title']),
                                'selected'=>json_encode($product->posts()->pluck('posts.id')->toArray()),
                                'where'=>json_encode([['field'=>'private','operation'=>'=','value'=>1]]),
                                ]],'select2') !!}
                            </div>
                        </div>
                        --}}
                    @endif
                    
                    <a class="btn btn-primary btnPrevious" >@lang('Corals::labels.previous')</a>
                    <a class="btn btn-primary btnNext" >@lang('Corals::labels.next')</a>
                    
                </div>
                <div id="menu3" class="tab-pane fade">
                      <br>
                      <div class="row">
                         <div class="col-md-12">
                         {{--    {!! CoralsForm::customField($product,'condition', $fieldClass='col-md-10')!!} --}}
                         </div>
                        </div>
                      <div class="row">
                         <div class="col-md-12">
                        
                            {{-- CoralsForm::select('global_options[]','Marketplace::attributes.product.global_options', \Marketplace::getAttributesList(),false,null,$product->admin_approved=='accepted'?['readonly']:['multiple'=>true], 'select2') --}}
                          {{--  {!! CoralsForm::select('type','Marketplace::attributes.product.type',trans('Marketplace::attributes.product.type_option') ,true, null,$product->admin_approved=='accepted'?['readonly']:['class'=>'',]) !!}--}}
                          {!! Form::hidden('type','simple') !!}
                          <div id="simple_product_attributes" >
                          <div class="col-md-6">
                            {!! CoralsForm::number('regular_price','Marketplace::attributes.product.regular_price',true,$product->exists? $sku->regular_price:null,['id'=>'regular_price','step'=>0.01,'min'=>0,'max'=>999999,'left_addon'=>'<i class="'.$sku->currency_icon.'"></i>']) !!}
                            {{--   {!! CoralsForm::customField($product,'price_for_you',$fieldClass = 'col-md-12')!!} --}}
                            {{--CoralsForm::text('price_for_you','price for you',false,null,['id'=>'result1','readonly','left_addon'=>'<i class="'.$sku->currency_icon.'"></i>'])--}}<br></br>
                            @if($product->slug)
                               <input type='hidden' name='code' value="{{ $sku->code}}">
                               @else 
                               <input type='hidden' name='code' value="test">
                               @endif
                          </div>
                    
                          <div class="col-md-6">
                            {!! CoralsForm::number('sale_price','Marketplace::attributes.product.sale_price',false,$product->exists? $sku->sale_price:null,['id'=>'sale_price','step'=>0.01,'min'=>0,'max'=>999999,'left_addon'=>'<i class="'.$sku->currency_icon.'"></i>']) !!}
                            {{--     {!! CoralsForm::customField($product,'saleprice_for_you',$fieldClass = 'col-md-12')!!}  --}}
                            {{--CoralsForm::text('saleprice_for_you','price for you',false,null,['id'=>'result2','readonly','left_addon'=>'<i class="'.$sku->currency_icon.'"></i>'])--}}<br></br>
                            {!! Form::hidden('allowed_quantity','1') !!}
                            {!! Form::hidden('inventory','finite') !!}
                            {{ Form::hidden('inventory_value',1)  }}
                           
                        
                            <div id="inventory_value_wrapper"></div>
                         </div>
                        </div>
                       {{--
                        <div id="variable_product_attributes" class="hidden">
                            {!! CoralsForm::select('variation_options[]','Marketplace::attributes.product.variation_options', \Marketplace::getAttributesList(),true,null,$product->admin_approved=='accepted'?[' readonly']:['multiple'=>true],$product->exists?'select':'select2') !!}
                        </div>
                             --}}
                             {{--   {!! CoralsForm::customField($product,'donation',$fieldClass = 'col-md-4')!!} --}}
                             {!! CoralsForm::customFields($product)!!}

                </div>
                    </div>
                    <a class="btn btn-primary btnPrevious" >@lang('Corals::labels.previous')</a>
                    </div>
                </div>
                           {!! \Actions::do_action('marketplace_product_form_post_fields', $product) !!}
                           <div class="row">
                            <div class="col-md-12">
                             {!! CoralsForm::formButtons() !!}
                           </div>
                          </div>
                           {!! CoralsForm::closeForm($product) !!}

                
            @endcomponent
        </div>
        @if($product->exists)
            <div class="col-md-5">
                @component('components.box')
                    @include('Marketplace::products.gallery',['product'=>$product,'editable'=>true])
                @endcomponent
            </div>
        @endif
    </div>
@endsection

@section('js')
    {!! \Html::script('assets/corals/plugins/nestable/select2totree.js') !!}
    <script type="application/javascript">
     var mainCategory; 
        $(document).ready(function () {
            $('input[name="external"]').on('change', function () {
                if ($(this).prop('checked')) {
                    $('#external_link').fadeIn();
                } else {
                    $('#external_link').fadeOut();
                }
            });
    //added hana
            var adminApproved = <?php echo json_encode($adminApproved); ?>;
            //if (adminApproved =='accepted'){
            $('#material').prop('disabled', true);
            $('#colour').prop('disabled', true);
            $('#shoes_size_women').prop('disabled', true);
            $('#shoes_size_men').prop('disabled', true);
            $('#shoes_size_kids').prop('disabled', true);
            $('#cloth_size_international_value').prop('disabled', true);
            $('#other_brand').prop('disabled', true);
            $('#printed').prop('disabled', true);
            $('#width').prop('disabled', true);
            $('#height').prop('disabled', true);
            $('#depth').prop('disabled', true);
            $('#condition').prop('disabled', true);
            $('#donation').prop('disabled', true);
            
           // }
       // else{
            $('#material').prop('disabled', false);
            $('#colour').prop('disabled', false);
            $('#shoes_size_women').prop('disabled', false);
            $('#shoes_size_men').prop('disabled', false);
            $('#shoes_size_kids').prop('disabled', false);
            $('#cloth_size_international_value').prop('disabled', false);
            $('#other_brand').prop('disabled', false);
            $('#printed').prop('disabled', false);
            $('#width').prop('disabled', false);
            $('#height').prop('disabled', false);
            $('#depth').prop('disabled', false);
            $('#condition').prop('disabled', false);
            $('#donation').prop('disabled', false);

          //  }
              //end 
  //added by wafa
            $('.btnNext').click(function(){
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
            });
            $('.btnPrevious').click(function(){
            $('.nav-tabs > .active').prev('li').find('a').trigger('click');
            });

           $('select[name="brand_id"]').on('change', function (e) {
              var brandname =this.options[this.selectedIndex].text; 
               if(brandname === "Other"){
                 $('#other_brand').removeClass('hidden');
               }else{
                $('#other_brand').addClass('hidden');
                  }
            });
           
            // regular_price
            $('input[name="regular_price"]').blur(  function(){
                 var main = $('#regular_price').val();
                 var com = main - (main*0.25);
                 $('#result1').val(com);
             });
            //end
            // sale_price
            $('input[name="sale_price"]').blur(  function(){
                 var main = $('#sale_price').val();
                 var com = main - (main*0.25);
                 $('#result2').val(com);
             });
            //end
          
            $('select[name="categories[]"]').on('change', function (e) {
                var data = $('#baseCategories').select2('data');
                var data2 = $('#mainCategory').select2('data');
                
                var i;
                var baseCategories = <?php echo json_encode($baseCategories); ?>;
                var catArray = <?php echo json_encode($catArray); ?>;
                var categories_parent =  <?php echo json_encode($categories_parent); ?>;
                console.log(categories_parent);
                
                    if(data2.length>0){
                    if( data2[0]['text']=='Men'|| data2[0]['text']=='Women' || data2[0]['text']=='Kids' ){
                        mainCategory = data2[0]['text'];  
                       console.log(mainCategory);
                    }
            }
                console.log(data2)
                for (i = 0; i < data.length; i++) { 
                    if( data[i]['text']=='Men'|| data[i]['text']=='Women' || data[i]['text']=='Kids' ){
                        mainCategory = data[i]['text'];
                        console.log(mainCategory);
                    }
                    var category_id = data[i]['id'];
                    var parent_id = categories_parent[category_id];
                    if( data[i]['text']=='Bag' || (typeof parent_id !== typeof undefined && parent_id == baseCategories['Bag'])){
                        console.log(parent_id);
                         $('#shoes_size_women').addClass('hidden');
                        $('#shoes_size_men').addClass('hidden');
                        $('#shoes_size_kids').addClass('hidden');
                        $('#cloth_size_international_value').addClass('hidden');
                        $('#bag_size').removeClass('hidden');

                        
                    }else if(data[i]['text']=='Shoes' || (typeof parent_id !== typeof undefined && parent_id == baseCategories['Shoes'] )){
                      console.log(data[i]['text']);
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

                    }else if(data[i]['text']=='Clothing' || (typeof parent_id !== typeof undefined && parent_id == baseCategories['Clothing'])){

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
   
                });


            $('input[name="price_per_classification"]').on('change', function () {
                if ($(this).prop('checked')) {
                    $('#classification_price_section').fadeIn();
                } else {
                    $('#classification_price_section').fadeOut();
                }
            });

            $('input[name="shipping[enabled]"]').on('change', function () {
                if ($(this).prop('checked')) {
                    $('#shipping').fadeIn();
                } else {
                    $('#shipping').fadeOut();
                }
            });
            $('select[name="type"]').on('change', function () {
                $product_type = $(this).val();
                if ($product_type === "simple") {
                    $('#simple_product_attributes').removeClass('hidden');
                    $('#variable_product_attributes').addClass('hidden');
                   
                } else if ($product_type === "variable") {
                    $('#simple_product_attributes').addClass('hidden');
                    $('#variable_product_attributes').removeClass('hidden');
                } else {
                    $('#simple_product_attributes').addClass('hidden');
                    $('#variable_product_attributes').addClass('hidden');
                }
            });

            

        function togglePremuimContent() {
            var input = $('#private_content_pages');
            if (input.prop('checked')) {
                $('#product_pages').fadeIn();
            } else {
                $('#product_pages').fadeOut();
            }
        }

        function toggleExternalURL() {
            var input = $('#external');
            if (input.prop('checked')) {
                $('#external_section').fadeIn();
            } else {
                $('#external_section').fadeOut();
            }
        }

        

            

            
           
    })

    </script>
@endsection