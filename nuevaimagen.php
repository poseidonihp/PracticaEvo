<script src="js/jquery.js"></script>
<script src="js/draganddrop.js"></script>
<!-- //Query Js que usa para Drag and Dropp -->

<!-- Formulario de carga de los archivos -->
<form name="upload">
<div class="formulario-title"><span >REGISTRAR ARCHIVOS</span></div>

<!-- Puedes adicionar mas campos que gustes, solo recuerda ingresarlos ala BD -->
    <div class="contend-form">
        <label>Nombre</label><br />
        <input type="text" name="nombre" id="nombre"/><br />
		<label>Prioridad</label><br />
        <input type="number"  name="prioridad" id="prioridad"/><br />
        <label>Descripción</label><br />
        <textarea name="descripcion" id="desc"></textarea><br /></br>
		
    </div>
<!-- //  -->

    <!-- Aki arrastras la imagen Aqui -->
    <div class="drag-drop" id="drop-files" ondragover="return false">
        Arrastrar sus archivos aquí
    </div>
     <!-- //Aki arrastras la imagen Aqui -->

    <!-- Box que almacena la imagenes a cargar como vista preliminar -->
    <div style="padding:10px;">
        <div id="uploaded-holder">
        <div id="dropped-files">
            <div id="upload-button">
                <a href="/" class="upload">Subir!</a>
                <a href="/" class="delete">Eliminar</a>
                <span>0 Files</span>
            </div>
        </div>
        <div id="extra-files">
            <div class="number">
                0
            </div>
            <div id="file-list">
                <ul></ul>
            </div>
        </div>
    </div>
        <div id="loading">
            <div id="loading-bar">
                <div class="loading-color"> </div>
            </div>
            <div id="loading-content">Cargando file</div>
        </div>
    </div>
    <!-- //Box que almacena la imagenes a cargar como vista preliminar -->

    <!-- Despliega los archivos cargados al directorio -->
    <!-- <div id="file-name-holder">
        <ul id="uploaded-files">
            <h1>Uploaded Files</h1>
        </ul>
    </div> -->
    <div style="clear:both;"></div>
    </div>
</form>
<!-- //Formulario de carga de los archivos -->