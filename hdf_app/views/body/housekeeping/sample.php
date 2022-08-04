 

 <table border="1" id="tr">
  
                <tr>

                  <td>sadas</td>
                </tr>

              </table>


<script type="text/javascript" src="<?php echo base_url() ?>assets/jquery.js"></script>
              <script type="text/javascript">
 $(document).ready( function() {
done();
});

function done() {
setTimeout( function() {
updates();
done();
}, 1000);
}

function updates() {
$.getJSON("http://localhost/fidesfinal/assets/fetch.php", function(data) {
$("#tr").empty();
$.each(data.result, function(){
$("#tr").append("<tr><td> "+this['name']+"</td> <td> "+this['age']+"</td><td> "+this['company']+" </td> <td> <a href='sample.php'>sample</a></td></tr>");
});
});
}


              </script>