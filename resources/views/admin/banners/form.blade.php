<div class="form-group">
    <label for="description">Описание</label>
    <input type="text" value="{{old('description', isset($banner) ? $banner->description : '')}}" class="form-control" placeholder="Описание" id="description" name="description">
</div>
<div class="form-group">
    <label for="title">Название</label>
    <input type="text" value="{{old('title', isset($banner) ? $banner->title : '')}}" class="form-control" placeholder="Название" id="title" name="title">
</div>
<div class="form-group">
    <label for="photo">Изображение</label>
    <input type="file" name="photo" value="" class="form-control" id="photo" >
</div>
