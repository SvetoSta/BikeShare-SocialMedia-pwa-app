mapboxgl.accessToken = 'pk.eyJ1IjoiYnVrdDBwIiwiYSI6ImNsYW1tbWNqZDBmZngzcW9ibTNtcjN2cXIifQ.VtsEu4HMRW-kAvIlgCSgfA';

navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {enableHighAccuracy: true})

function successLocation(position){
  console.log(position)
  setupMap([position.coords.longitude, position.coords.latitude])
}

function errorLocation(){

}

function setupMap(center){
  const map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v12',
  center: center,
  zoom: 14
});

const geojson = {
  type: 'FeatureCollection',
  features: [
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.45834, 51.44765]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 64%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.45964, 51.45038]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.45362, 51.44570]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.46843, 51.44756]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.47280, 51.44774]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.46082,51.44347]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.47339,51.44328]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.46680,51.44066]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.45922,51.43880]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.47125,51.43399]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.48332,51.43667]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.49880,51.43946]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.48234,51.42857]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.45862,51.42750]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.48070,51.42457]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.48846,51.44731]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.49696,51.43554]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.47787,51.44089]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [5.50144,51.44289]
      },
      properties: {
        title: 'PBike',
        description: 'Charged 40%'
      }
    }
  ]
};

for (const feature of geojson.features) {
  // create a HTML element for each feature
  const el = document.createElement('div');
  el.className = 'marker';

  // make a marker for each feature and add to the map
  new mapboxgl.Marker(el)
  .setLngLat(feature.geometry.coordinates)
  .setPopup(
    new mapboxgl.Popup({ offset: 25 }) // add popups
      .setHTML(
        `<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`
      )
  )
  .addTo(map);
}

  const nav = new mapboxgl.NavigationControl()
  map.addControl(nav)

  var directions = new MapboxDirections({
  accessToken: mapboxgl.accessToken,
  unit: 'metric',
  profile: 'mapbox/cycling'
  
  });

map.addControl(directions, 'top-left');

map.addControl(
new mapboxgl.GeolocateControl({
    positionOptions: {enableHighAccuracy: true},
    trackUserLocation: true,
    showUserHeading: true,
})
);

map.on('load',  function() {
directions.setOrigin(center);
directions.setDestination(center);
});

directions.on('route', e =>{
let routes = e.route
var dist = routes.map(r => r.distance) / 1000;
var points = (dist.toFixed(2)/1.69)*3;
var currentpoints = document.getElementById('points').value;
var totalkm = document.getElementById('totalkm').value;

var a = parseFloat(points);
var b = parseFloat(currentpoints);

var c = parseFloat(dist.toFixed(2));
var d = parseFloat(totalkm);

var newpoints = a + b;
var totalkm = c + d;

console.log(c);
console.log(d);
console.log(totalkm.toFixed(2));


document.getElementById("distance").innerHTML = dist.toFixed(2) + " KM until your destination";
document.getElementById("pointsadd").value = newpoints.toFixed(2);
document.getElementById("lastkm").value = dist.toFixed(2);
document.getElementById("totalkmadd").value = totalkm.toFixed(2);
// var template = `<p style="color: white;">${dist.toFixed(2)}</p>`;
// $('#distance').html(template);
});
// map.on('click', function(){
//   console.log(routes[0].distance);
// });
}



// add markers to map




// Add geolocate control to the map.
// map.addControl(

// );