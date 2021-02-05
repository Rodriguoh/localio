<html>
    <head>
        <meta charset="utf-8">
        <title>CkEditor</title>
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    </head>

    <body>
        <h1> Clasic editor</h1>
        <div>
            <form action="" id="submit">
                <textarea name="editor" id="editor"></textarea>
                <input type="button" id="btn-submit" value="Valider"/>
            </form>
        </div>

        <script>
            var editor = CKEDITOR.replace( 'editor', {
                filebrowserUploadUrl: "{{route('ckeditor.upload',['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
                uiColor: '#ADD8E6',
                width:'85%',
                height:500
            } );

            document.getElementById("btn-submit").addEventListener("click", () => {
               const dataEditor = editor.getData(); // retourne les données au format html
               console.log(dataEditor);
            });
        </script>

    </body>

</html>
