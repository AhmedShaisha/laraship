<style type="text/css">

    .downloads-section .form-group {
        margin-bottom: 0;
    }
</style>

<div id="downloads">
    <div class="downloads-section {{ $class = \Str::random().'_downloads' }}">
        <div class="form-group">
            <span data-name="downloads"></span>
        </div>
        <div id="clearedDownload">
        </div>
        <div class="table-responsive">
            <table id="downloads-table" width="100%"
                   class="table color-table info-table table table-hover table-striped table-condensed">
                <thead>
                <tr>
                    <th width="30%">@lang('Marketplace::labels.product.file')</th>
                    <th width="70%">@lang('Marketplace::labels.product.description')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($model->downloads??[] as $download)
                    <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">
                        <td>
                            <a href="{{ url('suport/ticket/files/'.$download['hashed_id']) }}"
                               target="_blank">{{ $download['name'] }}</a>
                        </td>
                        <td>
                            {{ $download['description'] }}
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-download" style="margin:0;"
                                    data-download_id="{{ $download['hashed_id'] }}"
                                    data-index="{{ $loop->index }}"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-success btn-sm" id="add-new-download">
            <i class="fa fa-plus"></i>
        </button>
        <span class="help-block">@lang('Marketplace::labels.product.add_download')</span>
    </div>
</div>




<script type="text/javascript">
    downloads_init = function () {
        if ($(".{{ $class }} #downloads-table").length > 0) {
            $(document).on('click', '.{{ $class }} #add-new-download', function () {
                var index = $('.{{ $class }} #downloads-table tr:last').data('index');
                if (isNaN(index)) {
                    index = 0;
                } else {
                    index++;
                }
                $('.{{ $class }} #downloads-table tr:last').after('<tr id="tr_' + index + '" data-index="' + index + '"><td><div class="form-group upload-file-area" data-input="file_' + index + '">' +
                    ' <input name="downloads[' + index + '][file]" type="file"' +
                    'id="file_' + index + '" class="form-control"/></span><span class="file-name"></span></div></td><td><div class="form-group">' +
                    '<input name="downloads[' + index + '][description]" type="text"' +
                    'value="" class="form-control"/></div></td>' +
                    '<td><div class="form-group"><button type="button" class="btn btn-danger btn-sm remove-download" style="margin:0;" data-index="' + index + '">'
                    + '<i class="fa fa-remove"></i></button></div></td>' +
                    '</tr>');
            });

            $(document).on('click', '.remove-download', function () {
                var index = $(this).data('index');

                var downloadId = $(this).data('download_id');

                $("#clearedDownload").append('<input type="hidden" name="cleared_downloads[]" value=' + downloadId + ' />');

                $("#tr_" + index).remove();
            });
        }
    };

    window.initFunctions.push('downloads_init');
</script>