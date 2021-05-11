<div class="form-group">
    <label for="name">Имя</label>
    <input type="text" name="name" id="name" class="form-control" value="{{old('name', isset($product) ? $product->name : '')}}">
</div>
<div class="form-group">
    <label for="photo">Изображение</label>
    <input type="file" name="photo" class="form-control" id="photo">
</div>
<div class="form-group">
    <label for="price">Цена</label>
    <input type="number" name="price" id="price" value="{{old('price', isset($product) ? $product->price : '')}}" class="form-control">
</div>
<div class="form-group">
    <label for="category">Категория</label>
    <select name="categories[]" id="category" class="form-control" multiple>
        @foreach(App\Models\Category::all() as $all)
            {{$s=0}}
            @if(isset($product) && isset($product->categories))
                @foreach($product->categories as $category)
                    @if($all->id === $category->id)
                        {{$s=1}}
                    @endif
                @endforeach
            @endif
            @if($s === 1)
                <option value="{{$all->id}}" selected class="form-control">{{$all->name}}</option>
            @else
                <option value="{{$all->id}}" class="form-control">{{$all->name}}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="form-group">
        <input type="checkbox" name="active" id="active" {{old('active',isset($product) ? ($product->active?"checked":'') : '' )}}>
    <label for="active">Показывать клиентам</label>
</div>

