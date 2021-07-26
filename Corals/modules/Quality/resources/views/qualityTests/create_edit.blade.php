@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('quality_qualityTest_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
                @slot('box_title')
                    @lang('Quality::attributes.qualityTest_details')
                @endslot
                {!! CoralsForm::openForm($qualityTest) !!}

                <div class="row">
                    <!-- place qualityTest fields here-->
                    <div class="col-md-12">
                        {!! CoralsForm::textarea('note', 'Quality::attributes.note', false, $qualityTest->note, ['help_text' => '']) !!}

                        @if (user()->hasRole(['qualitymanager', 'superuser']))
                            {!! CoralsForm::select('user_id', 'Quality::attributes.responsible', \Quality::getusersList()->pluck('full_name', 'id'), false, null, [], 'select2') !!}

                        @endif
                        {!! CoralsForm::radio('status', 'Corals::attributes.status', true, trans('Quality::attributes.status_options')) !!}

                        <div class="hidden" id="file">
                            {!! CoralsForm::file('file', 'Marketplace::labels.product.file', false, ['help_text' => 'Quality::attributes.uploadFile_help']) !!}
                        </div>


                        <div class="hidden" id="discount_percentage">
                            {!! CoralsForm::number('discount_percentage', 'Quality::attributes.discount_percentage', false, $qualityTest->discount_percentage, ['step' => 0.01, 'min' => 0, 'max' => 999999, 'left_addon' => '<i class="fa fa-dollar"></i>']) !!}
                        </div>
                        <b>@lang('Marketplace::labels.product.file') : </b>
                        @foreach ($files as $file)
                            <a href="{{ $file->getUrl() }}" target="_blank">{{ $file['name'] }}</a>
                        @endforeach

                    </div>

                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>@lang('Quality::attributes.shipping_details')</h3>
                    </div>


                    <div class="panel-body">



                        <div class="row">
                            <div class="col-md-6">
                                {!! CoralsForm::select('shipping[status]', 'Quality::attributes.shipping_status', trans('Quality::attributes.shipping_options'), false, $qualityTest->shipping['status'] ?? '', ['help_text' => '']) !!}
                                {!! Form::hidden('shipping[tracking_number]', $qualityTest->shipping['tracking_number'] ?? '') !!}
                                {!! Form::hidden('shipping[label_url]', $qualityTest->shipping['label_url'] ?? '') !!}
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <b>@lang('Marketplace::attributes.order.shipping_track') : </b>
                                {{ $qualityTest->shipping['tracking_number'] ?? '' }}<br>
                                <b>@lang('Marketplace::attributes.order.shipping_label') : </b>
                                {{ $qualityTest->shipping['label_url'] ?? '' }}<br>

                            </div>
                        </div>
                    </div>
                </div>
            @endcomponent
            <div class="row">
                <div class="col-md-12">
                    {!! CoralsForm::formButtons() !!}
                </div>
            </div>
            {!! CoralsForm::customFields($qualityTest) !!}
            {!! CoralsForm::closeForm($qualityTest) !!}
        </div>
    </div>




@endsection

@section('js')
    <script type="application/javascript">
        $(document).ready(function() {

            $("input[type='radio']").on('change', function() {

                var status = $(this).val();

                if (status == 'accepted') {
                    $('#file').removeClass('hidden');
                    $('#discount_percentage').addClass('hidden');

                } else if (status == 'review') {
                    $('#discount_percentage').removeClass('hidden');
                    $('#file').addClass('hidden');
                } else {
                    $('#file').addClass('hidden');
                    $('#discount_percentage').addClass('hidden');

                }
            });


        });

    </script>
@endsection
