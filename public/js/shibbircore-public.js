(function ($) {
  "use strict";
  $(document).ready(function () {
    $(document).on("submit", "#update_membership_feature", function (e) {
      e.preventDefault();
      var form = $(this);
      var actionUrl = handle.ajaxurl;
      var data = form.serialize() + "&action=" + "update_level_feature_action";

      $.ajax({
        dataType: "json",
        type: "POST",
        url: actionUrl,
        data: data,
        beforeSend: function () {
          $("#udpate_level_submit").val("Please wait...");
          $("#udpate_level_submit").prop("disabled", true);
        },
        success: function (data) {
          console.log(data);
          $(".ajax_response").html("");
          if(!data.success) {
            data.message.forEach(function(key, ele){
              $(".ajax_response").append("<div class='error-message'>" + key +"</div>");
            }); 
          } else {
            $(".ajax_response").append("<div class='success-message'>" + data.message +"</div>");
          }
          $("#udpate_level_submit").prop("disabled", false);
          $("#udpate_level_submit").val("UPDATE");
        },
      });
    });

    $(document).on("submit", "#add_new_training_video", function (e) {
      e.preventDefault();
     
      var actionUrl = handle.ajaxurl;
      var data = new FormData(this);
      // data.append('file', $('#video_file')[0].files[0]);

      $.ajax({
        dataType: "html",
        type: "POST",
        url: actionUrl,
        data: data,
        processData: false,
        contentType: false,
        beforeSend: function () {
          $("#video_btn").val("Please wait...");
          // $("#video_btn").prop("disabled", true);
        },
        success: function (data) {
          console.log(data);
          $(".ajax_response").html(data);
          // if(!data.success) {
          //   data.message.forEach(function(key, ele){
          //     $(".ajax_response").append("<div class='error-message'>" + key +"</div>");
          //   }); 
          // } else {
          //   $(".ajax_response").append("<div class='success-message'>" + data.message +"</div>");
          // }
          // $("#udpate_level_submit").prop("disabled", false);
          $("#udpate_level_submit").val("Add a new video");
        },
      });
    });
  });
})(jQuery);