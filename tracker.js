/*!
 * Matomo - free/libre analytics platform
 *
 * @link http://matomo.org
 * @license http://matomo.org/free-software/bsd/ BSD-3 Clause (also in js/LICENSE.txt)
 * @license magnet:?xt=urn:btih:c80d50af7d3db9be66a4d0a86db0286e4fd33292&dn=bsd-3-clause.txt BSD-3-Clause
 */

/**
 * To minify this version call
 * cat tracker.js | java -jar ../../js/yuicompressor-2.4.7/build/yuicompressor-2.4.7.jar --type js --line-break 1000 | sed 's/^[/][*]/\/*!/' > tracker.min.js
 */

(function () {

    function init() {
        if ('object' === typeof window && !window.Matomo) {
            // Matomo is not defined yet
            return;
        }

        Matomo.addPlugin('DevicePixelRatio', {
            log: function () {

                devicePixelRatio = window.devicePixelRatio;
                if(devicePixelRatio === null) {
                    return '' ;
                }

                return '&devicePixelRatio=' + devicePixelRatio; // will be URL-encoded by other code, will be rounded to two decimals by database on server side
            }
        });
    }

    if ('object' === typeof window.Matomo) {
        init();
    } else {
        // tracker is loaded separately for sure
        if ('object' !== typeof window.matomoPluginAsyncInit) {
            window.matomoPluginAsyncInit = [];
        }

        window.matomoPluginAsyncInit.push(init);
    }

})();
