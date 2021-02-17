@isset($model->item_product_id)
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-body line">
            <div class="form-horizontal form-group">
                <div class="col-md-12 col-lg-12">
                    <label class="col-md-2 control-label" for="">Upload</label>
                    <div class="col-md-10">
                        <div class="form-group">
                            <form method="post" action="{{ route('dropzone', ['code' => request()->get('code')]) }}"
                                enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                {{ csrf_field() }}
                                <div class="dz-message">
                                    <div class="col-xs-12">
                                        <div class="message">
                                            <p>Drop files here or Click to Upload</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="fallback">
                                    <input type="file" name="file" multiple>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div id="dropimage" class="col-md-12 col-lg-12">
                    <label class="col-md-2 control-label" for="">Files</label>
                    @foreach ($image_detail as $item_image)
                    @isset($item_image)
                    <div id="{{ $loop->iteration }}" class="">
                        <a class="delete col-md-1" data="{{ $loop->iteration }}"
                            href="{{ route('item_product_delete_image', ['code' => $item_image->item_product_image_file]) }}">
                            <img class="img-fluid" src="{{ Helper::files('product_detail/'.'thumbnail_'.$item_image->item_product_image_file) }}">
                            <span>x</span>
                        </a>
                    </div>
                    @endisset
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</form>

@push('javascript')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<!--
<link rel="stylesheet" href="{{ Helper::backend('vendor/dropzone/dropzone.css') }}">
<script src="{{ Helper::backend('vendor/dropzone/dropzone.min.js') }}"></script> -->

<script type="text/javascript">
Dropzone.options.myDropzone = {
    uploadMultiple: true,
    parallelUploads: 5,
    maxFilesize: 8,
    dictFileTooBig: 'Image is larger than 16MB',
    timeout: 10000,
    success: function(file, done) {
        new PNotify({
            title: 'Notification Success',
            text: 'Success Upload',
            type: 'success'
        });

        setTimeout(function() {
            location.reload()
        }, 500);
    },
    error: function(){

        new PNotify({
            title: 'Notification Failed',
            text: 'Failed Upload',
            type: 'error'
        });

        $('.dz-preview').remove();
    }
};

$(document).on('click', '.delete', function(e) {
    e.preventDefault();
    var conf = confirm("Are you sure to delete image ?");
    if (conf == true) {
        var url = $(this).attr('href');
        var code = $(this).attr('data');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: 'POST',
            success: function(done) {
                $('#' + code).remove();
            }
        });
    }

    return false;
});
</script>

@endpush
@endisset