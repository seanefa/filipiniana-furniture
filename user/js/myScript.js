$(function () {
  $('[data-toggle="popover"]').popover()
})

function productImgError(image) {
    image.onerror = "";
    image.src = "/admin/plugins/images/NoImage.jpg";
    return true;
}

function promoImgError(image) {
    image.onerror = "";
    image.src = "/admin/plugins/images/promoNoImage.jpg";
    return true;
}