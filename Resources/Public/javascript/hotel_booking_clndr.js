// Call this from the developer console and you can control both instances
var calendars = {};

$(document).ready( function() {
	// Assuming you've got the appropriate language files,
	// clndr will respect whatever moment's language is set to.
	// moment.locale('ru');

	// Here's some magic to make sure the dates are happening this month.
	//var thisMonth = moment().format('YYYY-MM');
	// Events to load into calendar
	/*
	var eventArray = [
		{
			title: 'Multi-Day Event',
			endDate: thisMonth + '-14',
			startDate: thisMonth + '-10'
		}, {
			endDate: thisMonth + '-23',
			startDate: thisMonth + '-21',
			title: 'Another Multi-Day Event'
		}, {
			date: thisMonth + '-27',
			title: 'Single Day Event'
		}
	];
	*/

	// The order of the click handlers is predictable. Direct click action
	// callbacks come first: click, nextMonth, previousMonth, nextYear,
	// previousYear, nextInterval, previousInterval, or today. Then
	// onMonthChange (if the month changed), inIntervalChange if the interval
	// has changed, and finally onYearChange (if the year changed).
	moment.locale(TYPO3.settings.TS.locale);
	calendars.clndr1 = $('#mini-clndr').clndr({
		template: $('#mini-clndr-template').html(),
		events: eventArray,
		multiDayEvents: {
			singleDay: 'date',
			endDate: 'endDate',
			startDate: 'startDate'
		},
		constraints: {
	        startDate: moment()
	    },
		showAdjacentMonths: true,
		adjacentDaysChangeMonth: false,
		moment: moment
	});



	// Bind all clndrs to the left and right arrow keys
	$(document).keydown( function(e) {
		// Left arrow
		if (e.keyCode == 37) {
			calendars.clndr1.back();
		}

		// Right arrow
		if (e.keyCode == 39) {
			calendars.clndr1.forward();
		}
	});
});