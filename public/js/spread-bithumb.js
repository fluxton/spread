
  var updateTimer = function () {
    function checkTime(i) {
      return (i < 10) ? "0" + i : i;
    }

    function startTime() {
      var today = new Date(),
      h = checkTime(today.getHours()),
      m = checkTime(today.getMinutes()),
      s = checkTime(today.getSeconds());
      console.log("last update: " + h + ":" + m + ":" + s);
      $("#start_time" ).html(h + ":" + m + ":" + s);
        // document.getElementById('start_time').innerHTML = h + ":" + m + ":" + s;        
    }

    function updateTime() {
      var today = new Date(),
      h = checkTime(today.getHours()),
      m = checkTime(today.getMinutes()),
      s = checkTime(today.getSeconds());
      $("#time" ).html(h + ":" + m + ":" + s);
      // document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
      t = setTimeout(function () {
        updateTime()
      }, 500);
    }
    startTime();
    updateTime();
  }

  var updateRate = function(rate) {
    console.log("rate: " + rate);
    $("#krw_to_usd" ).html(rate);
  }


    // var getKrwToUsdRate = function () {
    //   console.log("getKrwToUsdRate");
    //   $.get(
    //     "https://api.fixer.io/latest?base=KRW&symbols=USD",
    //     function(result){           
    //       console.log("rate2: " + result.rates.USD);
    //       $("#krw_to_usd" ).val(result.rates.USD)
    //       return  result.rates.USD;
    //     }
    //   );

    
    // };



var getNewData = function () {
  console.log('asking new data to the server....');
    $.ajax({
      type: 'GET',
      url: "/api/bithumb/spread",
      dataType: 'json',
      success: function(data){
          console.log('data arrived, updating table....');
          //console.log(data);

          updateRate(data.exchange_rate);            
          $.each( data.full_spread, function( symbol, coin_obj ) {
            
              $( "#"+symbol+"_bithumb" ).html(parseFloat(coin_obj.bithumb).toFixed(2) + " $");

              if (coin_obj.binance){

                $( "#"+symbol+"_binance" ).html(parseFloat(coin_obj.binance).toFixed(2) + " $");
                $( "#"+symbol+"_binance_diff_perc" ).html(parseFloat(coin_obj.binance_diff_perc).toFixed(3) + " %");
                document.getElementById(symbol+"_binance_diff_perc" ).style.color = (coin_obj.binance_diff_perc < 0) ? "red" : "green";
              }
              else{
                $( "#"+symbol+"_binance" ).html("####");
                $( "#"+symbol+"_binance_diff_perc" ).html("####");
                document.getElementById(symbol+"_binance_diff_perc" ).style.color = "blue";
              }

              if (coin_obj.bittrex){
                $( "#"+symbol+"_bittrex" ).html(parseFloat(coin_obj.bittrex).toFixed(2) + " $");
                $( "#"+symbol+"_bittrex_diff_perc" ).html(parseFloat(coin_obj.bittrex_diff_perc).toFixed(3) + " %");
                document.getElementById(symbol+"_bittrex_diff_perc" ).style.color = (coin_obj.bittrex_diff_perc < 0) ? "red" : "green";
              }
              else{
                $( "#"+symbol+"_bittrex" ).html("####");
                $( "#"+symbol+"_bittrex_diff_perc" ).html("####");
                document.getElementById(symbol+"_bittrex_diff_perc" ).style.color = "blue";
              }
            
          });

          updateTimer();
        }
     // error: failureFunction 
    });
  }



$(document).ready(function(){
  //getData();
  console.log('document ready');

  updateTimer();
  $("#update_button").click(getNewData);

  t = setTimeout(function () {
        getNewData()
      }, 1000*60);  //1 minute
});