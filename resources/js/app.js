/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import 'bootstrap';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

// const app = createApp({});
//
// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

//app.mount('#app');
var url = 'http://proyecto-laravel.com.devel';

window.addEventListener("load", function () {

    $('.btn-like, .btn-dislike').css('cursor', 'pointer');

    function like() {
        $(document).on('click', '.btn-like', function () {
            console.log('Click en btn-like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/heart-red.svg');

            let imageId = $(this).data('id');
            $.ajax({
                url: url + '/like/' + imageId,
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Has dado like a la publicacion');
                        let span = $('.number-likes[data-id="' + imageId + '"]');
                        let currentLikes = parseInt(span.text());
                        span.text(currentLikes + 1);
                    } else {
                        console.log('Error al dar like');
                    }
                }
            });
        })
    }

    function dislike(){
        $(document).on('click', '.btn-dislike', function () {
            console.log('Click en btn-dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/heart.svg');

            let imageId = $(this).data('id');
            $.ajax({
                url: url + '/unlike/' + $(this).data('id'),
                type: 'GET',
                success: function (response){
                    if(response.like){
                        console.log('Has dado dislike a la publicacion');

                        // Disminuir el contador de likes
                        let span = $('.number-likes[data-id="' + imageId + '"]');
                        let currentLikes = parseInt(span.text());
                        span.text(currentLikes - 1);
                    }else{
                        console.log('Error al dar dislike');
                    }
                }
            })

        });
    }

    like();
    dislike();

    //Buscador
    $('#buscador').submit(function (e) {
        e.preventDefault(); // evita que se envíe inmediatamente

        var searchValue = $('#search').val();
        var newAction = url + '/user/gente/' + searchValue;

        $(this).attr('action', newAction);
        this.submit(); // envía el formulario con el nuevo action
    });
});
