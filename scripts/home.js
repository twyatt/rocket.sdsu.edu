google.load("feeds", "1");
$(document).ready(initialize_photos);


// http://stackoverflow.com/questions/1643320/get-month-name-from-date-using-javascript
Date.prototype.monthNames = [
	"January", "February", "March",
	"April", "May", "June",
	"July", "August", "September",
	"October", "November", "December"
];
Date.prototype.getMonthName = function() {
	return this.monthNames[this.getMonth()];
};
Date.prototype.getShortMonthName = function () {
	return this.getMonthName().substr(0, 3);
};

// parse a date in yyyy-mm-dd format
// http://stackoverflow.com/questions/2488313/javascripts-getdate-returns-wrong-date
function parseDate(input) {
	var parts = input.match(/(\d+)/g);
	// new Date(year, month [, date [, hours[, minutes[, seconds[, ms]]]]])
	return new Date(parts[0], parts[1]-1, parts[2]); // months are 0-based
}


// http://stackoverflow.com/questions/8888491/how-do-you-display-javascript-datetime-in-12-hour-am-pm-format
function formatAMPM(date) {
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var ampm = hours >= 12 ? 'pm' : 'am';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var strTime = hours + ':' + minutes + ampm;
	return strTime;
}


function initialize_photos() {
	MAX_PHOTOS = 3;
	
	$.ajax({
		url: 'http://graph.facebook.com/450487865021856/photos',
		data: null,
		success: function(data, textStatus, jqXHR) {
			var container = $('#master-content-right');
			
			for (i = 0; i < data.data.length && i < MAX_PHOTOS; i++) {
				entry = data.data[i];
				
				width = entry.width;
				height = entry.height;
				img = entry.picture;
				link = entry.link;
				var date = new Date(entry.created_time);
				
				var dateText = date.getMonthName() + ' ' + date.getDate();
				if (date.getFullYear() != new Date().getFullYear()) {
					dateText += ', ' + date.getFullYear();
				}
				
				var link = $('<a class="photo-item" href="' + entry.link + '" target="_blank">');
				var image = $('<img src="' + img + '" class="photo-image" alt="Photo Item">');
				var publishedDate = $('<div class="date">' + dateText + '</div>');
				var clear = $('<div class="clear"></div>');
				
				link.append(image);
				link.append(publishedDate);
				link.append(clear);
				
				container.append(link);
			}
		},
		dataType: 'json'
	});
}


function initialize_news() {
	var feed = new google.feeds.Feed("http://sdsurocketproject.blogspot.com/feeds/posts/default?alt=rss");
	feed.setNumEntries(3);
	
	feed.load(function(result) {
		if (!result.error) {
			var container = $('#master-content-left');
			
			for (var i = 0; i < result.feed.entries.length; i++) {
				var entry = result.feed.entries[i];
				
				/*
				console.log('title: ' + entry.title);
				console.log('publishedDate: ' + entry.publishedDate);
				console.log('link: ' + entry.link);
				console.log('contentSnippet: ' + entry.contentSnippet);
				*/
				
				// parse for first image in blog entry to use as thumbnail image
				var images = $('<div>' + entry.content + '</div>').find('img');
				var img;
				if (images.length == 0) {
					// blog entry has no images, so we use a generic news item image
					img = 'images/news_item.png';
				} else {
					img = images.first().attr('src');
				}
				
				var date = new Date(entry.publishedDate);
				var dateText = date.getMonthName() + ' ' + date.getDate();
				if (date.getFullYear() != new Date().getFullYear()) {
					dateText += ', ' + date.getFullYear();
				}
				
				var item = $('<div class="news-item"></div>');
				var image = $('<img src="' + img + '" class="news-image" style="width: 110px; height: 73px;" width="110" height="73" alt="News Item">');
				var publishedDate = $('<div class="date">' + dateText + '</div>');
				var title = $('<div class="news-title"><a href="' + entry.link + '" target="_blank">' + entry.title + '</a></div>');
				var description = $('<div class="news-description">' + entry.contentSnippet + '</div>');
				var clear = $('<div class="clear"></div>');
				
				item.append(image);
				item.append(publishedDate);
				item.append(title);
				item.append(description);
				item.append(clear);
				
				container.append(item);
			}
		}
	});
}
google.setOnLoadCallback(initialize_news);


function initialize_events() {
	gapi.client.setApiKey('AIzaSyCUCcy7uSdeX2AnfrefrmFXyuSqnGUtwPQ');
	gapi.client.load('calendar', 'v3', function() {
		var now = new Date();
		
		var request = gapi.client.calendar.events.list({
			'calendarId': 'rocketproject.sdsu@gmail.com',
			'timeMin': now,
			'singleEvents': true,
			'fields': 'items(description,end,htmlLink,id,location,start,summary)',
			'orderBy': 'startTime',
			'maxResults': 5
		});
		
		var container = $('#master-content-center');
		
		request.execute(function(response) {
			if (jQuery.isEmptyObject(response.result) || response.items.length == 0) {
				var item = $('<div>No events scheduled.</div>');
				container.append(item);
			} else {
				for (var i = 0; i < response.items.length; i++) {
					var entry = response.items[i];
					
					var date;
					var dateText;
					if (entry.start.dateTime == null) {
						date = parseDate(entry.start.date);
						dateText = date.getMonthName() + ' ' + date.getDate();
					} else {
						date = new Date(entry.start.dateTime);
						dateText = date.getMonthName() + ' ' + date.getDate() + ' at ' + formatAMPM(date);
					}
					
					var item = $('<div class="event-item"></div>');
					var title = $('<div class="event-title"><a href="' + entry.htmlLink + '" target="_blank">' + entry.summary + '</a></div>');
					var startDate = $('<div class="date">' + dateText + '</div>');
					var clear = $('<div class="clear"></div>');
					
					item.append(title);
					item.append(startDate);
					item.append(clear);
					
					if (i < response.items.length - 1) {
						var separator = $('<span class="event-item-separator"></span>');
						item.append(separator);
					}
					
					container.append(item);
				}
			}
		});
	});
}
