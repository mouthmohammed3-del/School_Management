$(function () {
  "use strict";

  // On focus → hide placeholder
  $('[placeholder]').focus(function () {
      $(this).attr('data-text', $(this).attr('placeholder')); // save placeholder
      $(this).attr('placeholder',''); // hide placeholder
  }).blur(function () {
      $(this).attr('placeholder', $(this).attr('data-text')); // restore placeholder
  });

  // Add asterisk on required fields
  $('input[required]').each(function() {
      $(this).prev('label').append('<span class="text-danger">*</span>');
  });
  



 
  
    // Convert password field to text field on hover
    var passfield = $('.password'); // correct class
  
    $('.show-pass').hover(
      function() {
        passfield.attr('type','text'); // show password
      },
      function() {
        passfield.attr('type','password'); // hide password
      });


      $('.confirm').click(function(){

        return confirm('Are you sure?');

      });

 
    
  });
  

