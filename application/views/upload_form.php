<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>assets/uploadify.css" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="<?php echo site_url() ?>assets/jquery.uploadify-3.1.min.js"></script>
  <title></title>
</head>
<body>

    <div class="uploadify-queue" id="content_adjunto"></div>
    <input type="file" name="txt_adjunto" id="upload_btn" />  
    <input type="hidden" name="txtdireccion" id="txtdireccion" /> 
    <button type="button" id="btnGuardar">GUARDAR</button><br/>
    <span id="msj_error"></span>
    <hr/>
    Links de Archivos Predefinidos<br/>
    Ingrese el nombre de tu archivo a Descargar<br/>
    <input type="text" name="txt_namedowload" id="txt_namedowload" value="" placeholder="">
    <button type="button" id="btnDownload">Descargar</button><br/>
    Nota: Recuerde Ingresar el nombre con la extesión;<br/>
    <div>
      <!--
      <a href="<?php echo site_url() ?>upload_file/downloads_name/IMG_1829.jpg">Descarga 3</a>
      <a href="<?php echo site_url() ?>upload_file/downloads_name/logobolognesi.png">Descarga 4</a>-->
    </div>

    <script type='text/javascript' >
      var ejecuta = false;
      var base_url = '<?php echo base_url();?>';
      var cadena = "";
      var cadena_dir = "";

      $(document).ready(function () {

        $('#btnGuardar').click(function (e) {
            e.preventDefault();
            $('#upload_btn').uploadify('upload', '*');
        });

        $('#upload_btn').uploadify({
            'debug': false,
            'auto':false,
            'swf': base_url + 'assets/uploadify.swf',
            'uploader': base_url + 'upload_file/uploadFile',
            'cancelImg': base_url + 'assets/uploadify-cancel.png',
            'folder': '../uploads',
            'fileTypeExts':'*.png;*.jpg;*.bmp;*.png;*.pdf;*.pptx;*.ppt;*.docx;*.doc;*.txt;*.xlsx;*.xls',
            'fileTypeDesc':'Files',
            'fileSizeLimit':'2MB',
            'fileObjName':'txt_adjunto',
            'queueID'  : 'content_adjunto',
            'buttonText':'Select Archivo(s)',
            'buttonClass'  : 'button',
            'multi':true,
            'width'    : 200,
            'method'  : 'post',
            'removeCompleted':false,
            'onSelectError' : function(file) {
              $("#msj_error").text('El Archivo ' + file.name + ' excede el tamaño limite de 2MB');
            },
            'onCancel' : function(file) {
                console.log('The file ' + file.name + ' was cancelled.');
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                console.log(file);
                console.log(errorString);
            },
            'onUploadSuccess' : function(file, data, response) {
                console.log('The file data: ' + file);
                console.log('The file data: ' + data);
                cadena = cadena + data+";";
                cadena_dir = cadena_dir + file.name + ";";
                // cadena = nombre del archivo
                // cadena _ dir el es nombre codificado del archivo
                // Esto funciona para 1 o mas archivos
            },
            'onUploadComplete' : function(file) {
                console.log(file);
                console.log('The file ' + file.name + ' finished processing.');
            },
            'onQueueComplete' : function(queueData) {
                console.log(queueData);
                // Aqui se envia o llama al formulario para que se envie la data despues de haber subido la informacion al servidor
            }
        });
      
        $('#btnDownload').click(function (e){
            var text_name = $("#txt_namedowload").val();
            location.href="<?php echo site_url() ?>upload_file/downloads_name/"+text_name;
            $("#txt_namedowload").val("");
        });

      });
    </script>

</body>
</html>