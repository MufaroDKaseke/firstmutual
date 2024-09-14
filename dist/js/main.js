$( document ).ready(function() {

  let loginTabBtn = $('.login-tab-btn');

  // loginTabBtn.on('click', function(e) {
  //   e.preventDefault();
  //   $('.login-pane').removeClass('show active').css('display', 'none');
  //   $(`.login-pane[data-pane='${$(this).attr('data-target')}'`).toggleClass('show active fadeIn').css('display', 'block').fadeIn(300);
  // });


  loginTabBtn.on('click', function(e) {
    e.preventDefault();
    
    // Get specific form
    $.ajax({
      url: `app/services/login-form-${$(this).attr('data-target')}.php`,
      type: 'GET',
      dataType: 'html',
      success: function(htmlData) {
        $('#loginForm').html(htmlData);
      }

    });
    
  });


  // $('#loginForm').on('submit', function(e) => {
  //   e.preventDefault();

  // });

});