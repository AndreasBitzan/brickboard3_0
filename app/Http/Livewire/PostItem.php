<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;

class PostItem extends Component
{
    use AuthorizesRequests;
    use Actions;
    public $post;
    public $editPost = false;

    protected $rules = ['post.content' => 'required'];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function updatePost()
    {
        $this->post->save();
        $this->notification()->success(__('Post erfolgreich bearbeitet'));
        $this->reset('editPost');
    }

    public function deletePost()
    {
        $this->dialog()->confirm([
            'title' => __('Bist du sicher?'),
            'description' => __('Post wirklich löschen?'),
            'icon' => 'warning',
            'acceptLabel' => __('Ja, löschen'),
            'rejectLabel' => __('Abbrechen'),
            'method' => 'performDelete',
        ]);
    }

    public function render()
    {
        return view('livewire.post-item');
    }

    public function performDelete()
    {
        try {
            if ($this->authorize('delete', $this->post)) {
                $this->post->delete();
                $this->notification()->success(__('Post erfolgreich gelöscht'));
                $this->emitTo('topic-detail', 'refreshPostList');
            }
        } catch (\Exception $ex) {
            $this->notification()->info(__('Berechtigung fehlt'));
        }
    }
}
