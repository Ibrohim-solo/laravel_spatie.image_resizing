const Uppy = require('@uppy/core')
const Dashboard = require('@uppy/dashboard')
const GoogleDrive = require('@uppy/google-drive')
const Dropbox = require('@uppy/dropbox')
const Box = require('@uppy/box')
const Instagram = require('@uppy/instagram')
const Facebook = require('@uppy/facebook')
const OneDrive = require('@uppy/onedrive')
const Webcam = require('@uppy/webcam')
const ScreenCapture = require('@uppy/screen-capture')
const ImageEditor = require('@uppy/image-editor')
const Tus = require('@uppy/tus')
const Url = require('@uppy/url')
const DropTarget = require('@uppy/drop-target')
const GoldenRetriever = require('@uppy/golden-retriever')

const uppy = new Uppy({
    debug: true,
    autoProceed: false,
    restrictions: {
        maxFileSize: 1000000,
        maxNumberOfFiles: 3,
        minNumberOfFiles: 2,
        allowedFileTypes: ['image/*', 'video/*'],
        requiredMetaFields: ['caption'],
    }
})
    .use(Dashboard, {
        trigger: '.UppyModalOpenerBtn',
        inline: true,
        target: '.DashboardContainer',
        showProgressDetails: true,
        note: 'Images and video only, 2–3 files, up to 1 MB',
        height: 470,
        metaFields: [
            { id: 'name', name: 'Name', placeholder: 'file name' },
            { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
        ],
        browserBackButtonClose: false
    })
    .use(GoogleDrive, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
    .use(Dropbox, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
    .use(Box, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
    .use(Instagram, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
    .use(Facebook, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
    .use(OneDrive, { target: Dashboard, companionUrl: 'https://companion.uppy.io' })
    .use(Webcam, { target: Dashboard })
    .use(ScreenCapture, { target: Dashboard })
    .use(ImageEditor, { target: Dashboard })
    .use(Tus, { endpoint: 'https://tusd.tusdemo.net/files/' })
    .use(DropTarget, {target: document.body })
    .use(GoldenRetriever)

uppy.on('complete', result => {
    console.log('successful files:', result.successful)
    console.log('failed files:', result.failed)
})
