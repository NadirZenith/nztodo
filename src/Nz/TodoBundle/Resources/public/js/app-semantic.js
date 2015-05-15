$(document).ready(function () {
    $('.filter.menu .item')
            .tab()
            ;
    /*
     * 
     $('.ui.todo-done')
     .rating({
     clearable: true
     })
     ;
     */

    $('.ui.sidebar')
            .sidebar('attach events', '.launch.button')
            ;

    $('.ui.checkbox')
            .checkbox()
            ;

});