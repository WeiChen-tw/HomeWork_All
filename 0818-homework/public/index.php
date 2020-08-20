<?php
$connection = new PDO('mysql:host=localhost:3306;dbname=labdb;charset=utf8', 'root', '');
$statement = $connection->query('select * from news');
//$row = $statement->fetchAll(PDO::FETCH_ASSOC);

session_start();
if (isset($_SESSION["userName"])) {
    $sUserName = $_SESSION["userName"];
    
}
else{
    $sUserName="Guest";
}
if (isset($_GET["logout"])) {
    
    $message = $_SESSION["userName"]."您已登出.";
    echo '<script>alert("Welcome to Geeks for Geeks")</script>'; 
    
    session_unset();
    
    $sUserName = "Guest";
    //setcookie("userName", "Guest", time() - 3600);
    header("Location: index.php");
    exit();
}








?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>News</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.toast.css">
    <style>
        .modal-header,
        h4,
        .close {
            background-color: #5cb85c;
            color: white;
            text-align: center;
            font-size: 2em;
        }

        .modal-footer {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-sm-4">
                &nbsp;
            </div>
            <div class="col-sm-4">
                <div >
                    <?php if ($sUserName == "Guest"): ?>
                        <h1><?= "Guest"?><br>
                    <?php else: ?>
                        <h1><?= "AdminName:".$_SESSION["userName"]?><br>
                    <?php endif; ?>
                        <?php if ($sUserName == "Guest"): ?>
                            <a class="btn btn-success" href="login.php" >登入 </a>
                        <?php else: ?>
                            <a class="btn btn-danger" href="index.php?logout=1" >登出 </a>
                            <a class="btn btn-info" href="admin.php" >回管理頁 </a>
                        <?php endif; ?>
                            
                    </h1>
                    <hr>
                </div>
                <div>
                    <h2>最新消息</h2>
                </div>
                <ul id="latestNews" class="list-group">
                    <?php foreach ($statement as $row) { ?>
                        <li class="list-group-item"><?= $row['title'] . " [" . $row['ymd'] . "]" ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-sm-4">
                &nbsp;
            </div>

        </div> <!-- end of row -->

    </div> <!-- end of container -->




    <!-- 對話盒 -->
    <div id="newsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>新增/修改</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="titleTextBox">
                                <span class="glyphicon glyphicon-bullhorn"></span>
                                標題
                            </label>
                            <input type="text" id="titleTextBox" class="form-control" placeholder="請輸入標題" />
                        </div>

                        <div class="form-group">
                            <label for="ymdTextBox">
                                <span class="glyphicon glyphicon-time"></span>
                                日期
                            </label>
                            <input type="text" id="ymdTextBox" class="form-control" placeholder="yyyy-mm-dd 例如: 2017-05-20">
                        </div>
                        <div class="form-group">
                            <label for="TextBox">
                                內文
                            </label>
                            <textarea class="form-control" id="textBox" rows="3"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="button" id="okButton" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok"></span> 確定
                        </button>
                        <button type="button" id="cancelButton" class="btn btn-default" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> 取消
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 圖片對話盒 -->
    <div id="newImageModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Upload Image</h4>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titleTextBox">
                            <span class="glyphicon glyphicon-bullhorn"></span>
                            標題
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="ymdTextBox">
                            <span class="glyphicon glyphicon-time"></span>
                            日期
                        </label>
                    </div>
                    <!-- 上傳圖片並預覽: img id ="blah" -->
                    <form id="uploadForm" action="upload.php" method="post">
                        <div id="uploadFormLayer"></div>
                        <label>Upload Image File:</label><br />
                        <!-- <img id="blah" src="/Img/presetImg.png" style="width: 50%;"  /> -->
                        <input id="imgInp" name="userImage" type="file" class="inputFile " />
                    </form>
                </div>

                <div class="modal-footer">
                    <div class="pull-right">
                        <button id=imgSubmit type="submit" class="btn btn-primary" for="submit">Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ========== UI 與 JavaScript 分隔線 ========== -->



    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.toast.js"></script>

    <script>
        // 使用方式:
        // showToast("標題", "提示文字") 例如:
        // showToast("Hint", "請點一下正確的圖案");
        function showToast(heading, message) {
            $.toast({
                text: message, // Text that is to be shown in the toast
                heading: heading, // Optional heading to be shown on the toast
                icon: 'warning', // Type of toast icon
                showHideTransition: 'fade', // fade, slide or plain
                allowToastClose: true, // Boolean value true or false
                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                textAlign: 'left', // Text alignment i.e. left, right or center
                loader: true, // Whether to show loader or not. True by default
                loaderBg: '#9ec600', // Background color of the toast loader
                beforeShow: function() {}, // will be triggered before the toast is shown
                afterShown: function() {}, // will be triggered after the toat has been shown
                beforeHide: function() {}, // will be triggered before the toast gets hidden
                afterHidden: function() {} // will be triggered after the toast has been hidden
            });
        }
    </script>


    <script>
        //預覽上傳圖片

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });

        $(function() {

            var newsList = [{
                    ymd: "2017-05-01",
                    title: "Item 1",
                    text: "",
                    imgUrl: ""
                },
                {
                    ymd: "2017-05-01",
                    title: "Item 2",
                    text: "",
                    imgUrl: ""
                },
                {
                    ymd: "2017-05-02",
                    title: "Item 3",
                    text: "",
                    imgUrl: ""
                },
                {
                    ymd: "2017-05-03",
                    title: "Item 4",
                    text: "",
                    imgUrl: ""
                },
                {
                    ymd: "2017-05-04",
                    title: "Item 5",
                    text: "",
                    imgUrl: ""
                }
            ];
            let ttt = 1;
            newsList = "<?php echo $statement; ?>";
            console.log("1243");
            var newEditIndex = -1;
            loadUI();

            function loadUI() {


                // $.ajax({
                //     type: "get",
                //     url: "/home/news"
                // }).then(function (e) {
                //     newsList = JSON.parse(e);
                //     //console.log(newsList);
                //     loadImg();
                //     refreshUI();
                // })
            }

            function loadImg() {
                $.ajax({
                    type: "get",
                    url: "/home/img"
                }).then(function(e) {
                    newsList.imgUrl = JSON.parse(e);
                    console.log("loadImg:", newsList.imgUrl);
                })
            }
            //關閉表單時恢復預覽圖片   
            function clearImgForm() {
                $('#blah').attr('src', '/Img/presetImg.png');
                $("#imgInp").val('');
                console.log("close form img reset")
            }
            //驗證表單不為空
            function formCheck() {
                if ($("#titleTextBox").val() != "" &&
                    $("#ymdTextBox").val() != "" &&
                    $("#textBox").val() != "") {
                    return true;
                } else {
                    confirm("請輸入內容");
                    return false;
                }

                console.log($("#titleTextBox").val());
            }

            function refreshUI() {
                $("#latestNews").empty();
                for (let i = 0; i < newsList.length; i++) {
                    var newItem = newsList[i];
                    var liText = `${newItem.title} [${newItem.ymd}]`;
                    var liTextarea = `${newItem.text}`
                    var liImg = new Image(200, 200);
                    liImg.src = `${newItem.imgUrl}`;
                    //liImg.src= liImg.src.toString('base64');
                    liImg.src = "/Img/presetImg.png";
                    var li = $("<li></li>")
                        .addClass("list-group-item")
                        .append('<span class= h4>' + liText + '</span><br>')
                        .append(liTextarea)
                        .append('<span class="pull-right"><button class="btn btn-info btn-xs editItem"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>&nbsp;<button class="btn btn-primary btn-xs newImage"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></span></button>&nbsp;<button class="btn btn-danger btn-xs deleteItem"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></span>')
                        .append('<br><img src="' + liImg.src + '" style="width: 50%;" alt="image" />')

                    li.appendTo("#latestNews");

                    //console.log(i,liText);
                }
                //開啟上傳圖片的對話盒
                $(".newImage").click(function() {
                    var iIndex = $(this).closest("li").index();
                    newEditIndex = iIndex;
                    $("label[for='titleTextBox']").html("<span class=\"glyphicon glyphicon-bullhorn\"></span> 標題：" +
                        newsList[iIndex].title.toString());
                    $("label[for='ymdTextBox']").html("<span class=\"glyphicon glyphicon-time\"></span> 日期：" +
                        newsList[iIndex].ymd.toString());
                    $("#newImageModal").modal({
                        backdrop: "static"
                    });
                    console.log("newImage");
                })
                $("#newItem").click(function() {
                    newEditIndex = -1;
                    $("#titleTextBox").val("");
                    $("#ymdTextBox").val("");
                    $("#textBox").val("");
                    $("#newsModal").modal({
                        backdrop: "static"
                    });
                    console.log("newItem");
                })
                $(".editItem").click(function() {
                    var iIndex = $(this).closest("li").index();
                    newEditIndex = iIndex;
                    $("#titleTextBox").val(newsList[iIndex].title);
                    $("#ymdTextBox").val(newsList[iIndex].ymd);
                    $("#textBox").val(newsList[iIndex].text);
                    $("#newsModal").modal({
                        backdrop: "static"
                    });

                })
                $(".deleteItem").click(function() {
                    var iIndex = $(this).closest("li").index();
                    $.ajax({
                        type: "delete",
                        url: "/home/news",
                        data: newsList[iIndex]
                    }).then(function(e) {
                        showToast(e);
                        $.get("/home/news", function(e) {
                            newsList = JSON.parse(e);
                            loadUI();
                        })
                    })
                })

            }
            $("#okButton").on("click", function() {
                if (formCheck()) {
                    if (newEditIndex < 0) {
                        $("#newsModal").modal("hide");
                        let dataToServer = {
                            title: $("#titleTextBox").prop("value"),
                            ymd: $("#ymdTextBox").val(),
                            text: $("#textBox").val()
                        }
                        $.ajax({
                            type: "post",
                            url: "/home/news",
                            contentType: "Application/json",
                            data: JSON.stringify(dataToServer)
                        }).then(function(e) {
                            console.log(dataToServer);
                            loadUI();
                        })
                    } else {
                        newsList[newEditIndex].title = $("#titleTextBox").val();
                        newsList[newEditIndex].ymd = $("#ymdTextBox").val();
                        newsList[newEditIndex].text = $("#textBox").val();

                        $("#newsModal").modal("hide");
                        $.ajax({
                                type: "put",
                                url: "/home/news",
                                data: newsList[newEditIndex]
                            })
                            .then(function(e) {
                                loadUI();
                                showToast(e);
                            })
                    }

                }

            })

            //上傳圖片
            $("#imgSubmit").on("click", function() {
                newsList[newEditIndex].title = newsList[newEditIndex].title;
                newsList[newEditIndex].ymd = newsList[newEditIndex].ymd;
                newsList[newEditIndex].imgUrl = "base64";
                $("#newImageModal").modal("hide");
                $.ajax({
                    type: "put",
                    url: "/home/news",
                    data: newsList[newEditIndex],
                    success: function() {
                        loadUI();
                        //alert(newsList[newEditIndex].imgUrl);
                        alert("Image Uploaded Successfully");
                        clearImgForm() //清除表單資料
                    },
                    error: function() {
                        loadUI();
                        alert("ERROR :Image tooooooo large");
                    }
                })
            })
            //點擊類別close 回預設圖片
            $(".close").on("click", function() {
                clearImgForm() //清除表單資料
            })



        }) // end of init.
    </script>

</body>

</html>