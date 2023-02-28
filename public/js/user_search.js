$(function () {
    $(".search_conditions").click(function () {
        $(".accordion_btn").toggleClass("is_active");
        $(".accordion_btn").toggleClass("is_current");
        $(".search_conditions_inner").slideToggle();
    });

    $(".subject_edit_btn").click(function () {
        $(".subject_edit_accordion").toggleClass("is_active");
        $(".subject_edit_accordion").toggleClass("is_current");
        $(".subject_inner").slideToggle();
    });
});
