// import { SnackBar } from "./snackbar.js";


// module.exports = MDCSpinner;
$(document).ready(function () { 
    // В случае успешного ответа
    app.controls.item('loginform').onSuccess((data) => {
        location.href = data.data.url;
    });    
    // Password
    let password = app.controls.item("loginform-password");
    password.minLength = 5;
    password.trailingIcon.click(function() {        
        if (this.parent.type === "text") {
            this.parent.type = "password";
        } else {
            this.parent.type = "text";
        }
        this.parent.focus();
    }, password.trailingIcon);

    //Отоброжать снекбар в начале экрана    
    app.controls.item('app-snackbar').size('70%');

    let langMenu = app.controls.item('locale-menu');

    langMenu.listen('MDCMenu:selected', (event) => {
        
        app.controls.item('locale-spinner').show();

        app.utils.ajax({
            url: 'guest/locale',
            data: {
                'locale': langMenu.value
            }
        })
            .done((data) => {
                if (data.status == 'success') {
                    location.reload();
                } else {
                    app.controls.item('locale-spinner').close();                    
                    app.controls.item('app-snackbar').showMessage(data.message);
                }
            })
            .post();

    });

    //Необходимо, чтобы меню с языками выводилось над ссылкой, которое его вызывает
    $('.mdc-menu-surface--anchor').width($('.footer .mdc-typography--caption').width());

    document.getElementById('locale-link').addEventListener('click', () => {
        langMenu.open = true;
    });

});