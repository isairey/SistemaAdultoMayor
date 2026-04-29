
<link rel="stylesheet" href="<?= base_url(); ?>/assets/leaflet/leaflet.css" />
<script src="<?= base_url(); ?>/assets/leaflet/leaflet.js"></script>

<style>
  #map { height: 800px; }
</style>
<div id="map"></div>

<script>
  //var latitud = data.latitud;
  //var longitud = data.longitud;
  var map = L.map('map').setView([-17.3938, -66.1571], 19);
  //var map = L.map('map').setView([latitud,longitud], 19);

  //var marker = L.marker([$lati, -66.1571]).addTo(map);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  var marker =L.marker([-17.3938, -66.1571]);
/*  var marker =L.marker([latitud,longitud],
  {draggable: true}).addTo(map);
  marker.on('dragend', function(event){
    var position = marker.getLatLng();
    marker.setLatLng(position, {
    draggable: 'true'
    }).bindPopup(position).update();
    $("#latitude").val(position.lat);
    $("#longitude").val(position.lng).keyup();
  });*/

    //.bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
  //.openPopup();
    var popup = "Centro de la Ciudad de Cochabamba";
    marker.bindPopup(popup);
    marker.addTo(map);
    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("Mi domicilio es: " + e.latlng.toString())
            .openOn(map);
    }

    map.on('click', onMapClick);

</script>
