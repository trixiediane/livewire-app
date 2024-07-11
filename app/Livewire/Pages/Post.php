<?php

namespace App\Livewire\Pages;

use App\Models\Post as ModelsPost;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class Post extends Component
{
    use Toast;

    #[Validate('required|max:30')]
    public $title = '';

    #[Validate('required|min:8')]
    public $content = '';

    public function render()
    {
        return view('livewire.pages.post');
    }

    public function save()
    {
        $this->validate();

        // di pwede array sa addError
        // $this->addError('title_required', 'Title is required');

        ModelsPost::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->success(
            'Success!'
        );
    }
}
