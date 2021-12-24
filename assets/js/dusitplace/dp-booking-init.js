




  function initUsageScaleFilter(obj, room_id, target_value )
  {
    console.log('initUsageScaleFilter | '+ room_id);
    var urlTarget = BASE_URL + "/dp/get_usage_scale/"+room_id;
    jQuery.get(urlTarget, function(data, status){
      if(status == "success"){
        $('select[name="'+obj+'"]').empty();
        $('select[name="'+obj+'"]').append('<option>กรุณาระบุจำนวนผู้ใช้</option>');
		console.log(data);
        $.each(data, function(key, value) {

          var selectUsageScaleKey = value.id;
          if( value.id == target_value){
            $('select[name="'+obj+'"]').append('<option value="'+ selectUsageScaleKey +'" selected>'+ value.room_scale +'</option>');
          }else{
            $('select[name="'+obj+'"]').append('<option value="'+ selectUsageScaleKey +'">'+ value.room_scale +'</option>');
          }
        });
      }else{
        $('select[name="'+obj+'"]').empty();
      }
    }, 'json');
  }


  function initUsageFormatFilter(obj, room_id, target_value )
  {
    console.log('initUsageFormatFilter | '+ room_id);
    var urlTarget = BASE_URL + "/dp/get_usage_format/"+room_id;
    jQuery.get(urlTarget, function(data, status){
      if(status == "success"){
        $('select[name="'+obj+'"]').empty();
        $('select[name="'+obj+'"]').append('<option>กรุณาระบุรูปแบบห้อง</option>');
        $.each(data, function(key, value) {

          var selectUsageFormatKey = value;
          if( value == target_value){
            $('select[name="'+obj+'"]').append('<option value="'+ selectUsageFormatKey +'" selected>'+ value +'</option>');
          }else{
            $('select[name="'+obj+'"]').append('<option value="'+ selectUsageFormatKey +'">'+ value +'</option>');
          }

        });
      }else{
        $('select[name="'+obj+'"]').empty();
      }
    }, 'json');
  }
