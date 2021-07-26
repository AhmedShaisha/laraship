@extends('layouts.crud.create_edit')

@section('css')
    {!! \Html::style('assets/corals/plugins/nestable/select2totree.css') !!}
 <style>
/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
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
 {{--   @parent --}} 
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
          
            {!! CoralsForm::openForm($product) !!}
          
          <!--  <ul class="nav nav-tabs">
                    <li class="nav-item active"><a   class="nav-link active" data-toggle="tab" href="#step1">@lang('Marketplace::labels.product.abstract')</a></li>
                    <li class="nav-item"><a  class="nav-link" data-toggle="tab" href="#step2">@lang('Marketplace::labels.product.information')</a></li>
                    <li class="nav-item"><a  class="nav-link" data-toggle="tab" href="#step3">@lang('Marketplace::labels.product.file_and_photos')</a></li>
                    <li class="nav-item"><a  class="nav-link" data-toggle="tab" href="#step4">@lang('Marketplace::labels.product.condition_and_price')</a></li>
                    <li class="nav-item"><a  class="nav-link" data-toggle="tab" href="#gallery-tab">@lang('Marketplace::labels.product.photo')</a></li>
                  </ul>-->

                <div class="tab"> Main Info:

                    <div class="row"> <!--  for  storeAdmin -->
                          <div class="col-md-6">
                            {!! \Store::getStoreFields($product) !!}
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
                               <!--check it-->
                                {!! CoralsForm::select('tags[]','Marketplace::attributes.product.tags', \Marketplace::getTagsList(),false,null,['class'=>'tags','multiple'=>true], 'select2') !!}
                            </div>
                        </div>
                    @endif


                    <div class="row">
                        <div class="col-md-6" >
                            {!! CoralsForm::radio('status','Corals::attributes.status',true, trans('Corals::attributes.status_options')) !!}
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
 
                     </div>
              <div class="tab"> categories:
                
                     <div class="row">
                        <div class="col-md-6">
                      
                        {!! CoralsForm::select('categories[]','Marketplace::attributes.product.categories',\Marketplace::getCategoriesList($product->exists?$product->categories()->pluck('id')->toArray():[],[],$mainCategories) , true, null,$product->admin_approved=='accepted'?['readonly']:['multiple'=>false,'id'=>'mainCategory'], 'select2-tree') !!}
                        </div>
                     </div>

                     <div class="row">
                      <div class="col-md-6" >
                      @php
                      $catArray= \Marketplace::getCategoriesList($product->exists?$product->categories()->pluck('id')->toArray():[],$mainCategories);
                        @endphp
                          {!! CoralsForm::select('categories[]','Marketplace::attributes.product.product_type',$catArray , true, null,$product->admin_approved=='accepted'?['readonly']:['multiple'=>false,'id'=>'baseCategories'], 'select2-tree') !!}                       
                      </div>
                    </div> 

                     <div class="row">
                        <div class="col-md-6" >
                              {!! CoralsForm::select('brand_id','Marketplace::attributes.product.brand', \Marketplace::getBrandsList(),false,null,$product->admin_approved=='accepted'?['readonly']:['id'=>'brand_id'],$product->exists?'select':'select2') !!}
                        </div>
                    </div>

               </div>
                <div class="tab"> specifications:
                    <div class="row">
                        <div class="col-md-6">
                          {!! \Marketplace::getAttributeByKey('Material', $product->exists ? $sku : null )!!} 
                          </div>
                   </div> 

                  <div class="row">
                       <div class="col-md-6">
                        {!! \Marketplace::getAttributeByKey('Printed', $product->exists ? $sku : null )!!} 
                        </div>
                    </div> 


                      <div class="row hidden"  id="bag_size">
                        <div class="col-md-6">
                        {!! \Marketplace::getAttributeByKey('Width', $product->exists ? $sku : null )!!} 
                        {!! \Marketplace::getAttributeByKey('Height', $product->exists ? $sku : null )!!} 
                        {!! \Marketplace::getAttributeByKey('Depth', $product->exists ? $sku : null )!!} 
                        </div> 
                      </div>  
                  
              


                  <div class="row">
                        <div class="col-md-6">
                        {!! \Marketplace::getAttributeByKey('Colour', $product->exists ? $sku : null )!!} 
                      </div> 
                    </div> 


                   
                  <div class="row hidden"  id="cloth_size_international_value" >
                    <div class="col-md-6">
                    {!! \Marketplace::getAttributeByKey('cloth Size International', $product->exists ? $sku : null )!!} 
                    </div>
                  </div>
                    
                  
                <div class="row hidden" id="shoes_size_women" >
                  <div class="col-md-6">
                  {!! \Marketplace::getAttributeByKey('Shoes Size Women', $product->exists ? $sku : null )!!} 
                  </div> 
                </div> 
                   
               
                <div class="row hidden" id="shoes_size_men" >
                  <div class="col-md-6">
                  {!! \Marketplace::getAttributeByKey('Shoes Size Men', $product->exists ? $sku : null )!!} 
                  </div> 
                </div> 

               
                <div class="row hidden" id="shoes_size_kids" >
                  <div class="col-md-6">
                  {!! \Marketplace::getAttributeByKey('Shoes Size Kids', $product->exists ? $sku : null )!!} 
                  </div> 
                </div> 

          </div>
          <div class="tab"> original:
                <div class="row">
                  <div class="col-md-6">
                  {!! \Marketplace::getAttributeByKey('place of purchase', $product->exists ? $sku : null,['class'=>'form-check'] )!!} 
                  </div>
              </div>
            <!--check it-->
              <div id="shipping"
                             style="{{ $product->exists ? (!$product->shipping['enabled']?'display:none':'') : 'display:none' }}">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! CoralsForm::radio('shipping[shipping_option]','Marketplace::attributes.product.shipping_option', true, trans('Marketplace::labels.package.product_shipping_options'), data_get($product->shipping,'shipping_option', 'calculate_rates')) !!}
                                </div>
                            </div>
                            <div id="calculate_rates" class="shipping-options"
                                 style="{{ data_get($product->shipping,'shipping_option', 'calculate_rates') ==='calculate_rates'?'':'display:none' }}">
                                <div class="row">
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
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! CoralsForm::select('shipping[package_id]', 'Marketplace::attributes.product.package', \ShippingPackages::getAvailablePackages(), false, null, ['id'=>'package_id'],'select2') !!}
                                    </div>
                                </div>
                            </div>
                            <div id="flat_rate_prices" class="shipping-options"
                                 style="{{ data_get($product->shipping,'shipping_option') ==='flat_rate_prices'?'':'display:none' }}">
                                @include('Marketplace::shippings.partials.flat_rate_prices', compact('product'))
                            </div>
                            <hr/>
                        </div>
                      <!-- check it -->
                     <div class="row">
                        <div class="col-md-12">
                        {{--add --}}
                         {!! CoralsForm::label('proofOrigin','Marketplace::labels.product.proof_of_origin', false ) !!}
                        {{--add --}}
                        <span class="not-required">@lang('Marketplace::labels.product.optional')</span>
                        <br>
                        <span class="in3">@lang('Marketplace::labels.product.certificate')</span>
                        <p>@lang('Marketplace::labels.product.infoDownload')</p>
                        
                            @include('Marketplace::products.partials.downloadable', ['model' => $product])
                        </div>
                    </div>


              
          </div>

          <div class="tab"> condition and price:
                    <div class="row">
                         <div class="col-md-12">
                         {!! \Marketplace::getAttributeByKey('condition', $product->exists ? $sku : null, ['inline'])!!} 
                         </div>
                        </div>


                        @php
                        $id =\Marketplace::getAttributeID('order authentication'); 
                      @endphp
                      {!! Form::hidden('global_options[id]',"$id") !!}
                       

                              {!! Form::hidden('type','simple') !!}
                              @if($product->slug)
                               <input type='hidden' name='code' value="{{ $sku->code}}">
                               @else 
                               <input type='hidden' name='code' value="test">
                               @endif

                          <div class="row">
                             <div class="col-md-6">
                               {!! CoralsForm::number('regular_price','Marketplace::attributes.product.regular_price',true,$product->exists? $sku->regular_price:null,['id'=>'regular_price','step'=>0.01,'min'=>0,'max'=>999999,'left_addon'=>'<i class="'.$sku->currency_icon.'"></i>']) !!}
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                {!! \Marketplace::getAttributeByKey('Price For You', $product->exists ? $sku : null, ['id'=>'result1','left_addon'=>'<i class="'.$sku->currency_icon.'"></i>','readonly'] )!!} 
                                </div>
                            </div>
                          
                          <div class="row">
                            <div class="col-md-6">
                            {!! CoralsForm::number('sale_price','Marketplace::attributes.product.sale_price',false,$product->exists? $sku->sale_price:null,['id'=>'sale_price','step'=>0.01,'min'=>0,'max'=>999999,'left_addon'=>'<i class="'.$sku->currency_icon.'"></i>']) !!}
                            {!! \Marketplace::getAttributeByKey('Sale Price For You', $product->exists ? $sku : null, ['id'=>'result2','left_addon'=>'<i class="'.$sku->currency_icon.'"></i>','readonly'] )!!} 
                            </div>
                        </div>
                              
                             <!--check it -->
                             <div id="inventory_value_wrapper"></div>
                             
                            {!! Form::hidden('allowed_quantity','1') !!}
                            {!! Form::hidden('inventory','finite') !!}
                            {{ Form::hidden('inventory_value',1)  }}  


                        <div class="row">
                             <div class="col-md-6">
                             {!! \Marketplace::getAttributeByKey('Donation', $product->exists ? $sku : null )!!}
                             </div> 
                        </div>
                        {!! \Actions::do_action('marketplace_product_form_post_fields', $product) !!}
                        {!! CoralsForm::customFields($product)!!}
                        <div class="row">
                            <div class="col-md-12">
                             {!! CoralsForm::formButtons() !!}
                           </div>
                          </div>

                        
                           {!! CoralsForm::closeForm($product) !!}  

                </div>
                
                <div class="tab"> gallery:
                    <div class="row">
                      <div class="col-md-12">
                          <div id="gallery-photo"></div>
                        
                      </div>
                    </div>
                </div>
              



    <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>



  @endcomponent                      
                            
            @endsection
            </div>
            
    </div>
@section('js')
    {!! \Html::script('assets/corals/plugins/nestable/select2totree.js') !!}
    <script type="application/javascript">
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
     var mainCategory; 
     var currentTab = 0; 
        $(document).ready(function () {
     
 currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
       
       
       //added hana check it
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
 

   
           
            // regular_price
            $('input[name="regular_price"]').blur(  function(){
                 var main = $('#regular_price').val();
                 var com = main - (main*0.25);
                 $('#result1').val(com);
             });
            //end
            // sale_price //check it make it dynamic commition
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
                //photo
                $('select[id="baseCategories"]').on('change', function (e) {
                var cat_id = e.target.value;
             //   alert(cat_id);
                $.ajax({
                       url:"{{ route('catphotos') }}",
                       type:"GET",
                       data: {
                           cat_id: cat_id
                        },
              success:function (data) {
                console.log("data",data);
               $('#gallery-photo').empty();
               
               $.each(data.images, function(i, image) {
               $('#gallery-photo').append(
                '<div class="row" ><div class="col-md-12"><div class="col-md-6">'+
                        '<div class="panel panel-default"><div class="panel-body" >'+
                        ' <img src="'+image.url+'" class="img-responsive img-fluid" alt="category Gallery Image"/></div>'+
                        ' <div  class="panel-footer text-center font-weight-bold"><snap class="text-muted">'+image.name+'</snap></div></div></div>'+
                        '<div class="col-md-6"><div class="panel panel-default"><div class="panel-body">'+
                        '<div class="image-upload"><label for="image-input"> <i class="fa fa-plus fa-fw fa-5x add-photo"></i></label>'+
                        '<input type="file"  id="image-input" style="display: none"/></div> </div>'+
                        '<div  class="panel-footer text-center font-weight-bold"><snap class="text-muted">'+image.name+'o</snap></div></dive></div>'+
                        '</div></div>'

               );//end append
            });
       
              }
            }); //end ajax
                
                           });
               

//
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
function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  return true;
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
      
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}



            

            
           
   


 </script>
@endsection