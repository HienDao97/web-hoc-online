<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
        <div class="pull-left image">
            <?php $avatar = (!empty(Auth::user()->avatar) ? Auth::user()->avatar : "logo.jpg") ?>
            <img src="image/admin/{{$avatar}}" height="40px" width="100px" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>Admin {{env('APP_NAME')}}</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- search form (Optional)
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
            <a href="{{ route('admin_home') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('student.index') }}">
                <i class="fa fa-users"></i> <span>Student</span>
            </a>
        </li>
        <li class="treeview" onclick="return active(this)">
            <a href="{{ route('course.index') }}">
                <i class="fa fa-mobile-phone"></i> <span>Course</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ route('course.index') }}"><i class="fa fa-mobile-phone"></i>Course</a></li>
                <li><a href="{{ route('classroom.index') }}"><i class="fa fa-mobile-phone"></i>Classroom</a></li>
                <li><a href="{{ route('theory.index') }}"><i class="fa fa-mobile-phone"></i>Theory</a></li>
                <li><a href="{{ route('exercise.index') }}"><i class="fa fa-mobile-phone"></i>Exercise</a></li>
            </ul>
        </li>

    </ul>
    <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
@section('scripts')
    <script type="text/javascript">
        function active(_this) {
            if($(_this).has("active")){
                $(_this).removeClass("active");
            }else{
                $(_this).addClass("active");
            }
        }
    </script>
@endsection


