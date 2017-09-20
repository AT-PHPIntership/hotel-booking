@if (count($hintedPlaces) != 0)
  <div>
    @foreach($hintedPlaces as $place)
      <li class="place-selected text-success text-center form-control">{{$place->name}}</li>
    @endforeach
  </div>
@endif