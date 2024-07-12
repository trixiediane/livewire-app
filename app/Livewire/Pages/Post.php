<?php

namespace App\Livewire\Pages;

use App\Models\Post as ModelsPost;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Post extends Component
{
    use Toast;
    use WithPagination;

    #[Validate('required|max:30')]
    public $title = '';

    #[Validate('required|min:8')]
    public $content = '';
    public $updateTitle = '';
    public $updateContent = '';
    public bool $updatePostModal = false;
    public $postToUpdate;
    public bool $deleteModal = false;
    public $postToDelete;

    public function render()
    {
        $user = auth()->user();
        return view('livewire.pages.post', [
            'posts' => ModelsPost::where('user_id', $user->id)->paginate(3)
        ]);
    }

    public function save()
    {
        $this->validate();
        $user = auth()->user();

        // di pwede array sa addError
        // $this->addError('title_required', 'Title is required');

        ModelsPost::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => $user->id
        ]);

        $this->success(
            // 'Success!',
            title: 'Successfully saved!',
            description: 'Thank you!'
        );
    }

    // Method to open the modal and set the post data
    public function editPostModal($postId)
    {
        $this->postToUpdate = ModelsPost::findOrFail($postId); // Replace with your logic to fetch the post
        $this->updateTitle = $this->postToUpdate->title;
        $this->updateContent = $this->postToUpdate->content;
        $this->updatePostModal = true;
    }

    public function deletePostModal($postId)
    {
        $this->postToDelete = ModelsPost::findOrFail($postId);
        $this->updateTitle = $this->postToDelete->title;
        $this->updateContent = $this->postToDelete->content;
        $this->deleteModal = true;
    }

    // Method to update the post
    public function updatePost()
    {
        $this->validate([
            'updateTitle' => 'required|max:30',
            'updateContent' => 'required|min:8',
        ]);

        $this->postToUpdate->update([
            'title' => $this->updateTitle,
            'content' => $this->updateContent,
        ]);

        $this->updatePostModal = false;

        $this->info(
            // 'Success!',
            title: 'Successfully updated!',
            description: 'Thank you!'
        );
    }
    // Method to update the post
    public function deletePost()
    {
        $this->postToDelete->delete();

        $this->deleteModal = false;

        $this->error(
            // 'Success!',
            title: 'Successfully deleted!',
            description: 'Thank you!'
        );
    }
}
