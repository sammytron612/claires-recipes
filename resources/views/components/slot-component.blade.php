@props(['day','slott'])
<div class="col d-flex align-items-stretch">
    <div class="w-100 card p-0 mt-2 text-center">
        <div class="bg-white text-teal weight700 card-header">
            @if($day == '1')
            Monday-slot {{ $slott }}
            @endif
            @if($day == '2')
            Tuesday-slot {{ $slott }}
            @endif
            @if($day == '3')
            Wednesday-slot {{ $slott }}
            @endif
            @if($day == '4')
            Thursday-slot {{ $slott }}
            @endif
            @if($day == '5')
            Friday-slot {{ $slott }}
            @endif
            @if($day == '6')
            Saturday-slot {{ $slott }}
            @endif
            @if($day == '7')
            Sunday-slot {{ $slott }}
            @endif
        </div>
        <div class="card-body p-0">

            <img style="object-fit: cover;height:200px" class="w-100" src="{{ asset('storage/empty.jpg') }}">

            <div class="d-flex justify-content-center align-items-center px-2 py-3">
                Empty
            </div>
            <div class="card-footer">
                <button class="btn @if($slott == '1') text-green @else text-dark @endif" onclick="changeSlot(1,'{{ $day }}')"><i class="fa fa-square" aria-hidden="true"></i></button>
                <button class="btn @if($slott == '2') text-green @else text-dark @endif" onclick="changeSlot(2,'{{ $day }}')"><i class="fa fa-square" aria-hidden="true"></i></button>
                <button class="btn @if($slott == '3') text-green @else text-dark @endif" onclick="changeSlot(3,'{{ $day }}')"><i class="fa fa-square" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>
