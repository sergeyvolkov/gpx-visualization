/**
 * Configuration example
 * @author Anton Shevchuk
 */
/*global define,require*/
require.config({
    // why not simple "js"? Because IE eating our minds!
    baseUrl: '/js',
    // if you need disable JS cache
    urlArgs: "bust=" + (new Date()).getTime(),
    paths: {
        bootstrap: './vendor/bootstrap',
        jquery: './vendor/jquery',
        "jquery-ui": './vendor/jquery-ui',
        redactor: './../redactor/redactor',
        // cdnjs settings
        underscore: '//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.1/underscore-min',
        backbone: '//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min',
        async: './vendor/async',
        blockUI: '//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI',
        fullScreen: './vendor/jquery.fullscreen'
    },
    shim: {
        bootstrap: {
            deps: ['jquery'],
            exports: '$.fn.popover'
        },
        backbone: {
            deps: ['underscore', 'jquery'],
            exports: 'Backbone'
        },
        redactor: {
            deps: ['jquery'],
            exports: '$.fn.redactor'
        },
        underscore: {
            exports: '_'
        },
        "jquery-ui": {
            deps: ['jquery'],
            exports: '$.ui'
        },
        blockUI: {
            deps: ['jquery']
        },
        fullScreen: {
            deps: ['jquery'],
            exports: '$.fn.fullScreen'
        }
    },
    enforceDefine: true
});

require(['bluz', 'bluz.ajax', 'bootstrap']);