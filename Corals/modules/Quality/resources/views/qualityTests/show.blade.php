@extends('layouts.crud.show')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('quality_qualityTest_show') }}
        @endslot
    @endcomponent
@endsection

@section('css')
@endsection

@section('content')
    @component('components.box')
        <div class="row">
            <div class="col-md-8">
                <!-- show qualityTest details here -->
                @component('components.box')
                @slot('box_title')
                    @lang('Quality::labels.qualityTest_detail')
                @endslot
                <div class="table-responsive">
                    <table class="table color-table info-table table table-hover table-striped table-condensed">
                        <thead>
                        <tr>
                            <th>@lang('Quality::attributes.id')</th>
                            <th>@lang('Quality::attributes.product_name')</th>
                            <th>@lang('Corals::attributes.status')</th>
                            <th>@lang('Quality::attributes.responsible')</th>
                            <th>@lang('Quality::attributes.note')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $qualityTest->id }}</td>
                            <td>{!! $qualityTest->present('product_id')!!}</td>
                            <td>{!! $qualityTest->present('status') !!}</td>
                            <td>{!! $qualityTest->present('user_id') !!}</td>
                            <td>{!! $qualityTest->present('note') !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endcomponent

    @if($qualityTest->shipping)
    <div class="row mt-2">
        <div class="col-md-8">
            @component('components.box')
                @slot('box_title')
                    @lang('Marketplace::labels.order.shipping_details')
                @endslot
                <div class="table-responsive">
                    <table class="table color-table info-table table table-hover table-striped table-condensed">

                        <tbody>
                        @isset($qualityTest->shipping['address'])
                            <tr>
                                <th>@lang('Quality::attributes.shipping_address')</th>
                                <td>{{ $qualityTest->shipping['address'] ?? '-' }}</td>
                            </tr>
                            
                        @endisset
                        @if(isset($qualityTest->shipping['status'])&& !empty($qualityTest->shipping['status']))
                                <th>@lang('Quality::attributes.shipping_status')</th>
                                <td>{{ $qualityTest->shipping['status'] ?? '-' }}</td>
                            </tr>
                            
                        @endif
                        @if(isset($qualityTest->shipping['tracking_number']) && !empty($qualityTest->shipping['tracking_number']))
                            <tr>
                                <th>@lang('Marketplace::labels.order.tracking_num')</th>
                                <td>
                                    <a href="{{url($resource_url.'/'.$qualityTest->hashed_id.'/track')}}"
                                       class="btn btn-xs btn-primary m-r-5 m-l-5 modal-load"
                                       data-title="Tracking History">{{ $qualityTest->shipping['tracking_number'] }}</a>
                                </td>
                            </tr>
                        @endif
                        @if(isset($qualityTest->shipping['label_url']) && !empty($qualityTest->shipping['label_url']))
                            <tr>
                                <th>@lang('Marketplace::labels.order.tracking_label')</th>
                                <td>
                                    <a target="_blank"
                                       href="{{ $qualityTest->shipping['label_url'] }}">
                                        @lang('Marketplace::labels.order.click_here')
                                    </a>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            @endcomponent
        </div>
    </div>
@endif
@endsection

