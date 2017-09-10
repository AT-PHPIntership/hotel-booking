<div>
  @foreach($hintedPlaces as $place)
    <li class="place-selected text-success text-center form-control">{{$place->name}}</li>
  @endforeach
</div>