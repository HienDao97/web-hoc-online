<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  text-center" style="z-index: 999">
                @php
                    $currentRouteName = request()->route()->getName();
                    //dd($backend_menus)
                @endphp
                @foreach($backend_menus as $menu)
                    @if($menu['scroll'] == 1)
                        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link scroll" href="#{{ $menu['id'] }}">{{ $menu['name'] }}</a>
                        </li>
                    @else

                        <li class="nav-item  mt-lg-0 mt-3">
                            <a class="nav-link <?php echo (in_array($currentRouteName, $menu['route_name']))? "active" : ""?>" href="{{ route($menu['root_route']) }}" >{{ $menu['name'] }}</a>
                        </li>

                    @endif
                @endforeach
                @if(!empty(Auth::user()->id))
                    <li class="nav-item  mt-lg-0 mt-3">
                        <a class="nav-link <?php echo ($currentRouteName == "student.index")? "active" : ""?>" href="{{ route('student.index', Auth::user()->id) }}" >Trang cá nhân</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
