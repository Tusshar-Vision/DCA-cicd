@extends('layouts.base')

@section('content')
    // Highlights and notes side menu buttons and modal box, this is common on all pages of the reading ecosystem
    <div x-data="{ isHighlightsOpen: false, isNotesOpen: false }">
        <x-widgets.side-notes-and-highlights-menu :noteAvailable="$noteAvailable" />

        <x-modals.modal-box x-show="isHighlightsOpen" :heading="$highlightsHeading">
            <x-widgets.article-highlights />
        </x-modals.modal-box>
        <x-modals.modal-box x-show="isNotesOpen" :heading="$notesHeading">
            <livewire:widgets.edit-note :articleId="$article->getID()" />
        </x-modals.modal-box>
        <x-modals.modal-box x-show="isNoteOpen" heading="Add Note">
            <livewire:widgets.add-note :article="$article" :note="$note" />
        </x-modals.modal-box>
    </div>
@endsection
