<html>
    <head>
        <meta charset="utf-8">
        <title>CkEditor</title>
        <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
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
            var editor;

                ClassicEditor
                    .create( document.querySelector('#editor'),{
                        ckfinder: {
                            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                        },
                        toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]

                    } )
                    .then( newEditor => {
                        editor = newEditor;
                    } )

                    .catch( error => {
                        console.error( error );
                    });

            document.getElementById("btn-submit").addEventListener("click", () => {
               const dataEditor = editor.getData(); // retourne les données au format html
               console.log(dataEditor);
            });
        </script>

    </body>

</html>
