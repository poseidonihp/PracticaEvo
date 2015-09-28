$(document).ready(function() {
	
	// Hace que la información dataTransfer se envía cuando
	// Colocar el elemento en el cuadro desplegable.
	jQuery.event.props.push('dataTransfer');
	
	var z = -40;
	// El número de imágenes para mostrar
	var maxFiles = 15;
	var errMessage = 0;
	
	// Obtenga todas las URIs de datos y ponerlos en una matriz
	var dataArray = [];
	
	// Enlace el evento de colocación de la zona de saltos.
	$('#drop-files').bind('drop', function(e) {
			
		// Stop the default action, which is to redirect the page
		// To the dropped file
		
		var files = e.dataTransfer.files;
		
		// Show the upload holder
		$('#uploaded-holder').fadeIn(1000);
		
		// For each file
		$.each(files, function(index, file) {
						
			// Aqui se maneja los tipos de extensiones a subir.
			if (!files[index].type.match('image.*') && !files[index].type.match('application.*') && !files[index].type.match('text.*')) {
				
				if(errMessage == 0) {
					$('#drop-files').html('Hey! Solo archivos .doc,.pdf,.txt,.html.xls,.jpg');
					++errMessage
				}
				else if(errMessage == 1) {
					$('#drop-files').html('Detente! Solo .doc,.pdf,.txt,.html.xls,.jpg!');
					++errMessage
				}
				else if(errMessage == 2) {
					$('#drop-files').html("¿No sabes leer?! solamente .doc,.pdf,.txt,.html.xls,.jpg!");
					++errMessage
				}
				else if(errMessage == 3) {
					$('#drop-files').html("Carajos hermano entiende!! solo .doc,.pdf,.txt,.html.xls,.jpg :)");
					errMessage = 0;
				}
				return false;
			}
			
			// Compruebe la longitud de los elementos de imagen total.
			if($('#dropped-files > .image').length < maxFiles) {
				// Cambiar la posición del botón de subida por lo que se centrarse.
				var imageWidths = ((220 + (40 * $('#dropped-files > .image').length)) / 2) - 20;
				$('#upload-button').css({'left' : imageWidths+'px', 'display' : 'block'});
			}
			
			// Empezar una nueva instancia de FileReader.
			var fileReader = new FileReader();
				
				// When the filereader loads initiate a function
				fileReader.onload = (function(file) {
					
					return function(e) { 
						
						// Empuje el URI de datos en una matriz.
						//Aqui mismo podra agragar los campos que desee del formulario, esto seran enviado a upload.php
						dataArray.push({name : file.name, value : this.result, nombre: $('#nombre').val(), descripcion:$('#desc').val()});
						
						// Mueva cada imagen de 40 píxeles de ancho más.
						z = z+40;
						var image = this.result;
						
						
						//Condicion de mensaje cuando cargas 1 archivo o mas de 1
						if(dataArray.length == 1) {
							$('#upload-button span').html("1 Archivo cargado");
						} else {
							$('#upload-button span').html(dataArray.length+" Archivos cargados");
						}

						// Mas de 1 imagen extra mostrar lista
						if($('#dropped-files > .image').length < maxFiles) { 
							// Place the image inside the dropzone
							$('#dropped-files').append('<div class="image" style="left: '+z+'px; background: url('+image+'); background-size: 100%;"> </div>'); 
						}
						else {
							
							$('#extra-files .number').html('+'+($('#file-list li').length + 1));
							// Mostrar el diálogo de archivos adicionales
							$('#extra-files').show();
							
							// Empezar a añadir el nombre de archivo a la lista de archivos
							$('#extra-files #file-list ul').append('<li>'+file.name+'</li>');
							
						}
					}; 
				})(files[index]);
			// For data URI purposes
			fileReader.readAsDataURL(file);
	
		});
		

	});
	
	function restartFiles() {
	
		// Esto es para ajustar la barra de carga de nuevo a su estado por defecto
		$('#loading-bar .loading-color').css({'width' : '0%'});
		$('#loading').css({'display' : 'none'});
		$('#loading-content').html(' ');
		// --------------------------------------------------------
		
		// Tenemos que eliminar todas las imágenes y elementos li como
		// Apropiado. También haremos desaparecer el botón de subida
		
		$('#upload-button').hide();
		$('#dropped-files > .image').remove();
		$('#extra-files #file-list li').remove();
		$('#extra-files').hide();
		$('#uploaded-holder').hide(1000);
	
		// And finally, empty the array/set z to -40
		dataArray.length = 0;
		z = -40;
		
		return false;
	}
	
	//Click subir archivos
	$('#upload-button .upload').click(function() {
		
		//Validar que los campos sean lleanos antes de cargar las imagenes.

		$("#loading").show();
		var totalPercent = 100 / dataArray.length;
		var x = 0;
		var y = 0;
		
		$('#loading-content').html('Cargando '+dataArray[0].name);
		
		$.each(dataArray, function(index, file) {	
			
			$.post('upload.php', dataArray[index], function(data) {
			
				var fileName = dataArray[index].name;
				//Cargar los elementos del formulario

				++x;
				
				// Cambie la barra para representar cuánto se ha cargado
				$('#loading-bar .loading-color').css({'width' : totalPercent*(x)+'%'});
				
				if(totalPercent*(x) == 100) {
					// Mostrar finalizada la carga
					$('#loading-content').html('Carga completa!');
					
					// Restablecer todo cuando se ha completado la carga
					setTimeout(restartFiles, 500);
					//Esto refrescara el navegador para revisar el listado y que se haya cargado las imagenes.
					location.reload();
					
				} else if(totalPercent*(x) < 100) {
				
					// Demostrar que los archivos están cargando
					$('#loading-content').html('Uploading '+fileName);
				
				}
				
				// Mostrar un mensaje que muestra la dirección URL del archivo.
				var dataSplit = data.split(':');
				if(dataSplit[1] == 'subido correctamente') {
					var realData = '<li><a href="images/'+dataSplit[0]+'">'+fileName+'</a> '+dataSplit[1]+'</li>';
					
					$('#uploaded-files').append('<li><a href="images/'+dataSplit[0]+'">'+fileName+'</a> '+dataSplit[1]+'</li>');
				
					// Añadir a local storage 
					if(window.localStorage.length == 0) {
						y = 0;
					} else {
						y = window.localStorage.length;
					}
					
					window.localStorage.setItem(y, realData);
				
				} else {
					$('#uploaded-files').append('<li><a href="images/'+data+'. File Name: '+dataArray[index].name+'</li>');
				}
				
			});
		});
		return false;
});


	
	// Sólo un poco de estilo para el contenedor de archivos de la gota.
	$('#drop-files').bind('dragenter', function() {
		$(this).css({'box-shadow' : 'inset 0px 0px 20px rgba(0, 0, 0, 0.22)', 'border' : '4px dashed #FFF'});
		return false;
	});
	
	$('#drop-files').bind('drop', function() {
		$(this).css({'box-shadow' : 'none', 'border' : '4px dashed rgba(0,0,0,0.2)'});
		return false;
	});
	
	// For the file list
	$('#extra-files .number').toggle(function() {
		$('#file-list').show();
	}, function() {
		$('#file-list').hide();
	});
	
	$('#dropped-files #upload-button .delete').click(restartFiles);
	
	// Append the localstorage the the uploaded files section
	if(window.localStorage.length > 0) {
		$('#uploaded-files').show();
		for (var t = 0; t < window.localStorage.length; t++) {
			var key = window.localStorage.key(t);
			var value = window.localStorage[key];
			// Append the list items
			if(value != undefined || value != '') {
				$('#uploaded-files').append(value);
			}
		}
	} else {
		$('#uploaded-files').hide();
	}
});