<?php

namespace App\Http\Livewire;

use App\Models\News;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use WireUi\Traits\Actions;

class TestNotifcations extends Component
{
    use Actions;
    public $news;

    public function shootNotification()
    {
        $this->notification()->info('WORKS');
    }

    public function render()
    {
        error_log('title->'.App::getLocale());
        $this->news = News::where('title->'.App::getLocale(), 'like', '%Josef%')->first();

        return view('livewire.test-notifcations');
    }
}
