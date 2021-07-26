@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('support_customerSupport_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! CoralsForm::openForm($customerSupport) !!}
                <div class="row">
                <div class="col-md-4">
                        {!! CoralsForm::text('title','Support::attributes.title',true) !!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        {!! CoralsForm::textarea('description','Support::attributes.description',false,$customerSupport->description,['rows'=>4]) !!}
                    </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md-6">
                    {!! CoralsForm::email('email', 'Support::attributes.email', true) !!}
                    @if(isset($order_id))
                   {!! Form::hidden('order_id', $order_id) !!} 
                    @endif
                   
                    {!! CoralsForm::text('phone_number', 'Support::attributes.phone_number' ,false,null,['id'=>'authy-cellphone']) !!}
                       
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    
                    {{--  {!! CoralsForm::radio('customer_type','Support::attributes.are_you',true, trans('Support::attributes.customer_type_options')) !!} --}}
                   
                       
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    
                    {!! CoralsForm::select('status','Corals::attributes.status', trans('Support::attributes.status_options'),false,null,[], 'select2') !!} 
                   
                       
                    </div>
                    </div>

                    
                  {!! CoralsForm::select('user_id','Support::attributes.responsible', \Support::getusersList()->pluck('full_name'),false,null,[], 'select2') !!}
            
                {!! CoralsForm::customFields($customerSupport) !!}

                <div class="row">
                    <div class="col-md-12">
                    @include('Support::customerSupports.partials.downloadable', ['model' => $customerSupport])
                        </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        {!! CoralsForm::formButtons() !!}
                    </div>
                </div>
                {!! CoralsForm::closeForm($customerSupport) !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection