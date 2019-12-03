@push('css')
    @css('admin/constructor.css')
@endpush

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
                <div class="content__header__action content__header__action_save">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             width="24" height="24"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M86,14.33333c-39.49552,0 -71.66667,32.17115 -71.66667,71.66667c0,39.49552 32.17115,71.66667 71.66667,71.66667c39.49552,0 71.66667,-32.17115 71.66667,-71.66667c0,-39.49552 -32.17115,-71.66667 -71.66667,-71.66667zM86,28.66667c31.74921,0 57.33333,25.58412 57.33333,57.33333c0,31.74921 -25.58412,57.33333 -57.33333,57.33333c-31.74921,0 -57.33333,-25.58412 -57.33333,-57.33333c0,-31.74921 25.58412,-57.33333 57.33333,-57.33333zM78.83333,50.16667v28.66667h-28.66667v14.33333h28.66667v28.66667h14.33333v-28.66667h28.66667v-14.33333h-28.66667v-28.66667z"></path></g></g></svg>
                        Save
                    </button>
                </div>
                <div class="content__header__action content__header__action_save-and-back">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             width="50" height="50"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M37.84,0c-1.76128,0 -3.52277,0.67231 -4.86437,2.01563l-30.96,30.96c-2.68664,2.68664 -2.68664,7.04211 0,9.72875l30.96,30.96c1.3416,1.34504 3.10309,2.01563 4.86437,2.01563c1.76128,0 3.52277,-0.67058 4.86437,-2.01563c2.68664,-2.68664 2.68664,-7.04211 0,-9.72875l-19.21562,-19.21563h86.59125c26.56024,0 48.16,21.6032 48.16,48.16c0,26.56024 -21.59976,48.16 -48.16,48.16h-48.16h-3.44h-58.48v13.76h58.48h3.44h51.6v-0.17469c32.53894,-1.80107 58.48,-28.76434 58.48,-61.74531c0,-32.37772 -24.99305,-58.98298 -56.69281,-61.65125c-0.57425,-0.15556 -1.16394,-0.26875 -1.78719,-0.26875h-90.03125l19.21562,-19.21563c2.68664,-2.68664 2.68664,-7.04211 0,-9.72875c-1.3416,-1.34332 -3.10309,-2.01562 -4.86437,-2.01562z"></path></g></g></svg>
                        Save and back
                    </button>
                </div>
                <div class="content__header__action content__header__action_cancel">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             width="50" height="50"
                             viewBox="0 0 172 172"
                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M31.4975,21.715l-9.7825,9.7825l54.5025,54.5025l-54.825,54.9325l9.675,9.675l54.9325,-54.825l54.825,54.825l9.7825,-9.7825l-54.825,-54.825l54.5025,-54.5025l-9.7825,-9.7825l-54.5025,54.5025z"></path></g></g></svg>
                        Cancel
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
                <h2>Page constructor</h2>
                <div class="constructor container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="constructor__item constructor__header">
                                <div class="constructor__item__title">Header</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="constructor__item">
                                <div class="constructor__item__title">Sidebar</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="constructor__item">
                                <div class="constructor__item__title">Main</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="constructor__item">
                                <div class="constructor__item__title">Footer</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="constructor__item constructor__item_add">
                                <div class="constructor__item__title">Add new row</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="data card">
            <div class="data__header">
                <h2>Additional parameters</h2>
            </div>
            <div class="data__aditional">
                additional
            </div>
        </div>
    </div>
</div>

@include('admin.sidebars.edit')
@include('admin.sidebars.blocks')
