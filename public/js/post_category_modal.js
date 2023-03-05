// $(function () {
//     $(".main_category_modal_btn").click(function () {
//         $(".sub_category_inner").slideToggle();
//     });
// });

$(function () {
    $(".main_categories").click(function () {
        $(this).find(".sub_category_accordion").toggleClass("is_active");
        $(this).find(".sub_category_accordion").toggleClass("is_current");
        // $(this).find(".sub_category_modal").css("display", "none");
        $(this).next(".sub_category_modal").slideToggle();
    });
});
