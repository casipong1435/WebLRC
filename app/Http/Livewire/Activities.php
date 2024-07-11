<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;

class Activities extends Component
{

    public $search_input;

    public function render()
    {
        $activities = Activity::when($this->search_input, function($query){
            $query->search('activity', $this->search_input)
            ->search('id', $this->search_input)
            ->search('log_time', $this->search_input);
        })
        ->orderBy('log_time', 'desc')
        ->paginate(15);
        return view('livewire.activities', ['activities' => $activities]);
    }
}
