<x-app>
    <div id="location-container">
        <h1>Address: {{ $location->street_address_1 }} </h1>
            @foreach (["street_address_2", "city", "state", "zip"] as $attribute_name)
                <span>{{$attribute_name}}</span>:
                @if ($location->getAttributeValue($attribute_name))
                    <span id={{ $attribute_name }}> {{ $location->getAttributeValue($attribute_name) }}</span>
                @else
                    <span id={{ $attribute_name }}> none </span>
                @endif
                <br>
            @endforeach
    </div>
</x-app>