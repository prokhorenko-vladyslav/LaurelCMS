@push('css')
    @css('admin/sidebar.css')
@endpush

<aside clas="aside">
    <div class="aside__header d-flex">
        <div class="aside__logo">
            @img('logo.png', 'alt')
        </div>
        <div class="aside__toggle">
            <i class="fas fa-toggle-off"></i>
        </div>
    </div>
    <div class="aside__content">
        <ul class="aside__menu">
            <li class="aside__menu__item">
                <div class="aside__item__info">
                    <div class="aside__menu__item__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="aside__menu__item__title">
                        Dashboard
                    </div>
                    <div class="aside__menu__item__status">
                        <div class="aside__status__counter">2</div>
                    </div>
                </div>
                <input id="dashboard_1" class="d-none aside__menu__item__checkbox" type="checkbox">
                <label class="aside__menu__item__toggle" for="dashboard_1">
                    +
                </label>
                <ul class="aside__submenu">
                   <li class="aside__submenu__item">
                       <div class="aside__item__info">
                           <div class="aside__submenu__item__icon"></div>
                           <div class="aside__submenu__item__title">Dashboard1</div>
                           <div class="aside__submenu__item__status">
                               <div class="aside__status__counter">10</div>
                           </div>
                       </div>
                   </li>
                    <li class="aside__submenu__item">
                        <div class="aside__item__info">
                            <div class="aside__submenu__item__icon"></div>
                            <div class="aside__submenu__item__title">Dashboard2</div>
                            <div class="aside__submenu__item__status"></div>
                        </div>
                    </li>
                    <li class="aside__submenu__item">
                        <div class="aside__item__info">
                            <div class="aside__submenu__item__icon"></div>
                            <div class="aside__submenu__item__title">Dashboard3</div>
                            <div class="aside__submenu__item__status"></div>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="aside__menu__item">
                <div class="aside__item__info">
                    <div class="aside__menu__item__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="aside__menu__item__title">
                        Color Palette
                    </div>
                    <div class="aside__menu__item__status"></div>
                </div>
            </li>
            <li class="aside__menu__item">
                <div class="aside__item__info">
                    <div class="aside__menu__item__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="aside__menu__item__title">
                        Inbox
                    </div>
                    <div class="aside__menu__item__status"></div>
                </div>
            </li>
            <li class="aside__menu__item">
                <div class="aside__item__info">
                    <div class="aside__menu__item__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="aside__menu__item__title">
                        Chat
                    </div>
                    <div class="aside__menu__item__status"></div>
                </div>
            </li>
            <li class="aside__menu__item">
                <div class="aside__item__info">
                    <div class="aside__menu__item__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="aside__menu__item__title">
                        Tasks
                    </div>
                    <div class="aside__menu__item__status"></div>
                </div>
            </li>
            <li class="aside__menu__item">
                <div class="aside__item__info">
                    <div class="aside__menu__item__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="aside__menu__item__title">
                        Player
                    </div>
                    <div class="aside__menu__item__status"></div>
                </div>
            </li>
            <li class="aside__menu__item">
                <div class="aside__item__info">
                    <div class="aside__menu__item__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="aside__menu__item__title">
                        UI KIT
                    </div>
                    <div class="aside__menu__item__status"></div>
                </div>
            </li>
            <li class="aside__menu__item">
                <div class="aside__item__info">
                    <div class="aside__menu__item__icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="aside__menu__item__title">
                        Components
                    </div>
                    <div class="aside__menu__item__status">
                        <div class="aside__status__text">New</div>
                    </div>
                </div>
                <input class="d-none aside__menu__item__checkbox" type="checkbox">
                <label class="aside__menu__item__toggle">
                    +
                </label>
                <ul class="aside__submenu">
                    <li class="aside__submenu__item">
                        <div class="aside__item__info">
                            <div class="aside__submenu__item__icon"></div>
                            <div class="aside__submenu__item__title">Forms</div>
                            <div class="aside__submenu__item__status">
                                <div class="aside__status__counter">10</div>
                            </div>
                        </div>
                    </li>
                    <li class="aside__submenu__item">
                        <div class="aside__item__info">
                            <div class="aside__submenu__item__icon"></div>
                            <div class="aside__submenu__item__title">Buttons</div>
                            <div class="aside__submenu__item__status">
                                <div class="aside__status__counter">10</div>
                            </div>
                        </div>
                    </li>
                    <li class="aside__submenu__item">
                        <div class="aside__item__info">
                            <div class="aside__submenu__item__icon"></div>
                            <div class="aside__submenu__item__title">Tables</div>
                            <div class="aside__submenu__item__status">
                                <div class="aside__status__counter">10</div>
                            </div>
                        </div>
                    </li>
                    <li class="aside__submenu__item">
                        <div class="aside__item__info">
                            <div class="aside__submenu__item__icon"></div>
                            <div class="aside__submenu__item__title">Extra</div>
                            <div class="aside__submenu__item__status">
                                <div class="aside__status__counter">10</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
