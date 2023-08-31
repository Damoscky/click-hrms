$(document).ready(function() {

	// Bar Chart
	
	Morris.Bar({
		element: 'bar-charts',
		
		redrawOnParentResize: true,
		data: [
			{ y: 'January', a: 100 },
			{ y: 'Fabuary', a: 300},
			{ y: 'March', a: 50},
			{ y: 'April', a: 75},
			{ y: 'May', a: 50},
			{ y: 'June', a: 75},
			{ y: 'July', a: 00 },
			{ y: 'August', a: 40 },
			{ y: 'September', a: 12 },
			{ y: 'October', a: 10 },
			{ y: 'November', a: 100 },
			{ y: 'December', a: 50 }
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Total Income'],
		lineColors: ['#000080'],
		lineWidth: '1px',
		barColors: ['#000080'],
		resize: true,
		
		redraw: true
	});
	
	// Line Chart
	
	Morris.Line({
		element: 'line-charts',
		redrawOnParentResize: true,
		data: [
			{ y: '2006', a: 50, b: 90 },
			{ y: '2007', a: 75,  b: 65 },
			{ y: '2008', a: 50,  b: 40 },
			{ y: '2009', a: 75,  b: 65 },
			{ y: '2010', a: 50,  b: 40 },
			{ y: '2011', a: 75,  b: 65 },
			{ y: '2012', a: 100, b: 50 }
		],
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['Total Sales', 'Total Revenue'],
		lineColors: ['#ff9b44','#fc6075'],
		lineWidth: '3px',
		resize: true,
		
		redraw: true
	});
		
});