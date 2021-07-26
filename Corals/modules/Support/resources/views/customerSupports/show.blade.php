@extends('layouts.crud.show')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}  <small class="text-muted">asked {{$customerSupport->created_at->diffForHumans()}}</small>        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('support_customerSupport_show') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @component('components.box')
   
        <div class="row">
            <div class="col-md-10">
                <!-- show customerSupport details here -->
                <div class="table-responsive">
                    <table class="table color-table info-table table table-hover table-striped table-condensed">
                        <tbody>
                        <tr>
                            <td width="100">@lang('Support::attributes.title')</td>
                            <td>{!! $customerSupport->present('title') !!}</td>
                        </tr>
                        
                        <tr>
                            <td>@lang('Support::attributes.email')</td>
                            <td>{{ $customerSupport->email }}</td>
                        </tr>
                        
                        <tr>
                            <td>@lang('Support::attributes.phone_number')</td>
                            <td><b>{!! $customerSupport->present('phone_number')  !!}</b></td>
                        </tr>
                        <tr>
                            <td>@lang('Support::attributes.description')</td>
                            <td>{!! $customerSupport->description !!}</td>
                        </tr>
   
                        <tr>
                            <td>   {!! CoralsForm::openForm($customerSupport) !!}
                        {!! CoralsForm::select('status',null, trans('Support::attributes.status_options'),false,null,[], 'select2') !!} 
                        </td>
                            <td>   {!! CoralsForm::formButtons(trans('Corals::labels.send',['title' =>'Corals::labels.send']), [], ['show_cancel' => false])  !!}       {!! CoralsForm::closeForm($customerSupport) !!}</td>
                        </tr>
               
        
                        </tbody>
                    </table>

                    </div>
            </div>
        </div>
        
               

  
    <div class="raw">
    <div class="col-md-12">
    @include('Support::customerSupports.partials.downloadable', ['model' => $customerSupport])
        </div> 
        <div class="col-md-12">
        @include('Support::customerSupports.showResponse',['customerSupport'=>$customerSupport])
        </div> 
        </div> 
        <div class="raw">
        <div class="col-md-12">
                
                    @include('Support::responses.create_edit',['customerSupport'=>$customerSupport,'response'=>$response])



                </div> 
        </div> 

        @endcomponent
    @endsection