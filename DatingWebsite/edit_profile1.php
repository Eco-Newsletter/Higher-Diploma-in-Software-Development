

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


<?php include "header.html" ?>


<!-- bradcam_area  -->
    <div class="bradcam_area  bradcam_bg_1">
        <div class="container">
		<div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>CREATE YOUR DREAM PROFILE</h3>
                    </div>
                </div>
            </div>
            
		</div>

    <!--/ bradcam_ar
    <!-- slider_area_start --><!--page-wrapper bg-gra-02-->

    <div class=" p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
				<div class="row">
					<h1>UPLOAD YOUR PHOTOS HERE!</h1>
					<div class="container">
            <div class="row">
                <div class="col-lg-12">
				<form enctype="multipart/form-data" action="photoupload.php" method="POST">
				<input type="file" name="file">
				<button type = "submit"class="btn btn--radius-2 btn--magenta" name = "submit">UPLOAD</button>
                   </form>
                </div>
            </div>
        </div>

			</div>

                  <form action="enter_data.php" class="was-validated" method="post">

                        <div class="row row-space">
                            <div class="col-lg-4">

                                <div class="input-group">
                                    <!--<label class="label">Age</label>-->
                                    <div class="p-t-10">
                                    <div class="row row-space">
                                        <div class="col-lg-6">
                                            <div class="input-group">

                                                <div class="rs-select2 js-select-simple select--no-search">
                                                    <select name="age_id">
                                                        <option disabled="disabled" selected="selected">Age</option>
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
							
						<div class="row row-space">
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
						</div>


                        <div class="row row-space">
                            <div class="col-lg-6">
                              <div class="input-group">
                                <!--<label class="label">Location</label> -->

                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="location_id">
                                            <option disabled="disabled" selected="selected">Location</option>
                                            <option value = "3013">Antrim</option><option value = "3017">Armagh</option><option value = "3003">Carlow</option><option value = "3019">Cavan</option>
                                            <option value = "3027" >Clare</option><option value = "3030">Cork</option><option value = "3014">Derry</option><option value = "3021">Donegal</option>
                                            <option value = "3015">Down</option><option value = "3010">Dublin</option><option value = "3018">Fermanagh</option><option value = "3022">Galway</option>
                                            <option value = "3028">Kerry</option><option value="3007">Kildare</option><option value ="3002">Kilkenny</option><option value = "3011">Laois</option>
                                            <option value = "3023">Leitrim</option><option value="3029">Limerick</option><option value="3012">Longford</option><option value = "3010">Louth</option>
                                            <option value = "3024">Mayo</option><option value = "3008">Meath</option><option value="3020">Monaghan</option><option value = "3006">Offaly</option>
                                            <option value = "3025">Roscommon</option><option value = "3026">Sligo</option><option value="3031">Tipperary</option><option value="3016">Tyrone</option>
                                            <option value = "3032">Waterford</option><option value = "3009">WestMeath</option><option value = "3004">Wexford</option><option value="3005">Wicklow</option>
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
                                            <option disabled="disabled" selected="selected">Interest 1</option>
                                            <option value ="1003">Books</option><option value="1001">Cinema</option><option value="1011">Comedy</option><option value ="1010">Cook</option>
                                            <option value = "1008">Dancing</option><option value = "1015">Fashion</option><option value ="1012">Friends</option><option value ="1014">Gaming</option>
                                            <option value = "1018">Gardening</option><option value ="1004">Hike</option><option value = "1013">Music</option><option value = "10063">Painting</option>
                                            <option value = "1006">Running</option><option value = "1007">Swimming</option><option value = "1009">Travel</option><option value = "1002">Tv Shows</option>
                                            <option value = "1016">Volunteer</option><option value = "1005">Walking</option><option value = "1017">Yoga</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-6">
                                <div class="input-group">
                                    <!-- <label class="label">Interests</label> -->
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="interest_id2">
                                            <option disabled="disabled" selected="selected">Interest 2</option>
                                            <option value ="1003">Books</option><option value="1001">Cinema</option><option value="1011">Comedy</option><option value ="1010">Cook</option>
                                            <option value = "1008">Dancing</option><option value = "1015">Fashion</option><option value ="1012">Friends</option><option value ="1014">Gaming</option>
                                            <option value = "1018">Gardening</option><option value ="1004">Hike</option><option value = "1013">Music</option><option value = "10063">Painting</option>
                                            <option value = "1006">Running</option><option value = "1007">Swimming</option><option value = "1009">Travel</option><option value = "1002">Tv Shows</option>
                                            <option value = "1016">Volunteer</option><option value = "1005">Walking</option><option value = "1017">Yoga</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
							<div class="col-lg-6">
                                <div class="input-group">
                                    <!-- <label class="label">Interests</label> -->
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="interest_id3">
                                            <option disabled="disabled" selected="selected">Interest 3</option>
                                            <option value ="1003">Books</option><option value="1001">Cinema</option><option value="1011">Comedy</option><option value ="1010">Cook</option>
                                            <option value = "1008">Dancing</option><option value = "1015">Fashion</option><option value ="1012">Friends</option><option value ="1014">Gaming</option>
                                            <option value = "1018">Gardening</option><option value ="1004">Hike</option><option value = "1013">Music</option><option value = "10063">Painting</option>
                                            <option value = "1006">Running</option><option value = "1007">Swimming</option><option value = "1009">Travel</option><option value = "1002">Tv Shows</option>
                                            <option value = "1016">Volunteer</option><option value = "1005">Walking</option><option value = "1017">Yoga</option>
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
  </div>
</div>
    <!-- slider_area_end -->


    <?php include "footer.html" ?>


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
    <script src="js/range.js"></script>


    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>
    <!-- Jquery JS-->
   <!-- <script src="vendor/jquery/jquery.min.js"></script> -->

    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

			<!-- JS confirm popup window for logout-->
		<script>
			function confirmLogout() {
				if (confirm('Sure to log out?')) {
						location='logout.php';
				} else {
						location='welcome.php';
				}
			}
		</script>
</body>

</html>
