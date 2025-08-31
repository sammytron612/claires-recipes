<div>
    <nav aria-label="breadcrumb">
        @php $url = "" @endphp
        <ol class="flex flex-wrap items-center space-x-2 text-sm text-gray-600">
            @foreach($segments as $segment)
                @if($loop->last)
                    @php
                        $s = explode("-", $segment);
                        if(is_numeric(end($s)))
                        {
                            $segment   = implode('-', explode('-', $segment, -1));
                            $segment = str_replace('-', ' ', $segment);
                        }
                    @endphp
                    <li class="capitalize text-gray-800 font-medium" aria-current="{{ $segment }}">
                        <span class="mr-2 text-teal-600">
                            <i class="fas fa-angle-right"></i>
                        </span>
                        {{ $segment }}
                    </li>
                @else
                    @php
                        $url .= "/" . $segment;
                        $segment = str_replace('-', ' ', $segment);
                    @endphp
                    <li class="capitalize">
                        @if(!$loop->first)
                            <span class="mr-2 text-teal-600">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        @endif
                        <a href="{{ url($url) }}" class="text-teal-600 hover:text-teal-800 transition-colors">{{ $segment }}</a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>

