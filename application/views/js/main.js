$(document).ready(function () {

    $('.add__button').click(function (e) {
        e.preventDefault();
        $('.task_modal-create').addClass('midsalod');
    });

    $('.edit__button').click(function (e) {
        e.preventDefault();
        $('.task_modal-update').addClass('midsalod');
    });

    $('.sign-in').click(function () {
        $('.signin_modal').addClass('midsalod');
    })

    $('.closemodal').click(function (e) {
        e.preventDefault();
        $('.task_modal-create').removeClass('midsalod');
        $('.task_modal-update').removeClass('midsalod');
        $('.signin_modal').removeClass('midsalod');
    });

    /*$('.add__button').click(function (){
        $('.task__fields').css('display', 'grid')
    });*/

    $('#add__task').click(function () {
        var name        = $("input[name='user']").val();
        var email       = $("input[name='email']").val();
        var title       = $("input[name='title']").val();
        var description = $("input[name='description']").val();

        if (name === '') {
            $("input[name='user']").css('border', '2px solid red');
            alert('User is required field');

            return false;
        }

        if (email === '') {
            $("input[name='email']").css('border', '2px solid red');
            alert('Email is required field');

            return false;
        }

        if (email !== '') {
            var isEmail = checkEmail(email);

            if (!isEmail) {
                alert('Please enter correct email')
                return false
            }
        }

        if (title === '') {
            $("input[name='title']").css('border', '2px solid red');
            alert('Title is required field');

            return false;
        }

        if (description === '') {
            $("input[name='description']").css('border', '2px solid red');
            alert('Description is required field');

            return false;
        }

        $.ajax({
            url:     '/task/create',
            method:  'post',
            data:    {
                user:        name,
                title:       title,
                description: description,
                email:       email
            },
            success: function () {
                alert('Successfully create task');
                window.location = '/task/read';
            }
        });
    });

    $('#update__fields').click(function () {
        var id          = $("input[name='edit_description']").attr('id');
        var description = $("input[name='edit_description']").val();

        if($('#status').is(':checked')) {
            var status = 'выполнено';
        } else {
            var status = $("input[type='checkbox']").val();
        }

        $.ajax({
            url:     '/task/update',
            method:  'post',
            data:    {
                id:          id,
                description: description,
                status:      status
            },
            success: function (data) {
                console.log(data)
                if(data === 'false') {
                    alert('Пожалуйста авторизуйтесь');
                }else {
                    window.location = '/task/read';
                }
            }
        });
    });

    $('.sign-out').click(function () {
        $.ajax({
            url:     '/sign/out',
            method:  'post',
            success: function () {
                console.log('hello')
                window.location = '/task/read';
            }
        });
    })

    $('#login').click(function () {

        var username = $('#username').val();
        var password = $('#password').val();

        if (username === '') {
            alert('Field username required');
            return false;
        }

        if (password === '') {
            alert('Field password required');
            return false;
        }

        $.ajax({
            url:      '/login',
            method:   'post',
            dataType: 'json',
            data:     {username: username, password: password},
            success:  function (data) {
                console.log(data)
                console.log(data.success)
                if (data.success) {
                    window.location = '/task/read';
                } else {
                    alert(data.message)
                }
            }
        });
    })
})

function checkEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}

function editTask(id) {
    $.ajax({
        type:     "GET",
        url:      "/task/edit",
        data:     {taskId: id},
        dataType: "json",
        success:  function (data) {
            console.log(data)
            $("input[name='edit_title']").val(data.title);
            $("input[name='edit_user']").val(data.name);
            $("input[name='edit_description']").val(data.description);
            $("input[name='edit_description']").attr('id', id);
            $("input[name='edit_email']").val(data.email);
            $("input[name='edit_status']").val(data.status);
        }
    });
}