<div class="form-group">
    <label for="name">Name<span class="text-danger">*</span></label>
    <input type="text" id="name" class="form-control" placeholder="name" name="name" 
    @if($url == 'admin.module.location.edit') value="{{$data->name}}" @else value="{{old('name')}}"@endif required>
</div>
<div class="form-group">
    <label for="name">Parent<span class="text-danger">*</span></label>
    <select name="parent" id="parent" class="select2 form-control">
        <option value="">Select</option>
        @foreach ($datas as $type)
            <option value="{{$type->id}}" @if($url == 'admin.module.location.edit' && $data->parent == $type->id) selected @elseif (old('parent' == $type->id))selected @endif>{{$type->name}}</option>
        @endforeach ()
    </select>
</div>
<div class="form-group">
    <label for="name">Description</label>
    <textarea name="description" class="summernote">@if($url == 'admin.module.location.edit'){!! nl2br($data->description) !!}@else{!! nl2br(old('description')) !!}@endif</textarea>
</div>