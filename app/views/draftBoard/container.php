<iframe src="draftBoard_main" class="col-md-8" height="500px" name="draftBoard"></iframe>
<iframe src="draftBoard_wishlist" class="col-md-4" height="500px" name="wishlist"></iframe>
<iframe src="draftBoard_search" class="col-md-12" height="240px" name="search"></iframe>

<script type="text/javascript">
    var turn = -1;
    var starter = -1;
    var isTurn = false;

    $(document).ready(function(){
        window.setInterval(function(){
            $.ajax({
                url: 'ajax/checkTurn'
            }).done(function(results){
                if(results.draftPosition == 1 && starter != results.tripId){
                    starter = results.tripId;
                    $.ajax({
                        url: 'ajax/getDraftOrder'
                    }).done(function(results){
                        results = JSON.parse(results);
                        console.dir(results);
                        for(var i in results){
                            for(var j = 0; j < 10; j++) {
                                $('th.r'+results[i].draftPosition, frames['draftBoard'].document).html("<div><span>"+results[i].nickname+"</span></div>");
                                $('td.r' + results[i].draftPosition+".d"+(j+1), frames['draftBoard']
                                    .document).removeClass()
                                    .addClass("trip d"+(j+1)+" r"+results[i].draftPosition+" "+results[i].tripId);
                            }
                        }
                        $("td.r1", frames['draftBoard'].document).addClass("turn");
                    });
                }

                results = JSON.parse(results);
                if(turn != results.tripId) {
                    $.ajax({
                        url: 'ajax/getDrafted'
                    }).done(function(results){
                        results = JSON.parse(results);
                        for(var i = 0; i < results.length; i++){
                            $('td.trip.'+results[i].tripId+'.d'+results[i].draftedOrder, frames['draftBoard'].document).html(results[i].applicationId);
                        }
                    });
                    if(isTurn && results.tripId != <?php echo \helpers\session::get('tripId'); ?>){
                        isTurn = false;
                        $("input.draft", frames['wishlist'].document).prop("disabled", true);
                        $("input.draft", frames['search'].document).prop("disabled", true);
                    }
                    $("td", frames['draftBoard'].document).removeClass('turn');
                    $("td.trip." + results.tripId, frames['draftBoard'].document).addClass('turn');
                    turn = results.tripId;
                    if(turn == <?php echo \helpers\session::get('tripId'); ?>){
                        if(!isTurn){
                            alert("It's your turn!");
                            isTurn = true;
                            $("input.draft", frames['wishlist'].document).prop("disabled", false);
                            $("input.draft", frames['search'].document).prop("disabled", false);
                        }
                    }
                }
            });
        }, 1000);
    });

</script>