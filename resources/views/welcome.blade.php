<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Uppy</title>
    <link href="https://releases.transloadit.com/uppy/v2.1.0/uppy.min.css" rel="stylesheet">
</head>
<body>
<div id="drag-drop-area"></div>

<script src="https://releases.transloadit.com/uppy/v2.1.0/uppy.min.js"></script>
<script>
    var uppy = new Uppy.Core({
        debug: true,
        autoProceed: false,
        restrictions: {
            minFileSize: null,
            maxFileSize: 10000000,
            maxTotalFileSize: null,
            maxNumberOfFiles: 10,
            minNumberOfFiles: 0,
            allowedFileTypes: null,
            requiredMetaFields: [],
        },
        meta: {},
        onBeforeFileAdded: (currentFile, files) => currentFile,
        onBeforeUpload: (files) => {


        },
        locale: {},
        store: new Uppy.DefaultStore(),
        logger: Uppy.justErrorsLogger,
        infoTimeout: 5000,
    })
        .use(Uppy.Dashboard, {
            trigger: '.UppyModalOpenerBtn',
            inline: true,
            target: '#drag-drop-area',
            showProgressDetails: true,
            note: 'Все типы файлов, до 10 МБ',
            height: 470,
            metaFields: [
                {id: 'name', name: 'Name', placeholder: 'file name'},
                {id: 'caption', name: 'Caption', placeholder: 'describe what the image is about'}
            ],
            browserBackButtonClose: true
        })

        // .use(Uppy.GoogleDrive, {target: Uppy.Dashboard, companionUrl: 'https://companion.uppy.io'})
        // .use(Uppy.Dropbox, {target: Uppy.Dashboard, companionUrl: 'https://companion.uppy.io'})
        // .use(Uppy.Instagram, {target: Uppy.Dashboard, companionUrl: 'https://companion.uppy.io'})
        // .use(Uppy.Facebook, {target: Uppy.Dashboard, companionUrl: 'https://companion.uppy.io'})
        // .use(Uppy.OneDrive, {target: Uppy.Dashboard, companionUrl: 'https://companion.uppy.io'})
        // .use(Uppy.Webcam, {target: Uppy.Dashboard})
        // .use(Uppy.ScreenCapture, {target: Uppy.Dashboard})
        // .use(Uppy.ImageEditor, {target: Uppy.Dashboard})
        // .use(Uppy.DropTarget, {target: document.body})
        // .use(Uppy.GoldenRetriever)
        .use(Uppy.XHRUpload, {
            endpoint: '/fileUpload',
            fieldName: 'file',
            headers: file => ({
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }),
        });

    uppy.on('upload-success', (file, response) => {
        const httpStatus = response.status // HTTP status code
        const httpBody = response.body   // extracted response data

        // do something with file and response
    });


    uppy.on('file-added', (file) => {
        uppy.setFileMeta(file.id, {
            size: file.size,
        });
    });
    uppy.on('complete', result => {
        console.log('successful files:', result.images)
        console.log('failed files:', result.failed)

    });



</script>

</body>
</html>
