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

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function deletePost()
    {
        try {
            // TODO FIX RIGHTS
            if ($this->authorize('delete', $this->post)) {
                $this->post->delete();
                $this->notification()->info(__('Post bitte löschen'));
            }
        } catch (\Exception $ex) {
            $this->notification()->info(__('Berechtigung fehlt'));
        }
    }

    public function render()
    {
        return view('livewire.post-item');
    }
}
