document.addEventListener("DOMContentLoaded", function (event) {
    for (let i = 1; i < 3; i++) {
        CKEDITOR.ClassicEditor
            .create(document.getElementById("editor" + i), {
                toolbar: {
                    items: [
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight',
                        '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                        'superscript', '|',
                        'insertImage', 'CKFinder', 'insertTable', 'link', '|',
                        'alignment', 'htmlEmbed', '|',
                        '-',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'undo', 'redo', '|',
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'blockQuote', 'mediaEmbed', 'codeBlock', '|',
                        //'textPartLanguage', '|',
                        'sourceEditing',
                    ],
                    shouldNotGroupWhenFull: false
                },

                ckfinder: {
                    uploadUrl: '/ckfinder_admin/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                },

                removePlugins: [
                    'CKBox',
                    'EasyImage',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType',
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                ]
            })
            .catch(error => {
                console.log(error);
            });
    }
});