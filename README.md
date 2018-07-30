# Device Pixel Ratio Matomo Plugin

[![Build Status](https://travis-ci.org/johsin18/DevicePixelRatioMatomoPlugin.svg?branch=master)](https://travis-ci.org/johsin18/DevicePixelRatioMatomoPlugin)

## Description

This plugin collects statistics on the device pixel ratio of the visitor's devices.  This is useful to analyze how many visitors have Retina or other high DPI displays.  Find the respective report in the Visitors - Devices section.  You can switch to "Device Pixel Ratio Ranges" to see what share of visitors has a device pixel ratio of up to 1.00, 2.00, and so on.  Also, the screen resolution in the visitor log is augmented with the device pixel ratio (abbreviated to DPR there).

The measurement is based on the [window.devicePixelRatio](https://drafts.csswg.org/cssom-view/#dom-window-devicepixelratio) browser variable, which is [supported](https://caniuse.com/#search=devicePixelRatio) by all modern browsers.  Note that also a full page zoom different from 100% changes the device pixel ratio.  A user setting the zoom to 200% on a regular screen will be counted in the same way as a user having a Retina display with 100% zoom.  Still, the user with 200% zoom would also benefit from higher DPI assets.

The device pixel ratio is stored with two decimals accuracy.  For browsers not reporting the device pixel ratio, and for visits having occurred before the installation of this plugin, we report the value "Unknown".
