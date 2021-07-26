<div class="modal-content" id="content">
    <div class="modal-header">
        <h4 class="modal-title">{{ $order_item->description }}</h4>
    </div>
    <div class="modal-body">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">@lang('Marketplace::labels.product.information')</a>
            </li>
            <li><a data-toggle="tab" href="#menu1">@lang('Quality::attributes.shipping')</a></li>
        </ul>


        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <br>

                <div class="row">
                    <div class="col-md-12">
                        <b>@lang('Quality::attributes.note')</b>
                        <p>{{ $qualityTest->note }}</p>

                    </div>
                </div>

                <div id="review" class="hidden">
                    {!! CoralsForm::openForm($order_item, ['url' => url($resource_url . '/' . $order_item->hashed_id . '/update_qualityTest_status'), 'method' => 'PUT', 'class' => 'ajax-form', 'data-page_action' => 'closeModal', 'data-table' => '.dataTableBuilder']) !!}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <p> <b>@lang('Quality::labels.discount_percentage') : </b>
                                {{ $qualityTest->discount_percentage }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            {{-- <div  class="custom-control custom-radio">
    <label class="custom-control-label" for="agree"><input type="radio" name="submitbutton" value="agree" class="custom-control-input" id="agree" required>@lang('Quality::attributes.agree')</label>
  </div>
  <div class="custom-control custom-radio" >
    <label class="custom-control-label" for="disagree"><input type="radio" name="submitbutton" value="disagree"  class="custom-control-input" id="disagree" required>@lang('Quality::attributes.disagree')</label>
  </div> --}}
                            {!! CoralsForm::radio('response[seller]', 'Quality::labels.response', true, trans('Quality::attributes.response_options')) !!}
                            {!! CoralsForm::formButtons(trans('Corals::labels.send', ['title' => 'Corals::labels.send']), [], ['show_cancel' => false]) !!}
                        </div>
                    </div>
                    {!! CoralsForm::closeForm($order_item) !!}
                </div>

                <div class="hidden" id="pending">
                    {!! CoralsForm::openForm($qualityTest, ['url' => url(config('quality.models.qualityTest.resource_url') . '/' . $qualityTest->hashed_id . '/shipping_update'), 'method' => 'PUT', 'class' => 'ajax-form', 'data-page_action' => 'closeModal', 'data-table' => '.dataTableBuilder']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <p>@lang('Quality::attributes.pending')</p>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            {!! CoralsForm::text('shipping[tracking_number]', 'Marketplace::attributes.order.shipping_track', true, $qualityTest->shipping['tracking_number'] ?? '', ['class' => '']) !!}
                            {!! CoralsForm::text('shipping[label_url]', 'Marketplace::attributes.order.shipping_label', false, $qualityTest->shipping['label_url'] ?? '', ['class' => '']) !!}

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {!! CoralsForm::formButtons(trans('Quality::labels.save', ['title' => 'Quality::labels.save']), [], ['show_cancel' => false]) !!}
                        </div>
                    </div>
                    {!! CoralsForm::closeForm($qualityTest) !!}
                </div>

                <div class="hidden" id="accepted">
                    <b>@lang('Quality::attributes.accepted')</b><br>
                </div>

                <div class="hidden" id="rejected">
                    <b>@lang('Quality::attributes.rejected')</b><br>
                </div>

                <div class="hidden" id="message">
                    <b>@lang('Quality::attributes.message')</b><br>
                </div>

            </div>

            <div id="menu1" class="tab-pane fade in active">
                <br>
                <b>@lang('Quality::attributes.shipping_status') : </b> {{ $qualityTest->shipping['status'] ?? '' }}<br>
                <b>@lang('Quality::attributes.shipping_address') : </b>
                {{ $qualityTest->shipping['address'] ?? '' }}<br>
                <b>@lang('Marketplace::attributes.order.shipping_track') : </b>
                {{ $qualityTest->shipping['tracking_number'] ?? '' }}<br>
                <b>@lang('Marketplace::attributes.order.shipping_label') : </b>
                {{ $qualityTest->shipping['label_url'] ?? '' }}<br>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        $(document).ready(function(e) {

            var status = <?php echo json_encode($qualityTest - > status); ?>;            var response = <?php echo json_encode($qualityTest - > response['seller'] ??
            ''); ?>;
            if (status == 'review' && response.length == 0) {
                $('#review').removeClass('hidden');
                $('#pending').addClass('hidden');
                $('#accepted').addClass('hidden');
                $('#rejected').addClass('hidden');
                $('#message').addClass('hidden');
            } else if (status == 'accepted') {
                $('#accepted').removeClass('hidden');
                $('#pending').addClass('hidden');
                $('#review').addClass('hidden');
                $('#rejected').addClass('hidden');
                $('#message').addClass('hidden');
            } else if (status == 'pending') {
                $('#pending').removeClass('hidden');
                $('#accepted').addClass('hidden');
                $('#review').addClass('hidden');
                $('#rejected').addClass('hidden');
                $('#message').addClass('hidden');
            } else if (status == 'rejected') {
                $('#rejected').removeClass('hidden');
                $('#accepted').addClass('hidden');
                $('#review').addClass('hidden');
                $('#pending').addClass('hidden');
                $('#message').addClass('hidden');
            } else if (status == 'review' && response.length != 0) {
                $('#rejected').addClass('hidden');
                $('#accepted').addClass('hidden');
                $('#review').addClass('hidden');
                $('#pending').addClass('hidden');
                $('#message').removeClass('hidden');

            }



        });

    </script>
