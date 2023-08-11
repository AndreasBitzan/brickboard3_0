<?php

namespace App\Http\Livewire;

use App\Http\Enums\ModerationStateEnum;
use App\Models\PrivatePost;
use App\Models\PrivateTopic;
use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

class PrivateTopicCreator extends Component
{
    use Actions;
    public $title;
    public $content;
    public $placeholder;
    public $chosen_users;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function mount()
    {
        $this->placeholder = $this->getPlaceholder();
    }

    public function render()
    {
        return view('livewire.private-topic-creator');
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
            $this->notification()->error(__('Du bist blockiert und kannst keine Nachrichten mehr senden'));

            return;
        }

        $this->validate();

        $slug = Str::slug($this->title);

        if (PrivateTopic::where('slug', $slug)->exists()) {
            $slug = Str::slug($this->topic->title).'-'.now()->month.now()->day.now()->hour.now()->minute.now()->second;
        }

        $topic_created = PrivateTopic::create([
            'user_id' => auth()->id(),
            'last_user_id' => auth()->id(),
            'title' => $this->title,
            'slug' => $slug,
        ]);

        PrivatePost::create([
            'user_id' => auth()->id(),
            'content' => $this->content,
            'private_topic_id' => $topic_created->id,
        ]);

        $topic_created->chatters()->sync(array_merge($this->chosen_users, [auth()->id()]));

        $this->notification()->success(__('Thema erfolgreich erstellt'));

        return $this->redirect(route('private-messages'));
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
