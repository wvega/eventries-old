(function($){
    $(function() {
        var box = $('#wp-custom-events-info');

        if (box.length == 0) {return;}

        var StartDate = $('#wp-events-start-date'),
            StartTime = $('#wp-events-start-time'),
            EndDate = $('#wp-events-end-date'),
            EndTime = $('#wp-events-end-time'),
            StartDateDatepicker, EndDateDatepicker, li;

        li = StartDate.closest('li').children().hide().end(),
        StartDateDatepicker = $('<div>');
        li.append(StartDateDatepicker);
        StartDateDatepicker.datepicker({ altField: StartDate, defaultDate: new Date(StartDate.val()) });
        StartTime.timepicker({});

        li = EndDate.closest('li').children().hide().end(),
        EndDateDatepicker = $('<div>');
        li.append(EndDateDatepicker);
        EndDateDatepicker.datepicker({ altField: EndDate, defaultDate: new Date(EndDate.val()) });
        EndTime.timepicker({});
    });
})(jQuery);