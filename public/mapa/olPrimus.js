
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
  function HallarComuna( view, viewResolution, source, capa_base, coordenadas)
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
                                    }
                                  }); 
                                 return nombre_comuna;
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
       url: 'http://192.168.105.219:6080/arcgis/services/cercado/baseCercado/MapServer/WMSServer',
       params: {
                    'FORMAT': format,
                    'VERSION': '1.1.1',  
                    'LAYERS': '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14',
                    //'LAYERS': '7',
                    'STYLES': '',
                  },
        })
       });

       capa_base.set('name', 'base_catastro');
       capa_base.set('visible', true);

       

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
          capa_base
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
        if (scale >= 9500 && scale <= 950000) {
          scale = Math.round(scale / 1000) + "K";
        } else if (scale >= 950000) {
          scale = Math.round(scale / 1000000) + "M";
        } else {
          scale = Math.round(scale);
        }
        document.getElementById(id_scale).innerHTML = "Escala = 1 : " + scale;
       
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
               var feature = map.forEachFeatureAtPixel(evt.pixel,
               function (feature, layer) 
               {
                   return feature;
               });
               
               if (feature) 
               {
                   var geometry = feature.getGeometry();
                   var coord = geometry.getCoordinates();
                   var featureExtent = geometry.getExtent();
                   var featureCenter = ol.extent.getCenter(featureExtent);
                             
                   popup.setPosition(coord);
                   content.innerHTML=feature.get('html_contenido');
                  // alert(coord);
               } 
               else 
               {

                   popup.setPosition(undefined);
                   closer.blur();
                   return false;
               }
               
          
          /*
                var view = map.getView();
                var viewResolution = view.getResolution();
                var source = capa_base.getSource();
                var url = source.getGetFeatureInfoUrl(
                  evt.coordinate, viewResolution, view.getProjection(),
                  {'INFO_FORMAT': 'application/json', 'FEATURE_COUNT': 50});
                var auxiliar;
                if (url) 
                {
                        popup.setPosition(evt.coordinate);
                        //obtenemos los valores de la url con ajax
                        $.ajax(
                        {
                            url: url,
                            type:'GET',
                            dataType: 'text',
                            async: false,
                            success: function(output_string)
                                    {
                                      uso_de_suelo=HallarValorEtiqueta('UsodeSuelo', output_string);
                                      manzanas=HallarValorEtiqueta('Manzanas', output_string);
                                      subdistrito=HallarValorEtiqueta('SubDistrit', output_string);
                                      distrito=HallarValorEtiqueta('Distrito', output_string);
                                      nombre_subdistrito=HallarValorEtiqueta('NombreSD', output_string);

                                      var numero_subdistrito;
                                      var nombre_subdistrito;

                                      EncontrarDatosDistrito(output_string);
                                      comuna=HallarValorEtiqueta('Comuna', output_string);
                                      comuna= String(comuna);
                                      comuna=comuna.replace('Comuna ','');
                                      if (output_string.indexOf("Tipo")!=-1)
                                      // si existe la cadena "Tipo"
                                      {
                                          cadena_hasta_tipo=output_string.substring(output_string.indexOf("Tipo"));
                                          indice_final=cadena_hasta_tipo.indexOf("/FIELDS>");
                                          fila=cadena_hasta_tipo.substring(0,indice_final);
                                          array_cadenas=obtenerTextoEnComillas(fila);
                                          tipo=array_cadenas[0];
                                          nombre=array_cadenas[1];
                                          if (typeof tipo==='undefined')  
                                             comuna="No definido";
                                          if (typeof nombre==='undefined')  
                                             comuna="No definido";
                                      }
                                      else
                                      {
                                          cadena_hasta_catastral=output_string.substring(output_string.indexOf("CódigoCatastral"));
                                          indice_final=cadena_hasta_catastral.indexOf("</FIELDS>");
                                          fila=cadena_hasta_catastral.substring(0,indice_final-1);
                                          array_cadenas=obtenerTextoEnComillas(fila);
                                          codigo_catastral=array_cadenas[0];
                                          //distrito=array_cadenas[1];
                                          nro_subdistrito=array_cadenas[2];
                                          nro_manzana=array_cadenas[3];
                                          nro_predio=array_cadenas[4];
                                          nro_inmueble=array_cadenas[5];
                                          zona_tributaria=array_cadenas[6];
                                          tipo="No definido";
                                          nombre="No definido";
                                          //subdistrito=array_cadenas[7];
                                          //comuna=array_cadenas[8];    
                                      }
          
                                      content.innerHTML=
                                                        "<b>Uso de suelo:</b>"+uso_de_suelo+"<br>"+
                                                        "<b>Manzana:</b>"+manzanas+"<br>"+
                                                        "<b>Nro. Subdistrito:</b>"+numero_subdistrito+"<br>"+
                                                        "<b>Distrito:</b>"+distrito+"<br>"+
                                                        "<b>Nombre de subdistrito:</b>"+nombre_subdistrito+"<br>"+
                                                        "<b>Comuna:</b>"+comuna+"<br>"+
                                                        "<b>Tipo:</b>"+tipo+"<br>"+
                                                        "<b>Nombre:</b>"+nombre+"<br>"+

                                                        "<b>---------<br>";
                                                        
                                                        
                                                        //"<b>Distrito:</b>"+distrito+"<br>"+
                                                        //"<b>Nro. Subdistrito:</b>"+nro_subdistrito+"<br>"+
                                                        //"<b>Subdistrito:</b>"+subdistrito+"<br>"+
                                                        //"<b>Comuna:</b>"+comuna+"<br>"+
                                                        //"<b>Zona Tributaria:</b>"+zona_tributaria+"<br>"+
                                                        //"<b>Nro. Manzana:</b>"+nro_manzana+"<br>"+
                                                        //"<b>Nro. Predio:</b>"+nro_predio+"<br>"+
                                                        //"<b>Cód. Catastral:</b>"+codigo_catastral+"<br>"+
                                                        //"<b>Nro. Inmueble:</b>"+nro_inmueble;
                                                        
                                     
                                     document.getElementById('distrito').innerHTML = distrito;                                              
                                     document.getElementById('nro_subdistrito').innerHTML = nro_subdistrito;                                              
                                     document.getElementById('subdistrito').innerHTML = subdistrito;                                              
                                     document.getElementById('comuna').innerHTML = comuna;                                              
                                     document.getElementById('zona_tributaria').innerHTML = zona_tributaria;                                              
                                     document.getElementById('nro_manzana').innerHTML = nro_manzana;                                              
                                     document.getElementById('nro_predio').innerHTML = nro_predio;                                              
                                     document.getElementById('codigo_catastral').innerHTML = codigo_catastral;                                              
                                     document.getElementById('nro_inmueble').innerHTML = nro_inmueble;                                              
                                                        
                                      
                                      //content.innerHTML=array_cadenas;

                                    }
                        }); 
                        //---------------------
                       // content.innerHTML='<iframe seamless src="' + url + '"></iframe>';
                       //document.getElementById('nodelist').innerHTML = '<iframe seamless src="' + url + '"></iframe>';
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
            {
              text: 'Operaciones',
              icon: 'view_list.png',
              items: [
                
                {
                  text: 'Eliminar',
                  icon: 'eliminar.png',
                  callback: function(obj)
                              {
                                     vectorSource.removeFeature(feature);
                                     vectorLayer = new ol.layer.Vector({
                                                                      source: vectorSource,
                                                                });
                                     var id_letrero = getParameterByName('id'); 

                                     ActualizarRegistroLetrero(id_letrero, "''","''","''");
                                     map.getLayers().forEach(function(layer, i) 
                                     {
                                         if (layer.get('name')!=='base_catastro')
                                              map.removeLayer(layer);   
                                     });
                                     map.addLayer(vectorLayer);
                              }
                },
              ]
            },
            '-' // this is a separator
        ];
        
    }
    else 
    {
contextmenu_items = 
        [
            {
              text: 'Centrar aquí',
              classname: 'bold',
              icon: 'center.png',
              callback: center
            },
            {
              text: 'Operaciones',
              icon: 'view_list.png',
              items: [
                {
                  text: 'Crear marcador',
                  icon: 'agregar.png',
                  callback: function(obj)
                              {
                                 var id_letrero = getParameterByName('id'); 
                                 var razon_social;
                                 var estado;
                                 var codigo_licencia;
                                 var tipo_letrero;
                                 var tipo_material;
                                 var superficie;
                                 var imagen;
                                 //Llamada AJAX
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
                                                 coordenadas=obj.coordinate;   
                                                 estado=obj1.estado;
                                                 codigo_licencia=obj1.codigo_licencia;
                                                 tipo_letrero=obj1.tipo_letrero;
                                                 tipo_material=obj1.tipo_material;
                                                 superficie=obj1.superficie;
                                                 imagen=obj1.filename;

                                           });
                                           
                                      }
                                    }
                                  });
                                  // Fin de llamada AJAX
                                  if (estado=='AC')          
                                      icono="iconos\/marcador_verde.png";
                                  if (estado=='IN')          
                                      icono="iconos\/marcador_gris.png";  
                                  if (estado=='PE')          
                                      icono="iconos\/marcador_amarillo.png";    
                                  
                                 

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

                                //alert(vectorSource.getFeatures().length);  // devuelve el numero de features
                                vectorSource.clear();
                                vectorSource.addFeature(iconFeature);
                               
                                vectorLayer = new ol.layer.Vector({
                                      source: vectorSource,
                                });
                                
                                

                                // Obtencion de la comuna dadas las coordenadas del marcador
                                var view = map.getView();
                                var viewResolution = view.getResolution();
                                var source = capa_base.getSource();
                                var coordenadas= iconFeature.getGeometry().getCoordinates();

                                nombre_comuna= HallarComuna( view, viewResolution, source, capa_base, coordenadas);
                                
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

                                    
                                },iconFeature);



                                map.getLayers().forEach(function(layer, i) 
                                {
                                      if (layer.get('name')!=='base_catastro')
                                           map.removeLayer(layer);   
                                });
                                //******** Actualizacion de las coordenadas del registro actual al crear el marcador
                                posicion_x=iconFeature.getGeometry().getCoordinates()[0];
                                posicion_y=iconFeature.getGeometry().getCoordinates()[1];

                                ActualizarRegistroLetrero(id_letrero, nombre_comuna, posicion_x, posicion_y);
                                //********Fin de actualizacino de coordenadas del registro actual 
                                map.addLayer(vectorLayer);
                                map.addInteraction(dragInteraction);
                                //alert(map.getLayers().getArray().length);  // devuelve el numero de layers
                              }
                },
              ]
            },
            '-' // this is a separator
        ];
    }
    return (contextmenu_items); 
  }




















