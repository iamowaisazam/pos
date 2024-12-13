tinymce.init({
    selector: 'textarea#long_description_default', // Corrected the selector
    width: 900,
    height: 300,
    plugins: [
      'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview',
      'anchor', 'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 
      'code', 'fullscreen', 'insertdatetime', 'media', 'table', 'emoticons', 
      'template', 'codesample'
    ],
    toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | ' +
             'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
             'forecolor backcolor emoticons',
    menu: {
      favs: {title: 'Favorites', items: 'code visualaid | searchreplace | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });