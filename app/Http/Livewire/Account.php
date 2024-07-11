<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Hash;

class Account extends Component
{
    public $new_password;
    public $confirm_password;

    public function render()
    {
        return view('livewire.account');
    }

    public function changePassword(){
        $this->validate([
            'new_password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        try{
            User::where('id', auth()->user()->id)->update(['password' => Hash::make($this->new_password)]);
            session()->flash('success', 'Password Changed!');
            $this->dispatchBrowserEvent('change_clicked');
            $this->new_password = '';
            $this->confirm_password = '';
        }catch(\Exception $e){
            session()->flash('error', 'Something Went Wrong!');
            $this->dispatchBrowserEvent('change_clicked');
        }
    }
}
