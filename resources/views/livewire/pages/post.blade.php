<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <x-form wire:submit="save">
        {{-- Para sa custom error field:  error-field="title_required" --}}
        <x-input label="Title" wire:model="title" />
        <x-textarea label="Content" wire:model="content" placeholder="Your content ..." hint="Max 1000 chars" rows="5"
            inline />
        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
