$(document).ready(function(){
 
    
    $('.main').click(function(){
        $('.mainedit').hide();
        $(this).next('.mainedit').show().focus();
        $(this).hide();
    });

    
    $(".mainedit").on('focusout',function(){
        
        //  pagkuha han edit id ngan field , value
        var id = this.id;
        var split_id = id.split("/");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        
        $(this).hide();

        $(this).prev('.main').show();
        $(this).prev('.main').text(value);

        $.ajax({
            url: 'https://booking.hoteldefides.com/index.php/admin/updatePricing',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                console.log('Save successfully'); 
            }
        });
    
    });



});




$(document).ready(function(){
 
    
    $('.second').click(function(){
        $('.secondedit').hide();
        $(this).next('.secondedit').show().focus();
        $(this).hide();
    });

    
    $(".secondedit").on('focusout',function(){
        
        //  pagkuha han edit id ngan field , value
        var id = this.id;
        var split_id = id.split("/");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var prod_id = split_id[2];
        var value = $(this).val();
        
        
        $(this).hide();

        $(this).prev('.second').show();
        $(this).prev('.second').text(value);

        $.ajax({
            url: 'https://booking.hoteldefides.com/index.php/admin/updatePricingBed',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id ,prod:prod_id },
            success:function(response){
                console.log('Save successfully'); 
            }
        });
    
    });



});


$(document).ready(function(){
 
    
    $('.third').click(function(){
        $('.thirdedit').hide();
        $(this).next('.thirdedit').show().focus();
        $(this).hide();
    });

    
    $(".thirdedit").on('focusout',function(){
        
        //  pagkuha han edit id ngan field , value
        var id = this.id;
        var split_id = id.split("/");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        
        $(this).hide();

        $(this).prev('.third').show();
        $(this).prev('.third').text(value);

        $.ajax({
            url: 'https://booking.hoteldefides.com/index.php/admin/updatePricingPerson',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                console.log('Save successfully'); 
            }
        });
    
    });



});


$(document).ready(function(){
 
    
    $('.PNmain').click(function(){
        $('.PNmainedit').hide();
        $(this).next('.PNmainedit').show().focus();
        $(this).hide();
    });

    
    $(".PNmainedit").on('focusout',function(){
        
        //  pagkuha han edit id ngan field , value
        var id = this.id;
        var split_id = id.split("/");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        
        $(this).hide();

        $(this).prev('.PNmain').show();
        $(this).prev('.PNmain').text(value);

        $.ajax({
            url: 'https://booking.hoteldefides.com/index.php/admin/updatePricinResName',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                console.log('Save successfully'); 
            }
        });
    
    });



});



//////
$(document).ready(function(){
 
    
    $('.PCmain').click(function(){
        $('.PCmainedit').hide();
        $(this).next('.PCmainedit').show().focus();
        $(this).hide();
    });

    
    $(".PCmainedit").on('focusout',function(){
        
        //  pagkuha han edit id ngan field , value
        var id = this.id;
        var split_id = id.split("/");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        
        $(this).hide();

        $(this).prev('.PCmain').show();
        $(this).prev('.PCmain').text(value);

        $.ajax({
            url: 'https://booking.hoteldefides.com/index.php/admin/updatePricinResName',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                console.log('Save successfully'); 
            }
        });
    
    });



});

//coffeee

$(document).ready(function(){
 
    
    $('.CNmain').click(function(){
        $('.CNmainedit').hide();
        $(this).next('.CNmainedit').show().focus();
        $(this).hide();
    });

    
    $(".CNmainedit").on('focusout',function(){
        
        //  pagkuha han edit id ngan field , value
        var id = this.id;
        var split_id = id.split("/");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        
        $(this).hide();

        $(this).prev('.CNmain').show();
        $(this).prev('.CNmain').text(value);

        $.ajax({
            url: 'https://booking.hoteldefides.com/index.php/admin/CoffeeupdatePricinResName',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                console.log('Save successfully'); 
            }
        });
    
    });



});

$(document).ready(function(){
 
    
    $('.CPmain').click(function(){
        $('.CPmainedit').hide();
        $(this).next('.CPmainedit').show().focus();
        $(this).hide();
    });

    
    $(".CPmainedit").on('focusout',function(){
        
        //  pagkuha han edit id ngan field , value
        var id = this.id;
        var split_id = id.split("/");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).val();
        
        
        $(this).hide();

        $(this).prev('.CPmain').show();
        $(this).prev('.CPmain').text(value);

        $.ajax({
            url: 'https://booking.hoteldefides.com/index.php/admin/CoffeeupdatePricinResName',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                console.log('Save successfully'); 
            }
        });
    
    });



});



$(document).ready(function(){

var countBox =1;
var boxName = 0;

 

  $("#addInput4").click(function(){
      var boxName="textBox"+countBox;
      var boxName2 = "textBox"+countBox;
      var boxNumber = countBox;
      if(boxNumber < 50){
         $("#table4").before($("<tr id="+boxName2+"><td><div class='row'>&nbsp&nbsp&nbsp&nbsp<select name='room_type"+boxNumber+"' class='col col-sm-6 form-control' required><option value=''>Select</option><option >Standard Room</option> <option > Family Room</option> <option > Executive Room</option><option >Executive Seaside Room</option></select> &nbsp<select name='room_num"+boxNumber+"' class='col col-sm-5 form-control'  required><option value=''>Select</option><option >1</option><option >2</option><option >3</option><option >4</option><option >5</option><option >6</option><option >7</option><option >8</option><option >9</option><option >10</option></select></div><td><a onclick='$("+boxName2+").remove()' class='btn btn-danger'>X</a></td></div>"));
       countBox++;
      }
      

  });


});



