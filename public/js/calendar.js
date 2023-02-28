$(function () {
    $(".delete-modal-open").on("click", function () {
        $(".js-modal-delete").fadeIn();
        var delete_date = $(".delete_date").val();
        var getPart = $(".getPart").val();
        $(".modal-inner .date").text(delete_date);
        $(".modal-inner .part").text(getPart);
        $(".delete_date").val(delete_date);
        return false;
    });
    $(".js-modal-close").on("click", function () {
        $(".js-modal-delete").fadeOut();
        return false;
    });
});
