<?php use \helpers\form, \core\error; ?>
 <header>
    <h2><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Wish List</h2>
    <h5>Issue: <?php echo \helpers\Session::get("issue"); ?></h5>
</header>
<hr />

<table class="table table-hover">
    <thead>
        <tr>
            <th width="70">Rating</th>
            <th width="70">App #</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Notes</th>
            
        </tr>
    </thead>
    <tbody>
                
        <?php 

        
        if ($data['applicants']) {
                
            
            foreach ($data['applicants'] as $applicants_info) {
                    echo '<form name="wishlist" action="" method="post">';
                    echo '<tr bgcolor='.$applicants_info->color.'>';
                    
                    echo '<td>'.$applicants_info->rating.'</td>';
                    echo '<td>'.$applicants_info->applicationId.'</td>';
                    echo '<input type="hidden" name="applicationId" value="'.$applicants_info->applicationId.'"/>';
                    echo '<td>'.$applicants_info->gender.'</td>';
                    echo '<td>'.$applicants_info->age.'</td>';
                    echo '<td>'.$applicants_info->notes.'</td>';
                    echo '</tr>';
                    echo '</form>';
            }

        }
        ?>      
    </tbody>
</table>




<div class="modal fade" id="draftApplicant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Draft Participant</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<br />
<br />
<br />
<br />
<br />
<br />




