<x-app>
    <div id="locations-container">
        <h1>Locations</h1>
        @foreach ( $locations as $location )
            @if($location->is_client_address==true)
                <a href="/locations/{{ $location->id }}">
                    <div id="{{ $location->id }}">
                        {{ $location->street_address_1 }}
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</x-app>