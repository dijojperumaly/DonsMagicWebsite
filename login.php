<?php 
include('headerWhite.php');
?> 

	<!-- Title page -->
	<!--<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-02.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Account
		</h2>
	</section>	-->

	<!-- Content page -->
	<section class="bg0 p-t-62 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-lg-8 p-b-80">
					<div class="p-r-45 p-r-0-lg">
                        <!-- item blog -->                        
						<div class="p-b-63">							
							<div class="p-t-32">
								<h4 class="p-b-15">
                                    Sign Up Now
								</h4>
								<p class="stext-117 cl6">
									Create a DonsMagic Account
								</p>

								<!--<div class="flex-w flex-sb-m p-t-18">-->
                                <div class="p-t-55">
                                    <form method="post" action="#">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="txtname" id="txtname" placeholder="your name">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="txtphone" id="txtphone" placeholder="phone number">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="txtemail" id="txtemail" placeholder="email">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="txtpassword" id="txtpassword" placeholder="password">
                                        </div>

                                        <div class="form-group">
                                            <input class="btn btn-success" type="Submit" name="btnsignup" id="btnsignup" value="Sign Up" style="cursor:pointer;">
                                        </div>
                                    </form>									
								</div>
							</div>
						</div>

						<!-- item blog -->						

						<!-- item blog -->
						
						<!-- Pagination -->
						<!--<div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
							<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
								1
							</a>

							<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">
								2
							</a>
						</div>-->
					</div>
				</div>

				<div class="col-md-5 col-lg-4 p-b-80">
					<div class="side-menu">
                        <div class="p-r-45 p-r-0-lg">
                            <div class="p-b-63">
                                <div class="p-t-32">
                                    <!--<div class="bor17 of-hidden pos-relative">
                                        <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

                                        <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </div>-->                      
                                    <!--<h4 class="mtext-112 cl2 p-b-33">
                                        Sign In
                                    </h2>-->
                                    <h4 class="p-b-15">
                                        Sign In
                                    </h4>
                                    <p class="stext-117 cl6">
                                        You have an Account Please Sign In
                                    </p>
                                    <div class="p-t-55">
                                        <form method="post" action="#">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="txtloginuname" id="txtloginuname" placeholder="email">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="txtloginpassword" id="txtloginpassword" placeholder="password">
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-primary" type="Submit" name="btnlogin" id="btnlogin" value="Sign In" style="cursor:pointer;">
                                            </div>
                                        </form>
                                    </div>
                                </div>                                                    
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	
		
	<?php
include('footer.php');
?>