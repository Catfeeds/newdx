/* Simplified Chinese translation for the jQuery Timepicker Addon /
/ Written by Will Lu */
(function($) {
	$.timepicker.regional['zh-CN'] = {
		timeOnlyTitle: 'ѡ��ʱ��',
		timeText: 'ʱ��',
		hourText: 'Сʱ',
		minuteText: '����',
		secondText: '����',
		millisecText: '΢��',
		timezoneText: 'ʱ��',
		currentText: '����ʱ��',
		closeText: '�ر�',
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm',
		amNames: ['AM', 'A'],
		pmNames: ['PM', 'P'],
		ampm: false,
		prevText: '����',
        nextText: '����',
		monthNames: ['һ��', '����', '����', '����', '����', '����',
                '����', '����', '����', 'ʮ��', 'ʮһ��', 'ʮ����'],
        monthNamesShort: ['һ', '��', '��', '��', '��', '��',
                '��', '��', '��', 'ʮ', 'ʮһ', 'ʮ��'],
		dayNames: ['������', '����һ', '���ڶ�', '������', '������', '������', '������'],
        dayNamesShort: ['����', '��һ', '�ܶ�', '����', '����', '����', '����'],
        dayNamesMin: ['��', 'һ', '��', '��', '��', '��', '��']
	};
	
	$.timepicker.setDefaults($.timepicker.regional['zh-CN']);
})(jQuery);
