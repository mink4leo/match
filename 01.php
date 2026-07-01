<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKEditor 5 - Quick start CDN</title>
    <!-- <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css"> -->
    <script src="../admin3/ckeditor.js"></script>

    <style>
        .main-container {
            width: 795px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div id="editor">
            <p>Hello from CKEditor 5!</p>
        </div>
    </div>

    <script>
        // CKEDITOR =================================================================
        // initSample(); 

        CKEDITOR.replace('editor',

            {
                toolbar: [{
                        name: "document",
                        items: ["Source", "-", "NewPage", "Preview", "-", "Templates"],
                    }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                    ["Cut", "Copy", "Paste", "PasteText", "PasteFromWord", "Image"], // Defines toolbar group without name.
                    "/", // Line break - next group will be placed in new line.
                    {
                        name: "basicstyles",
                        items: ["Bold", "Italic"]
                    },
                ],
            }
        );
        // CKEDITOR.replace('locationA');
        // CKEDITOR.replace('medalA');
        // CKEDITOR.replace('cer_idcard');

        // CKEDITOR.editorConfig = function(config) {
        //     // Define changes to default configuration here. For example:
        //     config.language = 'th';
        //     //config.uiColor = '#AADC6E';

        //     // config.extraPlugins = 'image';
        //     // config.filebrowserUploadUrl = 'ckupload.php';
        //     config.image_removeLinkByEmptyURL = true;
        //     config.image_previewText = CKEDITOR.tools.repeat('ตัวอย่างรูปภาพ ', 100);

        // };

 
    </script>
</body>

</html>