// $(function () {
//     $(".delete-modal-open").on("click", function () {
//         $(".js-modal-delete").fadeIn();
//         var delete_date = $(".delete_date").val();
//         var getPart = $(".getPart").val();
//         $(".modal-inner .date").text(delete_date);
//         $(".modal-inner .part").text(getPart);
//         $(".delete_date").val(delete_date);
//         return false;
//     });
//     $(".js-modal-close").on("click", function () {
//         $(".js-modal-delete").fadeOut();
//         return false;
//     });
// });

$(function () {
    $(".delete-modal-open").on("click", function () {
        $(".js-modal-delete").fadeIn();
        var date = $(this).data("date");
        var part = $(this).data("part");
        var partname = $(this).data("partname");
        $(".modal-inner .date").text(date); //予約日
        $(".modal-inner .part").text(partname); //場所
        $(".date_hidden").val(part); //hiddenで1などの部数を送る
        $(".part_hidden").val(date); //hiddenで日付を送る
        return false;
    });
    $(".js-modal-close").on("click", function () {
        $(".js-modal-delete").fadeOut();
        return false;
    });
});
