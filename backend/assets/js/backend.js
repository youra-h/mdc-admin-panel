
$(document).ready(function () {
    let drawer = app.controls.item('app-drawer');
    app.controls.item('app-leftbar').attachDrawer(drawer);    

    app.controls.add('app-topbar', 'topAppBar').listen('MDCTopAppBar:nav', () => {
        drawer.open = !drawer.open;
    });

    $('#app-user').click(() => {
        app.controls.item('app-user-menu').open = true;
    });
});


