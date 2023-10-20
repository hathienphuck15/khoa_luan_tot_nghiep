// Tìm kiếm bằng giọng nói

// Khai báo thư viện nhận dạng giọng nói
var tts = window.tts;

// Khi nút bắt đầu bắt giọng nói được nhấn
$("#voice").on("click", function() {

  // Bắt đầu bắt giọng nói, khai báo ngôn ngữ nhận dạng
    var recognition = new webkitSpeechRecognition();
    recognition.lang = 'vi-VN';
    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.start();

  // Khi nhận được giọng nói
  recognition.onresult = function(event) {

    // Lấy văn bản từ giọng nói
    var text = event.results[0][0].transcript;

	  // Lấy ra giá trị từ ô tìm kiếm
    $("#spoken-text").val(text);

    // Mã hóa văn bản Tiếng Việt
    var encodedText = encodeURIComponent(text);
	
    // Gửi yêu cầu tìm kiếm đến máy chủ sử dụng AJAX
    $.ajax({
      url: "searchvoice.php",
      type: "POST",
	    data: {q: encodedText},
      success: function(data) {

        // Hiển thị kết quả trên trang web
		    $("#search-results").html(data);
      }
    });
  };
});

// Tìm kiếm bằng văn bản theo dạng live search
$(document).ready(function() {

  // Khi nhập từ khóa vào input
  $('#spoken-text').on('input', function() {
    var searchKeyword = $(this).val();

    // Kiểm tra từ khóa có độ dài ký tự bằng 2 có nằm trong CSDL không
    if (searchKeyword.length >= 2) {
      $.ajax({
        url: 'search.php',
        type: 'POST',
        data: {
          keyword: searchKeyword
        },
        success: function(data) {
          $('#search-results').html(data);
        }
      });

    // Ngược lại nếu không nhập hoặc xóa từ khóa sẽ hiện ra tất cả sản phẩm
    } else {
      $.ajax({
        url: 'search.php',
        type: 'POST',
        data: {
          keyword: ''
        },
        success: function(data) {
          $('#search-results').html(data);
        }
      });
    }
  });
});

