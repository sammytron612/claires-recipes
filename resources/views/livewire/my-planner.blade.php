<div>
    <section>
        <div class="pb-5 row row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-center py-5">
            @isset($monday['slot'])
                <x-slot-component day="1" :slott="$monday['slot']"/>
            @else
            @if(count($monday))
            <div class="col d-flex align-items-stretch">
                <div class="w-100 card p-0 mt-2 text-center">
                    <div class="bg-white text-teal weight700 card-header">
                        Monday-slot&nbsp{{ $monday[0]->slot }}
                    </div>
                    <div class="card-body p-0">
                        <a href="{{ route('recipe', $monday[0]->recipe->slug) }}">
                            <img style="object-fit: cover;height:200px" class="w-100" src="{{ asset('storage/' .$monday[0]->recipe->image) }}">
                        </a>
                        <div class="d-flex justify-content-center align-items-center px-2 py-3">
                            {{ $monday[0]->recipe->title }}
                        </div>
                        <div class="card-footer">
                            <button class="btn @if($monday[0]->slot == 1) text-green @else text-dark @endif" onclick="changeSlot(1,'1')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($monday[0]->slot == 2) text-green @else text-dark @endif" onclick="changeSlot(2,'1')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($monday[0]->slot == 3) text-green @else text-dark @endif" onclick="changeSlot(3,'1')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset

            @isset($tuesday['slot'])
                <x-slot-component day="2" :slott="$tuesday['slot']"/>
            @else
            @if(count($tuesday))
            <div class="col d-flex align-items-stretch">
                <div class="w-100 card p-0 mt-2 text-center">
                    <div class="bg-white text-teal weight700 card-header">
                        Tuesday-slot&nbsp{{ $tuesday[0]->slot }}
                    </div>
                    <div class="card-body p-0">
                        <a href="{{ route('recipe', $tuesday[0]->recipe->slug) }}">
                            <img style="object-fit: cover;height:200px" class="w-100" src="{{ asset('storage/' .$tuesday[0]->recipe->image) }}">
                        </a>
                        <div class="d-flex justify-content-center align-items-center px-2 py-3">
                            {{ $tuesday[0]->recipe->title }}
                        </div>
                        <div class="card-footer">
                            <button class="btn @if($tuesday[0]->slot == 1) text-green @else text-dark @endif" onclick="changeSlot(1,'2')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($tuesday[0]->slot == 2) text-green @else text-dark @endif" onclick="changeSlot(2,'2')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($tuesday[0]->slot == 3) text-green @else text-dark @endif" onclick="changeSlot(3,'2')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset

            @isset($wednesday['slot'])
                <x-slot-component day="3" :slott="$wednesday['slot']"/>
            @else
            @if(count($wednesday))
            <div class="col d-flex align-items-stretch">
                <div class="w-100 card p-0 mt-2 text-center">
                    <div class="bg-white text-teal weight700 card-header">
                        Wednesday-slot&nbsp{{ $wednesday[0]->slot }}
                    </div>
                    <div class="card-body p-0">
                        <a href="{{ route('recipe', $wednesday[0]->recipe->slug) }}">
                            <img style="object-fit: cover;height:200px" class="w-100" src="{{ asset('storage/' .$wednesday[0]->recipe->image) }}">
                        </a>
                        <div class="d-flex justify-content-center align-items-center px-2 py-3">
                            {{ $wednesday[0]->recipe->title }}
                        </div>
                        <div class="card-footer">
                            <button class="btn @if($wednesday[0]->slot == 1) text-green @else text-dark @endif" onclick="changeSlot(1,'3')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($wednesday[0]->slot == 2) text-green @else text-dark @endif" onclick="changeSlot(2,'3')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($wednesday[0]->slot == 3) text-green @else text-dark @endif" onclick="changeSlot(3,'3')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset
            @isset($thursday['slot'])
                <x-slot-component day="4" :slott="$thursday['slot']"/>
            @else
            @if(count($thursday))
            <div class="col d-flex align-items-stretch">
                <div class="w-100 card p-0 mt-2 text-center">
                    <div class="bg-white text-teal weight700 card-header">
                        Thursday-slot&nbsp{{ $thursday[0]->slot }}
                    </div>
                    <div class="card-body p-0">
                        <a href="{{ route('recipe', $thursday[0]->recipe->slug) }}">
                            <img style="object-fit: cover;height:200px" class="w-100" src="{{ asset('storage/' .$thursday[0]->recipe->image) }}">
                        </a>
                        <div class="d-flex justify-content-center align-items-center px-2 py-3">
                            {{ $thursday[0]->recipe->title }}
                        </div>
                        <div class="card-footer">
                            <button class="btn @if($thursday[0]->slot == 1) text-green @else text-dark @endif" onclick="changeSlot(1,'4')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($thursday[0]->slot == 2) text-green @else text-dark @endif" onclick="changeSlot(2,'4')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($thursday[0]->slot == 3) text-green @else text-dark @endif" onclick="changeSlot(3,'4')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset
            @isset($friday['slot'])
                <x-slot-component day="5" :slott="$friday['slot']"/>
            @else
            @if(count($friday))
            <div class="col d-flex align-items-stretch">
                <div class="w-100 card p-0 mt-2 text-center">
                    <div class="bg-white text-teal weight700 card-header">
                        Friday-slot&nbsp{{ $friday[0]->slot }}
                    </div>
                    <div class="card-body p-0">
                        <a href="{{ route('recipe', $friday[0]->recipe->slug) }}">
                            <img style="object-fit: cover;height:200px" class="w-100" src="{{ asset('storage/' .$friday[0]->recipe->image) }}">
                        </a>
                        <div class="d-flex justify-content-center align-items-center px-2 py-3">
                            {{ $friday[0]->recipe->title }}
                        </div>
                        <div class="card-footer">
                            <button class="btn @if($friday[0]->slot == 1) text-green @else text-dark @endif" onclick="changeSlot(1,'5')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($friday[0]->slot == 2) text-green @else text-dark @endif" onclick="changeSlot(2,'5')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($friday[0]->slot == 3) text-green @else text-dark @endif" onclick="changeSlot(3,'5')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset
            @isset($saturday['slot'])
                <x-slot-component day="6" :slott="$saturday['slot']"/>
            @else
            @if(count($saturday))
            <div class="col d-flex align-items-stretch">
                <div class="w-100 card p-0 mt-2 text-center">
                    <div class="bg-white text-teal weight700 card-header">
                        Saturday-slot&nbsp{{ $saturday[0]->slot }}
                    </div>
                    <div class="card-body p-0">
                        <a href="{{ route('recipe', $saturday[0]->recipe->slug) }}">
                            <img style="object-fit: cover;height:200px" class="w-100" src="{{ asset('storage/' .$saturday[0]->recipe->image) }}">
                        </a>
                        <div class="d-flex justify-content-center align-items-center px-2 py-3">
                            {{ $saturday[0]->recipe->title }}
                        </div>
                        <div class="card-footer">
                            <button class="btn @if($saturday[0]->slot == 1) text-green @else text-dark @endif" onclick="changeSlot(1,'6')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($saturday[0]->slot == 2) text-green @else text-dark @endif" onclick="changeSlot(2,'6')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($saturday[0]->slot == 3) text-green @else text-dark @endif" onclick="changeSlot(3,'6')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset
            @isset($sunday['slot'])
                <x-slot-component day="7" :slott="$sunday['slot']"/>
            @else
            @if(count($sunday))
            <div class="col d-flex align-items-stretch">
                <div class="w-100 card p-0 mt-2 text-center">
                    <div class="bg-white text-teal weight700 card-header">
                        Sunday-slot&nbsp{{ $sunday[0]->slot }}
                    </div>
                    <div class="card-body p-0">
                        <a href="{{ route('recipe', $sunday[0]->recipe->slug) }}">
                            <img style="object-fit: cover;height:200px" class="w-100" src="{{ asset('storage/' .$sunday[0]->recipe->image) }}">
                        </a>
                        <div class="d-flex justify-content-center align-items-center px-2 py-3">
                            {{ $sunday[0]->recipe->title }}
                        </div>
                        <div class="card-footer">
                            <button class="btn @if($sunday[0]->slot == 1) text-green @else text-dark @endif" onclick="changeSlot(1,'7')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($sunday[0]->slot == 2) text-green @else text-dark @endif" onclick="changeSlot(2,'7')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                            <button class="btn @if($sunday[0]->slot == 3) text-green @else text-dark @endif" onclick="changeSlot(3,'7')">
                                <i class="fa fa-square" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endisset
        </div>

        @if(count($plannerEntries))
        <table  class="table table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th></th>
                    <th class="w-25">Title</th>
                    <th class="d-none d-md-block w-50 text-truncate">Description</th>
                    <th class="text-center w-25">Day</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plannerEntries as $entry)
                    <tr>
                        <td class="align-middle"><img style="width:8rem; height:80px" class="border-dark" src="{{ asset('storage/' . $entry->recipe->image) }}"></td>
                        <td class="align-middle weight700">{{ $entry->recipe->title }}</td>
                        <td class="align-middle d-none d-md-block">{{ $entry->recipe->description }}</td>
                        <td class="align-middle">
                            @switch($entry->day)
                                @case('1')
                                    <button onclick="btnClicked(this.id, '{{ $entry->recipe->title }}')" id="{{ $entry->planner_id }}" class="w-100 btn btn-teal">Monday - slot&nbsp{{ $entry->slot }}</button>
                                    @break
                                @case('2')
                                    <button onclick="btnClicked(this.id)" id="{{ $entry->planner_id }}" class="w-100 btn btn-info">Tuesday - slot&nbsp{{ $entry->slot }}</button>
                                    @break
                                @case('3')
                                    <button onclick="btnClicked(this.id, '{{ $entry->recipe->title }}')" id="{{ $entry->planner_id }}" class="w-100 btn btn-primary">Wednesday - slot&nbsp{{ $entry->slot }}</button>
                                    @break
                                @case('4')
                                    <button onclick="btnClicked(this.id, '{{ $entry->recipe->title }}')" id="{{ $entry->planner_id }}" class="w-100 btn btn-light-green">Thursday - slot&nbsp{{ $entry->slot }}</button>
                                    @break
                                @case('5')
                                    <button onclick="btnClicked(this.id, '{{ $entry->recipe->title }}')" id="{{ $entry->planner_id }}" class="w-100 btn btn-crimson">Friday - slot&nbsp{{ $entry->slot }}</button>
                                    @break
                                @case('6')
                                    <button onclick="btnClicked(this.id, '{{ $entry->recipe->title }}')" id="{{ $entry->planner_id }}" class="w-100 btn btn-orange">Saturday - slot&nbsp{{ $entry->slot }}</button>
                                    @break
                                @case('7')
                                    <button onclick="btnClicked(this.id, '{{ $entry->recipe->title }}')" id="{{ $entry->planner_id }}" class="w-100 btn btn-indigo">Sunday - slot&nbsp{{ $entry->slot }}</button>
                                    @break
                                @case('8')
                                    <button onclick="btnClicked(this.id, '{{ $entry->recipe->title }}')" id="{{ $entry->planner_id }}" class="w-100 btn btn-outline-teal">Not chosen</button>
                                    @break
                                @default
                            @endswitch
                        </td>
                        <td class="text-right align-middle"><button wire:click.debounce.750ms="remove({{ $entry->planner_id }})" class="btn btn-sm btn-outline-danger">Remove</button></td>
                @endforeach
            </tbody>
       </table>
       <div class="mypagination">
           {{ $plannerEntries->links() }}
       </div>
       @else
            <h2 class="text-center pb-5">You have none</h2>
        @endif
   </section>



   <!-- Modal -->
   <div class="modal fade" id="days" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
       <div class="modal-dialog modal-sm" role="document">
           <div class="modal-content">
               <div class="modal-header text-center">
                    <h5 id="modal-title" class="weight700 text-teal text-center">
                    </h5>
                </div>
               <div class="modal-body p-5">
                   <input type="hidden" id="hidden"/>
                   <select id="days" onchange="selectChange(this.value)" class="custom-select py-2">
                       <option value="0">Choose</option>
                       <option class="weight900" value="8">None</option>
                            <optgroup label="Monday">
                                <option value="11">slot1</option>
                                <option value="12">slot2</option>
                                <option value="13">slot3</option>
                            </optgroup>
                            <optgroup label="Tuesday">
                                    <option value="21">slot1</option>
                                    <option value="22">slot2</option>
                                    <option value="23">slot3</option>
                            </optgroup>
                            <optgroup label="Wednesday">
                                <option value="31">slot1</option>
                                <option value="32">slot2</option>
                                <option value="33">slot3</option>
                            </optgroup>
                            <optgroup label="Thursday">
                                <option value="41">slot1</option>
                                <option value="42">slot2</option>
                                <option value="43">slot3</option>
                            </optgroup>
                            <optgroup label="Friday">
                                <option value="51">slot1</option>
                                <option value="52">slot2</option>
                                <option value="53">slot3</option>
                            </optgroup>
                            <optgroup label="Saturday">
                                <option value="61">slot1</option>
                                <option value="62">slot2</option>
                                <option value="63">slot3</option>
                            </optgroup>
                            <optgroup label="Sunday">
                                <option value="71">slot1</option>
                                <option value="72">slot2</option>
                                <option value="73">slot3</option>
                            </optgroup>

                    </select>
               </div>
               <div class="modal-footer">

               </div>
           </div>
       </div>
   </div>
</div>
<script>
    function changeSlot(v,day)
    {
        @this.call('updateSlot',v,day)
    }

    function btnClicked(id, title)
    {
        $('#modal-title').text(title)
        $('#hidden').val(id)
        $('#days').modal('show')
    }

    function selectChange(v)
    {
        plannerId = $('#hidden').val()
        $("#days option[value=0]").attr('selected', 'selected');
        @this.call('updatePlanner',v,plannerId)
    }

    Livewire.on('hideModalDays', () => {
    $('#days').modal('hide');

})


</script>
