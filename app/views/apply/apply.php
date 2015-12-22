<?php
if(isset($_GET['success'])){
    echo"YAY<br/>";
}else if(isset($_GET['failure'])){
    echo"BOO<br/>";
}

echo \core\error::display($data['errors']);
?>
<form method="POST" class="form">
    <h3>Student Information</h3>
    <div class="row">
        <div class="form-group col-md-3">
            <label>First Name:</label>
            <input type="text" name="fname" id="fname" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>Last Name:</label>
            <input type="text" name="lname" id="lname" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <label>Date of Birth:</label>
            <input type="text" name="dob" id="dob" class="form-control">
        </div>
        <label>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Hometown:</label>
            <input type="text" name="hometown" id="hometown" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <label>Gender:</label>
            <select id="gender" name="gender" class="form-control">
                <option value="Man">Man</option>
                <option value="Woman">Woman</option>
                <option value="Trans Man">Trans Man</option>
                <option value="Trans Woman">Trans Woman</option>
                <option value="Gender Queer">Gender Queer</option>
                <option value="Self-Identify">Self-Identify</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label>Year in School:</label>
            <select id="year" name="year" class="form-control">
                <option value="Freshman">Freshman</option>
                <option value="Sophomore">Sophomore</option>
                <option value="Junior">Junior</option>
                <option value="Senior">Senior</option>
                <option value="Fifth Year Senior">Fifth Year Senior</option>
                <option value="Graduate Student">Graduate Student</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Student Email:</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>Phone Number:</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <label>Student Number:</label>
            <input type="text" name="stunum" id="stunum" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>College/School you are associated with: </label>
            <select name="college" id="college" class="form-control">
                <?php foreach($data['colleges'] as $college){ ?>
                    <option value="<?php echo $college->collegeId; ?>"><?php echo $college->collegeName; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    



    <h3>Service Issues</h3>
    <h4>Please rank the service issues you are most interested in. Participants are placed on trips based on service issues, not locations.</h4>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Issue 1:</label>
            <select name="issue1" id="issue1" class="form-control">
                <?php foreach($data['issues'] as $issue){ ?>
                    <option value="<?php echo $issue->issueId; ?>"><?php echo $issue->issueName; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Issue 2:</label>
            <select name="issue2" id="issue2" class="form-control">
                <?php foreach($data['issues'] as $issue){ ?>
                    <option value="<?php echo $issue->issueId; ?>"><?php echo $issue->issueName; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Issue 3:</label>
            <select name="issue3" id="issue3" class="form-control">
                <?php foreach($data['issues'] as $issue){ ?>
                    <option value="<?php echo $issue->issueId; ?>"><?php echo $issue->issueName; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <h3>Final Questions</h3>
    <?php foreach($data['questions'] as $question){ ?>
        <div class="row">
            <div class="form-group col-md-6">
                <label><?php echo $question->questionText; ?></label>
                <?php switch($question->answerType){
                    case "textarea":
                        ?>
                        <textarea id="<?php echo $question->applicationQuestionId; ?>" name="<?php echo $question->applicationQuestionId; ?>" class="form-control" rows="10"></textarea>
                        <?php
                        break;
                    case "text":
                        ?>
                        <input type="text" id="<?php echo $question->applicationQuestionId; ?>" name="<?php echo $question->applicationQuestionId; ?>" class="form-control">
                        <?php
                        break;
                    case "radio":
                        foreach($data['options'] as $option){
                            if($question->applicationQuestionId == $option->applicationQuestionId) {
                                ?>
                                <div class="radio">
                                    <label for="<?php echo $question->applicationQuestionId . "o" . $option->applicationQuestionOptionId; ?>">
                                        <input
                                            type="radio"
                                            name="<?php echo $question->applicationQuestionId; ?>"
                                            id="<?php echo $question->applicationQuestionId . "o" . $option->applicationQuestionOptionId; ?>"
                                            value="<?php echo $option->value; ?>"
                                            >
                                        <?php echo $option->value; ?>
                                    </label>
                                </div>
                            <?php
                            }
                        }   
                        break;
                    default:

                } ?>

            </div>
        </div>
    <?php } ?>
    <br><br>
    <div class="row">
        <div class="form-group col-md-4">
            <button type="submit" value="Submit" name="submit" class="form-control btn btn-primary">Submit</button>
        </div>
        <div class="form-group col-md-1">
            <input type="button" onclick="location.href = '/login';"  class="btn" value="Cancel" />
        </div>
    </div>
</form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#dob").datepicker({
            changeYear: true,
            changeMonth: true,
            maxDate: new Date,
            yearRange: "c-100:c"
        }).inputmask("m/d/y");
        $("#phone").inputmask("(999)-999-9999");
        $("#stunum").inputmask("99999999");
    });
</script>