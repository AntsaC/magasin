$(document).ready(function () {
    $('#sidebar-nav .nav-item').click(function () {
        localStorage.setItem('current', $(this).index());
    })

    $('#sidebar-nav .nav-item').eq(localStorage.getItem('current')).addClass('active');

    let filter = $("#multi-filter");

    $('#filter-btn').click(function () {
        filter.animate({
            right: 0
        }, 100)
    })

    $('#hide-filter-btn').click(function () {
        filter.animate({
            right: '-300px'
        }, 100)
    })

})
