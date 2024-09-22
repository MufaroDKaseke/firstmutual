$( document ).ready(function() {

  const sidebar = $('.sidebar');
  const sidebarToggleBtn = $('.sidebar-toggle');

  // Open sidebar
  sidebarToggleBtn.on('click', (e) => {
    e.preventDefault();

    sidebar.toggleClass('show');
  });

  // Close sidebar
  $('.main-content, .sidebar-close').on('click', (e) => {
    sidebar.removeClass('show');
  });

  const dispenseContainer = $('.dispense-container');
  const dispenseLoadTabBtn = $('.dispense-container button[data-load="dispense-form"');

  // Load next slide on dispense
  dispenseContainer.on('click', 'button[data-load]', function(e) {
    // Get specific form
    $.ajax({
      url: `https://localhost/firstmutual/app/services/${$(this).attr('data-load')}.php`,
      type: 'GET',
      dataType: 'html',
      success: function(htmlData) {
        dispenseContainer.html(htmlData);
      }

    });
  });


});