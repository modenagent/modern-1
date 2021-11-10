<!DOCTYPE html>
<html>
  <head>
    <title>Complex Marker Icons</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- jsFiddle will insert css and js -->
  </head>
  <body>
  	<style type="text/css">
  		/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
		#map {
		  height: 100%;
		  /*width: 50%;*/
		}

		/* Optional: Makes the sample page fill the window. */
		html,
		body {
		  height: 80%;
		  width:90%;
		  margin: auto;
		  padding: 0;
		}
  	</style>
    <div id="map"></div>

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQQthVgLzHIRTyLS1WGP2spIshpD28n8M&callback=initMap&v=weekly&channel=2"
      async
    ></script>
    <script type="text/javascript">
    	// The following example creates complex markers to indicate beaches near
// Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
// to the base of the flagpole.
function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: { lat: 33.687355, lng: -117.745059 },
    heading : 123
  });

  setMarkers(map);
}

// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.
const beaches = [
  ["Main Property \n<br> $765000", 33.687355, -117.745059, 2],
  ["190 FIXIE \n<br> $850000", 33.690044, -117.734337, 3],
  ["107 TENOR \n<br> $870000", 33.6879, -117.7396, 4],
  ["103 ACAMAR \n<br> $830000", 33.686759, -117.736257, 5],
  ["137 OKRA \n<br> $950000", 33.682866, -117.744559, 6],
  ["41 PEONY \n<br> $800000", 33.687098, -117.747113, 7],
];

function setMarkers(map) {
  // Adds markers to the map.
  // Marker sizes are expressed as a Size of X,Y where the origin of the image
  // (0,0) is located in the top left of the image.
  // Origins, anchor positions and coordinates of the marker increase in the X
  // direction to the right and in the Y direction down.
  //var icon_map = "https://e7.pngegg.com/pngimages/962/833/png-clipart-red-location-logo-google-map-maker-google-maps-pin-pin-heart-pin-thumbnail.png";
   var icon_map = "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
   var selected_array = [];
	  const image = {
	    // url: icon_map,
	    // This marker is 20 pixels wide by 32 pixels high.
	    size: new google.maps.Size(20, 32),
	    // The origin for this image is (0, 0).
	    origin: new google.maps.Point(0, 0),
	    // The anchor for this image is the base of the flagpole at (0, 32).
	    anchor: new google.maps.Point(0, 32),
	  };
	  // Shapes define the clickable region of the icon. The type defines an HTML
	  // <area> element 'poly' which traces out a polygon as a series of X,Y points.
	  // The final coordinate closes the poly by connecting to the first coordinate.
	  const shape = {
	    coords: [1, 1, 1, 20, 18, 20, 18, 1],
	    type: "poly",
	  };

	  for (let i = 0; i < beaches.length; i++) {
	    const beach = beaches[i];
			var infowindow = new google.maps.InfoWindow();
	    var marker = new google.maps.Marker({
	      position: { lat: beach[1], lng: beach[2] },
	      map,
	      // icon: image,
	      shape: shape,
	      // title: beach[0],
	      zIndex: beach[3],
	    });
	    
	    google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
	        return function() {
	          infowindow.setContent(beaches[i][0]);
	          infowindow.open(map, marker);
	        }
	      })(marker, i));
	      
	       google.maps.event.addListener(marker, 'click', (function(marker, i) {
	        return function() {
	          /* infowindow.setContent(beaches[i][0]) */;
	          /* infowindow.open(map, marker) */;
	          if(i > 0) {

		          var chk_index = $.inArray(i, selected_array);
		          if(chk_index >= 0) {
		          	selected_array.splice(chk_index,1);
		          	marker.setIcon(null);
		          }
		          else {

		          	marker.setIcon('https://www.google.com/mapfiles/marker_green.png');
		          	selected_array.push(i);
		          }
	          }
	          console.log(selected_array);
	        }
	      })(marker, i));
	  }
	}
    </script>
  </body>
</html>