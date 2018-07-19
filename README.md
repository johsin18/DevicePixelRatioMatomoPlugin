# Matomo DevicePixelRatio Plugin

## Description

This plugin collects statistics on the device pixel ratio of the visitor's devices.  This is useful to analyze how many visitors have Retina or other high DPI displays.  Find the report in the Visitors - Devices section.

Note that also a full page zoom different from 100% changes the device pixel ratio.  A user setting the zoom to 200% on a regular screen will be counted in the same way as a user having a Retina display with 100% zoom.  Still, the user with 200% zoom would also benefit from higher DPI assets.  The exact definition of Window.devicePixelRatio can be found [here](https://drafts.csswg.org/cssom-view/#dom-window-devicepixelratio), it is [supported](https://caniuse.com/#search=devicePixelRatio) by all modern browsers.

The device pixel ratio is stored with two decimals accuracy.

TODO
* option to report the last device pixel ratio reported in the visit
