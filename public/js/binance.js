
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


 var getData = function () {
    $.ajax({
      type: 'GET',
      url: "/api-proxy/binance",
      dataType: 'json',
      success: function(data){
                  console.log('data');

                  console.log(data);
                }
     // error: failureFunction 
    });
  }

var updateTable = function(data){
  console.log('data');

  console.log(data);
};





$(document).ready(function(){
  //getData();

  //updateTime();
  $("#update_button").click(getData);
});




