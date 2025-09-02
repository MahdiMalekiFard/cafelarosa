@props([
    'parentClass' => '',
    'id'=>null,
    'name'=>'image',
    'type'=>'file',
    'label'=>'',
    'helperLabel'=>null,
    'required'=>0,
    'default'=>'',
    'size'=>'2M',
    'resolution'=>'1280*720',
    'extensions'=>'png jpg jpeg',
    'data'=>[]
])

@once
    @push('js')
        <script>
            let uploadedDocumentAppMap = {};

            $('#kt_dropzonejs_example_1').dropzone({
                url: '{{ route('upload-image-dropzone',['locale' => app()->getLocale()]) }}',
                maxFilesize: 2, // MB
                addRemoveLinks: true,
                acceptedFiles: 'image/*',
                thumbnailWidth: 200,
                thumbnailHeight: 200,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    $('form').append(
                        '<input type="hidden" name="documentsDropzone[]" value="' + response.name + '">'
                    );
                    uploadedDocumentAppMap[file.name] = response.name;
                },
                removedfile: function (file) {
                    let name = '';

                    if (file.upload) {
                        name = uploadedDocumentAppMap[file.name];
                    } else if (file.id !== undefined) {
                        name = file.id;
                    } else {
                        name = file.file_name || file.name;
                    }

                    if (file.previewElement !== null) {
                        file.previewElement.remove();
                    }

                    $('form').find('input[name="documentsDropzone[]"][value="' + name + '"]').remove();

                    if (file.id !== undefined) {
                        console.log(file.id);
                        $.ajax({
                            type: 'DELETE',
                            url: '/media/' + file.id,
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            success: function () {
                                console.log('Media with ID ' + file.id + ' deleted');
                            },
                            error: function () {
                                alert('Error deleting image.');
                            }
                        });
                    }
                },

                @if($type=='edit')
                init: function () {
                    let files = {!! $data !!}; // JSON passed from Blade

                    for (let i in files) {
                        let file = files[i];

                        let mockFile = {
                            name: file.file_name || `image_${i}`,
                            size: file.size || 123456,
                            type: 'image/jpeg',
                            id: file.id,
                            accepted: true
                        };

                        this.emit('addedfile', mockFile);
                        this.emit('thumbnail', mockFile, file.original_url);
                        this.emit('complete', mockFile);

                        mockFile.previewElement.classList.add('dz-complete');

                        // ✅ Make the preview image clickable
                        mockFile.previewElement.addEventListener('click', function () {
                            window.open(file.original_url, '_blank');
                        });

                        $('form').append(
                            '<input type="hidden" name="documentsDropzone[]" value="' + file.file_name + '">'
                        );
                    }
                }
                @endif
            });
        </script>
    @endpush

    @push('css')
        <style>
            .dropzone .dz-image-preview .dz-image img {
                background-size: contain;
                max-width: 200px;
                max-height: 200px;
            }
            .dropzone .dz-remove {
                cursor: pointer;
                z-index: 9999;
                pointer-events: auto;
                position: absolute;
                top: 5px;
                right: 5px;
                display: inline-block;
                color: red;
            }

            .dropzone .dz-preview {
                position: relative;
            }
        </style>
    @endpush
@endonce

<x-admin.element.form-group
    :parentClass="$parentClass"
    :name="$name"
    :required="$required"
    :label="$label"
    :helperLabel="$helperLabel"
>
    <div class="dropzone" id="kt_dropzonejs_example_1">
        <div class="dz-message needsclick">
            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
            <div class="ms-4">
                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop your files here.</h3>
                <span class="fs-7 fw-bold text-gray-400">You can upload up to 10 files in this section.</span>
            </div>
        </div>
    </div>
</x-admin.element.form-group>
