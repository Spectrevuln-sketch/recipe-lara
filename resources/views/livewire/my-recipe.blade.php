<div>
    <?php

    use App\Models\User;

    $user = Auth::user();

    ?>
    <div class="bg-gray-100 shadow-md">
        <div class="px-4 py-3 sm:px-8 md:px-16">
            <div class="flex items-center justify-center mb-2 text-xl font-semibold text-green-700 font-lora">Total Recipe ({{$recipe->count()}})</div>
            <div class="flex items-center justify-around">
                <a href="{{ route('store-recipe') }}" class="px-4 py-2 font-semibold text-center text-white transition duration-300 ease-out transform bg-green-500 rounded-md shadow-md hover:bg-green-400 hover:scale-105 font-nunito">Add More</a>

            </div>
        </div>
    </div>
    <div class="px-4 py-3 mb-3 sm:px-8 md:px-16">
        <div class="flex items-center py-2 mb-1 text-xl font-semibold text-green-700 font-lora">{{$user->name}}'s Recipes</div>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4">
            @foreach($recipe as $r)
            <div class="relative overflow-hidden transition duration-200 ease-in transform bg-white rounded-md shadow-md hover:scale-105">
                <a href="{{ route('show-recipe', ['id'=>$r->id]) }}">
                    <img src="{{asset('storage/'.$r->user_id.'-'.$r->title.'/'.$r->picture)}}" class="object-cover w-full h-56">
                </a>
                <a href="" class="px-4 py-2 font-semibold text-center text-white transition duration-300 ease-out transform bg-red-500 rounded-md shadow-md hover:bg-red-400 hover:scale-105 font-nunito" wire:click="getRecipeById({{$r}})">Delete</a>
                <div>
                    <span class="px-3 pt-3 text-xs font-nunito">{{$r->category}}</span>
                    <span class="block px-3 font-bold font-nunito text-l">{{$r->title}}</span>
                    <span class="block px-3 pb-3 text-gray-600 font-nunito text-md">By {{User::where('id', '=', $r->user_id)->value('name')}}</span>
                </div>
                <div class="absolute top-0 px-2 py-1 m-2 text-xs font-semibold uppercase bg-gray-200 rounded-full font-nunito">
                    <svg class="inline-block w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{$r->duration}} MIN</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
