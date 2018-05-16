
//base_api_url = myVar = '{{ env('APP_DEBUG') }}';



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

    $(".nav a").on("click", function(){
       $(".nav").find(".active").removeClass("active");
       $(this).parent().addClass("active");
    });

  
});