    <?php require_once("../../../../controller/account/settings/edit_profile.php"); ?>
    <?php require_once("../../../../controller/account/settings/change_password.php"); ?>
    <?php require_once("../settings/photo_model_gallery.php"); ?>
    <div class="col-lg-8 d-flex flex-column">
        <h2 class="mb-3 pb-4 border-bottom fs-3">Edit Profile</h2>
        <?php echo $message ?>
        <!-- comments -->
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h2 class="mb-3">General</h2>

                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Profile Picture</label>
                                <div class="d-flex">
                                    <div class="col-md-6 user_image_box">
                                        <a href="#" data-toggle="modal" data-target="#photo-library"> <img class="rounded-circle profile-img" src="../../../../<?php echo $user->image_path_and_placeholder() ?>" alt=""></a>
                                    </div>
                                    <div class="input-group col-xs-12 align-items-center ml-3">
                                        <input type="file" class="form-control file-upload-info" name="user_image" placeholder="Upload Image">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Username</label>
                                <input type="text" name="username" class="form-control" id="exampleInputName1" value="<?php echo $user->username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email address</label>
                                <input type="email" name="user_email" class="form-control" id="exampleInputEmail3" value="<?php echo $user->user_email; ?>">
                            </div>
                            <button type="submit" name="general" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h2 class="mb-3">User details</h2>
                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputName1">First Name</label>
                                        <input type="text" class="form-control" id="floatingInput" name="first_name" value="<?php echo $user->first_name; ?>">

                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Last Name</label>
                                        <input type="text" class="form-control" id="floatingInput" name="last_name" value="<?php echo $user->last_name; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label for="user_dob">Birth Date</label>
                                        <input type="date" class="form-control" name="user_dob" value="<?php echo $user->user_dob; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-select" id="gender" name="user_gender" aria-label="Floating label select example">
                                            <option selected><?php echo $user->user_gender; ?></option>
                                            <option value="female">Female</option>
                                            <option value="male">Male</option>
                                            <option value="prefer not to say">Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline">
                                <div class="form-group">
                                    <label for="course">Current course you are associated with</label>
                                    <select class="form-select" id="course" name="course" aria-label="Floating label select example">
                                        <option selected><?php echo $user->course; ?></option>
                                        <!-- //for each loop -->
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                        <option value="prefer not to say">Prefer not to say</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-outline">
                                <div class="form-group">
                                    <label for="campus">Campus</label>
                                    <select class="form-select" id="campus" name="campus" aria-label="Floating label select example">
                                        <option selected><?php echo $user->campus; ?></option>
                                        <!-- //for each loop -->
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                        <option value="prefer not to say">Prefer not to say</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profession">Current Profession</label>
                                        <select class="form-select" id="profession" name="profession" aria-label="Floating label select example">
                                            <option selected><?php echo $user->profession; ?></option>
                                            <!-- //for each loop -->
                                            <option value="student">student</option>
                                            <option value="lecturer">lecturer</option>
                                            <option value="service">service job</option>
                                            <option value="tech">tech</option>
                                            <option value="healthcare">healthcare</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="study">Level of study</label>
                                        <select class="form-select" id="study" name="level_of_study" aria-label="Floating label select example">
                                            <option selected><?php echo $user->level_of_study; ?></option>
                                            <option value="first">1st Year</option>
                                            <option value="second">2nd Year</option>
                                            <option value="third">3rd Year</option>
                                            <option value="fourth">4th Year</option>
                                            <option value="na">Not Applicable</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <div class="form-group">
                                    <label for="tel">Phone Number</label>
                                    <input type="tel" class="form-control" id="tel" name="user_tel" value="<?php echo $user->user_tel; ?>">

                                </div>
                            </div>

                            <button type="submit" name="user_details" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div>