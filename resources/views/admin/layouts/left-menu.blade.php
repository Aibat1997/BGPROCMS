<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/subscription" aria-expanded="false"><i class="mdi mdi-code-not-equal"></i><span class="hide-menu">Подписка</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/archive" aria-expanded="false"><i class="mdi mdi-archive"></i><span class="hide-menu">Архив</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/role" aria-expanded="false"><i class="mdi mdi-account-star-variant"></i><span class="hide-menu">Роль Пользователей</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/menu" aria-expanded="false"><i class="mdi mdi-menu"></i><span class="hide-menu">Меню</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/banner" aria-expanded="false"><i class="mdi mdi-file-image"></i><span class="hide-menu">Баннер</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/slider" aria-expanded="false"><i class="mdi mdi-teamviewer"></i><span class="hide-menu">Слайдер</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/pages" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Статичные страницы</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/news" aria-expanded="false"><i class="mdi mdi-newspaper"></i><span class="hide-menu">Новости</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/position" aria-expanded="false"><i class="mdi mdi-format-float-center"></i><span class="hide-menu">Позиции новостей</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/rubric" aria-expanded="false"><i class="mdi mdi-apps"></i><span class="hide-menu">Рубрика</span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="/admin/users" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Пользователи</span></a>
                </li>
                <li class="nav-item dropdown">
                    @if (\Request::session()->get('lang') == 'ru')
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-ru"> </span>Русский</a>
                    @elseif(\Request::session()->get('lang') == 'kz')
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-kz"> </span>Казахсикй</a>
                    @else
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> </span>Английский</a>
                    @endif
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                        <a class="dropdown-item" href="/lang/ru"><span class="flag-icon flag-icon-ru"> </span>Русский</a>
                        <a class="dropdown-item" href="/lang/kz"><span class="flag-icon flag-icon-kz"> </span>Казахсикй</a>
                        <a class="dropdown-item" href="/lang/en"><span class="flag-icon flag-icon-us"> </span>Английский</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    @if (\Request::session()->get('country') == 'ru')
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-ru"> </span></a>
                    @elseif(\Request::session()->get('country') == 'kz')
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-kz"> </span></a>
                    @else
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> </span></a>
                    @endif
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                        <a class="dropdown-item" href="/country/ru"><span class="flag-icon flag-icon-ru"> </span></a>
                        <a class="dropdown-item" href="/country/kz"><span class="flag-icon flag-icon-kz"> </span></a>
                        <a class="dropdown-item" href="/country/en"><span class="flag-icon flag-icon-us"> </span></a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
    <div class="sidebar-footer">
        <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <a href="{{ route('logout') }}" class="link" data-toggle="tooltip" title="Logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="mdi mdi-power"></i>
        </a> 

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>