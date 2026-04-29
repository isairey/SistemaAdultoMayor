
    var format = 'image/png';
    var bounds = [788396.9511477941, 8059108.1417208575,811711.388216491, 8090058.166346149];
    // Definir los id de los divs
    var id_map='map';
    var id_popup='popup';
    var id_popup_closer='popup-closer';
    var id_popup_content='popup-content';
    var id_wrapper='wrapper';
    var id_location='location';
    var id_scale='scale';
    // Fin de definicion de los divs

    //variables que no se tocan
     var mousePositionControl;
     var capa_base;
     var projection;
     var map;
     var contextmenu_items =  [ ];
     var contextmenu;
     var vectorSource = new ol.source.Vector({  // Creación del vector source generico

        });
  function ActualizarRegistroLetrero(id_letrero, nombre_comuna, posicion_x, posicion_y)
  {

                               //alert(nombre_comuna);
                                $.ajax(
                                  {
                                    url: '/ws/actualizar_data_letrero.php',
                                    data: {id:id_letrero, comuna:nombre_comuna, posicion_x:posicion_x, posicion_y:posicion_y},
                                    type:'GET',
                                    async: false,
                                    dataType: 'text',
                                    success: function(output_string)
                                    {
                                      //alert(output_string);
                                      // Es un WS que no devuelve nada, solo actualiza los datos del letrero  :-)
                                    }
                                  });
  }
  function getCookie(name)
{
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

function GraficaMarcadores()
{
    //GraficaRastreo();
    var consulta= getCookie('demo');
    consulta=decodeURIComponent(consulta).replace(/\+/g, ' ');
//    consulta= ArreglaConsulta(consulta);
   //alert(consulta);
    $.ajax({
            url: 'http://adultomayor.cochabamba.bo/public/mapa/ws/get_data_marcadores_denuncias.php',
            data: {consulta_busqueda:consulta},
            type:'GET',
            dataType: 'json',
            success: function(output_string)
            {

                //if(output_string!='[]')  // tenemos elementos
                {
                     //alert(output_string);
                     $.each(output_string, function (idx, obj1)
                     {
                         posicion_x=obj1.coord_e;
                         posicion_y=obj1.coord_s;

                         if ((posicion_x!=null) && (posicion_y!=null))
                         {
                               coordenada=[posicion_x, posicion_y];
                               id_denuncia=obj1.id_denuncia;
                               reclamante= obj1.reclamante;
                               subalcaldia= obj1.subalcaldia;
                               distrito=obj1.distrito;
                               otb=obj1.otb;
                               incidente=obj1.incidente;
                               codigo_denuncia=obj1.codigo_denuncia;
                               nombre_categoria=obj1.nombre_categoria;
                               fecha_asignacion=obj1.fecha_asignacion;
                               informe_tecnico= obj1.informe_tecnico;
                               icono=window.location.origin+"/adultomayor/public/mapa/denuncia.png";

                               // ****************

                               var html_contenido='<b>CÓDIGO: </b>'+codigo_denuncia+
                                              '<br><b>DISTRITO: </b>'+distrito+
                                              '<br><b>SUBALCALDIA: </b>'+subalcaldia+
                                              '<br><b>OTB: </b>'+otb+
                                              '<br><b>RECLAMANTE: </b>'+reclamante+
                                              '<br><b>INCIDENTE: </b>'+incidente+
                                              '<br><b>CATEGORÍA: </b>'+nombre_categoria+
                                              '<br><b>FECHA DE ASIGNACIÓN: </b>'+fecha_asignacion+
                                              '<br><b>INFORME TÉCNICO: </b>'+informe_tecnico;

                               //alert(coordenada);
                               //********************************************
                               var iconFeature = new ol.Feature({
                                    geometry: new ol.geom.Point(coordenada),
                               });

                               var iconStyle = [new ol.style.Style({
                                 image: new ol.style.Icon(({
                                 anchor:[0.5,1],
                                 anchorXUnits: 'fraction',
                                 anchorYUnits: 'fraction',
                                 rotateWithView: false,
                                 scale: 0.75,
                                 src:icono,
                                 }))
                                 }),
                                 new ol.style.Style({
                                 text: new ol.style.Text({
                                 text: codigo_reclamo,
                                 offsetY: -62,
                                 stroke: new ol.style.Stroke({color:'#000000' , width: '4'}),
                                 fill: new ol.style.Fill({color: '#ffffff'})
                                })
                                }),
                                ];

                                 iconFeature.setStyle(iconStyle);
                                 iconFeature.set('html_contenido',html_contenido);// debemos tener definido el html_contenido previamente
                                 vectorSource.addFeature(iconFeature);
                         }
                     });

                }

            }
          });
          // map.getView().fit(extent, map.getSize()); //ajustamos el zoom del mapa para mostrar todos los elementos existentes

          vectorLayer = new ol.layer.Vector({
              source: vectorSource,
          });
          vectorSource.clear();

         // extent = vectorLayer.getSource().getExtent();

          map.getLayers().forEach(function(layer, i)
          {
                   if (layer.get('name')!=='base_catastro' &&  layer.get('name')!=='capa_limites'  &&
                                          layer.get('name')!=='capa_vias' && layer.get('name')!=='capa_manzanas' &&
                                          layer.get('name')!=='capa_predios' && layer.get('name')!=='capa_otbs'
                                          )
                    map.removeLayer(layer);
          });
          map.addLayer(vectorLayer);

  setTimeout(function(){
  extent = vectorLayer.getSource().getExtent();
          map.getView().fit(extent, map.getSize());

   },50); //delay is in milliseconds


}

function GraficaSoloMarcadores()
{

    var consulta= getCookie('demo');
    consulta=decodeURIComponent(consulta).replace(/\+/g, ' ');
//    consulta= ArreglaConsulta(consulta);
  //console.log(consulta);

     $.ajax({
          url: 'http://adultomayor.cochabamba.bo/public/mapa/ws/get_data_marcadores_denuncias.php',
          data: {consulta_busqueda:consulta},
          type:'GET',
          dataType: 'json',
     })
     .done(function(output_string) {
          //console.log(output_string);
          //alert(output_string);
           $.each(output_string, function (idx, obj1)
           {
              posicion_x=obj1.coord_e;
              posicion_y=obj1.coord_s;

              if ((posicion_x!=null) && (posicion_y!=null))
              {
                    coordenada=[posicion_x, posicion_y];
                    id_denuncia=obj1.id_denuncia;
                    denunciante= obj1.denunciante;
                    subalcaldia= obj1.subalcaldia;
                    distrito=obj1.distrito;
                    otb=obj1.otb;
                    tipologia=obj1.tipologia;
                    codigo_denuncia=obj1.codigo_denuncia;
                    fecha_denuncia=obj1.fecha_denuncia;
                    icono=window.location.origin+"/public/mapa/denuncia.png";

                    // ****************

                    var html_contenido='<b>CÓDIGO: </b>'+codigo_denuncia+
                                   '<br><b>DISTRITO: </b>'+distrito+
                                   '<br><b>SUBALCALDIA: </b>'+subalcaldia+
                                   '<br><b>OTB: </b>'+otb+
                                   '<br><b>DENUNCIANTE: </b>'+denunciante+
                                   '<br><b>TIPOLOGIA: </b>'+tipologia+
                                   '<br><b>FECHA DE DENUNCIA: </b>'+fecha_denuncia;
                    //alert(coordenada);
                    //********************************************
                    var iconFeature = new ol.Feature({
                         geometry: new ol.geom.Point(coordenada),
                    });

                    var iconStyle = [new ol.style.Style({
                     image: new ol.style.Icon(({
                     anchor:[0.5,1],
                     anchorXUnits: 'fraction',
                     anchorYUnits: 'fraction',
                     rotateWithView: false,
                     scale: 0.75,
                     src:icono,
                     }))
                     }),
                     new ol.style.Style({
                     text: new ol.style.Text({
                     text: codigo_denuncia,
                     offsetY: -62,
                     stroke: new ol.style.Stroke({color:'#000000' , width: '4'}),
                     fill: new ol.style.Fill({color: '#ffffff'})
                     })
                     }),
                     ];

                     iconFeature.setStyle(iconStyle);
                     iconFeature.set('html_contenido',html_contenido);// debemos tener definido el html_contenido previamente
                     vectorSource.addFeature(iconFeature);
              }
          });

    })
     .fail(function(xhr, status) {
          alert('Disculpe, existió un problema  ' + status);
     })
     .always(function(output_string) {
          console.log("always");
     });
          // map.getView().fit(extent, map.getSize()); //ajustamos el zoom del mapa para mostrar todos los elementos existentes

          vectorLayer = new ol.layer.Vector({
              source: vectorSource,
          });
          vectorSource.clear();

         // extent = vectorLayer.getSource().getExtent();

          map.getLayers().forEach(function(layer, i)
          {
                   if (layer.get('name')!=='base_catastro' &&  layer.get('name')!=='capa_limites'  &&
                                          layer.get('name')!=='capa_vias' && layer.get('name')!=='capa_manzanas' &&
                                          layer.get('name')!=='capa_predios' && layer.get('name')!=='capa_otbs'
                                          )
                    map.removeLayer(layer);
          });
          map.addLayer(vectorLayer);

  setTimeout(function(){
  extent = vectorLayer.getSource().getExtent();
          map.getView().fit(extent, map.getSize());

   },50); //delay is in milliseconds


}

/*
function GraficaRastreo()
{
    var consulta= getCookie('posiciones_tecnicos');
    consulta=decodeURIComponent(consulta).replace(/\+/g, ' ');
    $.ajax({
            url: 'http://localhost:8080/adultomayor/public/mapa/ws/get_data_posiciones_tecnicos.php',
            data: {consulta_busqueda:consulta},
            type:'GET',
            dataType: 'text',
            success: function(output_string)
            {
                //if(output_string!='[]')  // tenemos elementos
                {
                     //alert(output_string);
                     icono=window.location.origin+"/public/mapa/persona.png";

                     $.each(JSON.parse(output_string), function(idx, obj1) // iteramos por todos los registros que devuelve la consulta
                     {
                         posicion_x=obj1.coord_e;
                         posicion_y=obj1.coord_s;

                         //alert(output_string);

                         if ((posicion_x!=null) && (posicion_y!=null))
                         {
                               coordenada=[posicion_x, posicion_y];

                               nombre_completo=obj1.nombre_completo;
                               hora_registro = obj1.hora_registro;

                               //********************************************
                               var iconFeature = new ol.Feature({
                                    geometry: new ol.geom.Point(coordenada),
                               });


                               var iconStyle = [new ol.style.Style({
                                 image: new ol.style.Icon(({
                                 anchor:[0.5,1],
                                 anchorXUnits: 'fraction',
                                 anchorYUnits: 'fraction',
                                 rotateWithView: false,
                                 scale: 0.75,
                                 src:icono,
                                 }))
                                 }),
                                 new ol.style.Style({
                                 text: new ol.style.Text({
                                 text: nombre_completo,
                                 offsetY: -62,
                                 stroke: new ol.style.Stroke({color:'#000000' , width: '4'}),
                                 fill: new ol.style.Fill({color: '#ffffff'})
                                })
                                }),
                                ];

                                 iconFeature.setStyle(iconStyle);
                                 //iconFeature.set('html_contenido',html_contenido);// debemos tener definido el html_contenido previamente
                                 vectorSource.addFeature(iconFeature);
                         }
                     });

                }

            }
          });

          /*
          vectorLayer = new ol.layer.Vector({
              source: vectorSource,
          });
           vectorSource.clear();
          map.getLayers().forEach(function(layer, i)
          {
                   if (layer.get('name')!=='base_catastro' &&  layer.get('name')!=='capa_limites'  &&
                                          layer.get('name')!=='capa_vias' && layer.get('name')!=='capa_manzanas' &&
                                          layer.get('name')!=='capa_predios' && layer.get('name')!=='capa_otbs'
                                          )
                    map.removeLayer(layer);
          });
          map.addLayer(vectorLayer);

}

*/

 function HallarDatosOtbs( view, viewResolution, source,  coordenadas)
  {
                                var url = source.getGetFeatureInfoUrl(
                                          coordenadas, viewResolution, view.getProjection(),
                                          {'INFO_FORMAT': 'application/json', 'FEATURE_COUNT': 50});
                                var nombre_comuna;

                                 $.ajax(
                                 {
                                   url: url,
                                   type:'GET',
                                   dataType: 'text',
                                   async: false,
                                   success: function(output_string)
                                   {
                                          nombre_otb = HallarValorEtiqueta('OTB', output_string);
                                          nombre_otb = String(nombre_otb);
                                   }
                                  });
                                 return {
                                             "nombre":nombre_otb,
                                        };
  }

  function HallarDatosCapaLimites( view, viewResolution, source,  coordenadas)
  {
                                var url = source.getGetFeatureInfoUrl(
                                          coordenadas, viewResolution, view.getProjection(),
                                          {'INFO_FORMAT': 'application/json', 'FEATURE_COUNT': 50});
                                var nombre_comuna;

                                 $.ajax(
                                 {
                                   url: url,
                                   type:'GET',
                                   dataType: 'text',
                                   async: false,
                                   success: function(output_string)
                                   {
                                          nombre_comuna = HallarValorEtiqueta('Comuna', output_string);
                                          nombre_comuna = String(nombre_comuna);
                                          nombre_comuna = nombre_comuna.replace('Comuna ','');

                                          nombre_distrito = HallarValorEtiqueta('distrito', output_string);
                                          nombre_distrito = String(nombre_distrito);
                                          nombre_distrito = nombre_distrito.replace('distrito:=','');

                                          nombre_distrito = HallarValorEtiqueta('distrito', output_string);
                                          nombre_distrito = String(nombre_distrito);
                                          nombre_distrito = nombre_distrito.replace('distrito:=','');

                                          nombre_zona = HallarValorEtiquetaZona(output_string);
                                          nombre_zona = String(nombre_zona);
                                          nombre_zona = nombre_zona.replace('Zona:','');
                                    }
                                  });
                                 return {
                                             "nombre_comuna":nombre_comuna,
                                             "nombre_distrito":nombre_distrito,
                                             "nombre_zona":nombre_zona
                                        };
  }

  function HallarDatosCapaVias( view, viewResolution, source,  coordenadas)
  {
                                var url = source.getGetFeatureInfoUrl(
                                          coordenadas, viewResolution, view.getProjection(),
                                          {'INFO_FORMAT': 'application/json', 'FEATURE_COUNT': 50});
                                var nombre_comuna;

                                 $.ajax(
                                 {
                                   url: url,
                                   type:'GET',
                                   dataType: 'text',
                                   async: false,
                                   success: function(output_string)
                                   {

                                          tipo = HallarValorEtiqueta('Tipo', output_string);
                                          tipo= String(tipo);
                                          tipo= tipo.trim();

                                          nombre = HallarValorEtiqueta('Nombre', output_string);
                                          nombre = String(nombre);
                                          nombre = nombre.trim();

                                    }
                                  });
                                 return {
                                             "tipo":tipo,
                                             "nombre":nombre,
                                        };
  }
  function HallarValorEtiquetaZona(fuente)
    {
          posicion_etiqueta=fuente.indexOf('Zona:');

          if (posicion_etiqueta!=-1)
          {
             cadena_sobrante=fuente.substring(posicion_etiqueta);
             posición_segunda_comilla= nth_occurrence(cadena_sobrante,'"',1);

             cadena_buscada=cadena_sobrante.substring(0,posición_segunda_comilla);
             return cadena_buscada;
          }
          else
            return 'No definido';

    }
  function HallarValorEtiqueta(etiqueta,fuente)
    {
          posicion_etiqueta=fuente.indexOf(etiqueta);

          if (posicion_etiqueta!=-1)
          {
             cadena_sobrante=fuente.substring(posicion_etiqueta);
             posición_segunda_comilla= nth_occurrence(cadena_sobrante,'"',2);
             cadena_buscada=cadena_sobrante.substring(0,posición_segunda_comilla+1);
             return obtenerTextoEnComillas(cadena_buscada);
          }
          else
            return 'No definido';

    }

        function EncontrarDatosDistrito(output_string)
    {
        indice_cadena_subdistrito=output_string.indexOf('SubDistrito');
        cadena_sobrante=output_string.substring(indice_cadena_subdistrito);
        posicion_cierre= cadena_sobrante.indexOf('</FIELDS>');
        cad_busq= cadena_sobrante.substring(0,posicion_cierre-2);
        arreglo_cadenas=cad_busq.split(" ");
        numero_subdistrito=arreglo_cadenas[1];

        cantidad= arreglo_cadenas.length;

        var i=3;
        nombre_subdistrito="";
        while(i<=(cantidad-1))
        {
           nombre_subdistrito=nombre_subdistrito+" "+arreglo_cadenas[i];
           i=i+1;
        }
        //return nombre_subdistrito;
    }




    function nth_occurrence (string, char, nth)
    {
        var first_index = string.indexOf(char);
        var length_up_to_first_index = first_index + 1;
        if (nth == 1)
        {
            return first_index;
        } else
        {
            var string_after_first_occurrence = string.slice(length_up_to_first_index);
            var next_occurrence = nth_occurrence(string_after_first_occurrence, char, nth - 1);

            if (next_occurrence === -1) {
                return -1;
            } else {
                return length_up_to_first_index + next_occurrence;
            }
        }
    }

    function obtenerTextoEnComillas(texto)
    {
          const regex = /(["'])(.*?)\1/g;
          var   grupo, resultado = [];

          while ((grupo = regex.exec(texto)) !== null)
          {
              //el grupo 1 contiene las comillas utilizadas
              //el grupo 2 es el texto dentro de éstas
              resultado.push(grupo[2]);
          }
          return resultado;
    }
  function CrearMapa()
  {
       mousePositionControl = new ol.control.MousePosition({
       className: 'custom-mouse-position',
       target: document.getElementById(id_location),
       coordinateFormat: ol.coordinate.createStringXY(5),projection: 'EPSG:32719',
       undefinedHTML: '&nbsp;'
       });

       capa_base = new ol.layer.Image({
       source: new ol.source.ImageWMS({
       ratio: 1,
       url: 'http://192.168.105.219:6080/arcgis/services/planificacion/usoSueloSistemas/MapServer/WMSServer',
       params: {
                    'FORMAT': format,
                    'VERSION': '1.1.1',
                    'LAYERS': '0,1,2',
                    //'LAYERS': '7',
                    'STYLES': '',
                  },
        })
       });
       capa_base.set('name', 'base_catastro');
       capa_base.set('visible', true);


       capa_limites = new ol.layer.Image({
       source: new ol.source.ImageWMS({
       ratio: 1,
       url: 'http://192.168.105.219:6080/arcgis/services/planificacion/limites/MapServer/WMSServer',
       params: {
                    'FORMAT': format,
                    'VERSION': '1.1.1',
                    'LAYERS': '0,1,2,3,4',
                    //'LAYERS': '7',
                    'STYLES': '',
                  },
        })
       });
       capa_limites.set('name', 'capa_limites');
       capa_limites.set('visible', true);


       capa_otbs = new ol.layer.Image({
       source: new ol.source.ImageWMS({
       ratio: 1,
       url: 'http://192.168.105.219:6080/arcgis/services/planificacion/OTBS/MapServer/WMSServer',
       params: {
                    'FORMAT': format,
                    'VERSION': '1.1.1',
                    'LAYERS': '0',
                    'STYLES': '',
                  },
        })
       });
       capa_otbs.set('name', 'capa_otbs');
       capa_otbs.set('visible', true);





       capa_vias = new ol.layer.Image({
       source: new ol.source.ImageWMS({
       ratio: 1,
       url: 'http://192.168.105.219:6080/arcgis/services/planificacion/viasCache/MapServer/WMSServer',
       params: {
                    'FORMAT': format,
                    'VERSION': '1.1.1',
                    'LAYERS': '0',
                    //'LAYERS': '7',
                    'STYLES': '',
                  },
        })
       });
       capa_vias.set('name', 'capa_vias');
       capa_vias.set('visible', true);


       capa_manzanas = new ol.layer.Image({
       source: new ol.source.ImageWMS({
       ratio: 1,
       url: 'http://192.168.105.219:6080/arcgis/services/catastro/manzanasCache/MapServer/WMSServer',
       params: {
                    'FORMAT': format,
                    'VERSION': '1.1.1',
                    'LAYERS': '0',
                    'STYLES': '',
                  },
        })
       });
       capa_manzanas.set('name', 'capa_manzanas');
       capa_manzanas.set('visible', true);


       capa_predios = new ol.layer.Image({
       source: new ol.source.ImageWMS({
       ratio: 1,
       url: 'http://192.168.105.219:6080/arcgis/services/catastro/prediosCache/MapServer/WMSServer',
       params: {
                    'FORMAT': format,
                    'VERSION': '1.1.1',
                    'LAYERS': '0',
                    'STYLES': '',
                  },
        })
       });
       capa_predios.set('name', 'capa_predios');
       capa_predios.set('visible', true);



       projection = new ol.proj.Projection({
          code: 'EPSG:32719',
          units: 'm',
          axisOrientation: 'neu'
       });

       //alert(this.map);
       map = new ol.Map({
       controls: ol.control.defaults({
          attribution: false
       }).extend([mousePositionControl]),
       target: id_map,// el id del mapa
       layers: [
          capa_base,capa_otbs,capa_manzanas, capa_predios,capa_limites,capa_vias

       ],
       view: new ol.View({
          projection: projection,
       resolutions: [156543.03390625, 78271.516953125, 39135.7584765625, 19567.87923828125, 9783.939619140625, 4891.9698095703125, 2445.9849047851562, 1222.9924523925781, 611.4962261962891, 305.74811309814453, 152.87405654907226, 76.43702827453613, 38.218514137268066, 19.109257068634033, 9.554628534317017, 4.777314267158508, 2.388657133579254, 1.194328566789627, 0.5971642833948135, 0.29858214169740677, 0.14929107084870338, 0.07464553542435169, 0.037322767712175846, 0.018661383856087923, 0.009330691928043961, 0.004665345964021981, 0.0023326729820109904, 0.0011663364910054952, 5.831682455027476E-4, 2.915841227513738E-4, 1.457920613756869E-4]
       })
       });

       map.getView().fit(bounds, map.getSize());
       map.getView().setResolution(map.getView().getResolution() /2);


       map.getView().on('change:resolution', function(evt)
       {

        var resolution = evt.target.get('resolution');
        var units = map.getView().getProjection().getUnits();
        var dpi = 25.4 / 0.28;
        //alert(map.getView().getResolution());
        var mpu = ol.proj.METERS_PER_UNIT[units];
        var scale = resolution * mpu * 39.37 * dpi;
        var scale1 = resolution * mpu * 39.37 * dpi;
        if (scale >= 9500 && scale <= 950000)
        {
          scale = Math.round(scale / 1000) + "K";
        }
        else
        if (scale >= 950000)
        {
           scale = Math.round(scale / 1000000) + "M";

        }
        else
        {
          scale = Math.round(scale);
        }
        document.getElementById(id_scale).innerHTML = "Escala = 1 : " + scale1;


        if (scale1 < 3500)
            capa_otbs.set('visible', false);
        else
            capa_otbs.set('visible', true);



      });


     // definiciones para el popup
        var container = document.getElementById(id_popup);
        var content = document.getElementById(id_popup_content);
        var closer = document.getElementById(id_popup_closer);
        closer.onclick = function()
                {
                popup.setPosition(undefined);
                closer.blur();
                return false;
                };

        var popup = new ol.Overlay({
            element: container,

        });
        map.addOverlay(popup);
      // fin definiciones para el popup
      map.on('singleclick', function(evt)
      {
              /*
               var feature = map.forEachFeatureAtPixel(evt.pixel,
               function (feature, layer)
               {
                   return feature;
               });



               if (feature)
               {
                    codigo_feature = feature.get('posicion_usuario');
                    if (codigo_feature != 'posicion_usuario')
                    {
                         var geometry = feature.getGeometry();
                         var coord = geometry.getCoordinates();
                         var featureExtent = geometry.getExtent();
                         var featureCenter = ol.extent.getCenter(featureExtent);
                         popup.setPosition(coord);
                         content.innerHTML=feature.get('html_contenido');
                    }


                  // alert(coord);
               }
               else
               {

                   popup.setPosition(undefined);
                   closer.blur();
                   return false;
               }
               */
      });
    // funciones básicas del menu de contexto



    elastic = function(t)
    {
        return Math.pow(2, -10 * t) * Math.sin((t - 0.075) * (2 * Math.PI) / 0.3) + 1;
    };

    center = function(obj)
    {
         var pan = ol.animation.pan({
         duration: 1000,
         easing: elastic,
         source: map.getView().getCenter()
         });
         map.beforeRender(pan);
         map.getView().setCenter(obj.coordinate);
    };

    //fin de funciones basicas del menu de contexo
    contextmenu_items =  [ ];
    contextmenu = new ContextMenu(
    {
          width: 180,
          items: contextmenu_items
    });

    map.addControl(contextmenu);

    // Creacion por defecto del marcador si existe
    var id_letrero = getParameterByName('id');
    var razon_social, posicion_x, posicion_y;
    //Llamada AJAX
    /*
    $.ajax(
    {
         url: '/ws/get_data_letrero.php',
         data: {id:id_letrero},
         type:'GET',
         async: false,
         dataType: 'text',
         success: function(output_string)
         {
                if(output_string!='[]')
                {
                   $.each(JSON.parse(output_string), function(idx, obj1)
                   {
                        razon_social= obj1.razon_social;
                        posicion_x=obj1.posicion_x;
                        posicion_y=obj1.posicion_y;
                        razon_social=obj1.razon_social;
                        estado=obj1.estado;
                        coordenada=[posicion_x, posicion_y];
                        codigo_licencia=obj1.codigo_licencia;
                        tipo_letrero=obj1.tipo_letrero;
                        tipo_material=obj1.tipo_material;
                        superficie=obj1.superficie;
                        imagen=obj1.filename;

                        if (estado=='AC')
                               icono="iconos\/marcador_verde.png";
                        if (estado=='IN')
                               icono="iconos\/marcador_gris.png";
                        if (estado=='PE')
                               icono="iconos\/marcador_amarillo.png";

                        if ((posicion_x!=null) && (posicion_y!=null))
                        {
                                 //*****************
                                 var html_contenido;
                                 var imagen_fisica;
                                 if ((imagen!=null) && (imagen!=''))
                                 {
                                      imagen_fisica=window.location.origin+"/uploads/"+imagen;
                                      html_foto="<img src=\""+imagen_fisica+"\"/>";
                                      html_contenido='<b>Fotografía: </b>'+html_foto+'<b>Código de licencia: </b>'+codigo_licencia+'<b><br>Tipo: </b>'+tipo_letrero+'<br><b>Material: </b>'+tipo_material+'<br><b>Superficie: </b>'+superficie;
                                 }
                                 else
                                 {
                                      html_contenido='<b>Código de licencia: </b>'+codigo_licencia+'<b><br>Tipo: </b>'+tipo_letrero+'<br><b>Material: </b>'+tipo_material+'<br><b>Superficie: </b>'+superficie;
                                 }

                                 //alert('Estas son las coordenadas iniciales'+coordenada);
                                 var iconFeature = new ol.Feature({
                                 geometry: new ol.geom.Point(coordenada),
                                                 });

                                 var iconStyle = [new ol.style.Style({
                                                          image: new ol.style.Icon(({
                                                          anchor:[0.5,1],
                                                          anchorXUnits: 'fraction',
                                                          anchorYUnits: 'fraction',
                                                          rotateWithView: false,
                                                          scale: 0.2,
                                                          src:icono,
                                                    }))
                                                       }),
                                  new ol.style.Style({
                                                           text: new ol.style.Text({
                                                                text: razon_social,
                                                                offsetY: -55,
                                                                stroke: new ol.style.Stroke({color:'#000000' , width: '4'}),
                                                                fill: new ol.style.Fill({color: '#ffffff'})
                                                           })
                                                    }),
                                ];

                                iconFeature.setStyle(iconStyle);

                                iconFeature.set('html_contenido',html_contenido);

                                vectorSource.clear();
                                vectorSource.addFeature(iconFeature);

                                vectorLayer = new ol.layer.Vector({
                                      source: vectorSource,
                                });

                                 // Drag and drop feature
                                var dragInteraction = new ol.interaction.Modify({
                                    features: new ol.Collection([iconFeature]),
                                    style: null,
                                    pixelTolerance: 20
                                    });

                                // Add the event to the drag and drop feature
                                dragInteraction.on('modifyend',function(e)
                                {
                                    var f=e.features.getArray()[0];
                                    var coordenadas=f.getGeometry().getCoordinates();
                                    var view = map.getView();
                                    var viewResolution = view.getResolution();
                                    var source = capa_base.getSource();
                                    nombre_comuna= HallarComuna( view, viewResolution, source, capa_base, coordenadas);
                                    posicion_x=coordenadas[0];
                                    posicion_y=coordenadas[1];
                                    ActualizarRegistroLetrero(id_letrero, nombre_comuna, posicion_x, posicion_y);


                                },iconFeature)

                                map.getLayers().forEach(function(layer, i)
                                {
                                      if (layer.get('name')!=='base_catastro')
                                           map.removeLayer(layer);
                                });
                                map.addLayer(vectorLayer);
                                map.addInteraction(dragInteraction);
                           //*****************
                        }
                    });
                }
         }
         });
         */
    // Fin de llamada AJAX



    // fin de creacion del marcador si es que existe

    contextmenu.on('open', function(evt)
    {
        var feature = map.forEachFeatureAtPixel(evt.pixel, function(ft, l)
        {
           return ft;
        });

      //alert(feature.get('cod_sitio'));
      if (feature && feature.get('type') == 'removable')
      {
        contextmenu.clear();
        removeMarkerItem.data =
        {
          marker: feature
        };
        contextmenu.push(removeMarkerItem);
      } else
      {
        contextmenu.clear();// se vacian los items del menu
        contextmenu_items=DevuelveItemsMenu(feature);
        contextmenu.extend(contextmenu_items);//  Se agregan los items del menu
        contextmenu.extend(contextmenu.getDefaultItems());
      }
    });









  }

  function getParameterByName(name, url)
  {

        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
  }


  function DevuelveItemsMenu(feature)
  {
    contextmenu_items;
    if (feature)
    {
        contextmenu_items =
        [
            {
              text: 'Centrar aquí',
              classname: 'bold',
              icon: 'center.png',
              callback: center
            },

        ];

    }
    else
    {
contextmenu_items =
        [
            {
              text: 'Centrar aquí',
              classname: 'bold',
              icon: '/adultomayor/public/mapa/center.png',
              callback: center
            },
            {
              text: 'Operaciones',
              icon: '/adultomayor/public/mapa/view_list.png',
              items: [
                {
                  text: 'Crear marcador',
                  icon: '/adultomayor/public/mapa/agregar.png',
                  callback: function(obj)
                              {

                                 var icono="/adultomayor/public/mapa/pre_denuncia.png";
                                 var iconFeature = new ol.Feature({
                                                     geometry: new ol.geom.Point(obj.coordinate),
                                                     //name: 'Marcador'+i
                                                 });
                                 var iconStyle = [new ol.style.Style({
                                                          image: new ol.style.Icon(({
                                                          anchor:[0.5,1],
                                                          anchorXUnits: 'fraction',
                                                          anchorYUnits: 'fraction',
                                                          rotateWithView: false,
                                                          scale: 0.8,
                                                          src:icono,
                                                    }))
                                                       }),
                                   /*
                                  new ol.style.Style({
                                                           text: new ol.style.Text({
                                                                text: "Mi texto",
                                                                offsetY: -55,
                                                                stroke: new ol.style.Stroke({color:'#000000' , width: '4'}),
                                                                fill: new ol.style.Fill({color: '#ffffff'})
                                                           })
                                                    }),
                                     */
                                ];
                                iconFeature.setStyle(iconStyle);
                                //iconFeature.set('html_contenido',html_contenido);

                               iconFeature.set('posicion_nuevo_reclamo','posicion_nuevo_reclamo');
                               features_aux= vectorSource.getFeatures();

                               if (features_aux != null && features_aux.length > 0)
                               {
                                   for (x in features_aux)
                                   {
                                      codigo_feature = features_aux[x].get('posicion_nuevo_reclamo');
                                      if (codigo_feature == 'posicion_nuevo_reclamo')
                                      {
                                          source.removeFeature(features_[x]);
                                          break;
                                      }
                                   }
                               }


                                vectorSource.addFeature(iconFeature);
                                vectorLayer = new ol.layer.Vector({
                                      source: vectorSource,
                                });
                                // Drag and drop feature
                                var dragInteraction = new ol.interaction.Modify({
                                    features: new ol.Collection([iconFeature]),
                                    style: null,
                                    pixelTolerance: 20
                                    });
                                // Add the event to the drag and drop feature
                                dragInteraction.on('modifyend',function(e)
                                {
                                    var f=e.features.getArray()[0];
                                    var coordenadas=f.getGeometry().getCoordinates();
                                    var view = map.getView();
                                    var viewResolution = view.getResolution();
                                    var source = capa_base.getSource();
                                    posicion_x=coordenadas[0];
                                    posicion_y=coordenadas[1];
                                    $('#registrar_coord_s').val(posicion_y);
                                    $('#registrar_coord_e').val(posicion_x);

                                    source = capa_limites.getSource();
                                    datos_cl= HallarDatosCapaLimites( view, viewResolution, source,coordenadas);

                                    source = capa_vias.getSource();
                                    datos_cv=HallarDatosCapaVias( view, viewResolution, source, coordenadas);

                                    source = capa_otbs.getSource();
                                    datos_co=HallarDatosOtbs( view, viewResolution, source, coordenadas);

                                    $('#denuncia_subalcaldia').val(datos_cl.nombre_comuna);
                                    $('#denuncia_distrito').val(datos_cl.nombre_distrito);
                                   // $('#denuncia_zona').val(datos_cl.nombre_zona);
                                    $('#denuncia_denuncia').val(datos_cl.nombre);
                                    $('#denuncia_otb').val(datos_co.nombre);
                                    /*
                                    $('#registrar_tipo').val(datos_cv.tipo);
                                    $('#registrar_nombre').val(datos_cv.nombre);
                                    */



                                },iconFeature);
                                map.getLayers().forEach(function(layer, i)
                                {
                                      if (layer.get('name')!=='base_catastro' &&  layer.get('name')!=='capa_limites'  &&
                                          layer.get('name')!=='capa_vias' && layer.get('name')!=='capa_manzanas' &&
                                          layer.get('name')!=='capa_predios' && layer.get('name')!=='capa_otbs'
                                          )
                                           map.removeLayer(layer);
                                });

                                posicion_x=iconFeature.getGeometry().getCoordinates()[0];
                                posicion_y=iconFeature.getGeometry().getCoordinates()[1];
                                $('#registrar_coord_s').val(posicion_y);
                                $('#registrar_coord_e').val(posicion_x);

                                map.addLayer(vectorLayer);
                                map.addInteraction(dragInteraction);
                                var view = map.getView();
                                 var viewResolution = view.getResolution();
                                 var source = capa_limites.getSource();
                                 datos_cl= HallarDatosCapaLimites( view, viewResolution, source,obj.coordinate);


                                 source = capa_vias.getSource();
                                 datos_cv=HallarDatosCapaVias( view, viewResolution, source,source,obj.coordinate);

                                 source = capa_otbs.getSource();
                                 datos_co=HallarDatosOtbs( view, viewResolution, source,source,obj.coordinate);



                                 $('#denuncia_subalcaldia').val(datos_cl.nombre_comuna);
                                 $('#denuncia_distrito').val(datos_cl.nombre_distrito);
                                // $('#denuncia_zona').val(datos_cl.nombre_zona);

                                 $('#denuncia_otb').val(datos_co.nombre);
                                  /*
                                 $('#registrar_tipo').val(datos_cv.tipo);
                                 $('#registrar_nombre').val(datos_cv.nombre);
                                 */

                              }
                },
                /*
                {

                      text: 'Eliminar marcador',
                      icon: '/public/mapa/agregar.png',

                },
                */
              ]
            },

            '-' // this is a separator
        ];
    }
    return (contextmenu_items);
  }
