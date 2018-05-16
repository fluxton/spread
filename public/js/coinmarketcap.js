
  var updateLastUpdateTime = function () {
    function checkTime(i) {
      return (i < 10) ? "0" + i : i;
    }

    function getTime() {
      var today = new Date(),
      h = checkTime(today.getHours()),
      m = checkTime(today.getMinutes()),
      s = checkTime(today.getSeconds());
      console.log("last update: " + h + ":" + m + ":" + s);
      $("#start_time" ).html(h + ":" + m + ":" + s);
        // document.getElementById('start_time').innerHTML = h + ":" + m + ":" + s;        
    }
    getTime();
  }

  var updateRate = function(rate) {
    console.log("rate: " + rate);
    $("#krw_to_usd" ).html(rate);
  }


var getNewData = function () {
  console.log('asking new data to the server....');
  $.ajax({
    type: 'GET',
    url: "/api/coinmarketcap/data",
    dataType: 'json',
    success: function(data){
      console.log('data arrived, updating table....');
      //console.log(data);

      $.each( data, function( key, coin_obj ) {

        var symbol = coin_obj.symbol;
        // console.log(coin_obj);
        // console.log(symbol);

        $( "#"+symbol+"_rank" ).html(coin_obj.rank);
        $( "#"+symbol+"_rank" ).attr('data-value', coin_obj.rank);
        $( "#"+symbol+"_name" ).html(coin_obj.name);
        $( "#"+symbol+"_name" ).attr('data-value', coin_obj.name);
        //$( "#"+symbol+"_price_usd" ).html(coin_obj.price_usd + '$');
        $( "#"+symbol+"_price_usd" ).html(parseFloat(coin_obj.price_usd).toFixed(4) + " $");
        $( "#"+symbol+"_price_usd" ).attr('data-value', coin_obj.price_usd);
        $( "#"+symbol+"_price_btc" ).html(coin_obj.price_btc);
        $( "#"+symbol+"_price_btc" ).attr('data-value', coin_obj.price_btc);
        $( "#"+symbol+"_market_cap_usd" ).html(coin_obj.market_cap_usd + ' $');
        $( "#"+symbol+"_market_cap_usd" ).attr('data-value', coin_obj.market_cap_usd);
        $( "#"+symbol+"_24h_volume_usd" ).html(coin_obj['24h_volume_usd'] + ' $');
        $( "#"+symbol+"_24h_volume_usd" ).attr('data-value', coin_obj['24h_volume_usd']);
        $( "#"+symbol+"_percent_change_1h" ).html(coin_obj.percent_change_1h + '%');
        $( "#"+symbol+"_percent_change_1h" ).attr('data-value', coin_obj.percent_change_1h);
        document.getElementById(symbol+"_percent_change_1h" ).style.color = (coin_obj.percent_change_1h < 0) ? "red" : "green";
        $( "#"+symbol+"_percent_change_24h" ).html(coin_obj.percent_change_24h + '%');
        $( "#"+symbol+"_percent_change_24h" ).attr('data-value', coin_obj.percent_change_24h);
        document.getElementById(symbol+"_percent_change_24h" ).style.color = (coin_obj.percent_change_24h < 0) ? "red" : "green";
        $( "#"+symbol+"_percent_change_7d" ).html(coin_obj.percent_change_7d + '%');
        $( "#"+symbol+"_percent_change_7d" ).attr('data-value', coin_obj.percent_change_7d);
        document.getElementById(symbol+"_percent_change_7d" ).style.color = (coin_obj.percent_change_7d < 0) ? "red" : "green";

      });
      console.log('updated completed');

      updateLastUpdateTime();
    }
    // error: failureFunction 
  });
}



$(document).ready(function(){  
    console.log('document ready');

    updateLastUpdateTime();    

    var timer_var;

    var startTimer = function () {
      console.log('start timer');
      timer_var = setInterval(function() {        
        getNewData();
      }, 60 * 1000);
    }

    var stopTimer = function () {
      console.log('stop timer');
        clearInterval(timer_var);
    }
    
    $("#update_button").click(getNewData);

    $('#auto_update').change(function () {        
        console.log($('#auto_update').is(":checked"));
        if($('#auto_update').is(":checked")){
          startTimer();
        }
        else{
          stopTimer();
        }        
     });

  
});