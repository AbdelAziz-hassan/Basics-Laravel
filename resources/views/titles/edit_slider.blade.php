@extends('layouts.admin')
@push('head')
<!-- jquery-fancyfileuploader-master -->
<link rel="stylesheet" type="text/css" href="/vendors/jquery-fancyfileuploader-master/fancy-file-uploader/fancy_fileupload.css" media="screen">
@endpush
@section('content')
    <section class="content-header">
        <h1>
            {{$model}}
        </h1>
   </section>
   <div class="content">
    @include('partials.flash')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                    <div class="col-sm-12">
                        <form action="#">
                            <label for="files"><h4>@lang('titles.upload_slider')</h4></label>
                            <input id="demo" data-slug="{{$title->id}}" data-model="{{get_class($title)}}" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png,video/mp4" multiple style="display:none;">
                        </form>
                    </div>
               </div>
           </div>
       </div>
   </div>
@endsection
@push('scripts')
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    <!-- jquery-fancyfileuploader-master -->
    <script src="/vendors/jquery-fancyfileuploader-master/fancy-file-uploader/jquery.ui.widget.js"></script>
    <script src="/vendors/jquery-fancyfileuploader-master/fancy-file-uploader/jquery.fileupload.js"></script>
    <script src="/vendors/jquery-fancyfileuploader-master/fancy-file-uploader/jquery.iframe-transport.js"></script>
    <script src="/vendors/jquery-fancyfileuploader-master/fancy-file-uploader/jquery.fancy-fileupload.js"></script>

    <script>
        $(document).ready(function () {
            $( window ).on( "load", function() { 
                $.get('/getTitleFiles/{{$id}}?model={{$model}}',function(data){
                    $('.ff_fileupload_uploads').append(data);
                });
            });
        });
        $(document).on('click','.ff_fileupload_remove_file',function(ev){
            var that = $(this);
            var id= "{{$id}}";
            ev.preventDefault();
            $.post('/deleteFile/'+$(this).attr('data-id'),{id:id,'model':'{{$model}}'}).done(function(data){
                console.log(data);
                if(data == "true"){
                    that.parent().parent().remove();
                    console.log(that);
                }
            });
        });
    </script>
    <script>
    
        $('#demo').FancyFileUpload({
        params : {
            action:'fileuploader',
        },
        maxfilesize : 1000000,
        uploadcompleted : function(e, data) {
            this.find('.ff_fileupload_actions button.ff_fileupload_remove_file').attr('data-id',data.result.id);;
        }
        });
    </script>
@endpush