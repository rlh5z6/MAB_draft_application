<iframe src="draftBoard_main" class="col-md-12" height="500px" name="draftBoard"></iframe>
<input type="button" class="btn btn-primary" value="Finalize Draft" onclick="finalize()">
<input type="button" class="btn btn-primary" value="Skip Current User's Turn" onclick="skipturn()">
<input type="button" class="btn btn-primary" value="Begin Draft" onclick="begin()">
<img src="/app/images/ajax-loader.gif" id="loading">
<script type="text/javascript">
    var turn = -1;
    var starter = -1;

    $(document).ready(function(){
        $("#loading").hide();
        window.setInterval(function(){
            $.ajax({
                url: 'ajax/checkTurn'
            }).done(function(results){
                results = JSON.parse(results);
                if(turn != results.tripId) {
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
                    $.ajax({
                        url: 'ajax/getDrafted'
                    }).done(function(results){
                        results = JSON.parse(results);
                        for(var i = 0; i < results.length; i++){
                            $('td.trip.'+results[i].tripId+'.d'+results[i].draftedOrder, frames['draftBoard'].document).html(results[i].applicationId);
                        }
                    });
                    $("td", frames['draftBoard'].document).removeClass('turn');
                    $("td.trip." + results.tripId, frames['draftBoard'].document).addClass('turn');
                    turn = results.tripId;
                }
            });
        }, 1000);
    });

    function finalize(){
        $("#loading").show();
        $.ajax({
            url: 'ajax/finalizeDraft'
        }).done(function(results){
            results = JSON.parse(results);
            if(results){
                alert('Success!');
            }else{
                alert('Failure!');
            }
            $("#loading").hide();
        });
    }

    function skipturn(){
        $.ajax({
            url: 'ajax/checkTurn'
        }).done(function(trip){
            trip = JSON.parse(trip);
            $.ajax({
                url: 'ajax/updateTurn?tripId='+trip.tripId
            });
        });
    }

    function begin(){
        $("#loading").show();
        $.ajax({
            url: 'ajax/startDraft'
        }).done(function(results){
            if(results){
                alert("Success!");
            }else{
                alert("Failure!");
            }
            $("#loading").hide();
        });
    }
</script>