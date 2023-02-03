<!DOCTYPE html>
<html>
  <head>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  </head>
  <body>
    <div id="editor">
      <p>Write something here...</p>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
      var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        [{'header': [1,2,3,4,5,6,false]}],
        [{'list': 'ordered'},{'list': 'bullet'}],
        [{'indent': '-1'}, {'indent': '+1'}],
        [{'direction': 'rtl'}],
        [{'size': ['small', false, 'large', 'huge']}],
        ['link', 'image', 'video', 'formula'],
        [{'color': []}],
        [{'font': []}],
        [{'align': []}]
      ];

      var quill = new Quill('#editor', {
        modules: {
          toolbar: toolbarOptions
        },
        theme: 'snow'
      });

      var range = quill.getSelection();
if (range) {
  var imageUrl = 'https://img2.rtve.es/i/?w=1600&i=1634194794500.jpg';
  quill.insertEmbed(range.index, 'image', imageUrl, Quill.sources.USER);
  quill.setSelection(range.index + 1, Quill.sources.SILENT);
}
    </script>
  </body>
</html>