## Documentation

The device pixel ratio is read on browser side from window.devicePixelRatio. For visits not reporting the device pixel ratio, we store NULL into the database. For those visits and ones having occurred before the installation of this plugin, we report the value "Unknown".
