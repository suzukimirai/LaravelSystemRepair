// $(function () {
//     $(".main_category_modal_btn").click(function () {
//         $(".sub_category_inner").slideToggle();
//     });
// });

$(function () {
    $(".main_categories").click(function () {
        $(this).next().next(".sub_category_accordion").toggleClass("is_active");
        $(this)
            .next()
            .next(".sub_category_accordion")
            .toggleClass("is_current");
        $(this).next(".sub_category_modal").slideToggle();
    });
});
