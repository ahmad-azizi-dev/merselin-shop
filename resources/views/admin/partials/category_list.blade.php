@foreach($categories as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td>
            @for ($i= $level ; $i >0 ; $i--)
                &#9562;
                &#9552;
                &#9552;
                &#128308;
            @endfor

            {{$category->name}}</td>
        <td style="min-width: 230px !important;">

            <a class="btn btn-sm  bg-gradient-warning m-2" href="{{route('categories.indexSetting', $category->id)}}">Setting</a>

            <button type="button" class="btn btn-sm  bg-gradient-info m-2" data-toggle="modal"
                    data-target="#details{{$category->id}}">
                details
            </button>
            </span>

            <button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal"
                    data-target="#myModal{{$category->id}}">
                delete
            </button>
            </span>


            <!-- The details Modal -->
            <div class="modal fade" id="details{{$category->id}}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-info"><i class="fa fa-newspaper"></i> details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <table class="table-bordered table-sm table-striped table-responsive">
                                <tbody>
                                <tr>
                                    <th style="min-width: 180px !important;">id</th>
                                    <td style="min-width: 580px !important;">{{$category->id}}</td>
                                </tr>
                                <tr>
                                    <th>name</th>
                                    <td>{{$category->name}}</td>
                                </tr>
                                <tr>
                                    <th>meta title</th>
                                    <td>{{$category->meta_title}}</td>
                                </tr>
                                <tr>
                                    <th>slug</th>
                                    <td>{{$category->slug}}</td>
                                </tr>
                                <tr>
                                    <th>meta description</th>
                                    <td>{{$category->meta_desc}}</td>
                                </tr>
                                <tr>
                                    <th>meta keywords</th>
                                    <td>{{$category->meta_keywords}}</td>
                                </tr>
                                <tr>
                                    <th>parent ID</th>
                                    <td>{{$category->parent_id}}</td>
                                </tr>
                                <tr>
                                    <th>attributes</th>
                                    <td>
                                        <ul>
                                            @foreach($category->attributeGroups as $attributeGroup)
                                                <li>  {{$attributeGroup->title}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>created date (Tehran)</th>
                                    <td>{{$category->created_at->setTimezone('Asia/Tehran')}}</td>
                                </tr>
                                <tr>
                                    <th>updated date (Tehran)</th>
                                    <td>{{$category->updated_at->setTimezone('Asia/Tehran')}}</td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">

                            <button type="button" class="btn btn-block btn-secondary w-25 mr-3"
                                    data-dismiss="modal">Ok
                            </button>

                            <a class="btn btn-block  bg-gradient-warning m-2 w-25"
                               href="{{route('categories.edit', $category->id)}}">edit</a>

                        </div>
                    </div>
                </div>
            </div>


            <!-- The delete Modal -->
            <div class="modal fade" id="myModal{{$category->id}}">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-danger"><i class="fa fa-window-close"></i> danger!</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            are you sure that want to delete the <b
                                class="text-info">{{$category->name}} </b>
                            category!!
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">

                            <button type="button" class="btn btn-block btn-secondary w-50 mr-3"
                                    data-dismiss="modal">cancel
                            </button>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id] ]) !!}
                            {!! Form::submit('delete', ['class'=>'btn bg-gradient-danger mx-2']) !!}
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </td>

    </tr>
    @if(count($category->childrenRecursive) > 0)
        @include('admin.partials.category_list', ['categories' => $category->childrenRecursive, 'level' => $level+1])
    @endif
@endforeach
