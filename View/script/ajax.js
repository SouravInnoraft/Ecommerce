function getOtp(e) {
  e.preventDefault();
  let email_id = $('#email_id').val();
  let first_name = $('#first_name').val();
  let last_name = $('#last_name').val();
  let password = $('#password').val();
  $.ajax({
    type: "post",
    url: "Controller/Ajax-register.php",
    data: {
      email_id: email_id,
      first_name: first_name,
      last_name: last_name,
      password: password
    },
    success: function (data) {
      if(data=='') {
        $('#msg').addClass('red').text('An Error Occured');
      }
      else {
        $('.signup-body').html(data);
      }
    },
    error: function () {
      alert('Error')
    }
  });
}

$(document).on('submit', '#register-form', getOtp);

function getResetOtp(e) {
  e.preventDefault();
  let email_id = $('#email_id').val();
  $.ajax({
    type: "post",
    url: "Controller/Ajax-reset.php",
    data: {
      email_id: email_id
    },
    success: function (data) {
      if (data == '') {
        $('#msg').addClass('red').text('An Error Occured');
      }
      else {
        $('.signup-body').html(data);
      }
    },
    error: function () {
      alert('Error')
    }
  });
}

$(document).on('submit', '#reset-form', getResetOtp);
function preloadData() {
  $.ajax({
    url: "Controller/Ajax-preload.php",
    type: "POST",
    success: function (data) {
      $(".content").html(data);
    }
  });
}

// Function call.
$(window).on('load', preloadData);

function cartData() {
  $.ajax({
    url: "Controller/Ajax-cart.php",
    type: "POST",
    success: function (data) {
      if(data==''){
        $(".isEmptyCart").text('no data available');
      }
      else{
        $('.table').html(data);
      }
    }
  });
}

$(window).on('load', cartData);

function searchData() {
  let search_term = $('#search-name').val();
  if(search_term != ''){
    $.ajax({
      url: 'Controller/ajax-search.php',
      type: 'POST',
      data: {
        search: search_term
      },
      success: function (data) {
        $(".content").html(data);
      },
      error: function () {
        alert('Error')
      }
    })
  }
  else{
    location.reload();
  }
}
$('#search-name').on("keyup", searchData);

function addtocart() {
  let id = $(this).data('productid');
  $.ajax({
    url: 'Controller/ajax-addtocart.php',
    type: 'POST',
    data: {
      product_id:id
    },
    success: function (data) {
      alert("Added to cart");
    },
    error: function () {
      alert('Error')
    }
  })
}
$(document).on('click', '#addtocart', addtocart);

function clearCart() {
  $.ajax({
    url: 'Controller/ajax-clearCart.php',
    type: 'POST',
    success: function (data) {
      alert("deleted from cart");
      location.reload();
    },
    error: function () {
      alert('Error')
    }
  })
}
$(document).on('click', '#clear-cart', clearCart);

function sendBill() {
  $.ajax({
    url: 'Controller/ajax-sendBill.php',
    type: 'POST',
    success: function (data) {
      alert("Thanks for shopping, please visit us again");
      location.reload();
    },
    error: function () {
      alert('Error')
    }
  })
}
$(document).on('click', '#checkout', sendBill);
