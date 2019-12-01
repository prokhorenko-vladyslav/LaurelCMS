@push('css')
    @css('admin/sidebar.css')
@endpush

<input id="aside-toggle" class="d-none aside-toggle" type="checkbox">
<aside class="aside" style="background-image: url('@imgUrl('backgrounds/sidebar.jpg')')">
    <div class="aside__wrapper">
        <div class="aside__layout"></div>
        <div class="aside__header d-flex justify-content-between">
            <div class="aside__logo">
                @img('logo.png', 'alt')
            </div>
            <div class="aside__toggle">
                <label for="aside-toggle">
                    <span class="aside__toggle__ball"></span>
                </label>
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
                            <a href="#">Dashboard Dashboard1 Dashboard1 Dashboard1</a>
                        </div>
                        <div class="aside__menu__item__status">
                            <div class="aside__status__counter">2</div>
                        </div>
                    </div>
                    <input id="dashboard_1" class="d-none aside__menu__item__checkbox" type="checkbox">
                    <label class="aside__menu__item__toggle" for="dashboard_1"></label>
                    <ul class="aside__submenu">
                       <li class="aside__menu__item">
                           <div class="aside__item__info">
                               <div class="aside__menu__item__icon">
                                   <i class="fas fa-home"></i>
                               </div>
                               <div class="aside__menu__item__title">
                                   <a href="#">Dashboard1</a>
                               </div>
                               <div class="aside__menu__item__status">
                                   <div class="aside__status__counter">10</div>
                               </div>
                           </div>
                       </li>
                        <li class="aside__menu__item">
                            <div class="aside__item__info">
                                <div class="aside__menu__item__icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="aside__menu__item__title">
                                    <a href="#">Dashboard2</a>
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
                                    <a href="#">Dashboard3</a>
                                </div>
                                <div class="aside__menu__item__status"></div>
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
                            <a href="#">Dashboard Dashboard1 Dashboard1 Dashboard1</a>
                        </div>
                        <div class="aside__menu__item__status">
                            <div class="aside__status__counter">2</div>
                        </div>
                    </div>
                    <input id="dashboard_2" class="d-none aside__menu__item__checkbox" type="checkbox">
                    <label class="aside__menu__item__toggle" for="dashboard_2"></label>
                    <ul class="aside__submenu">
                        <li class="aside__menu__item">
                            <div class="aside__item__info">
                                <div class="aside__menu__item__icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="aside__menu__item__title">
                                    <a href="#">Dashboard1</a>
                                </div>
                                <div class="aside__menu__item__status">
                                    <div class="aside__status__counter">10</div>
                                </div>
                            </div>
                        </li>
                        <li class="aside__menu__item">
                            <div class="aside__item__info">
                                <div class="aside__menu__item__icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="aside__menu__item__title">
                                    <a href="#">Dashboard2</a>
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
                                    <a href="#">Dashboard3</a>
                                </div>
                                <div class="aside__menu__item__status"></div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="aside__menu__item">
                    <div class="aside__item__info">
                        <div class="aside__menu__item__icon">
                            <i class="fas fa-tint"></i>
                        </div>
                        <div class="aside__menu__item__title">
                            <a href="#">Color Palette</a>
                        </div>
                        <div class="aside__menu__item__status"></div>
                    </div>
                </li>
                <li class="aside__menu__item">
                    <div class="aside__item__info">
                        <div class="aside__menu__item__icon">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="aside__menu__item__title">
                            <a href="#">Inbox</a>
                        </div>
                        <div class="aside__menu__item__status"></div>
                    </div>
                </li>
                <li class="aside__menu__item">
                    <div class="aside__item__info">
                        <div class="aside__menu__item__icon">
                            <i class="far fa-comments"></i>
                        </div>
                        <div class="aside__menu__item__title">
                            <a href="#">Chat</a>
                        </div>
                        <div class="aside__menu__item__status"></div>
                    </div>
                </li>
                <li class="aside__menu__item">
                    <div class="aside__item__info">
                        <div class="aside__menu__item__icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="aside__menu__item__title">
                            <a href="#">Tasks</a>
                        </div>
                        <div class="aside__menu__item__status"></div>
                    </div>
                </li>
                <li class="aside__menu__item">
                    <div class="aside__item__info">
                        <div class="aside__menu__item__icon">
                            <i class="fas fa-music"></i>
                        </div>
                        <div class="aside__menu__item__title">
                            <a href="#">Player</a>
                        </div>
                        <div class="aside__menu__item__status"></div>
                    </div>
                </li>
                <li class="aside__menu__item">
                    <div class="aside__item__info">
                        <div class="aside__menu__item__icon">
                            <i class="fas fa-cubes"></i>
                        </div>
                        <div class="aside__menu__item__title">
                            <a href="#">UI KIT</a>
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
                            <a href="#">Components</a>
                        </div>
                        <div class="aside__menu__item__status">
                            <div class="aside__status__text">New</div>
                        </div>
                    </div>
                    <input id="components-item" class="d-none aside__menu__item__checkbox" type="checkbox">
                    <label class="aside__menu__item__toggle" for="components-item"></label>
                    <ul class="aside__submenu">
                        <li class="aside__menu__item">
                            <div class="aside__item__info">
                                <div class="aside__menu__item__icon"></div>
                                <div class="aside__menu__item__title">
                                    <a href="#">Forms</a>
                                </div>
                                <div class="aside__menu__item__status">
                                    <div class="aside__status__counter">10</div>
                                </div>
                            </div>
                        </li>
                        <li class="aside__menu__item">
                            <div class="aside__item__info">
                                <div class="aside__menu__item__icon"></div>
                                <div class="aside__menu__item__title">
                                    <a href="#">Buttons</a>
                                </div>
                                <div class="aside__menu__item__status">
                                    <div class="aside__status__counter">10</div>
                                </div>
                            </div>
                        </li>
                        <li class="aside__menu__item">
                            <div class="aside__item__info">
                                <div class="aside__menu__item__icon"></div>
                                <div class="aside__menu__item__title">
                                    <a href="#">Tables</a>
                                </div>
                                <div class="aside__menu__item__status">
                                    <div class="aside__status__counter">10</div>
                                </div>
                            </div>
                        </li>
                        <li class="aside__menu__item">
                            <div class="aside__item__info">
                                <div class="aside__menu__item__icon"></div>
                                <div class="aside__menu__item__title">
                                    <a href="#">Extra</a>
                                </div>
                                <div class="aside__menu__item__status">
                                    <div class="aside__status__counter">10</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</aside>
