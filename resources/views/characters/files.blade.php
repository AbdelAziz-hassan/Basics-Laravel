<tbody>
    @foreach($title->files as $photo)
        <tr class="ff_fileupload_queued">
            <td class="ff_fileupload_preview">
                <button class="ff_fileupload_preview_image ff_fileupload_preview_image_has_preview" type="button" aria-label="Preview" style="background-image: url({{url($photo->path)}});"><span class="ff_fileupload_preview_text">{{$photo->name}}</span></button>
                <div class="ff_fileupload_actions_mobile">
                    <button class="ff_fileupload_start_upload" type="button" aria-label="Start uploading"></button>
                    <button class="ff_fileupload_remove_file" type="button" aria-label="Remove from list"></button>
                </div>
            </td>
            <td class="ff_fileupload_summary">
                <div class="ff_fileupload_filename">{{$photo->name}}</div>
                <div class="ff_fileupload_fileinfo">{{$photo->size*0.001}} KB | .{{$photo->extension}}</div>
                <div class="ff_fileupload_buttoninfo ff_fileupload_hidden"></div>
                <div class="ff_fileupload_errors ff_fileupload_hidden"></div>
                <div class="ff_fileupload_progress_background ff_fileupload_hidden">
                    <div class="ff_fileupload_progress_bar"></div>
                </div>
            </td>
            <td class="ff_fileupload_actions">
                <button class="ff_fileupload_remove_file" type="button" data-id = "{{$photo->id}}" aria-label="Remove from list"></button>
            </td>
        </tr>
    @endforeach
</tbody>