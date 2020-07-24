require('tinymce');

require('tinymce/plugins/paste');
require('tinymce/themes/modern');
require('tinymce/plugins/lists/plugin.min');
require('tinymce/plugins/advlist/plugin.min');
require('tinymce/plugins/fullpage');
require('tinymce/plugins/autolink/plugin.min');
require('tinymce/plugins/image/plugin.min');
require('tinymce/plugins/charmap/plugin.min');
require('tinymce/plugins/preview/plugin.min');
require('tinymce/plugins/hr/plugin.min');
require('tinymce/plugins/print/plugin.min');
require('tinymce/plugins/anchor/plugin.min');
require('tinymce/plugins/pagebreak/plugin.min');
require('tinymce/plugins/searchreplace/plugin.min');
require('tinymce/plugins/visualblocks/plugin.min');
require('tinymce/plugins/visualchars/plugin.min');
require('tinymce/plugins/wordcount/plugin.min');
require('tinymce/plugins/code/plugin.min');
require('tinymce/plugins/fullscreen/plugin.min');
require('tinymce/plugins/media/plugin.min');
require('tinymce/plugins/nonbreaking/plugin.min');
require('tinymce/plugins/insertdatetime/plugin.min');
require('tinymce/plugins/save/plugin.min');
require('tinymce/plugins/tabfocus/plugin.min');
require('tinymce/plugins/table/plugin.min');
require('tinymce/plugins/directionality/plugin.min');
require('tinymce/plugins/textcolor/plugin.min');
require('tinymce/plugins/contextmenu/plugin.min');
require('tinymce/plugins/template/plugin.min');
require('tinymce/plugins/colorpicker/plugin.min');
require('tinymce/plugins/textpattern/plugin.min');
require('tinymce/plugins/link');

var editor_config = {
  menubar: false,
  height: 500,
  document_base_url:
    process.env.NODE_ENV == 'production'
      ? `${window.location.origin}/`
      : `${window.location.origin}`,
  path_absolute:
    process.env.NODE_ENV == 'production'
      ? `${window.location.origin}/`
      : `${window.location.origin}`,
  selector: 'textarea.my-editor',
  remove_script_host: false,
  valid_elements: '*[*]',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak fullpage',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'template paste textcolor colorpicker textpattern'
  ],
  language: 'pt_BR',
  toolbar:
    'insert | template |fullpage |undo redo |  formatselect | bold italic backcolor forecolor  | alignleft aligncenter alignright alignjustify | styleselect | fontsizeselect | bullist numlist outdent indent | removeformat | help | link image media code',
  relative_urls: false,
  file_browser_callback: function(field_name, url, type, win) {
    var x =
      window.innerWidth ||
      document.documentElement.clientWidth ||
      document.getElementsByTagName('body')[0].clientWidth;
    var y =
      window.innerHeight ||
      document.documentElement.clientHeight ||
      document.getElementsByTagName('body')[0].clientHeight;

    var cmsURL = `${editor_config.path_absolute}/arquivos?field_name=${field_name}`;

    if (type == 'image') {
      cmsURL = cmsURL + '&type=Images';
    } else {
      cmsURL = cmsURL + '&type=Files';
    }

    tinyMCE.activeEditor.windowManager.open({
      file: cmsURL,
      title: 'Editor de dados',
      width: x * 0.9,
      height: y * 0.9,
      resizable: 'yes',
      close_previous: 'no'
    });
  },

  template_popup_height: '400',
  template_popup_width: '320',
  templates: [
    { title: 'Nome', description: 'Nome de Inscrito', content: '{{ $name }}' }
  ]
};
tinymce.init(editor_config);
