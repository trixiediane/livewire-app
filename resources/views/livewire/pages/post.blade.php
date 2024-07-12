<div>
    <x-form wire:submit="save">
        {{-- Para sa custom error field:  error-field="title_required" --}}
        <x-input label="Title" wire:model="title" placeholder="Your title..." />
        <x-textarea label="Content" wire:model="content" placeholder="Your content..." hint="Max 1000 chars" rows="5"
            inline />
        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>

    {{-- @foreach ($post as $display)
        <br>{{$display->title}}
    @endforeach --}}

    @php
    $headers = [
        ['key' => 'title', 'label' => 'Title', 'class' => 'w-1'],
        ['key' => 'content', 'label' => 'Content'],
    ];
@endphp

<x-table :headers="$headers" :rows="$posts" with-pagination>
    {{-- Customizing each cell --}}
    @scope('cell_title', $post)
        <strong>{{ $post->title }}</strong>
    @endscope

    @scope('cell_content', $post)
        <div>{{ $post->content }}</div>
    @endscope

    @scope('actions', $post)
        {{-- Edit button --}}
        <x-button icon="o-pencil" wire:click="editPostModal({{ $post->id }})" spinner class="btn-sm" />

        {{-- Delete button --}}
        <x-button icon="o-trash" wire:click="delete({{ $post->id }})" spinner class="btn-sm" />
    @endscope
</x-table>

<x-modal wire:model="updatePostModal" title="Edit Post" subtitle="Update the title and content..." separator>
    <div>
       <x-input label="Title" wire:model="updateTitle" />

       <x-textarea label="Content" wire:model="updateContent" />
    </div>

    <x-slot name="actions">
        <x-button label="Cancel" @click="$wire.updatePostModal = false" />
        <x-button label="Update" class="btn-primary" wire:click="updatePost" />
    </x-slot>
</x-modal>

</div>
