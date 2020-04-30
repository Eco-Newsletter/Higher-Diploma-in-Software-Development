

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/slicknav.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">


	<style>
	.img-button{
   padding-left;50px;
	position:relative;
	padding-top:10px;
	max-width:300px
	display:block;
	
}
	
.profile_pic{
		padding-bottom:20px;
}
	



    </style>
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                           <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="recommendation.html">home</a></li>
                                            <li><a href="search.html">Search</a></li>
                                            <li><a href="indexlaszlo.html">Notification <i class="ti-angle-down"></i></a>
                                            </li>
                                            <li><a href="#">My Profile <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="view_profile.php">View </a></li>
                                                    <li><a href="edit_profile1.php">Edit </a></li>
                                                    <li><a href="preferences.php">Your Preferences</a></li>
                                                </ul>
                                            </li>
                                            <li><a  class="bottom" href="logout.php" onclick=confirmLogout() >Logout</a></li>
                                        </ul>
                                    </nav> 
                                </div> 
                            </div>
                            <!--div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    <div class="phone_num d-none d-xl-block">
                                        <a href="#">Log in</a>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn3" href="#">Sign Up</a>
                                    </div>
                                </div>
                            </div -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->
<!-- bradcam_area  -->
    <div class="bradcam_area  bradcam_bg_1">
        <div class="container">
            <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="profile_pic">
							<img class ="img-fluid" src = "profile.png" alt = "picture">
						</div>
					</div>

					<div class = "col-lg-2 col-md-2">
					<div class = "thumbnails">
						<img class = "img-fluid" src = "dummysmall.png" alt = "thumbnails">
						</div>
					</div>
					<div class = "col-lg-2 col-md-2">
					<div class = "thumbnails">
						<img class = "img-fluid" src = "dummysmall.png" alt = "thumbnails">
						</div>
					</div>
					<div class = "col-lg-2 col-md-2">
					<div class = "thumbnails">
						<img class = "img-fluid" src = "dummysmall.png" alt = "thumbnails">
						</div>
					</div>
					<div class = "col-lg-2 col-md-2">
					<div class = "thumbnails">
						<img class = "img-fluid" src = "dummysmall.png" alt = "thumbnails">
						</div>
					</div>
					<br>
					<h1>UPLOAD YOUR PHOTOS HERE!</h1>
					<div class="container">
            <div class="row">
                <div class="col-lg-12">
                   <form method="post" action="photoupload.php" enctype='multipart/form-data'>
						<input type="file" name="path" >
						<input type="submit" value="Upload Image" name="submit">
					</form>
                </div>
            </div>
        </div>
			</div>
		</div>
	</div>	
    <!--/ bradcam_ar
    <!-- slider_area_start -->

    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">

                  <form action="enter_data.php" class="was-validated" method="post">
                       
                        <div class="row row-space">
                            <div class="col-lg-4">

                                <div class="input-group">
                                    <label class="label">Age</label>
                                    <div class="p-t-10">
                                    <div class="row row-space">
                                        <div class="col-lg-6">
                                            <div class="input-group">

                                                <div class="rs-selectage js-select-simple select--no-search">
                                                    <select name="age_id">
                                                        <option disabled="disabled" selected="selected">From</option>
                                                        <option>18</option><option>19</option><option>20</option><option>21</option>
                                                        <option>22</option><option>23</option><option>24</option><option>25</option>
                                                        <option>26</option><option>27</option><option>28</option><option>29</option>
                                                        <option>30</option><option>31</option><option>32</option><option>33</option>
                                                        <option>34</option><option>35</option><option>36</option><option>37</option>
                                                        <option>38</option><option>39</option><option>40</option><option>41</option>
                                                        <option>42</option><option>43</option><option>44</option><option>45</option>
                                                        <option>46</option><option>47</option><option>48</option><option>49</option>
                                                        <option>50</option><option>51</option><option>52</option><option>53</option>
                                                        <option>54</option><option>55</option><option>56</option><option>57</option>
                                                        <option>58</option><option>59</option><option>60</option><option>61</option>
                                                        <option>62</option><option>63</option><option>64</option><option>65</option>
                                                        <option>66</option><option>67</option><option>68</option><option>69</option>
                                                        <option>70</option><option>71</option><option>72</option><option>73</option>
                                                        <option>74</option><option>75</option><option>76</option><option>77</option>
                                                        <option>78</option><option>79</option><option>80</option><option>81</option>
                                                        <option>82</option><option>83</option><option>84</option><option>85</option>
                                                        <option>86</option><option>87</option><option>88</option><option>89</option>
                                                        <option>90</option><option>88</option><option>92</option><option>93</option>
                                                        <option>94</option><option>92</option><option>96</option><option>97</option>
                                                        <option>98</option><option>99</option><option>100</option><option>101</option>
                                                    </select>
                                                    <div class="select-dropdown"></div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="input-group">
                                    <label class="label">gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" checked="checked" name="gender" value="m">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" name="gender" value="f">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            

                        <div class="row row-space">
                            <div class="col-lg-6">
                              <div class="input-group">
                                <!--<label class="label">Location</label> -->

                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="location_id">
                                            <option disabled="disabled" selected="selected">Location</option>
                                            <option value = "3001">Dublin</option><option value = "3002">Kilkenny</option><option value = "3003">Carlow</option><option value = "3004">Wexford</option>
                                            <option value = "3005" >Wicklow</option><option value = "3006">Offaly</option><option value = "3007">Kildare</option><option value = "3008">Meath</option>
                                            <option value = "3009">WestMeath</option><option value = "3010">Louth</option><option value = "3011">Laois</option><option value = "3012">Longford</option>
                                            <option value = "3013">Antrim</option><option value="3014">Derry</option><option value ="3015">Down</option><option value = "3016">Tyrone</option>
                                            <option value = "3017">Armagh</option><option value="3018">Fermanagh</option><option value="3019">Cavan</option><option value = "3020">Monaghan</option>
                                            <option value = "3021">Donegal</option><option value = "3022">Galway</option><option value="3023">Leitrim</option><option value = "3024">Mayo</option>
                                            <option value = "3025">Roscommon</option><option value = "3026">Sligo</option><option value="3027">Clare</option><option value="3028">Kerry</option>
                                            <option value = "3029">Limerick</option><option value = "3030">Cork</option><option value = "3031">Tipperary</option><option value="3032">Waterford</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>

                              </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="input-group">
                                    <!-- <label class="label">Interests</label> -->
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="interest_id">
                                            <option disabled="disabled" selected="selected">Interests</option>
                                            <option value ="1001">Cinema</option><option value="1002">Tv shows</option><option value="1003">Books</option><option value ="1004">Hike</option>
                                            <option value = "1005">Walking</option><option value = "1006">Running</option><option value ="1007">Swimming</option><option value ="1008">Dancing</option>
                                            <option value = "1009">Travel</option><option value ="1010">Cook</option><option value = "1011">Commedy</option><option value = "1012">Friends</option>
                                            <option value = "1013">Music</option><option value = "1014">Gaming</option><option value = "1015">Fashion</option><option value = "1016">Volunteer</option>
                                            <option value = "1017">Yoga</option><option value = "1018">Gardening</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row row-space">
						<div class="input-group">
									<label class="label">About me:</label>
									<input class="input--style-4" type="text" id="bio" placeholder="Enter a description" name="bio">
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
								</div>
								</div>

                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--magenta" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- slider_area_end -->



    <!-- footer start -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="img/logo.png" alt="">
                                </a>
                            </div>
                            <p>
                                findSupport@support.com <br>
                                +10 873 672 6782 <br>
                                600/D, Green road, NewYork
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">
                            <h3 class="footer_title">
                                Company
                            </h3>
                            <ul>
                                <li><a href="#">About </a></li>
                                <li><a href="#"> Pricing</a></li>
                                <li><a href="#">Carrier Tips</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s">
            <div class="container">
                <div class="footer_border">
				</div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->

    <!-- link that opens popup -->
    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/gijgo.min.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>
</body>

</html>