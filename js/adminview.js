$(".checkable").change(function () {
  handleChange(this);
});

function handleChange(checkbox) {
  if (checkbox.checked == true) {
    var gotChecked = parseInt(
      $(checkbox.parentNode.parentNode.firstElementChild).text()
    );

    $.ajax({
      url: "ajax/update_data.php",
      type: "POST",
      dataType: "json",
      data: { action: gotChecked },
    }).always(function () {
      window.location.reload();
    });
  }
}

setTimeout(function () {
  window.location.reload();
}, 15000);
