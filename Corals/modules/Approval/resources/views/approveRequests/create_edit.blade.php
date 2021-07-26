@extends('layouts.crud.create_edit')



@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('approval_approveRequest_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! CoralsForm::openForm($approveRequest) !!}
                <div class="row">
                    <!-- place approveRequest fields here-->
                    <div class="col-md-8">
                        {!! CoralsForm::textarea('note','Approval::attributes.note',false,$approveRequest->note,['help_text'=>'']) !!}
                        {!! CoralsForm::radio('status','Corals::attributes.status',true, trans('Approval::attributes.status_options')) !!} 
                    </div>
                </div>

                {!! CoralsForm::customFields($approveRequest) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! CoralsForm::formButtons() !!}
                    </div>
                </div>
                {!! CoralsForm::closeForm($approveRequest) !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection
