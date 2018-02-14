
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



var updateTable = function(){
  $.when(
      $.ajax("https://api.fixer.io/latest?base=KRW&symbols=USD"),
      $.ajax("https://api.bithumb.com/public/ticker/all")
    )
    .done(function(rateInfo, bithumbData){
      var rate = rateInfo[0].rates.USD;      
      updateRate(rate);            
      $.each( bithumbData[0].data, function( symbol, coin_obj ) {
        // console.log(symbol + ": ");
        // console.log(coin_obj);
         if (symbol !== 'date') {
          // console.log("sell_price: " +coin_obj.sell_price);
          var sell_price = (rate*coin_obj.sell_price).toFixed(2);
          // console.log(sell_price);
          $( "#"+symbol+"_sell_price" ).html(sell_price + " $");
          var max_price = (rate*coin_obj.max_price).toFixed(2);
          $( "#"+symbol+"_max_price" ).html(max_price + " $"); 
          var min_price = (rate*coin_obj.min_price).toFixed(2);
          $( "#"+symbol+"_min_price" ).html( min_price + " $");
          var volume_1day = (rate*coin_obj.volume_1day).toFixed(2);
          $( "#"+symbol+"_volume_1day" ).html(volume_1day + " $");
        }
      });
      updateTimer();
    })
    .fail(function () {
      $("#error").html("an error occured").show();
    });
}



$(document).ready(function(){
  //updateTable();

  updateTimer();
  $("#update_button").click(updateTable);
});


