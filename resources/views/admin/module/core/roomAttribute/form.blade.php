<div class="form-group">
    <label for="name">Name<span class="text-danger">*</span></label>
    <input type="text" id="name" class="form-control" placeholder="name" name="name" 
    @if($url == 'admin.module.hotel.roomAttribute.edit') value="{{$data->name}}" @else value="{{old('name')}}"@endif required>
</div>
<div class="form-group">
    <label for="position">Position</label>
    <input type="number" id="position" class="form-control" placeholder="position" name="position" 
    @if($url == 'admin.module.hotel.roomAttribute.edit') value="{{$data->position}}" @else value="{{old('position')}}"@endif>
</div>