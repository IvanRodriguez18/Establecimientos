import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#mapa'))
    {
        const latitud = document.querySelector('#lat').value;
        const longitud = document.querySelector('#lng').value;
        const lat = latitud === '' ? 20.666332695977 : latitud;
        const lng = longitud === '' ? -103.392177745699 : longitud;
        const mapa = L.map('mapa').setView([lat, lng], 17);

        //Eliminar PINES previos que puedan salir en el mapa
        let markers = new L.FeatureGroup().addTo(mapa);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);

        //Agregar el PIN a las capas
        markers.addLayer(marker);

        //Creando un GeoCode services
        const geoCodeServices = L.esri.Geocoding.geocodeService();
        //Variable que almacena el valor ingresado por el usuario en el buscador
        const buscador = document.querySelector('#formbuscador');
        buscador.addEventListener('blur', buscarDireccion);
        //reubicar PIN
        reubicarPin(marker);
        function reubicarPin(marker)
        {
            //Detectar el movimiento del PIN
            marker.on('moveend', function(event){
                marker = event.target;
                const posicion = marker.getLatLng();
                //Centar mapa automaticamente
                mapa.panTo(new L.LatLng(posicion.lat, posicion.lng));
                //Reverse GeoCoding, cuando el usuario reubica el pin
                geoCodeServices.reverse().latlng(posicion, 17).run(function(error, resultado) {
                    marker.bindPopup(resultado.address.LongLabel);
                    marker.openPopup();
                    //Completar inputs con el movimiento del PIN
                    llenarInputs(resultado);
                });
            });
        }
        function buscarDireccion(event) {
            if (event.target.value.length >= 10)
            {
                provider.search({query: event.target.value})
                .then(resultado => {
                    if (resultado)
                    {
                        //Limpiar PINES Previos
                        markers.clearLayers();
                        //Reverse GeoCoding, cuando el usuario reubica el pin
                        geoCodeServices.reverse().latlng(resultado[0].bounds[0], 17).run(function(error, resultado)
                        {
                            //Llenar los inputs del formulario
                            llenarInputs(resultado);
                            //Centrar el mapa de acuerdo a la busqueda
                            mapa.setView(resultado.latlng);
                            //Agregar el PIN al mapa
                            marker = new L.marker(resultado.latlng, {
                                draggable: true,
                                autoPan: true
                            }).addTo(mapa);
                            //Agregar al contenedor del markers el nuevo PIN
                            markers.addLayer(marker);
                            //Mover el PIN en el mapa
                            reubicarPin(marker);
                        })
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }

        function llenarInputs(resultado) {
            document.querySelector('#direccion').value = resultado.address.Address || '';
            document.querySelector('#colonia').value = resultado.address.Neighborhood || '';
            document.querySelector('#lat').value = resultado.latlng.lat || '';
            document.querySelector('#lng').value = resultado.latlng.lng || '';
        }
    }
});
