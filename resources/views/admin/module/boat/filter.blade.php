@extends('layouts.back.master')
@section('title', 'Boat')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.boat.index') }}">Boat</a></li>
                            <li class="breadcrumb-item active"><a href="#">All Boats</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Column selectors table -->
            <section id="column-selectors">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h4 class="card-title">All Boats</h4>
                    </div>
                    <div class="col-lg-6">
                        <form id="adminFilterUrl" action="{{route ('admin.module.boat.search', ["All Data"]) }}" method="get">@csrf
                            <div class="row justify-content-end">
                                <div class="col-lg-6 form-group">
                                    <input type="text" class="form-control" id="search" placeholder="search by Boat name">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <button type="submit" class="btn btn-primary" id="btnFilter"> <i class="fa fa-search"></i> Search </button>
                                </div>
                                <div class="col-lg-3 form-group">
                                    <a href="{{route ('admin.module.boat.create') }}" class="btn btn-info">Create New Boat</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <p class="font-italic text-right">Found {{$datas->total()}} items</p>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Name</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (sizeof ($datas) > 0)
                                                <?php $count = 1; ?>
                                                    @foreach ($datas as $data)
                                                        <tr>
                                                            <td>{{$datas ->perPage()*($datas->currentPage()-1)+$count}}</td>
                                                            <td>
                                                                @if ($data->is_feature == 1)
                                                                    <span class="badge feature-item">Featured</span>
                                                                @endif
                                                                {{$data->name}}
                                                            </td>
                                                            <td>
                                                                @if ($data->location_id)
                                                                    {{$data->location->name}}{{$data->location->parent ? ', ' . $data->location->parentName->name : ''}}
                                                                @endif
                                                            </td>
                                                            <td><span class="badge @if($data->status == "Draft")draft @elseif($data->status == "Publish")publish @endif">{{$data->status}}</span></td>
                                                            <td>{{App\Helper\DateFormatHelper::dateFormat($data->created_at)}}</td>
                                                            <td>
                                                                <a href="{{ route ('admin.module.boat.edit', ['id'=>$data->id])}}">
                                                                    <button type="button" title="Edit Boat" class="btn btn-primary btn-sm btn-icon">
                                                                    <i class="fa fa-pencil-square"></i></button>
                                                                </a>
                                                                <button type="button" class="btn btn-danger btn-sm btn-icon" title="Delete Boat" 
                                                                    onclick="deleteData('{{ route('admin.module.boat.delete', [$data->id]) }}')">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php $count++; ?>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot class="display-hidden">
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Name</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row mt-1 float-right">
                                        <div class="col-md-12 text-right">
                                            {{$datas->links('pagination::bootstrap-4')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Column selectors table -->
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            const filterUrl = "{{url ('admin/module/boat/search') }}";
            $("#search").keyup(function(){
                var searchFor = $(this).val();
                adminFilterUrlGenerate(filterUrl, searchFor);
            });

        });
    </script>
@endsection