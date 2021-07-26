@section('css')
@endsection
@extends('layouts.crud.show')

@section('content')
    <div class="modal-content" id="content">
        <div class="modal-body">

            <div>
                <h4 class="modal-title">{{ $order_item->description }}</h4>
            </div>


            <div id="review" class="hidden">
                {!! CoralsForm::openForm($order_item, ['url' => url($resource_url . '/' . $order_item->hashed_id . '/update_BuyerFormAgreement'), 'method' => 'PUT', 'data-page_action' => 'closeModal', 'data-table' => '.dataTableBuilder']) !!}
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-12">

                        {!! CoralsForm::radio('response[buyer]', 'Quality::labels.response', true, trans('Quality::attributes.response_options')) !!}
                        {!! CoralsForm::formButtons(trans('Corals::labels.send', ['title' => 'Corals::labels.send']), [], ['show_cancel' => false]) !!}
                    </div>
                </div>
                {!! CoralsForm::closeForm($order_item) !!}
            </div>
            <div class="hidden" id="message">
                <b>@lang('Quality::attributes.message')</b><br>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="application/javascript">
        $(document).ready(function(e) {

            var response = <?php echo json_encode($order_item - > qualityTest - > response[
                'buyer'] ?? ''); ?>;
            if (response.length == 0) {
                $('#review').removeClass('hidden');
                $('#message').addClass('hidden');
            } else if (response.length != 0) {
                $('#review').addClass('hidden');
                $('#message').removeClass('hidden');
            }
        });

    </script>
@endsection
