<?php

namespace App\Http\Livewire;

use App\Http\Enums\TopicTypeEnum;
use App\Models\BrickfilmCategory;
use App\Models\MovieAuthor;
use App\Models\MovieRole;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Str;
use Livewire\Component;

class MovieCreator extends Component
{
    public $categories = [];
    public $topic;
    public $content;
    public $chosen_categories = [];
    public $messageboard;
    public $authors = [];
    public $movieRoles = [];

    protected $listeners = ['addAuthors'];

    protected $rules = [
        'topic.title' => 'required|min:1',
        'topic.includes_peter' => 'nullable',
        'topic.movie_created_at' => 'required',
        'topic.video_url' => 'required',
        'content' => 'required',
        'chosen_categories' => 'required|max:3',
    ];

    protected $validationAttributes = [
        'topic.title' => 'Titel',
        'topic.video_url' => 'Video URL',
        'content' => 'Inhalt',
        'chosen_categories' => 'Kategorien',
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
        $this->authors = collect([auth()->user()])->toArray();
        $this->movieRoles = MovieRole::all();
    }

    public function addAuthors($author, $roleId)
    {
        $author['movie_role'] = $roleId;
        array_push($this->authors, $author);
    }

    public function removeAuthor($id)
    {
        $this->authors = array_filter($this->authors, function ($author) use ($id) {
            return $author['id'] != $id;
        });
    }

    public function getRoleName($roleId = 1)
    {
        return $this->movieRoles->where('id', $roleId)->first()->name;
    }

    public function save()
    {
        $this->validate();

        $slug = Str::slug($this->topic->title);

        if (Topic::where('slug', $slug)->exists()) {
            $slug = Str::slug($this->topic->title).'-'.now()->month.now()->day.now()->hour.now()->minute.now()->second;
        }

        if (!$this->topic->includes_peter) {
            $this->topic->includes_peter = false;
        }

        $this->topic->slug = $slug;
        $this->topic->messageboard_id = $this->messageboard->id;
        $this->topic->user_id = auth()->id();
        $this->topic->last_user_id = auth()->id();
        $this->topic->moderation_state_id = auth()->user()->moderation_state_id;
        $this->topic->topic_type_id = TopicTypeEnum::BRICKFILM->value;
        $this->topic->last_post_at = now();

        $this->topic->save();

        $this->topic->brickfilm_categories()->sync($this->chosen_categories);

        Post::create([
            'user_id' => auth()->id(),
            'content' => $this->content,
            'topic_id' => $this->topic->id,
            'messageboard_id' => $this->messageboard->id,
            'moderation_state_id' => auth()->user()->moderation_state_id,
        ]);

        foreach ($this->authors as $author) {
            MovieAuthor::create([
                'topic_id' => $this->topic->id,
                'user_id' => $author['id'],
                'movie_role_id' => isset($author['movie_role']) ? $author['movie_role'] : 1,
            ]);
        }

        return $this->redirect(route('forum.brickfilms', $this->messageboard));
    }

    public function render()
    {
        error_log('Render');
        error_log(json_encode($this->chosen_categories));

        return view('livewire.movie-creator');
    }
}
