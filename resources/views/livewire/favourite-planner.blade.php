<div>
    @if(!count($favourites))
    <h2 class="text-center py-5">You have none</h2>
    @else
    <section class="max-w-7xl mx-auto bg-white mt-5 px-4">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/2 truncate">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Planner</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($favourites as $fav)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><a href="{{ route('recipe',$fav->slug) }}"><img style="width:8rem; height:100px;" class="border border-gray-800 rounded" src="{{ asset('storage/' . $fav->image) }}"></a></td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold"><a href="{{ route('recipe',$fav->slug) }}">
                            {{ $fav->title }}
                        </a></td>
                        <td class="align-middle d-none d-md-block"">{{ $fav->description }}</td>
                        @php $flag = false; $flag1 = false @endphp
                        @foreach($plannerEntries as $plannerEntry)
                            @if($fav->recipe_id == $plannerEntry->recipe_id)
                                <td class="align-middle">
                                    @php $flag1 = true @endphp
                                  <input wire:click.debounce.500ms="RemovePlanner({{ $plannerEntry->planner_id }})"type="checkbox" checked id="" value="checkedValue" class="">
                                </td>
                                @php $flag = true @endphp
                            @endif
                        @endforeach
                        @if(!$flag)
                            <td class="align-middle">No</td>
                        @endif
                        <td class="align-middle"><button wire:click.debounce.500ms="destroy({{ $fav->fav_id }})" class="w-100 p-2 btn btn-sm mb-1 btn-outline-danger mr-1">Remove from favs</button>
                            @if(!$flag)
                                <button wire:click.debounce.500ms="AddPlanner({{ $fav->recipe_id }})" class="w-100 btn p-2 btn-sm  btn-outline-primary">Add to planner</button></td>
                            @endif
                            @if($flag1)
                                <button wire:click.debounce.500ms="RemovePlanner({{ $plannerEntry->planner_id }})" class="w-100 p-2 btn btn-sm mb-1 btn-outline-danger mr-1">Remove from planner</button>
                            @endif
                    </tr>
                @endforeach

            </tbody>
       </table>
       <div class="mypagination">
           {{ $favourites->links() }}
       </div>
   </section>
   @endif
</div>
