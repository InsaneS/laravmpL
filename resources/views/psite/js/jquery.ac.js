// ----------------------------------------------------------------------------
// autoComplete, JQuery plugin
// v 1.0
// ----------------------------------------------------------------------------
// Copyright (C) 2010 recens
// http://recens.ru/jquery/plugin_auto_complete.html
// ----------------------------------------------------------------------------
jQuery.fn.ac = function(o) { // ���������� �������
	var o = $.extend({     // ��������� �� ���������
		url:'ajax.php',  // URL ��� ������ ����
		onClose:function(suggest) {  // �������, ������� ����������� ��� �������� ���� � �����������
			setTimeout(function(){
				suggest.slideUp('fast'); // ������ ��������� ����
			}, 100); // ����� 100 ��
		},
		dataSend:function(input) {  // �������, ������������ ������ ��� �������� �� ������
			return 'suggest_name=' + input.attr('name') + '&query=ac&word=' + word;
		},
		wordClick:function(input,link) { // �������, ������� ����������� ��� ���������� ����� � input
			input.val(link.attr('href')).focus();
		}
	}, o);

	return $(this).each(function(){ // ������ ���� ��� �����
		var onClose = o.onClose;
		var input = $(this); // ����������� ���������� input
		input.after('<div class="auto-suggest"></div>'); // ����� ���� ��������� ���� ��� ���������
		var suggest = input.next(); // ����������� ��� ����������
		suggest.width(input.width() + 6); // ���������� ��� ���� ������
		input.blur(function(){ // ����� input �� � ������
			if (suggest.is(':visible'))  {  // ���� ��������� �� ������
				input.focus(); // ������������ �� input'e
				onClose(suggest); // � �������� ���������
			}
		}).keydown(function(e) {  // ��� ������� �������
			if (e.keyCode == 38 || e.keyCode == 40) { // ���� ��� ������� ����� ��� ����
	   			var tag = suggest.children('a.selected'),  // ������� ���������� �����
	   			new_tag = suggest.children('a:first'); // � ������ � ������
	   			if (tag.length) { // ���� ��������� ����������
	   			   	if (e.keyCode == 38) { // ������ ������� �����
	   			   		if (suggest.children('a:first.selected').length) {  // � ������� ������ �����
		                	new_tag = suggest.children('a:last'); // �������� ���������
		   				} else {  // �����
		   					new_tag = tag.prev('a');  // �������� ����������
		   				}
		   			} else { // �����
		   				if (!suggest.children('a:last.selected').length) new_tag = tag.next('a'); // �������� ���������
		   			}
		   			tag.removeClass('selected'); // ������� ��������� �� ������� ������
		    	}
		    	new_tag.addClass('selected');   // ��������� ����� ���������
	            input.val(new_tag.attr('href')); // �������� ����� � ���� �����
		    	return;
			}
			if (e.keyCode == 13 || e.keyCode == 27) {   // ���� ������ ������� Enter ��� Esc
	   			onClose(suggest); // ��������� ����
		    	return;
			}
		}).keyup(function(e) {
	       	if (e.keyCode == 38 || e.keyCode == 40 || e.keyCode == 13 || e.keyCode == 27) return; // ���� ������ ���� �� ����������������� ������, �������
			word = input.val(); // ��������� ���������� �� ��������� ���� �����
			if (word) { // ���� ���������� �� �����
				$.post(o.url, o.dataSend(input), function(data){  // ���������� ������
					if (data.length > 0) { // ���� ���� ������ ���������� ����
						suggest.html(data).show().children('a').click(function(){ // �������, ������������� ��� ������� �� �����
							o.wordClick(input,$(this)); // ���������������� �������, ����������� ����
							return false;
						});
					} else {  // ���� ���
						onClose(suggest); // ��������� ����
					}
				});
			} else { // ���� ���������� �����
	    		onClose(suggest); // ��������� ����
			}
		});
	});
}