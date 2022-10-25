<div>
    <nav aria-label="breadcrumb">
        @php $url = "" @endphp
        <ol class="breadcrumb">
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
                    <li class="breadcrumb-item active text-capitalize" aria-current="{{ $segment }}">{{ $segment }}</li>
                @else
                    @php
                        $url .= "/" . $segment;
                        $segment = str_replace('-', ' ', $segment);
                    @endphp
                    <li class="breadcrumb-item text-capitalize"><a href="{{ url($url) }}">{{ $segment }}</a></li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>

