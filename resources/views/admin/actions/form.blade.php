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
<div class="form-group" style="background-color: #d3d8e3; padding: 5px; border-radius: 5px">
    <div id="action1" class="d-flex flex-row">
        <div class="form-group" style="width: 55%; margin-right: 3%">
            <label for="product">Продукты</label>
            <select name="product[1][product]" class="form-control">
                @foreach(\App\Models\Product::all() as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" style="width: 25%">
            <label for="quantity">Количество</label>
            <input type="number" class="form-control" name="product[1][quantity]">
        </div>
        <button class="btn btn-danger remove-action h-50 ml-3" style="margin-top: 31px; display: none" type="button">Удалить</button>
    </div>
    <div class="form-group" style="width: 33%">
        <button class="btn-dark btn" type="button" id="add-action">Добавить</button>
        <br>
    </div>
</div><br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>


    $(document).on('click', '.remove-action', function () {
        $(this).parent().remove();
    });

    $("#add-action").click(function(){

        // get the last DIV which ID starts with ^= "another-participant"
        var $div = $('div[id^="action"]:last');

        // Read the Number from that DIV's ID (i.e: 1 from "another-participant1")
        // And increment that number by 1
        var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;

        // Clone it and assign the new ID (i.e: from num 4 to ID "another-participant4")
        var $clon = $div.clone().prop('id', 'action'+num );

// for each of the inputs inside the dive, clear it's value and
// increment the number in the 'name' attribute by 1
        $clon.find('input').each(function() {
            this.value= "";
            let name_number = this.name.match(/\d+/);
            name_number++;
            this.name = this.name.replace(/\[[0-9]\]+/, '['+name_number+']')
        });

        $clon.find('select').each(function() {
            this.value= "";
            let name_number = this.name.match(/\d+/);
            name_number++;
            this.name = this.name.replace(/\[[0-9]\]+/, '['+name_number+']')
        });

        $clon.find('.remove-action').css('display', 'block');
        // Finally insert $klon after the last div
        $div.after( $clon );

    });

</script>
