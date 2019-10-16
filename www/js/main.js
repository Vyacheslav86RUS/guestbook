//http://guestbook.ru
var sort = 1;
var fsizes = {"image/jpeg":1,"image/jpg":1,"image/png":1,"text/plain":100};
var funits = {"image/jpeg":"MB","image/jpg":"MB","image/png":"MB","text/plain":"KB"};
var ftipes = ["image/jpeg", "image/jpg", "image/png","text/plain"];
$().ready(function () {
    var msg = "";
    $("#login").on({
        blur: function(){
            if ($(this).val() !== "") {
                isValideValues(0);
            } else {
                paintErrors($(this), "Введите логин", 1);
            }
        },
        change: function(){
            if ($(this).val() !== "") {
                isValideValues(0);
            } else {
                paintErrors($(this), "Введите логин", 1);
            }
        }
    });
    $("#inputPassword").on({
        blur: function(){
            if ($(this).val() !== "") {
                isValideValues(1);
            } else {
                paintErrors($(this), "Введите пароль", 1);
            }
        },
        change: function(){
            if ($(this).val() !== "") {
                isValideValues(1);
            } else {
                paintErrors($(this), "Введите пароль", 1);
            }
        }
    });
    $("#inputEmail").on({
        blur: function(){
            if ($(this).val() !== true) {
                isValideValues(2);
            } else {
                paintErrors($(this), "Введите email", 1);
            }
        },
        change: function(){
            if ($(this).val() !== true) {
                isValideValues(2);
            } else {
                paintErrors($(this), "Введите email", 1);
            }
        }
    });
    $("#confirmPassword").on({
        blur: function(){
            if ($(this).val() !== true) {
                isValideValues(3);
            } else {
                paintErrors($(this), "Введите пароль", 1);
            }
        },
        change: function(){
            if ($(this).val() !== true) {
                isValideValues(3);
            } else {
                paintErrors($(this), "Введите пароль", 1);
            }
        }
    });
    $("#uname").on({
        blur: function(){
            if ($(this).val() !== true) {
                isValideValues(4);
            } else {
                paintErrors($(this), "Введите имя", 1);
            }
        },
        change: function(){
            if ($(this).val() !== true) {
                isValideValues(4);
            } else {
                paintErrors($(this), "Введите имя", 1);
            }
        }
    });
    $("#inputURL").on({
        blur: function(){
            if ($(this).val() !== true) {
                isValideValues(5);
            }
        },
        change: function(){
            if ($(this).val() !== true) {
                isValideValues(5);
            }
        }
    });
    $("#msg").on({
        input: function () {
            var reg = /<(.|\n)*?>/g;
            var expr = new RegExp(reg);
            if (this.value.search(expr) !== -1) {
                this.value = msg;
            } else {
                msg = this.value;
            }
        },
        blur: function () {
            if ($(this).val() !== true) {
                isValideValues(6);
            } else {
                paintErrors($(this), "Введите текст сообщения", 1);
            }
        },
        change: function(){
            if ($(this).val() !== true) {
                isValideValues(6);
            } else {
                paintErrors($(this), "Введите текст сообщения", 1);
            }
        }
    });
    $("#MyFile").on({
        change: function(event){
            //var output = document.getElementById('output');
            //output.src = URL.createObjectURL(event.target.files[0]);
            if($(this)[0].files.length > 0){
                isValideValues(7);
            } else {
                paintErrors($(this),"",4);
            }
        }
    });
    $("#MyEdit").click(function(){
        editGuest();
        return false;
    });
    $("#MySend").click(function () {
        addGuest();
        return false;
    });
 
    $("#btn_login").click(function () {
        login_form();
        return false;
    });
    $("#btn_reg").click(function () {
        registration();
        return false;
    });   
    
    $("#dimg").click(function (){
        $("#MyFile").removeAttr('disabled');
        $("div.panel").remove();
    });
    $("#pag").click(function (){
        var dataPost = new FormData;
        dataPost.append('pagination',$("#pagination").val());
        var Ajaxparam = {contentType: false, processData: false, cache:false};
        sendServer("../../app/core.php?id=pag", "POST", dataPost, Ajaxparam);
        return false;
    });
    $(".anim").hover(function() {
	$(this).css({'z-index' : '10'});
	$(this).find(".images").addClass("hover").stop()
		.animate({
			marginTop: '-110px', 
			marginLeft: '-110px', 
			top: '50%', 
			left: '50%', 
			width: '174px', 
			height: '174px',
			padding: '20px' 
		}, 200);
	} , function() {
	$(this).css({'z-index' : '0'});
	$(this).find(".images").removeClass("hover").stop()
		.animate({
			marginTop: '0', 
			marginLeft: '0',
			top: '0', 
			left: '0', 
			width: '100px', 
			height: '100px', 
			padding: '5px'
		}, 400);
});
    
});

function registration() {
    var isValidLogin = isValideValues(0);
    var isValidPassword = isValideValues(1);
    var isValidConfirmPassword = isValideValues(3);
    var isValidEmail = isValideValues(2);
    if (isValidLogin === true && isValidPassword === true && isValidEmail === true && isValidConfirmPassword === true) {
        var dataPost = new FormData();
        dataPost.append("login", $("#login").val());
        dataPost.append("email", $("#inputEmail").val());
        dataPost.append("inputPassword", md5($("#inputPassword").val()));
        dataPost.append("confirmPassword", md5($("#confirmPassword").val()));
        var Ajaxparam = {contentType: false, processData: false};
        sendServer("../app/core.php?id=reg", "POST", dataPost, Ajaxparam);
    } else {
        paintErrors($("#alert"), "Заполните, корректно все поля и попробуйте снова", 0);
    }
}

function login_form() {
    var isValidLogin = isValideValues(0);
    var isValidPassword = isValideValues(1);
    if (isValidLogin === true && isValidPassword === true) {
        var dataPost = new FormData();
        dataPost.append("login", $("#login").val());
        dataPost.append("inputPassword", md5($("#inputPassword").val()));
        var Ajaxparam = {contentType: false, processData: false};
        sendServer("../app/core.php?id=auth", "POST", dataPost, Ajaxparam);
    } else {
        paintErrors($("#alert"), "Заполните, корректно все поля и попробуйте снова", 0);
    }
}

function addGuest() {
    var isValidName = isValideValues(4);
    var isValidEmail = isValideValues(2);
    var isValidUrl = isValideValues(5);
    var isValidMsg = isValideValues(6);
    var isValidFile = isValideValues(7);
    if (isValidName === true && isValidEmail === true && isValidUrl === true && isValidMsg === true && isValidFile === true) {
        var dataPost = new FormData;
        dataPost.append('name', $("#uname").val());
        dataPost.append('email', $("#inputEmail").val());
        dataPost.append('hpage', $("#inputURL").val());
        dataPost.append('gmsg', $("#msg").val());
        jQuery.each($('#MyFile')[0].files, function (i, file) {
            dataPost.append('file', file);
        });
        //dataPost.append('file', $('#MyFile').prop('files')[0]);
        var Ajaxparam = {contentType: false, processData: false, cache:false};
        sendServer("../../app/core.php?id=gsadd", "POST", dataPost, Ajaxparam);
    } else {
        paintErrors($("#alert"), "Заполните, корректно все поля и попробуйте снова", 0);
    }
}

function editGuest() {
    var isValidName = isValideValues(4);
    var isValidEmail = isValideValues(2);
    var isValidUrl = isValideValues(5);
    var isValidMsg = isValideValues(6);
    var isValidFile = isValideValues(7);
    if (isValidName === true && isValidEmail === true && isValidUrl === true && isValidMsg === true && isValidFile === true) {
        var dataPost = new FormData;
        var purl = document.location.pathname;
        var path = purl.split('/'); 
        dataPost.append('id',path[3]);
        dataPost.append('name', $("#uname").val());
        dataPost.append('email', $("#inputEmail").val());
        dataPost.append('hpage', $("#inputURL").val());
        dataPost.append('gmsg', $("#msg").val());
        jQuery.each($('#MyFile')[0].files, function (i, file) {
            dataPost.append('file', file);
        });
        if(!$("#panel").length){
            dataPost.append('fpath','');
        }
        //dataPost.append('file', $('#MyFile').prop('files')[0]);
        var Ajaxparam = {contentType: false, processData: false, cache:false};
        sendServer("../../app/core.php?id=gsedit", "POST", dataPost, Ajaxparam);
    } else {
        paintErrors($("#alert"), "Заполните, корректно все поля и попробуйте снова", 0);
    }
}

function isValideValues(type) {
    var isValid = true;
    switch (type) {
        case 0:
        {
            var login = $("#login");
            if (login.val() !== "") {
                if (isValideLogin(login.val()) === true) {
                    paintErrors(login, "", 2);
                } else {
                    paintErrors(login, "Логин не может быть меньше 5 символов", 1);
                    isValid = false;
                }
            } else {
                paintErrors(login, "Введите логин", 1);
                isValid = false;
            }

            break;
        }
        case 1:
        {
            var pass = $("#inputPassword");
            if (pass.val() !== "") {
                if (isValidePassword(pass.val()) === true) {
                    paintErrors(pass, "", 2);
                } else {
                    paintErrors(pass, "Ваш пароль не должен быть меньше 5 символов", 1);
                    isValid = false;
                }
            } else {
                paintErrors(pass, "Введите пароль", 1);
                isValid = false;
            }

            break;
        }
        case 2:
        {
            var email = $("#inputEmail");
            if (email.val() !== "") {
                if (isValideEmail(email.val()) === true) {
                    paintErrors(email, "", 2);
                } else {
                    paintErrors(email, "Введите корректный email", 1);
                    isValid = false;
                }
            } else {
                paintErrors(email, "Введите email", 1);
                isValid = false;
            }

            break;
        }
        case 3:
        {
            var pass = $("#inputPassword");
            var cpass = $("#confirmPassword");
            if (cpass.val() !== "") {
                if (checkPassword(md5(pass.val()), md5(cpass.val())) === true) {
                    paintErrors(cpass, "", 2);
                } else {
                    paintErrors(cpass, "Пароль не совпадает", 1);
                    isValid = false;
                }
            } else {
                paintErrors(cpass, "Введите пароль", 1);
                isValid = false;
            }

            break;
        }
        case 4:
        {
            var uname = $("#uname");
            if (uname.val() !== "") {
                if (isValideName(uname.val()) === true) {
                    paintErrors(uname, "", 2);
                } else {
                    paintErrors(uname, "Имя не может быть меньше 2 символов", 1);
                    isValid = false;
                }
            } else {
                paintErrors(uname, "Введите имя", 1);
                isValid = false;
            }
            break;
        }
        case 5:
        {
            var url = $("#inputURL");
            if (url.val() !== "") {
                if (isValideURL(url.val()) === true) {
                    paintErrors(url, "", 2);
                } else {
                    paintErrors(url, "Введите корректный url", 1);
                    isValid = false;
                }
            }
            break;
        }
        case 6:
        {
            var msg = $("#msg");
            if (msg.val() !== true) {
                if (isValideMsg(msg.val()) === true) {
                    paintErrors(msg, "", 2);
                } else {
                    paintErrors(msg, "Текст сообщения не может быть меньше 5 символов", 1);
                    isValid = false;
                }
            } else {
                paintErrors(msg, "Введите текст сообщения", 1);
                isValid = false;
            }
            break;
        }
        case 7:{
            var files = $('#MyFile');
            if(files[0].files.length > 0){
                var r = validateFile(files[0].files);
                if(r !== true){
                    paintErrors(files, r, 1);
                    isValid = false;
                } else {
                   paintErrors(files, "", 2); 
                }
            }
            break;
        }
    }
    return isValid;
}

function isValideLogin(login) {
    var isValid = true;
    if (login.length < 5) {
        isValid = false;
    }
    return isValid;
}
function isValidePassword(password) {
    var isValid = true;
    if (password.length < 5) {
        isValid = false;
    }
    return isValid;
}
function isValideEmail(email) {
    var pattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,2}[a-zA-Z0-9]*)?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,2}[a-zA-Z0-9])?){0,2}$/;
    //var pattern = /^((?!\.)[\w-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
    return pattern.test(email);
}
function isValideName(name) {
    var isValid = true;
    if (name.length < 2) {
        isValid = false;
    }
    return isValid;
}
function isValideURL(url) {
    var pattern = /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i;
    return pattern.test(url);
}
function isValideMsg(msg) {
    var isValid = true;
    if (msg.length < 5) {
        isValid = false;
    }
    return isValid;
}
function validateFile(files) {
    var result = true;
    for (var i = 0; i < files.length; i++) {
        if(ftipes.indexOf(files[i].type) === -1){
            result = "Файл " + files[i].name + " не является image/jpeg,image/jpg,image/png,text/plain";
        } else {
            var s = getFileSize(fsizes[files[i].type],funits[files[i].type]);
            if(files[i].size > s){
                result = "Файл " + files[i].name + " должен быть не больше " + fsizes[files[i].type] + funits[files[i].type];
            }
        }
    }
    return result;
}
function getFileSize(size, unit) {
    var units = ["B", "KB", "MB", "GB", "TB"];
    var userch = units.indexOf(unit);
    var result;
    if (userch === -1) {
        result = 0;
    } else {
        while (userch > 0) {
            size *= 1024;
            userch -= 1;
        }
        result = size;
    }
    return result;
}
function checkPassword(ferstPassword, secondPassword) {
    var checkPass = true;
    if (ferstPassword != secondPassword) {
        checkPass = false;
    }
    return checkPass;
}

//type = 0 - alert error
//type = 1 - error
//type = 2 - ok
//type = 3 - alert ok
//type = 3 - clear
function paintErrors(obj, msg = "", type = 0) {
    switch (Number(type)) {
        case 0:{
            var className = obj.attr("class");
            var offset = "";
            if(className === "5"){
                offset = " col-sm-offset-4";
            } else {
                offset = " col-sm-offset-2";
            }
            $("#alert").html('<div class="row"><div class="col-sm-' + className + offset + '"><div class="alert alert-warning alert-dismissable"><span class="glyphicon glyphicon-warning-sign"></span><strong>' + msg + '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div></div></div>');
            break;
        }
        case 1:{
            obj.parent("div").addClass("has-error").removeClass("has-success");
            obj.next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            obj.next("span").next("em").text(msg);
            break;
        }
        case 2:{
            obj.next("span").next("em").text(msg);
            obj.parent("div").addClass("has-success").removeClass("has-error");
            obj.next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
            break;
        }
        case 3:{
            var className = obj.attr("class");
            var offset = "";
            if(className === "5"){
                offset = " col-sm-offset-4";
            } else {
                offset = " col-sm-offset-2";
            }
            $(".has-feedback").removeClass("has-success").removeClass("has-error");
            $(".form-control-feedback").removeClass("glyphicon-ok").removeClass("glyphicon-remove");
            //$("#MyForm").find("input, textarea").each(function(){
            //    console.log($(this));
            //    $(this).val("");
            //});
            $("#MyForm")[0].reset();
            $("#alert").html('<div class="row"><div class="col-sm-' + className + offset + '"><div class="alert alert-success alert-dismissable"><span class="glyphicon glyphicon-ok-sign"></span><strong>' + msg + '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div></div></div>');
            break;
        }
        case 4:{
            obj.next("span").next("em").text(msg);
            obj.parent("div").removeClass("has-success").removeClass("has-error");
            obj.next("span").removeClass("glyphicon-ok").removeClass("glyphicon-remove");     
        }
    }
}

function sendServer(url, type, data, params = {}){
    var cache = (params.hasOwnProperty("cache")) ? params.cache : true;
    var contentType = (params.hasOwnProperty("contentType")) ? params.contentType : "application/x-www-form-urlencoded; charset=UTF-8";
    var processData = (params.hasOwnProperty("processData")) ? params.processData : true;
    switch (type) {
        case "GET":
        {
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                cache: cache,
                contentType: contentType,
                processData: processData,
                data: data,
                success: function (data) {
                    console.log(data);
                },
                beforeSend: function (jqXHR, settings) {
                    console.log(jqXHR);
                    console.log(settings);
                },
                error: function (jqxhr, status, errorMsg) {
                    console.log(jqXHR);
                    console.log(status);
                    console.log(errorMsg);
                }
            });
            break;
        }
        case "POST":
        {
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                cache: cache,
                contentType: contentType,
                processData: processData,
                data: data,
                success: responseServer,
                beforeSend: function (jqXHR, settings) {
                    //console.log(jqXHR);
                    //console.log(settings);
                },
                error: function (jqxhr, status, errorMsg) {
                    //console.log(jqXHR);
                    //console.log(status);
                    //console.log(errorMsg);
                }
            });
            break;
        }
    }
}
function responseServer(data) {
    if (data["error"] === 1) {
        paintErrors($("#alert"),data["msg"],0);
    } else {
        switch(Number(data['status'])){
            case 1:
                document.location.href = data['redirect'];
                break;
            case 2: //document.location.href = 'http://guestbook.kl/main/guest';
              //  console.log(data);
                $("#pagination").val("");
                $(".result").html(data['html']);
                break;
            case 3:
                if (data['check'] == 1) {
                    paintErrors($("#alert"),data['msg'],3);
                } else {
                    document.location.href = data['redirect'];
                }
                break;
            case 4:
            case 5:
                paintErrors($("#alert"),"Ваши данные успешно добавлены",3);
                break;
        }
        //console.log(data);
        //paintErrors($("#alert"),"Ваши данные успешно добавлены",3);
    }
}


