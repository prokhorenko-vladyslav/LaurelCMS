<div class="row">
    <div class="col-md-12">
        <div class="content__header">
            <div class="content__header__info">
                <h1 class="content__title">Extended Tables</h1>
                <div class="content__description">
                    Tables with some actions and with more feathers
                </div>
            </div>
            <div class="content__header__actions">
                <div class="content__header__action content__header__action_create">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             width="24" height="24"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M86,14.33333c-39.49552,0 -71.66667,32.17115 -71.66667,71.66667c0,39.49552 32.17115,71.66667 71.66667,71.66667c39.49552,0 71.66667,-32.17115 71.66667,-71.66667c0,-39.49552 -32.17115,-71.66667 -71.66667,-71.66667zM86,28.66667c31.74921,0 57.33333,25.58412 57.33333,57.33333c0,31.74921 -25.58412,57.33333 -57.33333,57.33333c-31.74921,0 -57.33333,-25.58412 -57.33333,-57.33333c0,-31.74921 25.58412,-57.33333 57.33333,-57.33333zM78.83333,50.16667v28.66667h-28.66667v14.33333h28.66667v28.66667h14.33333v-28.66667h28.66667v-14.33333h-28.66667v-28.66667z"></path></g></g></svg>
                        Create
                    </button>
                </div>
            </div>
        </div>
        <div class="data card">
            <div class="data__localization">
                <button class="data__localization__item active">En</button>
                <button class="data__localization__item">Ru</button>
                <button class="data__localization__item">Ua</button>
            </div>
            <div class="data__header">
                <h2>Action buttons</h2>
            </div>
            <div class="data__search">
                <input class="search__input form-control" type="text" placeholder="Type to search...">
                <button class="search__button btn btn-primary">Search</button>
            </div>
            <div class="data__content">
                <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Is banned</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="data__filter">
                        <td class="data__filter__number">
                            <input class="form-control" type="text" placeholder="ID">
                        </td>
                        <td class="data__filter__checkbox">
                            <input class="form-control" type="checkbox" placeholder="Is banned">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Yes
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">Yes</button>
                                    <button class="dropdown-item" type="button">No</button>
                                </div>
                            </div>
                        </td>
                        <td class="data__filter__text">
                            <input class="form-control" type="text" placeholder="First Name">
                        </td>
                        <td class="data__filter__text">
                            <input class="form-control" type="text" placeholder="Last name">
                        </td>
                        <td class="data__filter__checkbox">
                            <input class="form-control" type="checkbox" placeholder="Gender">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Male
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">Male</button>
                                    <button class="dropdown-item" type="button">Female</button>
                                </div>
                            </div>
                        </td>
                        <td class="data__filter__text">
                            <input class="form-control" type="text" placeholder="Email">
                        </td>
                        {{--Изменяем число rowspan в зависимости от количества фильтров--}}
                        <td class="data__filter__actions" rowspan="2">
                            <button class="data__filter__action data__filter__action_add">Add Filter</button>
                            <button class="data__filter__action data__filter__action_filter">Filter</button>
                        </td>
                    </tr>
                    <tr class="data__filter">
                        <td class="data__filter__number">
                            <input class="form-control" type="text" placeholder="ID">
                        </td>
                        <td class="data__filter__checkbox">
                            <input class="form-control" type="checkbox" placeholder="Is banned">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Yes
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">Yes</button>
                                    <button class="dropdown-item" type="button">No</button>
                                </div>
                            </div>
                        </td>
                        <td class="data__filter__text">
                            <input class="form-control" type="text" placeholder="First Name">
                        </td>
                        <td class="data__filter__text">
                            <input class="form-control" type="text" placeholder="Last name">
                        </td>
                        <td class="data__filter__checkbox">
                            <input class="form-control" type="checkbox" placeholder="Gender">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Male
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">Male</button>
                                    <button class="dropdown-item" type="button">Female</button>
                                </div>
                            </div>
                        </td>
                        <td class="data__filter__text">
                            <input class="form-control" type="text" placeholder="Email">
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>No</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>No</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>Yes</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>No</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>No</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>No</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>No</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>No</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>No</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="data__row">
                        <td>1</td>
                        <td>No</td>
                        <td>John</td>
                        <td>Carter</td>
                        <td>Male</td>
                        <td>johncarter@mail.com</td>
                        <td class="actions">
                            <div class="action show">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="action edit">
                                <a href="/dashboard/edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                            <div class="action delete">
                                <i class="fas fa-times"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="data__pagination">
            <div class="pagination__item">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="50" height="50"
                         viewBox="0 0 172 172"
                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#009da0"><path d="M96.25281,13.73313c-0.90031,0.01344 -1.74688,0.38969 -2.365,1.03469l-71.23219,71.23219l71.23219,71.23219c0.86,0.90031 2.15,1.26313 3.34594,0.94063c1.20938,-0.30906 2.15,-1.24969 2.45906,-2.45906c0.3225,-1.19594 -0.04031,-2.48594 -0.94063,-3.34594l-66.36781,-66.36781l66.36781,-66.36781c1.02125,-0.99437 1.31688,-2.49937 0.76594,-3.80281c-0.55094,-1.31688 -1.84094,-2.15 -3.26531,-2.09625zM140.97281,13.73313c-0.90031,0.01344 -1.74688,0.38969 -2.365,1.03469l-71.23219,71.23219l71.23219,71.23219c0.86,0.90031 2.15,1.26313 3.34594,0.94063c1.20938,-0.30906 2.15,-1.24969 2.45906,-2.45906c0.3225,-1.19594 -0.04031,-2.48594 -0.94063,-3.34594l-66.36781,-66.36781l66.36781,-66.36781c1.02125,-0.99437 1.31688,-2.49937 0.76594,-3.80281c-0.55094,-1.31688 -1.84094,-2.15 -3.26531,-2.09625z"></path></g></g></svg>
                </a>
            </div>
            <div class="pagination__item">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="50" height="50"
                         viewBox="0 0 172 172"
                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#009da0"><path d="M120.33281,13.73313c-0.90031,0.01344 -1.74688,0.38969 -2.365,1.03469l-68.8,68.8c-1.34375,1.34375 -1.34375,3.52062 0,4.86437l68.8,68.8c0.86,0.90031 2.15,1.26313 3.34594,0.94063c1.20938,-0.30906 2.15,-1.24969 2.45906,-2.45906c0.3225,-1.19594 -0.04031,-2.48594 -0.94063,-3.34594l-66.36781,-66.36781l66.36781,-66.36781c1.02125,-0.99437 1.31688,-2.49937 0.76594,-3.80281c-0.55094,-1.31688 -1.84094,-2.15 -3.26531,-2.09625z"></path></g></g></svg>
                </a>
            </div>
            <div class="pagination__item">
                <a href="#">1</a>
            </div>
            <div class="pagination__item active">
                <a href="#">2</a>
            </div>
            <div class="pagination__item">
                <a href="#">3</a>
            </div>
            <div class="pagination__item">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="50" height="50"
                         viewBox="0 0 172 172"
                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#009da0"><path d="M51.55969,13.73313c-1.3975,0 -2.64719,0.84656 -3.18469,2.13656c-0.52406,1.30344 -0.215,2.78156 0.79281,3.7625l66.36781,66.36781l-66.36781,66.36781c-0.90031,0.86 -1.26313,2.15 -0.94063,3.34594c0.30906,1.20938 1.24969,2.15 2.45906,2.45906c1.19594,0.3225 2.48594,-0.04031 3.34594,-0.94063l68.8,-68.8c1.34375,-1.34375 1.34375,-3.52062 0,-4.86437l-68.8,-68.8c-0.645,-0.67188 -1.53187,-1.03469 -2.4725,-1.03469z"></path></g></g></svg>
                </a>
            </div>
            <div class="pagination__item">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="50" height="50"
                         viewBox="0 0 172 172"
                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#009da0"><path d="M30.93313,13.73313c-1.41094,0 -2.66063,0.84656 -3.19813,2.13656c-0.52406,1.30344 -0.215,2.78156 0.79281,3.7625l66.36781,66.36781l-66.36781,66.36781c-0.90031,0.86 -1.26313,2.15 -0.94063,3.34594c0.30906,1.20938 1.24969,2.15 2.45906,2.45906c1.19594,0.3225 2.48594,-0.04031 3.34594,-0.94063l71.23219,-71.23219l-71.23219,-71.23219c-0.645,-0.67188 -1.53187,-1.03469 -2.45906,-1.03469zM75.63969,13.73313c-1.3975,0 -2.64719,0.84656 -3.18469,2.13656c-0.52406,1.30344 -0.215,2.78156 0.79281,3.7625l66.36781,66.36781l-66.36781,66.36781c-0.90031,0.86 -1.26313,2.15 -0.94063,3.34594c0.30906,1.20938 1.24969,2.15 2.45906,2.45906c1.19594,0.3225 2.48594,-0.04031 3.34594,-0.94063l71.23219,-71.23219l-71.23219,-71.23219c-0.645,-0.67188 -1.53187,-1.03469 -2.4725,-1.03469z"></path></g></g></svg>
                </a>
            </div>
        </div>
    </div>
</div>
