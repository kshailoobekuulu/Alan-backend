<div class="form-group">
    <label for="name">Имя</label>
    <input type="text" value="{{old('name', isset($category) ? $category->name : '')}}" class="form-control" placeholder="Имя" id="name" name="name">
</div>
<div class="form-group">
    <label for="slug">Слаг</label>
    <input type="text" value="{{old('slug', isset($category) ? $category->slug : '')}}" class="form-control" placeholder="Слаг" id="slug" name="slug">
</div>
<div class="form-group">
    <label for="icon">Иконка</label>
    <input type="file" name="category_icon" value="" class="form-control" id="icon">
</div>
<div class="form-group">
    <label for="photo">Изображение</label>
    <input type="file" name="photo" class="form-control" id="photo">
</div>
<div class="form-group">
    <label for="product">Продукты</label>
    <select name="products[]" id="product" multiple class="form-control">
        @foreach(\App\Models\Product::all() as $all)
            {{$s=0}}
            @if(isset($category))
                @foreach($category->products as $product)
                    @if($all->id === $product->id)
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
