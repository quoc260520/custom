  <!-- footer section-->
  <footer class="ht-footer">
    <div class="container">
        <div class="flex-parent-ft">
            <div class="flex-child-ft item1">
                <a href="./Home/Content/Client/index-2.html"><img class="logo" src="./Home/Content/Client/images/logo1.png" alt=""></a>
                <p>
                    5th Avenue st, manhattan<br>
                    New York, NY 10001
                </p>
                <p>Call us: <a href="./Home/Content/Client/#">(+01) 202 342 6789</a></p>
            </div>
            <div class="flex-child-ft item2">
                <h4>Resources</h4>
                <ul>
                    <li><a href="./Home/Content/Client/#">About</a></li>
                    <li><a href="./Home/Content/Client/#">Blockbuster</a></li>
                    <li><a href="./Home/Content/Client/#">Contact Us</a></li>
                    <li><a href="./Home/Content/Client/#">Forums</a></li>
                    <li><a href="./Home/Content/Client/#">Blog</a></li>
                    <li><a href="./Home/Content/Client/#">Help Center</a></li>
                </ul>
            </div>
            <div class="flex-child-ft item3">
                <h4>Legal</h4>
                <ul>
                    <li><a href="./Home/Content/Client/#">Terms of Use</a></li>
                    <li><a href="./Home/Content/Client/#">Privacy Policy</a></li>
                    <li><a href="./Home/Content/Client/#">Security</a></li>
                </ul>
            </div>
            <div class="flex-child-ft item4">
                <h4>Account</h4>
                <ul>
                    <li><a href="./Home/Content/Client/#">My Account</a></li>
                    <li><a href="./Home/Content/Client/#">Watchlist</a></li>
                    <li><a href="./Home/Content/Client/#">Collections</a></li>
                    <li><a href="./Home/Content/Client/#">User Guide</a></li>
                </ul>
            </div>
            <div class="flex-child-ft item5">
                <h4>Newsletter</h4>
                <p>Subscribe to our newsletter system now <br> to get latest news from us.</p>
                <form action="#">
                    <input type="text" placeholder="Enter your email...">
                </form>
                <a href="./Home/Content/Client/#" class="btn">Subscribe now <i class="ion-ios-arrow-forward"></i></a>
            </div>
        </div>
    </div>
    <div class="ft-copyright">
        <div class="ft-left">
            <p><a target="_blank" href="./Home/Content/Client/https://www.templateshub.net">Templates Hub</a></p>
        </div>
        <div class="backtotop">
            <p><a href="./Home/Content/Client/#" id="back-to-top">Back to top  <i class="ion-ios-arrow-thin-up"></i></a></p>
        </div>
    </div>
</footer>
<!-- end of footer section-->
<script src="{{ asset('assets/Content/Client/js/jquery.js') }}"></script>
<script src="{{ asset('assets/Content/Client/js/plugins.js') }}"></script>
<script src="{{ asset('assets/Content/Client/js/plugins2.js') }}"></script>
<script src="{{ asset('assets/Content/Client/js/custom.js') }}"></script>

{{-- <script type="text/javascript">
    $('#loginForm').on('submit', function checkLogin(e) {
        e.preventDefault();

        let UserName = $('#usernamelogin').val();
        let Pass = $('#passwordlogin').val();
        console.log('Username:', UserName); // Kiểm tra giá trị của username ở đây
    console.log('mk:', Pass); 
        $.ajax({
            url: "{{ route('login') }}",
            type: "POST",
            data: {
                UserName: UserName,
                Pass: Pass,
            },
            success: function (response) {
             alert("ok");
             window.location.href = "/trangchu";
            }
        })
    });

</script> --}}
{{-- <script type="text/javascript">
    $('#loginForm').on('submit', function checkLogin(e) {
    e.preventDefault();

    let UserName = $('#usernamelogin').val();

    let Pass = $('#passwordlogin').val();


    console.log('Username:', UserName); // Kiểm tra giá trị của username ở đây
    console.log('mk:', Pass); 
    if (Pass==null) {
        alert("Mật khẩu không trùng khớp");
    } else {
        $.ajax({
            url: "{{ route('login') }}",
            type: "POST",
            data: {
                UserName: UserName,
                Pass: Pass
            },
                success: function (response) {
                   
                   
                        alert("Bạn đã đăng ký thành công");
                        window.location.href = "/trangchu";
                    
                }
            })
        }
    });
</script> --}}
{{-- <script type="text/javascript">
    $('#registerForm').on('submit', function checkLogin(e) {
    e.preventDefault();

    let UserName = $('#tendangnhap').val();
    let HoTen=$('#hoten').val();
    let Email=$('#email').val();
    let SDT =$('#sdt').val();
    let Pass = $('#matkhau').val();
    var repassword = $('#rqmatkhau').val();

    console.log('Username:', UserName); // Kiểm tra giá trị của username ở đây
    console.log('mk:', Pass); 
    if (repassword != Pass) {
        alert("Mật khẩu không trùng khớp");
    } else {
        $.ajax({
            url: "{{ route('sigin') }}",
            type: "POST",
            data: {
                UserName: UserName,HoTen:HoTen,Email:Email,SDT:SDT
                Pass: Pass,
    
            },
                success: function (response) {
                   
                   
                        alert("Bạn đã đăng ký thành công");
                        window.location.href = "/trangchu";
                    
                }
            })
        }
    });
</script> --}}
<script type="text/javascript">
    $(document).ready(function () {
        var modal = $('.modal');
        var btn = $('#checkSo');
        var span = $('.close');

        btn.click(function () {
            modal.show();
        });

        span.click(function () {
            modal.hide();
        });

        $(window).on('click', function (e) {
            if ($(e.target).is('.modal')) {
                modal.hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });


        $(".bank-item").click(function () {
            $(".bank-item").removeClass("selected");
            $(this).addClass("selected");
        });
    });
</script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '/api/theloai-trangchu',
            type: "GET",
            dataType: 'json',
                success: function (response) {
                    var listheloai=$('.theloaiphim'); 
                    listheloai.html("");
                    var theloai=response;
                    theloai.forEach(function(sanpham) {
                        listheloai.append(`<li><a href="/phim/theloai/`+sanpham.idTheLoai+`">`+sanpham.TenTheLoai+`</a></li>`);
                    });
                }
            })
    });
</script>
</body>


</html>
