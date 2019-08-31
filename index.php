<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
    <script src="morris/morris.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
    <script src="morris/examples/lib/example.js"></script>
<!--이 링크를 사용하면 부트스트랩의 graph의 설정값과 겹쳐서 body의 폭이 줄어듬 -->
<!--    <link rel="stylesheet" href="morris/examples/lib/example.css">-->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
    <link rel="stylesheet" href="morris/morris.css">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>농산물 가격 예측 서비스</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <style type="text/css">
        @media (min-width: 800px) and (max-width: 850px) {
            .navbar:not(.top-nav-collapse) {
                background: #1C2331 !important;
            }
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="#" target="_blank">
            <strong>지구정복 팀</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link border border-light rounded"
                       target="_blank">
                        <i class="fab fa-github mr-2"></i>GitHub
                    </a>
                </li>
            </ul>

        </div>

    </div>
</nav>
<!-- Navbar -->

<!-- Full Page Intro -->
<div class="view" style="background-image: url('http://kunde9999.iptime.org:10009/img/background_img_05.jpg'); background-repeat: no-repeat; background-size: cover;">

    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

        <!-- Content -->
        <div class="text-center white-text mx-5 wow fadeIn">
            <h1 class="mb-4">
                <strong>농산물 가격 예측 서비스</strong>
            </h1>

            <p>
                <strong>올해 수확할 농산물의 가격을 예측해 드립니다.</strong>
            </p>

            <a target="_blank" class="btn btn-outline-white btn-lg" id="prediction" onclick="fnMove()">
                가격 예측하기
                <i class="fas fa-graduation-cap ml-2"></i>
            </a>
        </div>
        <!-- Content -->

    </div>
    <!-- Mask & flexbox options-->

</div>
<!-- Full Page Intro -->

<!--Main layout-->
<main>
    <div class="container" id="scroll_postion">

        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <!--Grid row-->
            <div class="row" >
                <!--Grid column-->
                <div class="col-md-2 mb-4">
                    <br><br><br><br>

                    <br><br><br><br>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-2 mb-4">
                    <br><br><br><br>
                    <h3>농산물 이름</h3>
                    <select id="select_product">
                        <option value="0">선택하기</option>
                        <option value="1" selected="selected">배추</option>
                        <option value="2">무</option>
                        <option value="3">양파</option>
                        <option value="4">마늘</option>
                        <option value="5">고추</option>
                    </select>
                    <br><br><br><br>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-2 mb-4">
                    <br><br><br><br>
                    <h3>면적</h3>
                    <input name="area" id="input_area" type="text" value="100" />
                    <br><br><br><br>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-2 mb-4">
                    <br><br><br><br>
                    <h3>단위</h3>
                    <select id="select_unit">
                        <option value="0">선택하기</option>
                        <option value="1">제곱미터</option>
                        <option value="2">평</option>
                        <option value="3">헥타르(ha)</option>
                        <option value="4" selected="selected">아르(a)</option>
                    </select>
                    <br><br><br><br>
                </div>
                <!--Grid column-->
                <div class="col-md-2 mb-4">
                    <br><br><br><br>
                    <button type="button" class="btn btn-primary btn-lg" id="btn_select">조회하기</button>
                    <br><br><br><br>
                </div>


            </div>
            <div  style="text-align: center; font-size: 2.0rem" id="print">
                 <br><br><br><br>
            </div>
            <!--Grid row-->
            <br><br><br><br>
        </section>

        <!--Section: Main info-->
<section>
    <div >
        <div id="parent_graph">
            <h1>연도별 배추 생산량/가격</h1>
            <div id="graph"></div>
            <pre style="display:none" id="code" class="prettyprint linenums">
                        var year_data = [
                          {"period": "2018", "실 수확량(Ton)": 34839, "예상 수확량(Ton)": 35671},
                          {"period": "2017", "실 수확량(Ton)": 35903, "예상 수확량(Ton)": 35903},
                          {"period": "2016", "실 수확량(Ton)": 20099, "예상 수확량(Ton)": 20099},
                          {"period": "2015", "실 수확량(Ton)": 21650, "예상 수확량(Ton)": 21650},
                          {"period": "2014", "실 수확량(Ton)": 26970, "예상 수확량(Ton)": 26970},
                          {"period": "2013", "실 수확량(Ton)": 39570, "예상 수확량(Ton)": 39570},
                          {"period": "2012", "실 수확량(Ton)": 35295, "예상 수확량(Ton)": 35295},
                          {"period": "2011", "실 수확량(Ton)": 51943, "예상 수확량(Ton)": 51943},
                          {"period": "2010", "실 수확량(Ton)": 45221, "예상 수확량(Ton)": 45221}
                        ];
                        Morris.Line({
                          element: 'graph',
                          data: year_data,
                          xkey: 'period',
                          ykeys: ['실 수확량(Ton)', '예상 수확량(Ton)'],
                          labels: ['실 수확량(Ton)', '예상 수확량(Ton)']
                        });
                        </pre>
        </div>
    </div>
</section>
        <hr class="mb-5">

    </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mt-4 wow fadeIn">



    <hr class="my-4">



    <!--Copyright-->
    <div class="footer-copyright py-3">
        © 2019 Copyright:
        <a  target="_blank"> earth_conquest.com </a>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->

<script>
    function fnMove(){
        var offset = $("#scroll_postion").offset();
        $('html, body').animate({scrollTop : offset.top}, 400);
    }
</script>

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();

</script>
</body>

</html>

<script type="text/javascript">

    $("#btn_select").click(function () {
        // alert('test');
        var product_name = document.getElementById('select_product').value;
        var area = document.getElementById('input_area').value;
        var unit = document.getElementById('select_unit').value;



            $.ajax({
                url:'./select_data.php',
                type: 'post',
                data: {'product_name':product_name,'area':area, 'unit':unit},
                success : function(data){
                    // alert('성공???' + data);
                    $("#print").html("2018 입력한 면적의 총 생산량 : 50130kg");


                    }


            });

    });

    $("#student_registration_btn").click(function () {
        var json_member = new Array();
        var json_member_list;
        var select_lecture_radio = $("input[name=select_lecture]:checked");
        var lecture_seq;
        select_lecture_radio.each(function (i) {
            // checkbox.parent() : checkbox의 부모는 <td>이다.
            // checkbox.parent().parent() : <td>의 부모이므로 <tr>이다.
            var tr = select_lecture_radio.parent().parent().eq(i);
            var td = tr.children();
            // td.eq(0)은 체크박스 이므로  td.eq(1)의 값부터 가져온다.
            lecture_seq = td.eq(10).text();
            // json_mem_ob.lecture_seq = lecture_seq;
        });
        var select_member_checkbox = $("input[name=select_member]:checked");
        var member_seq;
        select_member_checkbox.each(function (j) {
            var json_mem_ob = new Object();
            // checkbox.parent() : checkbox의 부모는 <td>이다.
            // checkbox.parent().parent() : <td>의 부모이므로 <tr>이다.
            var tr = select_member_checkbox.parent().parent().eq(j);
            var td = tr.children();
            // td.eq(0)은 체크박스 이므로  td.eq(1)의 값부터 가져온다.
            member_seq = td.eq(5).text();
            member_name = td.eq(2).text();
            member_mobile_number = td.eq(3).text();
            json_mem_ob.member_seq = member_seq;
            json_mem_ob.member_name = member_name;
            json_mem_ob.member_mobile_number = member_mobile_number;
            json_member.push(json_mem_ob);

            json_member_list = JSON.stringify(json_member);

            $.ajax({
                url:'./class_management_confirm.php',
                type: 'post',
                data: {'type':'update_member','lecture_seq':lecture_seq, 'json_member_list':json_member_list},
                success : function(data){
                    // alert('성공???' + data);
                    document.location.reload();
                },
                error : function (error) {
                    alert(error);
                }
            });
        });


    });
</script>