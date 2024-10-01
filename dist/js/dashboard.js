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
    let form = $(this).parents('form');
    let formData = form.serialize();

    // Get specific form
    $.ajax({
      url: `https://localhost/firstmutual/app/services/${$(this).attr('data-load')}.php`,
      type: 'POST',
      dataType: 'html',
      data: formData,
      success: function(htmlData) {
        dispenseContainer.html(htmlData);
      }

    });
  });

  dispenseContainer.on('click', '.dispense-item-add', function(e) {
    let currentCart = $('input#items').val();
    let qty = $(this).siblings('input[name=qty]').val();
    let item = JSON.parse($(this).siblings('select[name=item]').children('option:selected').val());

    item.quantity = parseInt(qty);
    item.subtotal = parseInt(item.price) * parseInt(item.quantity);
    if (currentCart !== "") {
      currentCart = JSON.parse(currentCart);
    } else {
      currentCart = [];
    }
    currentCart.push(item);
    $('input#items').val(JSON.stringify(currentCart));

    $('#cart-items').prepend(`
        <li class="list-group-item d-flex justify-content-between lh-sm">
          <div>
            <h6 class="my-0">${item.name}</h6>
            <small class="text-body-secondary"><i class="fa fa-xmark"></i> ${item.quantity}</small>
          </div>
          <span class="text-body-secondary">${item.subtotal}</span>
        </li>
      `);

    $('#cart-total').html('USD$' + (parseInt($('#cart-total').text()) + item.subtotal));

  });


  dispenseContainer.on('click', '.dispense-payment-btn', function (e) {
    $('.dispense-payment-btn').removeClass('checked');
    $(this).addClass('checked');
  });


});