var elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;

//reset all folder paths
elixir.config.assetsPath = '';
elixir.config.publicPath = 'public/assets';
elixir.config.css.sass.folder = '';
elixir.config.css.folder = '';
elixir.config.js.folder = '';

var resourcesAssets = 'resources/assets/';
var components = 'resources/assets/components/';
var vendors = 'resources/assets/vendors/';

//destination path configuration
var dest = 'public/assets/';
//var destImg = dest + 'img/';
//var destImages = dest + 'images/';

var devModules = {
    frontend: ['device'],
    test: []
};


/**====vendors resource file path===========================*/
var myResource = {
    myGeneralSass: resourcesAssets + 'myCustom/myGeneral.sass',
    myRWDSass: resourcesAssets + 'myCustom/myRWD.sass'
};

/**====vendors resource file path===========================*/
var vendorsResource = {
    dropzone: {
        css: vendors + 'dropzone/dropzone4.2.0.css',
        js: vendors + 'dropzone/dropzone4.2.0.js',
        mySinglePhotoJs: vendors + 'dropzone/mySinglePhotoDropZoneControl.js'
    },
    jquery: {
        js: vendors + 'jquery/jquery.min.js'
    },
    fontAwesome: {
        css: vendors + 'font-awesome/font-awesome.min.css'
    },
    metisMenu: {
        css: vendors + 'metisMenu/metisMenu.min.css',
        js: vendors + 'metisMenu/metisMenu.min.js'
    },
    bootstrap: {
        css: vendors + 'bootstrap/css/bootstrap.min.css',
        js: vendors + 'bootstrap/js/bootstrap.min.js'
    },
    vue: {js: vendors + 'vue/vue2.0.js'},
    vueRouter: {js: vendors + 'vue/vueRouter2.1.0.js'},
    vueResource: {js: vendors + 'vue/vueResource1.0.3.js'}
};

/**====Auth Section===========================*/
//elixir(function (mix) {
//
//    mix.sass(
//        'resources/assets/auth/appAuth.sass',
//        'resources/assets/auth/appAuth.css');
//    mix.styles([
//            'resources/assets/auth/bootstrap.min.css',
//            'resources/assets/auth/appAuth.css',
//        ],
//        'public/assets/auth/appAuth.css'
//    );
//});
/**====Auth Section===========================*/



/**====Frontend Section===========================*/
/**====frontend resource and  public/destination  file path===========================*/
var frontendResource = {
    appCustom: {
        sass: resourcesAssets + 'frontend/app/appCustom.sass',
        css: resourcesAssets + 'frontend/app/appCustom.css',
        js: resourcesAssets + 'frontend/app/appCustom.js'
    },

    page: {
        home: {
            sass: resourcesAssets + 'frontend/pages/home/home.sass',
            css: resourcesAssets + 'frontend/pages/home/home.css',
            js_source: resourcesAssets + 'frontend/pages/home/home_source.js',
            js: resourcesAssets + 'frontend/pages/home/home.js'
        },
        devices: {
            show: {
                sass: resourcesAssets + 'frontend/pages/devices/show.sass',
                css: resourcesAssets + 'frontend/pages/devices/show.css',
                js_source: resourcesAssets + 'frontend/pages/devices/show_source.js',
                js: resourcesAssets + 'frontend/pages/devices/show.js'
            },
            create: {
                sass: resourcesAssets + 'frontend/pages/devices/create.sass',
                css: resourcesAssets + 'frontend/pages/devices/create.css',
                js_source: resourcesAssets + 'frontend/pages/devices/create_source.js',
                js: resourcesAssets + 'frontend/pages/devices/create.js'
            },
            edit: {
                sass: resourcesAssets + 'frontend/pages/devices/edit.sass',
                css: resourcesAssets + 'frontend/pages/devices/edit.css',
                js_source: resourcesAssets + 'frontend/pages/devices/edit_source.js',
                js: resourcesAssets + 'frontend/pages/devices/edit.js'
            },
            index: {
                sass: resourcesAssets + 'frontend/pages/devices/index.sass',
                css: resourcesAssets + 'frontend/pages/devices/index.css',
                js_source: resourcesAssets + 'frontend/pages/devices/index_source.js',
                js: resourcesAssets + 'frontend/pages/devices/index.js'
            }
        },
        orgs: {
            show: {
                sass: resourcesAssets + 'frontend/pages/orgs/show.sass',
                css: resourcesAssets + 'frontend/pages/orgs/show.css',
                js_source: resourcesAssets + 'frontend/pages/orgs/show_source.js',
                js: resourcesAssets + 'frontend/pages/orgs/show.js'
            },
            create: {
                sass: resourcesAssets + 'frontend/pages/orgs/create.sass',
                css: resourcesAssets + 'frontend/pages/orgs/create.css',
                js_source: resourcesAssets + 'frontend/pages/orgs/create_source.js',
                js: resourcesAssets + 'frontend/pages/orgs/create.js'
            },
            edit: {
                sass: resourcesAssets + 'frontend/pages/orgs/edit.sass',
                css: resourcesAssets + 'frontend/pages/orgs/edit.css',
                js_source: resourcesAssets + 'frontend/pages/orgs/edit_source.js',
                js: resourcesAssets + 'frontend/pages/orgs/edit.js'
            },
            index: {
                sass: resourcesAssets + 'frontend/pages/orgs/index.sass',
                css: resourcesAssets + 'frontend/pages/orgs/index.css',
                js_source: resourcesAssets + 'frontend/pages/orgs/index_source.js',
                js: resourcesAssets + 'frontend/pages/orgs/index.js'
            }
        },
        account: {
            sass: resourcesAssets + 'frontend/pages/account/account.sass',
            css: resourcesAssets + 'frontend/pages/account/account.css',
            js_source: resourcesAssets + 'frontend/pages/account/account_source.js',
            js: resourcesAssets + 'frontend/pages/account/account.js'
        },
        test: {
            sass: resourcesAssets + 'frontend/pages/test/test.sass',
            css: resourcesAssets + 'frontend/pages/test/test.css',
            js_source: resourcesAssets + 'frontend/pages/test/test_source.js',
            js: resourcesAssets + 'frontend/pages/test/test.js'
        }
    }
};


var frontendPublic = {
    app: {
        css: dest + 'frontend/app.css',
        js: dest + 'frontend/app.js'

    },
    devices: {
        show: {
            css: dest + 'frontend/devices/show.css',
            js: dest + 'frontend/devices/show.js'
        },
        create: {
            css: dest + 'frontend/devices/create.css',
            js: dest + 'frontend/devices/create.js'
        },
        edit: {
            css: dest + 'frontend/devices/edit.css',
            js: dest + 'frontend/devices/edit.js'
        },
        index: {
            css: dest + 'frontend/devices/index.css',
            js: dest + 'frontend/devices/index.js'
        }
    },
    home: {
        css: dest + 'frontend/home/home.css',
        js: dest + 'frontend/home/home.js'
    },
    account: {
        css: dest + 'frontend/account/account.css',
        js: dest + 'frontend/account/account.js'
    },
    test: {
        css: dest + 'frontend/test/test.css',
        js: dest + 'frontend/test/test.js'
    }
};

/** **Application Frontend CSS and Js Begin*****/
if ((devModules.frontend.indexOf('application')) == (-1)) {
}
else
    elixir(function (mix) {
        // Custom Styles
        mix.sass(
            frontendResource.appCustom.sass,
            frontendResource.appCustom.css
        );

        mix.styles(
            [
                '/resources/assets/vendors/bootstrap/frontend/css/bootstrap.min.css',
                vendorsResource.fontAwesome.css,
                frontendResource.appCustom.css
            ],
            frontendPublic.app.css);

        // all global js files into app.js
        mix.scripts(
            [
                vendorsResource.jquery.js,
                vendorsResource.bootstrap.js,
                vendorsResource.vue.js,
                frontendResource.appCustom.js
            ], frontendPublic.app.js);
    });
/** **Application CSS and Js End*****/

/** *** Home  Begin ****/
if ((devModules.frontend.indexOf('home')) == (-1)) {
}
else
    elixir(function (mix) {
        //index
        mix.sass(
            frontendResource.page.home.sass,
            frontendResource.page.home.css
        );

        mix.styles([
                frontendResource.page.home.css
            ],
            frontendPublic.home.css
        );

        mix.webpack(frontendResource.page.home.js_source,
            frontendResource.page.home.js);

        mix.scripts([
                frontendResource.page.home.js],
            frontendPublic.home.js
        );
    });
/** *** Home  End ****/

/** *** Account  Begin ****/
if ((devModules.frontend.indexOf('account')) == (-1)) {
}
else
    elixir(function (mix) {
        //index
        mix.sass(
            frontendResource.page.account.sass,
            frontendResource.page.account.css
        );

        mix.styles([
                frontendResource.page.account.css
            ],
            frontendPublic.account.css
        );

        mix.webpack(frontendResource.page.account.js_source,
            frontendResource.page.account.js);

        mix.scripts([
                frontendResource.page.account.js],
            frontendPublic.account.js
        );
    });
/** *** Account  End ****/


/** *** Device Begin ****/
if ((devModules.frontend.indexOf('device')) == (-1)) {
}
else
    elixir(function (mix) {
        //create
        mix.sass(
            frontendResource.page.devices.create.sass,
            frontendResource.page.devices.create.css
        );

        mix.styles([
                frontendResource.page.devices.create.css
            ],
            frontendPublic.devices.create.css
        );

        mix.webpack(frontendResource.page.devices.create.js_source,
            frontendResource.page.devices.create.js);

        mix.scripts([
                frontendResource.page.devices.create.js],
            frontendPublic.devices.create.js
        );


        //edit
        mix.sass(
            frontendResource.page.devices.edit.sass,
            frontendResource.page.devices.edit.css
        );

        mix.styles([
                frontendResource.page.devices.edit.css
            ],
            frontendPublic.devices.edit.css
        );

        mix.webpack(frontendResource.page.devices.edit.js_source,
            frontendResource.page.devices.edit.js);

        mix.scripts([
                vendorsResource.vueResource.js,
                frontendResource.page.devices.edit.js
            ],
            frontendPublic.devices.edit.js
        );

        //show
        mix.sass(
            frontendResource.page.devices.show.sass,
            frontendResource.page.devices.show.css
        );

        mix.styles([
                frontendResource.page.devices.show.css
            ],
            frontendPublic.devices.show.css
        );

        mix.webpack(frontendResource.page.devices.show.js_source,
            frontendResource.page.devices.show.js);

        mix.scripts([
                vendorsResource.vueResource.js,
                frontendResource.page.devices.show.js],
            frontendPublic.devices.show.js
        );


        //index
        mix.sass(
            frontendResource.page.devices.index.sass,
            frontendResource.page.devices.index.css
        );

        mix.styles([
                frontendResource.page.devices.index.css
            ],
            frontendPublic.devices.index.css
        );

        mix.webpack(frontendResource.page.devices.index.js_source,
            frontendResource.page.devices.index.js);

        mix.scripts([
                frontendResource.page.devices.index.js],
            frontendPublic.devices.index.js
        );
    });
/** *** Devices End ****/


/** *** Test  Begin ****/
if ((devModules.test.indexOf('test')) == (-1)) {
}
else
    elixir(function (mix) {
        //index
        mix.sass(
            frontendResource.page.test.sass,
            frontendResource.page.test.css
        );

        mix.styles([
                frontendResource.page.test.css
            ],
            frontendPublic.test.css
        );

        mix.webpack(frontendResource.page.test.js_source,
            frontendResource.page.test.js);

        mix.scripts([
                vendorsResource.vueResource.js,
                frontendResource.page.test.js],
            frontendPublic.test.js
        );
    });
/** *** Test End ****/


/**  admin section assets management*/
/**====admin resource and  public/destination  file path===========================*/
//var adminResource = {
//    appCustom: {
//        sass: resourcesAssets + 'admin/app/appCustom.sass',
//        css: resourcesAssets + 'admin/app/appCustom.css',
//        js: resourcesAssets + 'admin/app/appCustom.js'
//    },
//    page: {
//        product: {
//            index: {
//                sass: resourcesAssets + 'admin/pages/product/index.sass',
//                css: resourcesAssets + 'admin/pages/product/index.css',
//                js: resourcesAssets + 'admin/pages/product/index.js'
//            },
//            edit: {
//                sass: resourcesAssets + 'admin/pages/product/edit.sass',
//                css: resourcesAssets + 'admin/pages/product/edit.css',
//                js: resourcesAssets + 'admin/pages/product/edit.js'
//            }
//        },
//        order: {
//            index: {
//                sass: resourcesAssets + 'admin/pages/order/index.sass',
//                css: resourcesAssets + 'admin/pages/order/index.css',
//                js: resourcesAssets + 'admin/pages/order/index.js'
//            }
//        },
//        shops: {
//            index: {
//                sass: resourcesAssets + 'admin/pages/shops/index.sass',
//                css: resourcesAssets + 'admin/pages/shops/index.css',
//                js: resourcesAssets + 'admin/pages/shops/index.js',
//                js_source: resourcesAssets + 'admin/pages/shops/index_source.js'
//            },
//            edit: {
//                sass: resourcesAssets + 'admin/pages/shops/edit.sass',
//                css: resourcesAssets + 'admin/pages/shops/edit.css',
//                js: resourcesAssets + 'admin/pages/shops/edit.js',
//                js_source: resourcesAssets + 'admin/pages/shops/edit_source.js'
//            }
//        },
//    }
//};
//
//
//var adminPublic = {
//    app: {
//        css: dest + 'admin/app.css',
//        js: dest + 'admin/app.js'
//    },
//    product: {
//        index: {
//            css: dest + 'admin/product/index.css',
//            js: dest + 'admin/product/index.js'
//        },
//        edit: {
//            css: dest + 'admin/product/edit.css',
//            js: dest + 'admin/product/edit.js'
//        }
//    },
//    order: {
//        index: {
//            css: dest + 'admin/order/index.css',
//            js: dest + 'admin/order/index.js'
//        },
//    },
//    shops: {
//        index: {
//            css: dest + 'admin/shops/index.css',
//            js: dest + 'admin/shops/index.js'
//        },
//        edit: {
//            css: dest + 'admin/shops/edit.css',
//            js: dest + 'admin/shops/edit.js'
//        }
//    },
//};


/**====Admin Section===========================*/
/** **Application Admin CSS and Js Begin*****/
//elixir.config.assetsPath = '';
//elixir.config.publicPath = '';
//
//elixir.config.css.sass.folder = '';
//elixir.config.css.folder = '';
//elixir.config.js.folder = '';
//
//elixir(function (mix) {
//    // Custom Styles
//    mix.styles(
//        [
//            '/resources/assets/vendors/fonts.css',
//            vendorsResource.bootstrap.css,
//            vendorsResource.fontAwesome.css,
//            '/resources/assets/vendors/panel.css',
//            '/resources/assets/vendors/metisMenu/metisMenu.css',
//            '/resources/assets/vendors/josh/black.css',
//            //'/resources/assets/vendor/josh/white.css',
//            '/resources/assets/admin/app/my.css'
//        ],
//        'public/assets/admin/app.css');
//
//    // all global js files into app.js
//    mix.scripts(
//        [
//            '/resources/assets/vendors/jquery/jquery-1.11.1.min.js',
//            '/resources/assets/vendors/jquery-ui/jquery-ui.min.js',
//            '/resources/assets/vendors/bootstrap/js/bootstrap.min.js',
//            '/resources/assets/vendors/raphael/raphael-min.js',
//            '/resources/assets/vendors/livicons/livicons-1.4.min.js',
//            '/resources/assets/vendors/metisMenu/metisMenu.js',
//            '/resources/assets/vendors/holderjs/holder.min.js',
//            vendorsResource.vue.js,
//            '/resources/assets/vendors/josh/josh.js',
//            '/resources/assets/admin/app/app.js'
//        ], 'public/assets/admin/app.js');
//});
/** **Application CSS and Js End*****/


/** **Product Begin*****/
//elixir(function (mix) {
//    //index
//    mix.sass(
//        adminResource.page.product.index.sass,
//        adminResource.page.product.index.css
//    );
//
//    mix.styles([
//            adminResource.page.product.index.css
//        ],
//        adminPublic.product.index.css
//    );
//
//    mix.scripts([
//            adminResource.page.product.index.js],
//        adminPublic.product.index.js
//    );
//
//
//    //edit
//    mix.sass(
//        adminResource.page.product.edit.sass,
//        adminResource.page.product.edit.css
//    );
//
//    mix.styles([
//            vendorsResource.dropzone.css,
//            adminResource.page.product.edit.css
//        ],
//        adminPublic.product.edit.css
//    );
//
//
//    mix.scripts(
//        [
//            vendorsResource.dropzone.js,
//            vendorsResource.dropzone.myJs,
//            adminResource.page.product.edit.js],
//        adminPublic.product.edit.js
//    );
//});
/** **Product End*****/



/** **Order Begin*****/
//elixir(function (mix) {
//    //index
//    mix.sass(
//        adminResource.page.order.index.sass,
//        adminResource.page.order.index.css
//    );
//
//    mix.styles([
//            adminResource.page.order.index.css
//        ],
//        adminPublic.order.index.css
//    );
//
//    mix.scripts([
//            adminResource.page.order.index.js],
//        adminPublic.order.index.js
//    );
//});
/** **Order End*****/


/** **Shops Begin*****/
//elixir(function (mix) {
//    //index
//    mix.sass(
//        adminResource.page.shops.index.sass,
//        adminResource.page.shops.index.css
//    );
//
//    mix.styles([
//            adminResource.page.shops.index.css
//        ],
//        adminPublic.shops.index.css
//    );
//
//    mix.webpack(adminResource.page.shops.index.js_source,
//        adminResource.page.shops.index.js);
//
//    mix.scripts([
//            adminResource.page.shops.index.js],
//        adminPublic.shops.index.js
//    );
//
//
//    //edit
//    mix.sass(
//        adminResource.page.shops.edit.sass,
//        adminResource.page.shops.edit.css
//    );
//
//    mix.styles([
//            vendorsResource.dropzone.css,
//            adminResource.page.shops.edit.css
//        ],
//        adminPublic.shops.edit.css
//    );
//
//    mix.webpack(adminResource.page.shops.edit.js_source,
//        adminResource.page.shops.edit.js);
//
//    mix.scripts(
//        [
//            vendorsResource.dropzone.js,
//            vendorsResource.dropzone.myJs,
//            adminResource.page.shops.edit.js],
//        adminPublic.shops.edit.js
//    );
//});
/** **Shops End*****/



/** **LockScreen Begin*****/
//elixir.config.assetsPath = '';
//elixir.config.publicPath = '';
//
//elixir.config.css.sass.folder = '';
//elixir.config.css.folder = '';
//elixir.config.js.folder = '';
//
//elixir(function (mix) {
//    mix.sass(
//        'resources/assets/auth/appAuth.sass',
//        'public/assets/auth/appAuth.css');
//
//    mix.styles([
//            'resources/assets/vendors/bootstrap/css/bootstrap.min.css',
//            'resources/assets/admin/auth/lockscreen.css'
//        ],
//        'public/assets/admin/auth/lockscreen.css'
//    );
//
//    //js
//    mix.scripts(
//        [
//            '/resources/assets/vendors/jquery/jquery-1.11.1.min.js',
//            '/resources/assets/vendors/bootstrap/js/bootstrap.min.js',
//            '/resources/assets/vendors/holderjs/holder.min.js',
//        ],
//        'public/assets/admin/channel/auth/lockscreen.js'
//    );
//
//});
/** **Auth End*****/

