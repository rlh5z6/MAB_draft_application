<script>
    $(document).ready(function(){
        $("#phone_num").inputmask("(999)-999-9999");
        $("#date_of_birth").datepicker({
            maxDate: new Date,
            changeYear: true,
            changeMonth: true,
            yearRange: "c-100:c"
        }).inputmask("m/d/y");
    });


</script>

<?php if($data['password']){ ?>
    <div>
        <p><?php echo $data['password']; ?></p>
    </div>
<?php } ?>


<div class="page-header">
    <h2>Register Board Member</h2>
</div>

<form name="register" method="post" action="/registerBoardMember_submit">

    <div id="first_nameDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="first_name">First Name: </label>
                <input type="text" id="first_name" name="first_name" class="form-input text form-control">
            </div>
        </div>
    </div>

    <div id="last_nameDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="last_name">Last Name: </label>
                <input type="text" id="last_name" name="last_name" class="form-input text form-control">
            </div>
        </div>
    </div>

    <div id="titleDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="title">Title: </label>
                <input type="text" id="title" name="title" class="form-input text form-control">
            </div>
        </div>
    </div>

    <div id="user_nameDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="user_name">Username: </label>
                <input type="text" id="user_name" name="user_name" class="form-input text form-control">
            </div>
        </div>
    </div>

    <div id="date_of_birthDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="date_of_birth">Date of Birth: </label>
                <input type="date_of_birth" id="date_of_birth" name="date_of_birth" class="form-input text form-control">
            </div>
        </div>
    </div>

    <div id="genderDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="gender">Gender: </label>
                <select id="gender" name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="Woman">Woman</option>
                    <option value="Man">Man</option>
                    <option value="Trans Woman">Trans Woman</option>
                    <option value="Trans Man">Trans Man</option>
                    <option value="Gender Queer">Gender Queer</option>
                    <option value="Self-Identify">Self-Identify</option>
                </select>
            </div>
        </div>
    </div>

    <div id="emailDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="email">Email: </label>
                <input type="text" id="email" name="email" class="form-input text form-control">
            </div>
        </div>
    </div>

    <div id="phone_numDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="phone_num">Phone Number: </label>
                <input type="text" id="phone_num" name="phone_num" class="form-input text form-control">
            </div>
        </div>
    </div>

    <div id="seasonIdDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="seasonId">Season: </label>
                <?php echo \helpers\Form::select(array( 'name'=> 'seasonId', 'id' => 'seasonId', 'class' => 'form-control', 'data' => $data['season_names']));?>
            </div>
        </div>
    </div>

    <div id="hometownDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="hometown">Hometown: </label>
                <?php echo \helpers\Form::input(array( 'name'=> 'hometown', 'id' => 'hometown', 'class' => 'form-control', 'placeholder' => 'City, State'));?>
            </div>
        </div>
    </div>

    <div id="schoolYearDiv" class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <label for="schoolYear">Year in School: </label>
                <select id="schoolYear" name="schoolYear" class="form-control">
                    <option value="">Select</option>
                    <option value="Freshman">Freshmen</option>
                    <option value="Sophomore">Sophomore</option>
                    <option value="Junior">Junior</option>
                    <option value="Senior">Senior</option>
                    <option value="Fifth Year+">Fifth Year+</option>
                    <option value="Graduate">Graduate</option>
                </select>
            </div>
        </div>
    </div>


    <br><br>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-4 col-md-3">
                <input type="submit" name="submit" class="form-input text btn btn-default btn-primary btn-lg" value="Register Board Member">
            </div>
        </div>
    </div>
    <br><br><br><br>
</form>


