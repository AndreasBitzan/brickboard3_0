<?php

namespace App\Http\Livewire;

use App\Http\Enums\ModerationStateEnum;
use App\Models\Messageboard;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

class TopicCreator extends Component
{
    use Actions;
    public $title;
    public $content;
    public $placeholder;
    public $messageboard;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function mount(Messageboard $messageboard)
    {
        $this->messageboard = $messageboard;
        $this->placeholder = $this->getPlaceholder();
    }

    public function render()
    {
        return view('livewire.topic-creator');
    }

    public function createTopic()
    {
        if (null == $this->title || '' == $this->title || empty(trim($this->title))) {
            $this->notification()->error(__('Bitte gib einen Titel an!'));
        }

        if (null == $this->content || '' == $this->content || empty(trim($this->content))) {
            $this->notification()->error(__('Bitte gib deinen Inhalt ein!'));
        }

        if (auth()->user()->moderation_state_id == ModerationStateEnum::BLOCKED->value) {
            $this->notification()->error(__('Du bist blockiert und kannst keine Beiträge mehr posten'));

            return;
        }

        $this->validate();

        $topic_created = Topic::create([
            'user_id' => auth()->id(),
            'last_user_id' => auth()->id(),
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'messageboard_id' => $this->messageboard->id,
            'moderation_state_id' => auth()->user()->moderation_state_id,
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'content' => $this->content,
            'topic_id' => $topic_created->id,
            'messageboard_id' => $this->messageboard->id,
            'moderation_state_id' => auth()->user()->moderation_state_id,
        ]);
        $this->notification()->success(__('Thema erfolgreich erstellt'));

        return $this->redirect(route('forum.detail', $this->messageboard));
    }

    private function getPlaceholder()
    {
        $placeholders = [
            'Ich will euch was beichten...',
            'Ich darf stolz verkünden, dass...',
            'Boah, was wollt ich eigentlich schreiben?',
            'Ich hätte gerne so eine tolle Frisur wie Peter Valerius, weil...',
            'Glasses',
            'Hallo Brickfilmwelt!',
            'Wie macht man eigentlich einen Brickfilm?!',
        ];

        return $placeholders[array_rand($placeholders)];
    }
}
