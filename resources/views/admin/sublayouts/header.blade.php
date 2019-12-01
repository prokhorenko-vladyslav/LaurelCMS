@push('css')
    @css('admin/header.css')
@endpush

<header class="header">
    <div class="search">
        @inputText('search__input', 'search__input form-control-position', 'search__value', 'Search')
        <span class="search__icon">
            <i class="fas fa-search"></i>
        </span>
    </div>
    <div class="menu">
        <div class="menu__item menu__item_fullscreen">
            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
        </div>
        <div class="menu__item menu__item_localization has-popup">
            <i class="fa fa-flag-o dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu dropdown-menu-right localization__dropdown">
                <a class="dropdown-item" href="#">
                    <img class="dropdown-item__flag" src="https://img.icons8.com/color/48/000000/usa-circular.png">
                    English
                </a>
                <a class="dropdown-item" href="#">
                    <img class="dropdown-item__flag" src="https://img.icons8.com/color/48/000000/russian-federation-circular.png">
                    Russian
                </a>
                <a class="dropdown-item" href="#">
                    <img class="dropdown-item__flag" src="https://img.icons8.com/color/48/000000/ukraine-circular.png">
                    Ukrainian
                </a>
            </div>
        </div>
        <div class="menu__item menu__item_notifications has-popup has-counter">
            <i class="fa fa-bell-o dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu dropdown-menu-right notification__dropdown">
                <div class="notification__dropdown__content">
                    <a class="dropdown-item dropdown-item__notification dropdown-item__notification_message" href="#">
                        <i class="fa fa-bell-o"></i>
                        <span class="notification__content">
                            <span class="notification__header">New Order Received</span>
                            <span class="notification__description">Lorem ipsum dolor sit ametitaque in, et!</span>
                        </span>
                    </a>
                    <a class="dropdown-item dropdown-item__notification dropdown-item__notification_warning" href="#">
                        <i class="fa fa-bell-o"></i>
                        <span class="notification__content">
                            <span class="notification__header">New User Registered</span>
                            <span class="notification__description">Lorem ipsum dolor sit ametitaque in, et!</span>
                        </span>
                    </a>
                    <a class="dropdown-item dropdown-item__notification dropdown-item__notification_error" href="#">
                        <i class="fa fa-bell-o"></i>
                        <span class="notification__content">
                            <span class="notification__header">New Order Received</span>
                            <span class="notification__description">Lorem ipsum dolor sit ametitaque in, et!</span>
                        </span>
                    </a>
                    <a class="dropdown-item dropdown-item__notification dropdown-item__notification_success" href="#">
                        <i class="fa fa-bell-o"></i>
                        <span class="notification__content">
                            <span class="notification__header">New User Registered</span>
                            <span class="notification__description">Lorem ipsum dolor sit ametitaque in, et!</span>
                        </span>
                    </a>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item dropdown-item__notifications-all" href="#">Read all notifications</a>
            </div>
            <span class="counter">+99</span>
        </div>
        <div class="menu__item menu__item_account has-popup">
            <i class="fa fa-user-o dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu dropdown-menu-right account__dropdown">
                <a class="dropdown-item" href="#">
                    <img class="dropdown-item__flag" src="https://img.icons8.com/color/48/000000/usa-circular.png">
                    English
                </a>
                <a class="dropdown-item" href="#">
                    <img class="dropdown-item__flag" src="https://img.icons8.com/color/48/000000/russian-federation-circular.png">
                    Russian
                </a>
                <a class="dropdown-item" href="#">
                    <img class="dropdown-item__flag" src="https://img.icons8.com/color/48/000000/ukraine-circular.png">
                    Ukrainian
                </a>
            </div>
        </div>
        <div class="menu__item menu__item_server-info">
            <i class="fa fa-align-left" aria-hidden="true"></i>
        </div>
    </div>
</header>
