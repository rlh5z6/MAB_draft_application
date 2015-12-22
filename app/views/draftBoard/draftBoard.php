<table class="draft-board">
    <thead>
        <tr>
            <th></th>
            <?php foreach($data['draftOrder'] as $trip){ ?>
                <th class="rotate r<?php echo $trip->draftPosition; ?>"><div><span><?php echo $trip->nickname; ?></span></div></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php for($i = 0; $i < 10; $i++){ ?>
            <tr>
                <th><?php echo $i+1; ?></th>
                <?php foreach($data['draftOrder'] as $trip){ ?>
                    <td class="trip <?php echo $trip->tripId; ?> d<?php echo $i+1; ?> r<?php echo $trip->draftPosition; ?>"></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>