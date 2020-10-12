<div class="row">

    <div class="col-sm-6">
        <!-- select -->
        <div class="form-group">

            <label>categories (multiple select)
                <span wire:loading wire:target="selectedCategories"
                      class="spinner-border spinner-border-sm text-primary"></span>
            </label>

            <select wire:model="selectedCategories" name="category[]" class="form-control" multiple size="20">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">&#128309; {{$category->name}}</option>
                    @if(count($category->childrenRecursive) > 0)
                        @include('admin.partials.category', ['categories'=>$category->childrenRecursive, 'level'=>1])
                    @endif
                @endforeach
            </select>

        </div>
    </div>

    <div class="col-sm-6">

        <div class="form-group mt-5 border p-2">
            <i class="fa-list fa mb-4 mx-1"></i><span class="text-bold"> attributes list</span>

            <!-- select -->
            @forelse($attributeGroups as $attributeGroup)

                @if($attributeGroup->attributesValue->count())
                    <div class="form-group">

                        <label> &#128311; <span
                                class="text-danger text-bold">{{$attributeGroup->title}}</span>
                            (<span class="text-primary">{{$attributeGroup->type}}</span>)</label>

                        <select name="attributeValues[]" class="form-control" multiple
                                size="{{$attributeGroup->attributesValue->count()}}">
                            @foreach($attributeGroup->attributesValue as $attributeValue)
                                <option value="{{$attributeValue->id}}"

                                        @if(old('attributeValues'))
                                        @if(in_array($attributeValue->id,old('attributeValues')))selected @endif
                                        @elseif(count($storedAttributeValues))
                                        @if(in_array($attributeValue->id, $storedAttributeValues))selected
                                        class="text-danger" @endif @endif

                                >{{$attributeValue->title}}</option>
                            @endforeach
                        </select>

                    </div>
                @else
                    <p> &#10060; there is no value for the <span
                            class="text-danger text-bold">{{$attributeGroup->title}}</span> attribute</p>
                @endif
            @empty
                @if($selectedCategories) <p> &#10060; there is no attribute for the this category</p> @else <p> &#10060;
                    please select a category</p> @endif
            @endforelse

        </div>
    </div>

</div>
