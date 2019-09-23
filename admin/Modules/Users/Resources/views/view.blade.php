@extends('layouts.admin_default')
@section('title', 'Create post')
@section('content')
    <section class="content-header">
        <h1>
            Edit product
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>Admin home</a></li>
            <li><a href="{{ route('product.index') }}">List product</a></li>
            <li class="active">Edit product</li>
        </ol>
    </section>
    <section class="content">
        <div id="page-wrapper">
            <div class="page-content">

                <!-- begin PAGE TITLE ROW -->
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="portlet portlet-default">
                                <div style="margin-left: 25px">
                                    <div class="portlet-body">

                                            <div class="box-body" id="overview">

                                                <div class="row">
                                                    <div class="col-lg-2 col-md-3">
                                                        <img class="img-responsive img-profile img-thumbnail"
                                                             src="{{ asset('image/category/download.png') }}" alt="">

                                                        <div class="list-group" style="margin-top: 15px">
                                                            <a href="#" class="list-group-item active">Overview</a>
                                                            <a href="#" class="list-group-item">Messages<span style="background: green"
                                                                                                              class="badge green">4</span></a>
                                                            <a href="#" class="list-group-item">Alerts<span style="background: orange"
                                                                                                            class="badge orange">9</span></a>
                                                            <a href="#" class="list-group-item">Orders<span style="background: blue"
                                                                    class="badge blue">{{ count($items) }}</span></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 col-md-5">
                                                        <h1>
                                                            @if(empty($user->name))
                                                                {{ $user->firstname." ".$user->lastname }}
                                                            @else
                                                                {{ $user->name }}
                                                            @endif
                                                        </h1>
                                                        <p>deptrai...</p>
                                                        <ul class="list-inline">
                                                            <li><i class="fa fa-map-marker fa-muted"></i> {{ $user->address }}
                                                            </li>
                                                            <li><i class="fa fa-user fa-muted"></i>
                                                                @if(empty($user->name))
                                                                    {{ $user->firstname." ".$user->lastname }}
                                                                @else
                                                                    {{ $user->name }}
                                                                @endif
                                                            </li>
                                                            <li><i class="fa fa-phone fa-muted"></i> {{ $user->phone }}
                                                            </li>
                                                            <li><i class="fa fa-calendar fa-muted"></i> Member Since:
                                                                {{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}
                                                            </li>
                                                        </ul>
                                                        <h3>Recent Sales</h3>
                                                        <div class="table-responsive box-body no-padding"
                                                             style="border: 1px solid black">
                                                            <table class="table table-hover table-bordered table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Time</th>
                                                                    <th>Amount</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if(!empty($items))
                                                                    @foreach($items as $item)
                                                                        <tr>
                                                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('H:s') }}</td>
                                                                            <td>{{ number_format($item->total_price) }}</td>
                                                                            <td>
                                                                                <a href="{{ route('order.view', $item->order_id) }}">
                                                                                    <?php echo \Modules\Orders\Entities\Orders::genStatusHtml($item->status) ?>
                                                                                </a>

                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <h3>Contact Details</h3>
                                                        <p><i class="fa fa-globe fa-muted fa-fw"></i> <a href="#">http://www.website.com</a>
                                                        </p>
                                                        <p>
                                                            {{--<i class="fa fa-phone fa-muted fa-fw"></i> {{$member->phonenumber}}--}}
                                                        </p>
                                                        <p>
                                                            {{--<i class="fa fa-building-o fa-muted fa-fw"></i> {{$member->address}}--}}
                                                        {{--<p><i class="fa fa-envelope-o fa-muted fa-fw"></i> <a--}}
                                                                {{--href="#">{{$member->email}}</a>--}}
                                                        {{--</p>--}}
                                                        <ul class="list-inline">
                                                            <li><a class="facebook-link" href="#"><i
                                                                        class="fa fa-facebook-square fa-2x"></i></a>
                                                            </li>
                                                            <li><a class="twitter-link" href="#"><i
                                                                        class="fa fa-twitter-square fa-2x"></i></a>
                                                            </li>
                                                            <li><a class="linkedin-link" href="#"><i
                                                                        class="fa fa-linkedin-square fa-2x"></i></a>
                                                            </li>
                                                            <li><a class="google-plus-link" href="#"><i
                                                                        class="fa fa-google-plus-square fa-2x"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('admin-lte/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{asset('js/tinymceConfig.js')}}"></script>
    <script src="{{asset('js/news_posts.js?v=1')}}"></script>

    <script>

    </script>

@endsection
