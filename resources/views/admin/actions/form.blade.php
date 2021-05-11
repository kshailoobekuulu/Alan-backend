<div class="form-group">
    <label for="price">Цена</label>
    <input type="text" value="{{old('price', isset($action) ? $action->price : '')}}" class="form-control" placeholder="Цена" id="price" name="price">
</div>
<div class="form-group">
    <label for="title">Название</label>
    <input type="text" value="{{old('title', isset($action) ? $action->title : '')}}" class="form-control" placeholder="Название" id="title" name="title">
</div>
<div class="form-group">
    <label for="photo">Изображение</label>
    <input type="file" name="photo" value="" class="form-control" id="photo" >
</div>
<div class="form-group">
    <label for="product">Название</label>
    <input type="text" value="{{old('title', isset($banner) ? $banner->title : '')}}" class="form-control" placeholder="Название" id="title" name="title">
</div>
