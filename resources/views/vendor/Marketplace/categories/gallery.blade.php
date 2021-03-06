<div id="gallery">
    @if($editable)
        {!! \Html::style('assets/corals/plugins/dropzone-4.3.0/dropzone.min.css') !!}
        {!! \Html::script('assets/corals/plugins/dropzone-4.3.0/dropzone.min.js') !!}
        <script>
            Dropzone.autoDiscover = false;
        </script>
    @endif
    <style type="text/css">
        .add-photo {
            padding: 0 !important;
            opacity: 0.1;
        }

        .add-photo:hover {
            opacity: 0.2;
        }

        .gallery-item {
            position: relative;
            @if($editable)
                             border: 1px solid #B1B1B1;
        @endif






        }

        .gallery-item, .gallery-item form {
            @if($editable)
                             height: 230px;
        @endif






        }

        .gallery-item img {
            max-height: 220px;
            width: auto;
        }

        .gallery-item form {
            width: 230px;
        }

        .dropzone .dz-message {
            margin: 3em 0;
        }

        .dz-message i {
            font-size: 8em;
            color: #000;
        }

        .dropzone {
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        .item-buttons {
            top: 190px;
            left: 5px;
            position: absolute;
            margin: 2px 2px;
        }

        .featured-item {
            position: absolute;
            top: 5px;
            left: 5px;
            color: #ff9122;
        }
    </style>
    <div class="row">
        @foreach($category->getMedia($category->galleryMediaCollection) as $media)
            <div class="col-md-6 brick gallery-item">
          
                <a href="{{ $media->getUrl() }}" data-lightbox="category-gallery">
                    <img src="{{ $media->getUrl() }}" class="img-responsive img-fluid" alt="category Gallery Image"/></a>
                @if($editable)
                    <div class="item-buttons" style="display: none;">
                        <a href="{{ url('marketplace/categories/'.$media->id.'/gallery/delete') }}"
                           class="btn btn-sm btn-danger item-button" title="Delete Gallery Item"
                           data-action="delete" data-page_action="reloadGallery">
                            <i class="fa fa-fw fa-remove"></i>
                        </a>
                     
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @if($editable)
        <div class="">
            <form action="{{ url($resource_url.'/'.$category->hashed_id.'/gallery/upload') }}" class="dropzone"
                  id="galleryDZ">
                {{ csrf_field() }}
            </form>
        </div>
        <script type="text/javascript">
            var galleryDZ = new Dropzone("#galleryDZ", {
                maxFilesize: 1, // MB
                acceptedFiles: 'image/*',
                dictDefaultMessage: '<i class="fa fa-plus fa-fw fa-5x add-photo"></i>',
                queuecomplete: function () {
                    reloadGallery();
                },
                error: function (file, response) {
                    var message;
                    if ($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                }
            });

            function reloadGallery() {
                setTimeout(function () {
                    $('#gallery').load("{{ url($resource_url.'/'.$category->hashed_id.'/gallery') }}");
                }, 500);
            }

            function initGalleryItemButtons() {
                $(document).on("mouseenter", ".gallery-item", function (e) {
                    $(this).find(".item-buttons").show();
                });

                $(document).on("mouseleave", ".gallery-item", function (e) {
                    $(this).find(".item-buttons").hide();
                });
            }

            window.onload = function () {
                initGalleryItemButtons();
            }
        </script>
    @endif
</div>