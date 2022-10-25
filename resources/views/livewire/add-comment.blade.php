<div x-data="{ isVisible: false }" class="mt-3 w-100 w-md-50">
    <div id="starRating" x-data="{ temp: 0, rating: @entangle('rating').defer }" class="invisible"  @click="rating = temp">
        <input class="d-none" :value="rating" type="number"/>
        <template x-for="item in [1,2,3,4,5]">
         <span @mouseenter="temp = item"
               @mouseleave="temp = rating"
               class="text-secondary"
               :class="{'text-warning': (temp >= item)}"><i class="fa fa-star fa-md"></i></span>
        </template>
    </div>

    <div x-on:show.window="isVisible = true"></div>
    <div x-on:hide-button.window="isVisible = false"></div>
    <div class="mt-2">
        <form wire:submit.prevent="StoreComment">
            <textarea  @click="$dispatch('show')" style="height:2.5rem" wire:model.defer="comment" id="MakeComment" class="txt form-control w-100" placeholder="Make a comment"></textarea>
            <div x-show="isVisible">
                <button style="width:30rem" type="Submit" class="w-100 mt-2 btn btn-teal btn-block">Submit</button>
            </div>
        </form>
    </div>
</div>

