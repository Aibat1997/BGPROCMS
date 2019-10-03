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