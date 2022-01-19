<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecipeUpdate extends Component
{

    public $form = [
        'id' => '',
        'user_id'=>'',
        'picture' => '',
        'title' => '',
        'category' => '',
        'duration' => '',
        'ingredient' => '',
        'detail' => '',
    ];


    protected $listeners = [
        'getRecipeId' => 'UpdateRecipeData',
        // 'recipeUpdate'=> 'handleUpdate'

    ];

    public function UpdateRecipeData($recipe)
    {
        $this->form['user_id'] = Auth::user()->id;
        $this->form['picture'] = $this->picture->getClientOriginalName();
        $this->picture->storeAs($this->form['user_id'] . '-' . $this->form['title'], $this->form['picture']);
        $this->form['id'] = $recipe['id'];
        $this->form['title'] = $recipe['title'];
        $this->form['category'] = $recipe['category'];
        $this->form['duration'] = $recipe['duration'];
        $this->form['ingredient'] = $recipe['ingredient'];
        $this->form['detail'] = $recipe['detail'];
    }

    public function render()
    {
        return view('livewire.recipe-update')->extends('layouts.app');
    }



    public function updateRecipe()
    {
        if($this->form['id']){
            $recipe = Recipe::find($this->form['id']);
            $recipe->update([
                'title'=> $this->form['title'],
                'category'=> $this->form['category'],
                'duration' => $this->form['duration'],
                'ingredient'=> $this->form['ingredient'],
                'detail' => $this->form['detail']
            ]);

            $this->resetInput();
            session()->flash('message', 'Recipe'.$recipe['title'].'Telah Di Ubah !' );
            // $this->emit('recipeUpdate', $recipe );
        }

    }


    public function resetInput(){
        $this->form =null;
    }



}
