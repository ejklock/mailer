import jquery from 'jquery';
import './vendor/taginput';
window.jQuery = jquery;
window.$ = jquery;
window.$ = window.jquery = jquery;
global.$ = global.jQuery = jquery;
import 'bootstrap';
import './vendor/editor';
import 'util';
import './vendor/sb-admin.min';

$(function() {
  $('[data-toggle="tooltip"]').tooltip();
});

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function() {
  $('#emails').tagsinput('focus', {
    onTagExists: function(item, $tag) {
      $tag.hide.fadeIn();
    }
  });

  $('#csv').on('click', function() {
    if ($(this).prop('checked')) {
      $('.bootstrap-tagsinput').hide();
      $('#emails')
        .hide()
        .prop('type', 'file')
        .prop('name', 'toFile')
        .prop('class', 'form-control')
        .removeAttr('data-role')
        .show();
    } else {
      $('#emails')
        .hide()
        .prop('type', 'text')
        .prop('name', 'to')
        .attr('data-role', 'tagsinput');
      $('.bootstrap-tagsinput').show();
    }
  });
});
