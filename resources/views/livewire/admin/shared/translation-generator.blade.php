@push('js')
    <script src="/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
@endpush
<div class="" wire:ignore>
    <x-admin.widget.card >
        @foreach($fields as $key=>$translatable)
            @if($translatable['name']==='body')
                <textarea
                        wire:ignore.self
                        x-ref="editorTextarea"
                        x-init="
                            $nextTick(() => {
                                const name = 'fields.' + '{{$key}}' + '.value';
                                if ($refs.editorTextarea && $refs.editorTextarea.id) {
                                    tinymce.init({
                                        selector: '#' + $refs.editorTextarea.id,
                                        setup: (editor) => {
                                        editor.on('init', () => {
                                                editor.setContent($wire.get(name)); // This will work
                                            });
                                            editor.on('change keyup', () => {
                                                $wire.set(name, editor.getContent());
                                            });

                                            Livewire.hook('message.processed', (message, component) => {
                                                if (component.fields  && component.fields['{{$key}}']) {
                                                    editor.setContent(component.fields['{{$key}}'].value);
                                                }
                                            });

                                            // Cleanup function to destroy the editor on Alpine.js cleanup
                                            return () => {
                                                editor.destroy();
                                            };
                                        }
                                    });
                                } else {
                                    console.error('Textarea ID is missing or invalid:', $refs.editorTextarea);
                                }
                            });
                        "
                        class="form-control mymce"
                        wire:key="editor-{{$key}}"
                        id="editor-{{$key}}"
                        name="fields.{{ $key }}.value"
                ></textarea>
                <!-- Hidden input for Livewire reactivity -->
                <input type="hidden" wire:model="fields.{{ $locale }}.{{ $key }}.value">
            @else
                <x-admin.element.input
                        wire:loading.attr="disabled"
                        :label="$translatable['label']"
                        name="fields.{{$key}}.value"
                        wire:model="fields.{{$key}}.value"
                        required="1"
                />
            @endif

            @slot('footer')
                <button
                        wire:loading.attr="disabled"
                        wire:click="saveTranslation" class="btn btn-sm btn-primary">
                    <span wire:loading.attr="hidden" wire:target="saveTranslation">{{trans('general.submit')}}</span>
                    <span hidden wire:loading.attr.remove="hidden" wire:target="saveTranslation">...</span>
                </button>
            @endslot

        @endforeach
    </x-admin.widget.card>
</div>