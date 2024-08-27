CKEDITOR.ClassicEditor.create(document.getElementById("answer"), {
            toolbar: {
                items: [
                    'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript',
                    'alignment', '|',
                    'link', 'insertImage',
                ],
                shouldNotGroupWhenFull: true
            },

            ckfinder: {
                uploadUrl: '/ckfinder_guest/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
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
        });