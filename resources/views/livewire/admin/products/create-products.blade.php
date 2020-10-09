<div class="row">

    <div class="col-sm-6">
        <!-- select -->
        <div class="form-group">

            {!! Form::label('category_parent', 'categories') !!}

            <select name="category" class="form-control">
                <option class="text-danger" value="">select categories for this product ...</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">&#128309; {{$category->name}}</option>
                    @if(count($category->childrenRecursive) > 0)
                        @include('admin.partials.category', ['categories'=>$category->childrenRecursive, 'level'=>1])
                    @endif
                @endforeach
            </select>

        </div>
    </div>

</div>
