<?php

namespace App\Livewire;


use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Heart extends Component
{

    public Model $heartable;

    public function toggle()
    {
    
        if ($this->heartable->isHearted()) {
            
            $this->heartable->unHeart();
        
        } else {
            $this->heartable->heart();

        };

    }



    public function render()
    {
        return view('livewire.heart');
    }
}
