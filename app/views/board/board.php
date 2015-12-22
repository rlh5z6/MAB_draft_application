<header>
    <h2>Board of Directors</h2>
</header>
<hr />


<table class="table table-striped table-hover">
    <h4>2014-2015 Board of Directors</h4>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th>Mizzou Email</th>
            <th>Phone Number</th>
        </tr>
    </thead>
    <tbody>
        
    <?php
    
        if ($data['board_of_directors']) {
            foreach ($data['board_of_directors'] as $board_info) {
        ?>
                <tr data-toggle="modal" data-id="1" data-target="#orderModal">
        <?php
                echo '<td>'.$board_info->firstName.'</td>';
                echo '<td>'.$board_info->lastName.'</td>';
                echo '<td>'.$board_info->title.'</td>';
                echo '<td>'.$board_info->email.'</td>';
                echo '<td>'.$board_info->phone.'</td>';
            }
        }
        echo '</tr>';
    ?>
            
        </tr>
    </tbody>
    
</table>

<script>
$(function(){
    $('#orderModal').modal({
        keyboard: true,
        backdrop: "static",
        show:false,
        
    }).on('show', function(){
          var getIdFromRow = $(event.target).closest('tr').data('id');
        //make your ajax call populate items or what even you need
        $(this).find('#orderDetails').html($('<b> Order Id selected: ' + getIdFromRow  + '</b>'))
    });
});



</script>