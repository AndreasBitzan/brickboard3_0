<?php

namespace App\Http\Livewire;

use App\Models\BrickfilmCategory;
use App\Models\Topic;
use Livewire\Component;

class MovieCreator extends Component
{
    public $categories = [];
    public $topic;
    public $content;
    public $chosen_categories = [];

    protected $rules = [
        'topic.title' => 'required|min:1',
        'topic.includes_peter' => 'nullable',
        'topic.movie_created_at' => 'required',
        'topic.movie_url' => 'required',
    ];

    private $movieEditorPlaceholder = [
        'Mein neuer Film!',
        'Hi, bitte um Feedback wegen...',
        'Ich habe mir bei diesem Film folgendes gedacht...',
        'Da erwartet euch was, ich habe sogar behind the Scenes Infos für euch!',
        'Mist, ich habe Peter in dem Film vergessen!',
    ];

    public function mount()
    {
        $this->categories = BrickfilmCategory::where('assignable', true)->orderBy('position', 'asc')->get();
        $this->topic = new Topic();
        $this->topic->movie_created_at = now();
    }

    public function render()
    {
        return view('livewire.movie-creator');
    }
}
