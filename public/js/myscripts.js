$(document).ready(function(){
   //Method - click Add new user
    function addUser(){
        $("#loadImgAddUser").removeClass("hidden");
        modalOpen(undefined);
        $("#loadImgAddUser").addClass("hidden");
    }
    window.addUser=addUser;// function is global
    
    //Method - click Edit user
    function editUser(id){
        modalOpen(id);
    }
    window.editUser=editUser; // function is global
    
    //Method - click Delete user
    function deleteUser(id){
        modalRemoveUser(id);
    }
    window.deleteUser=deleteUser; // function is global
    
    var tempUserId;
    window.tempUserId=tempUserId; // function is global
    
    //*********************************************************************************
    //Method show modal window with Add or Edit User Form
    function modalOpen(user){
        window.modalOpen=modalOpen; // function is global
        if(user){
            var loginUser = $("#user-"+user).text();
            $("#myModal h4.modal-title").text("Редактирование пользователя - "+loginUser);
            var url = "/admin/users/"+user+"/edit";
        }
        else{
            $("#myModal h4.modal-title").text("Добавление пользователя");
            var url = "/admin/users/create";
        }
        
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: url,
            data: {_token: $('meta[name="csrf-token"]').attr('content'),},
            success: function(data) {
                if ((data.status == 'error')) {
                    alert(data.msg);
                }else{
                    $('#myModal .modal-body').html(data.content);
                }
            },
            beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));},
        });
        
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        //show buttons 
        $("#myModal #close_form").removeClass("hidden");
        $("#myModal #send_form").removeClass("hidden");
        $("#myModal").modal('show');
        return true;
    }
    
    //////******FOR ADD/UPDATE USER 
    $("#send_form").click(function() {
        var name = $('#myModal #name').val();
        var _token = $('#myModal input[name=_token]').val();
        var email = $('#myModal input[name=email]').val();
        var password = $('#myModal input[name=password]').val();
        var password_confirmation = $('#myModal input[name=password_confirmation]').val();
        var role_id = $("#myModal select option:selected").val();
        var user_id = $("#myModal #id_user").val();
        
        if(user_id) {
            var url = '/admin/users/'+user_id;
            var method = 'put';
        }
        else{
            var url = '/admin/users';
            var method = 'post';
        }  
        
        $.ajax({
            type: method,
            dataType: 'json',
            url: url,
            data: {
                name: name, 
                _token: _token,
                email: email, 
                role_id: role_id, 
                password: password,
                password_confirmation: password_confirmation
            }, 
            success: function(data) {
                if ((data.status == 'error')) {
                    $('#myModal .alert-danger').removeClass('hidden');
                    $("#myModal .alert-danger").html(data.msg);
                }else if(data.status == 'ok') {
                    $('#myModal .alert-danger').addClass('hidden');
                    $('#myModal .modal-body').html('<div class="alert alert-success">'+data.msg+'</div>');
                    $("#myModal #close_form").addClass("hidden");
                    $("#myModal #send_form").addClass("hidden");
                    
                    reloadContent();
                }
            },
            beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));},
        });
        
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });
    ////***********END FOR ADD/UPDATE USER


    //**************************************************************
    //function ReloadContent
    function reloadContent(){
         $.ajax({
            type: 'get',
            dataType: 'json',
            url: "/admin/users/getTableUsers",
            data: {_token: $('meta[name="csrf-token"]').attr('content'),},
            success: function(data) {
                if ((data.status == 'error')) {
                    alert(data.msg);
                }else{
                    $('#content-page').html(data.table_users);
                }
            },
            beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));},
        });
        
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        return true;
    }
    
    
    //*************************************************************
    //functions Remove user
    function modalRemoveUser(id){
        tempUserId = id;
        $("#myModalRemove #close_form").removeClass("hidden");
        $("#myModalRemove #agreeRemoveUser").removeClass("hidden");
        $("#myModalRemove").modal('show');
        var nameUser = $("#user-"+id).text();
        $('#myModalRemove .modal-body').html('Вы действительно хотете удалить '+nameUser+'?');
    }
    
    $("#agreeRemoveUser").click(function(){
        $.ajax({
            type: 'delete',
            dataType: 'json',
            url: "/admin/users/"+tempUserId,
            data: {_token: $('meta[name="csrf-token"]').attr('content'),},
            success: function(data) {
                if ((data.status == 'error')) {
                    $('#myModalRemove .modal-body').html('<div class="alert alert-danger">'+data.msg+'</div>');
                }else{
                    $('#myModalRemove .modal-body').html('<div class="alert alert-success">'+data.msg+'</div>');
                    $("#myModalRemove #close_form").addClass("hidden");
                    $("#myModalRemove #agreeRemoveUser").addClass("hidden");
                    reloadContent();
                }
            },
            beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));},
        });
        
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    });
    
    //END functions Remove user
});

