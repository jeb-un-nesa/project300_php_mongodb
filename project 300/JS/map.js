var map, heatmap;
var markers = [];
var infowindow1 = new google.maps.InfoWindow();
var infowindow2 = new google.maps.InfoWindow();
var marker1, marker2;

function initMap(points) {

    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 24.9045, lng: 91.8611},
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP// 'terrain' //hybrid, roadmap, satelite
    });

    ///////////////////////////////////////////////

    google.maps.event.addListener(map, 'click', function (event) {
        if (markers.length == 0) {

            $("#latId").val(event.latLng.lat());
            $("#langId").val(event.latLng.lng());
            console.log($("#langId").val())
            $("#createButton").prop("disabled", false);


            console.log("Point 1 => \n" + event);
            marker1 = new google.maps.Marker({
                position: event.latLng,
                map: map
            });
            markers.push(event);
            infowindow1.setContent('Start or Create Report...');
            infowindow1.open(map, marker1);
        }
        else if (markers.length == 1) {
            console.log("Point 2 => \n" + event);
            marker2 = new google.maps.Marker({
                position: event.latLng,
                map: map
            });
            markers.push(event);
            infowindow2.setContent('Destination...');
            infowindow2.open(map, marker2);
            console.log('Calculating Path => ');
            DRAW_ROOT(markers[0].latLng, markers[1].latLng);

            $("#createButton").prop("disabled", true);
        }
        else {
            console.log("Clear Path.");
            directionsDisplay.setMap(null);
            infowindow1.close();
            infowindow2.close();
            markers = [];
            marker1.setMap(null);
            marker2.setMap(null);
        }



    });

    function DRAW_ROOT(place1, place2) {
        $('#loading').show();
        directionsDisplay.setMap(map);
        directionsService.route({
            origin: place1,
            destination: place2,
            // waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: 'DRIVING',
            provideRouteAlternatives: true
        }, function (response, status) {
            if (status === 'OK') {
                console.log(response);

                directionsDisplay.setDirections(response);
                var route = response.routes[0];
                
                marker1.setMap(null);
                marker2.setMap(null);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
            $('#loading').hide();
        });
    }

    function oldRoot() {
        if (markers.length == 2) {
            marker1 = new google.maps.Marker({
                position: event.latLng,
                map: map
            });
            infowindow1.setContent('Starting...');
            infowindow1.open(map, marker1);
            marker2 = new google.maps.Marker({
                position: event.latLng,
                map: map
            });
            markers.push(event);
            infowindow2.setContent('Destination...');
            infowindow2.open(map, marker2);
            console.log('Calculating Path => ');
            DRAW_ROOT(markers[0].latLng, markers[1].latLng);
        }
    }


////////////////////////////////////////////////
    infoWindow = new google.maps.InfoWindow; /// FOR STICKER "I'm here"
    var mapCentre;
    var map;
    initialize();

    function initialize() {
        var mapOptions;

        if (mapLat != null && mapLng != null && mapZoom != null) {

            mapOptions = {
                center: new google.maps.LatLng(mapLat, mapLng),
                zoom: parseInt(mapZoom),
                scaleControl: true
            };
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    // infoWindow.setPosition(pos);
                    // infoWindow.setContent('I\'m here');
                    // infoWindow.open(map);
                    marker0 = new google.maps.Marker({
                        position: pos,
                        map: map,
                        icon: 'images/markme.png'
                    });   



                    //map.setCenter(pos);
                }, function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            }
            map.setCenter(mapOptions.center);
            map.setZoom(mapOptions.zoom);

        } else if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // infoWindow.setPosition(pos);
                // infoWindow.setContent('I\'m here');
                // infoWindow.open(map);
                marker0 = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: '../images/markme.png'
                }); 
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        mapCentre = map.getCenter();

        //Set local storage variables.
        mapLat = mapCentre.lat();
        mapLng = mapCentre.lng();
        mapZoom = map.getZoom();

        google.maps.event.addListener(map, "center_changed", function () {
            //Set local storage variables.
            mapCentre = map.getCenter();

            mapLat = mapCentre.lat();
            mapLng = mapCentre.lng();
            mapZoom = map.getZoom();
            // console.log(mapLat+ ' -> ' + mapLng) ;
        });

        google.maps.event.addListener(map, "zoom_changed", function () {
            //Set local storage variables.
            mapCentre = map.getCenter();
            mapLat = mapCentre.lat();
            mapLng = mapCentre.lng();
            mapZoom = map.getZoom();
        });
    }

    points.forEach(function(element){

        imagePath = "";

        if(element.type=="report"){
            imagePath = 'images/reportme.png'
        }
        else if(element.type=="mugging"){
            imagePath = 'images/muggingf.png'
        }
        else if(element.type=="robbery"){
            imagePath = 'images/robberyf.png'
        }
        else if(element.type=="harrasment"){
            imagePath = 'images/harrasmentf.png'
        }
        else if(element.type=="accident"){
            imagePath = 'images/accidentf.png'
        }
        else if(element.type=="theft"){
            imagePath = 'images/theftf.png'
        }
        else{
            imagePath = 'images/newsicon.png'
        }


        marker0 = new google.maps.Marker({
                    position: new google.maps.LatLng(element.lat, element.lng),
                    map: map,
                    icon: imagePath
                }); 

    })

    heatmap = new google.maps.visualization.HeatmapLayer({
        data: points,
        map: map,
        radius: 20
    });
    oldRoot();
}