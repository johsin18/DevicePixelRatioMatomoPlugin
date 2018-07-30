## FAQ

__Shouldn't the plugin analyze the pure device pixel ratio, wihtout taking the zoom into account?__

I do not think that you can query the browser for neither the full page zoom nor the pure pixel device ratio, window.pixelDeviceRatio gives you both at the same time.

__What if the device pixel ratio changes during the visit (e.g. by the user changing the full page zoom level)?__

The plugin records the device pixel ratio at the beginning of each visit, later changes are ignored.  I might think about an option for taking the value for the last action instead, if you provide me with very good arguments for that.

__An unknown device pixel ratio is reported for all visitors.  What is wrong?__

This plugin needs to add a snippet to the JavaScript code that make the browser report visitor actions.  To allow this addition, piwik.js must be writable in you installation ("Writable JavaScript Tracker" in System Check must be checked).  As the script might be cached on client side, it might take a while until all clients will correctly report the device pixel ratio.  If you report the actions using some other API, add "devicePixelRatio=1.23" to the arguments.
