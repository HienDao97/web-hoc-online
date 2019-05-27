<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  text-center">
                @php
                    $currentRouteName = request()->route()->getName();
                    //dd($currentRouteName)
                @endphp
                @foreach($backend_menus as $menu)
                    @if($menu['scroll'] == 1)
                        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link scroll" href="#{{ $menu['id'] }}">{{ $menu['name'] }}</a>
                        </li>
                    @else
                        @if($menu['name'] == "Khoá học")
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                               {{ $menu['name'] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($course_menus as $menu)
                                    <a class="dropdown-item scroll" href="#lop{{ $menu->id }}">{{ $menu->name }}</a>
                                @endforeach
                            </div>
                        @else
                            <li class="nav-item  mt-lg-0 mt-3">
                                <a class="nav-link <?php echo ($currentRouteName == $menu['route_name'])? "active" : ""?>" href="{{ route($menu['route_name']) }}" >{{ $menu['name'] }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
</div>
