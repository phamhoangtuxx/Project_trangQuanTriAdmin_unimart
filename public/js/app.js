$(document).ready(function () {
    $(".nav-link.active .sub-menu").slideDown();
    // $("p").slideUp();

    $("#sidebar-menu .arrow").click(function () {
        $(this).parents("li").children(".sub-menu").slideToggle();
        $(this).toggleClass("fa-angle-right fa-angle-down");
    });

    $("input[name='checkall']").click(function () {
        var checked = $(this).is(":checked");
        $(".table-checkall tbody tr td input:checkbox").prop(
            "checked",
            checked
        );
    });
});

$(document).ready(function () {
    $(".increment").click(function () {
        var quantityInput = $(this).siblings(".quantity");
        var currentQuantity = parseInt(quantityInput.val());
        quantityInput.val(currentQuantity + 1);
    });

    $(".decrement").click(function () {
        var quantityInput = $(this).siblings(".quantity");
        var currentQuantity = parseInt(quantityInput.val());
        if (currentQuantity > 1) {
            quantityInput.val(currentQuantity - 1);
        }
    });
});
