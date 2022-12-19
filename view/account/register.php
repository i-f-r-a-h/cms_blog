<?php include("../includes/header.php"); ?>
<?php require_once("../../controller/account/register.php"); ?>

<div class="h-100 bg-dark">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-registration my-4">
                    <div class="row g-0">
                        <div class="col-xl-6 d-none d-xl-block">
                            <img src="../images/register.webp" alt="Sample photo" class="img-fluid h-100 object-fit-cover" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                        </div>


                        <div class="col-xl-6">

                            <div class="card-body p-md-5 text-black">
                                <!-- form -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <h3 class="mb-5 ">Register</h3>
                                    <?php echo $message; ?>
                                    <?php echo $completed; ?>
                                    <div class="form-outline mb-4">
                                        <label for="">Add a profile picture</label>
                                        <div class="input-group mb-3">
                                            <input type="file" name="profile-pic" class="form-control" id="inputGroupFile02">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="floatingInput" name="first_name">
                                                <label for="floatingInput">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="floatingInput" name="last_name">
                                                <label for="floatingInput">Last Name</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">
                                                <input type="date" class="form-control mt-2" name="user_dob">
                                                <label for="user_dob">Birth Date</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">
                                                <select class="form-select  mt-2" id="floatingSelect" name="user_gender" aria-label="Floating label select example">
                                                    <option selected>Choose</option>
                                                    <option value="female">Female</option>
                                                    <option value="male">Male</option>
                                                    <option value="prefer not to say">Prefer not to say</option>
                                                </select>
                                                <label for="floatingSelect">Gender</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <div class="form-floating">
                                            <select class="form-select  mt-2" id="floatingSelect" name="course" aria-label="Floating label select example">
                                                <option selected>Choose course</option>
                                                <?php $courses = sae_courses::find_all();
                                                foreach ($courses as $course) {
                                                    echo "<option value='$course->course_name'>$course->course_name</option>";
                                                } ?>
                                            </select>
                                            <label for="floatingSelect">Current course you are associated with</label>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <div class="form-floating">
                                            <select class="form-select  mt-2" id="floatingSelect" name="campus" aria-label="Floating label select example">
                                                <option selected>Choose campus</option>
                                                <?php $campuses = sae_campus::find_all();
                                                foreach ($campuses as $campus) {
                                                    echo "<option value='$campus->id'>$campus->campus_name</option>";
                                                } ?>
                                            </select>
                                            <label for="floatingSelect">Campus</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">
                                                <select class="form-select  mt-2" id="floatingSelect" name="profession" aria-label="Floating label select example">
                                                    <option selected>Choose</option>
                                                    <option value="student">student</option>
                                                    <option value="lecturer">lecturer</option>
                                                    <option value="service">service job</option>
                                                    <option value="tech">tech</option>
                                                    <option value="healthcare">healthcare</option>
                                                    <option value="healthcare">other</option>
                                                </select>
                                                <label for="floatingSelect">Current Profession</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">
                                                <select class="form-select  mt-2" id="floatingSelect" name="level_of_study" aria-label="Floating label select example">
                                                    <option selected>Choose</option>
                                                    <?php $levels = sae_level_of_study::find_all();
                                                    foreach ($levels as $level) {
                                                        echo "<option value='$level->level'>$level->level</option>";
                                                    } ?>
                                                    <option value="na">Not Applicable</option>
                                                </select>
                                                <label for="floatingSelect">Level of study</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="floatingInput" name="user_tel">
                                            <label for="floatingInput">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="floatingInput" name="user_email" placeholder="name@example.com">
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInput" name="username">
                                            <label for="floatingInput">Username</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">

                                                <input type="password" class="form-control" name="user_password">
                                                <label for="password">password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating">

                                                <input type="password" class="form-control" name="confirm-password">
                                                <label for="confirm-password">confirm password</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-check pb-4">
                                        <input class="form-check-input" type="checkbox" id="gridCheck" value="confirm">
                                        <label class="form-check-label" for="gridCheck">
                                            I accept the terms and conditions of this blog.
                                        </label>
                                    </div>


                                    <div class="d-flex  pt-4">
                                        <input type="submit" name="submit-register" value="Register" class="btn btn-warning btn-lg ms-2">
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
<?php include("../includes/footer.php"); ?>