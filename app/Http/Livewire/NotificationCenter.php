<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use Livewire\Component;
use WireUi\Traits\Actions;

class NotificationCenter extends Component
{
    use Actions;
    public $notificationList = [];

    public function updated($value, $key)
    {
        error_log('NOTIFICATIONS UPDATE TRIGGER');
        error_log(json_encode($value));
        error_log(json_encode($key));
    }

    public function compareNotifcations()
    {
        error_log('Comparing notifications');
        $new_data = Notification::all();

        if (count($new_data) > count($this->notificationList)) {
            $this->notification()->info('Neue Notification!');
            $this->notificationList = $new_data;
        }
    }

    public function mount()
    {
        error_log('MOUNT CALLED');
        $this->notificationList = Notification::all();
    }

    public function render()
    {
        error_log('Notification render called');

        return view('livewire.notification-center');
    }
}
