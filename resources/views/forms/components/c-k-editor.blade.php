@php
    $statePath = $getStatePath();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    wire:ignore
>
	<textarea wire:ignore
              wire:model.lazy="{{ $getId() }}"
              id="content"
		{{ $attributes->merge(['class' => 'form-control']) }}>
    </textarea>

    @once
        @push('scripts')
            <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

            <script>
                function initializeCKEditor() {
                    ClassicEditor
                        .create( document.querySelector( '#content' ))
                        .catch( error => {
                            console.log( error );
                        } );
                }

                initializeCKEditor();

                document.addEventListener('livewire:dom:afterUpdate', initializeCKEditor);
            </script>
        @endpush
    @endonce
</x-dynamic-component>
