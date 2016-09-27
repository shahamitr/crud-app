google-map-animation
====================
The idea is simple: We need to do animation between two place on google map, respecting the estimated time and the route provided from the google direction api.

This module can be simply include it in your app, and by configuring and injecting it you can make it working.

**Requirements:** AngularJS v1.4.11+

## Usage:
1. include all the dependencies which are needed to make animation work, following component and libraries are needed as pre-requisite.
    
    #### via bower:
    ```
    $ bower install angular-google-maps
    $ bower install jquery-easing
    $ bower install epoly-v3 
    ```
    
    #### via npm:
    ```
    $ npm install angular-google-maps
    $ npm install jquery-easing
    ```
    
    #### once the library is installed, include it:
    ```html
    <script src="bower_components/angular-google-maps/dist/angular-google-maps.js" type="text/javascript"></script>
    <script src="bower_components/jquery-easing/jquery.easing.min.js"></script>
    <script src="bower_components/epoly-v3-bower/v3_epoly.js"></script>
    OR
    <script src="node_modules/angular-google-maps/dist/angular-google-maps.js" type="text/javascript"></script>
    <script src="bower_components/jquery-easing/jquery.easing.min.js"></script>
    ```
    ***NOTE: epoly library is not available on node package manager, so you need to install it from bower only.
    
2. include required library from the CDN, Sliding marker and Marker animate. Marker animate converts all the google map marker and make it capable of sliding on google map.
    
    ```html
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marker-animate-unobtrusive/0.2.8/vendor/markerAnimate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marker-animate-unobtrusive/0.2.8/SlidingMarker.min.js"></script>
    ```
    
3. include the files of the module in your app, as the component of the library is decoupled in different files, so the files 
    
    ```html
    <script src="scripts/common/map/google-maps-animation.module.js" type="text/javascript"></script>
    <script src="scripts/common/map/google-maps-animation.config.js" type="text/javascript"></script>
    <script src="scripts/common/map/google-maps-animation.factory.js" type="text/javascript"></script>
    <script src="scripts/common/map/google-maps-library.js" type="text/javascript"></script>
    ```
    
4. Now its the time to inject the dependency to your all. see reference code below.
    
    ```js
    angular.module('myApp', ['googleMaps.module'])
    ```
    
5. Library has exposed all the function which are required to start animation, stop animation, adjust animation upon geting real time lat/long.

    1) create and object of googleMaps.module and initialize map.
    2) then create marker on the map for place A and for place B.
    3) then start animation.
    4) depending upon any condition, you can stop the animation and do teardown activity.

    #### init google map:
    
    ```js
    var googleMap = new googleMaps.module();
    googleMap.showMap();
    googleMap.createMarker();
    ```
    
   #### execute google map:

    ```js
    googleMap.startProviderAnimation();
    //Function will start the animation provided both marker is set, in our case those are customer marker and driver marker.
    
    googleMap.adjustAnimation();
    //Function will adjust the animation on map, provided you are using any real time mechanism to get lat long and pass it to this service. Animation will start again for the point which is provided.
    
    googleMap.calculateETA(srcLat, srcLgt, destinationLat, destinationLgt);
    //Function will calculate and returns the google object in case of success and will return error. call to this function is optional if you want to calculate ETA and want to display it you can call it and utilize the response.
    ```
    
   #### teardown google map:
    ```js
    googleMap.resetMapConfig();
    googleMap.cancelTimer();
    ```
    
6. That's it -- you're done!
#### via bower:
```
$ bower install angular-loading-bar
```
#### via npm:
```
$ npm install angular-loading-bar
```
#### via CDN:
```html
 <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.css' type='text/css' 
 <script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.js'></script>
```
## Why I created this
There are a couple projects similar to this out there, but none were ideal for me.  All implementations I've seen require that
Additionally, Angular was created as a highly testable framework, so it pains me to see Angular modules without tests.  That i
**Goals for this project:**
1. Make it automatic
2. Unit tests, 100% coverage
3. Must work well with ngAnimate
4. Must be styled via external CSS (not inline)
5. No jQuery dependencies
## Configuration
#### Turn the spinner on or off:
The insertion of the spinner can be controlled through configuration.  It's on by default, but if you'd like to turn it off, s
```js
angular.module('myApp', ['angular-loading-bar'])
  .config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
  }])
```
#### Turn the loading bar on or off:
Like the spinner configuration above, the loading bar can also be turned off for cases where you only want the spinner:
```js
angular.module('myApp', ['angular-loading-bar'])
  .config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeBar = false;
  }])
```
#### Customize the template:
If you'd like to replace the default HTML template you can configure it by providing inline HTML as a string:
```js
angular.module('myApp', ['angular-loading-bar'])
  .config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Loading...</div>';
  }])
```
#### Position the template:
If you'd like to position the loadingBar or spinner, provide a CSS selector to the element you'd like the template injected in
```js
angular.module('myApp', ['angular-loading-bar'])
  .config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    cfpLoadingBarProvider.spinnerTemplate = '<div><span class="fa fa-spinner">Custom Loading Message...</div>';
  }])
```
```html
<div id="loading-bar-container"></div>
```
Also keep in mind you'll likely want to change the CSS to reflect it's new position, so you'll need to override the default CS
```css
#loading-bar .bar {
  position: relative;
}
```
#### Latency Threshold
By default, the loading bar will only display after it has been waiting for a response for over 100ms.  This helps keep things
```js
angular.module('myApp', ['angular-loading-bar'])
  .config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.latencyThreshold = 500;
  }])
```
#### Ignoring particular XHR requests:
The loading bar can also be forced to ignore certain requests, for example, when long-polling or periodically sending debuggin
```js
// ignore a particular $http GET:
$http.get('/status', {
  ignoreLoadingBar: true
});
// ignore a particular $http POST.  Note: POST and GET have different
// method signatures:
$http.post('/save', data, {
  ignoreLoadingBar: true
});
```
```js
// ignore particular $resource requests:
.factory('Restaurant', function($resource) {
  return $resource('/api/restaurant/:id', {id: '@id'}, {
    query: {
      method: 'GET',
      isArray: true,
      ignoreLoadingBar: true
    }
  });
});
```
## How it works:
This library is split into two modules, an $http `interceptor`, and a `service`:
**Interceptor**  
The interceptor simply listens for all outgoing XHR requests, and then instructs the loadingBar service to start, stop, and in
**Service**  
The service is responsible for the presentation of the loading bar.  It injects the loading bar into the DOM, adjusts the widt
## Service API (advanced usage)
Under normal circumstances you won't need to use this.  However, if you wish to use the loading bar without the interceptor, y
```js
angular.module('myApp', ['cfp.loadingBar'])
```
```js
cfpLoadingBar.start();
// will insert the loading bar into the DOM, and display its progress at 1%.
// It will automatically call `inc()` repeatedly to give the illusion that the page load is progressing.
cfpLoadingBar.inc();
// increments the loading bar by a random amount.
// It is important to note that the auto incrementing will begin to slow down as
// the progress increases.  This is to prevent the loading bar from appearing
// completed (or almost complete) before the XHR request has responded.
cfpLoadingBar.set(0.3) // Set the loading bar to 30%
cfpLoadingBar.status() // Returns the loading bar's progress.
// -> 0.3
cfpLoadingBar.complete()
// Set the loading bar's progress to 100%, and then remove it from the DOM.
```
## Events
The loading bar broadcasts the following events over $rootScope allowing further customization:
**`cfpLoadingBar:loading`** triggered upon each XHR request that is not already cached
**`cfpLoadingBar:loaded`** triggered each time an XHR request recieves a response (either successful or error)
**`cfpLoadingBar:started`** triggered once upon the first XHR request.  Will trigger again if another request goes out after `
**`cfpLoadingBar:completed`** triggered once when the all XHR requests have returned (either successfully or not)
## Credits:
Credit goes to [rstacruz](https://github.com/rstacruz) for his excellent [nProgress](https://github.com/rstacruz/nprogress).
## License:
Licensed under the MIT license
