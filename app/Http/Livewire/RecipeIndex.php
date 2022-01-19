<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Illuminate\Http\Request;

class RecipeIndex extends Component
{
    public $stausUpdate = false;



    public function render(Request $request)
    {
        $id = $request->id;
        $recipe = Recipe::where('id', '=', $id)->get();
        return view('livewire.recipe', ['recipe' => $recipe])->extends('layouts.app');
    }
    public function getRecipeById($id)
    {
        $this->stausUpdate = true;
        $recipe = Recipe::find($id);
        $this->emit('getRecipeId', $recipe);
    }

    public function distroy_recipe($id){
        if($id){
            $data = Recipe::find($id);
            $data->delete();
            session()->flash('message', 'Delete Data Success !');
        }
    }




}
