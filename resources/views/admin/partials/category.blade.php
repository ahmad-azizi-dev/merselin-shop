@if(isset($selected_category))
    @foreach($categories as $sub_category)

        {{-- we can not choose its own or its children as parents, these IDs are restricted in edit the following --}}
        @if($selected_category->id != $sub_category->id)

            <option value="{{$sub_category->id}}"
                    @if($selected_category->parent_id == $sub_category->id) class="text-primary" selected @endif>
                @for ($i= $level ; $i >0 ; $i--)
                    &#9562;
                    &#9552;
                    &#9552;
                    &#128308;
                @endfor

                {{$sub_category->name}}</option>
            @if(count($sub_category->childrenRecursive) > 0)
                @include('admin.partials.category', ['categories' => $sub_category->childrenRecursive, 'level' => $level+1, 'selected_category'=>$selected_category])
            @endif
        @endif
    @endforeach
@else

{{--the following code is just for creating a category, therefore, we can choose all of these categories as a parent and no restriction is needed--}}
    @foreach($categories as $sub_category)

        <option value="{{$sub_category->id}}">
            @for ($i= $level ; $i >0 ; $i--)
                &#9562;
                &#9552;
                &#9552;
                &#128308;
            @endfor

            {{$sub_category->name}}</option>
        @if(count($sub_category->childrenRecursive) > 0)
            @include('admin.partials.category', ['categories' => $sub_category->childrenRecursive, 'level' => $level+1])
        @endif

    @endforeach
@endif
