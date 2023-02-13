<div class="form-group">
    <label for="name">Name<span class="text-danger">*</span></label>
    <input type="text" id="name" class="form-control" placeholder="name" name="name" 
    @if($url == 'admin.module.flight.airport.edit') value="{{$data->name}}" @else value="{{old('name')}}" @endif required>
</div>
<div class="form-group">
    <label for="code">ITA Code<span class="text-danger">*</span></label>
    <input type="text" id="code" class="form-control" placeholder="ITA Code" name="code" 
    @if($url == 'admin.module.flight.airport.edit') value="{{$data->code}}" @else value="{{old('code')}}" @endif required>
</div>
<div class="form-group">
    <label for="location_id">Location</label>
    <select name="location_id" id="location_id" class="select2 form-control">
        <option value="">Select</option>
        @foreach ($locations as $loc)
            <option value="{{$loc->id}}" @if($url == 'admin.module.flight.airport.edit' && $data->location_id == $loc->id) selected @endif>
                {{$loc->name}} {{$loc->parent ? ', ' . $loc->parentName->name : ''}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="address">Address<span class="text-danger">*</span></label>
    <input type="text" id="address" class="form-control" placeholder="Address" name="address" 
    @if($url == 'admin.module.flight.airport.edit') value="{{$data->address}}" @else value="{{old('address')}}" @endif required>
</div>
{{-- <div class="form-group">
    <label for="map_lat">Latitude</label>
    <input type="number" id="map_lat" class="phone form-control" placeholder="name" name="Latitude" 
    @if($url == 'admin.module.flight.airport.edit') value="{{$data->map_lat}}" @else value="{{old('map_lat')}}" @endif>
</div>
<div class="form-group">
    <label for="map_lng">Longitude</label>
    <input type="number" id="map_lng" class="phone form-control" placeholder="name" name="Longitude" 
    @if($url == 'admin.module.flight.airport.edit') value="{{$data->map_lng}}" @else value="{{old('map_lng')}}" @endif>
</div>
<div class="form-group">
    <label for="map_zoom">Map Zoom</label>
    <input type="number" id="map_zoom" class="phone form-control" placeholder="name" name="Map Zoom" 
    @if($url == 'admin.module.flight.airport.edit') value="{{$data->map_zoom}}" @else value="{{old('map_zoom')}}" @endif>
</div> --}}
<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="select form-control">
        <option value="Publish" @if($url == 'admin.module.flight.airport.edit' && $data->status == "Publish") selected @endif>Publish</option>
        <option value="Draft" @if($url == 'admin.module.flight.airport.edit' && $data->status == "Draft") selected @endif>Draft</option>
    </select>
</div>