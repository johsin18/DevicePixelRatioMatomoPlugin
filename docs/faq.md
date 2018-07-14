## FAQ

__Shouldn't the plugin analyze the pure device pixel ratio, wihtout taking the zoom into account?__

I do not think that you can query the browser for neither the full page zoom nor the pure pixel device ratio, window.pixelDeviceRatio gives you both at the same time.

__What if the device pixel ratio changes during the visit (e.g. by the user changing the full page zoom level)?__

The plugin records the device pixel ratio at the beginning of each visit, later changes are ignored.  I might think about an option for taking the value for the last action instead, if you provide me with very good arguments for that.
