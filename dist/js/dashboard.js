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


});