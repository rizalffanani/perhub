

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?php echo site_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 color1">
				Login
			</span>
		</div>
	</div>


	<!-- Login -->
	<div class="p-t-30">
		<div class="container p-b-20">
			<div class="row">
				<div class="col-md-6 m-r-auto m-l-auto m-b-30">
					<div class="p-lr-40 p-t-30 m-lr-0-xl p-lr-15-sm">
						<h4 class="ltext-103 color1 text-center">
							Login
						</h4>
					</div>
				</div>
			</div>

            <div class="row">
                <div class="col-md-6 m-lr-auto m-b-30">
                    <div class="bor10 p-l-20 p-r-20 m-lr-0-xl p-lr-15-sm" id="load">
                        <form id="signin" class="p-t-50 p-b-50 p-lr-30">
                            <div class="bor8 m-b-12 how-pos4-parent">
                                <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="text" name="email" placeholder="Email" required >
                            </div>
                            <div class="bor8 m-t-15 m-b-12 how-pos4-parent">
                                <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="password" name="pass" placeholder="Password" required >
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-danger">
                                        <input id="checkbox6" class="dis-inline" type="checkbox" name="remember">
                                        <label for="checkbox6" class="dis-inline pointer">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6 col-sm-3 m-t-12 text-right">
                                    <a href="javascript:void(0)" id="reset" class="color2"><b>Lupa Password?</b></a>
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-md-12">
                                    <button type="submit" class="flex-c-m w-full stext-101 cl0 size-101 bg-1 hovbtn2 p-lr-15 trans-04">
                                        LOG IN
                                    </button>
                                    <p class="text-center m-t-15">Belum punya akun? <a href="<?php echo site_url("home/signup"); ?>">Register</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</form>


  <script type="text/javascript">
  	$(function(){
  		$("#signin").on("submit",function(e){
  			e.preventDefault();

  			var submit = $("#submit").html();
  			$(".form").prop("readonly",true);
  			$("#submit").html("<i class='fa fa-spin fa-spinner'></i> tunggu sebentar...");
  			$.post("<?php echo site_url("home/signin"); ?>",$(this).serialize(),function(msg){
  				var data = eval('('+msg+')');
  				if(data.success == true){
  					window.location.href=data.redirect;
  				}else{
  					$("#submit").html(submit);
  					swal("Warning!","alamat email atau password salah, silahkan cek kembali","error");
  				}
  			});
  		});

  		$("#reset").click(function(){
  			$("#load").html("<i class='fa fa-spin fa-spinner'></i> mohon tunggu sebentar...");
  			$("#load").load("<?php echo site_url("home/signin/pwreset"); ?>");
  		});
  	});
  </script>
