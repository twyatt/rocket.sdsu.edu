google.load("feeds", "1");


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


function initialize_news() {
	var feed = new google.feeds.Feed("http://sdsurocketproject.blogspot.com/feeds/posts/default?alt=rss");
	feed.setNumEntries(2);
	
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
				
				var date = new Date(entry.publishedDate);
				
				var item = $('<div class="news-item"></div>');
				var image = $('<img src="http://newscenter.sdsu.edu/sdsu_newscenter/images/stories/thumbnails/wide/201212030951_rockets150v.jpg" class="news-image" alt="Project members carry the 18-foot rocket to the launchpad. Photo by Daniel Silva">');
				var publishedDate = $('<div class="date">' + date.getMonthName() + ' ' + date.getDate() + '</div>');
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
					
					var date = new Date(entry.start.dateTime);
					
					var item = $('<div class="event-item"></div>');
					var title = $('<div class="event-title"><a href="' + entry.htmlLink + '" target="_blank">' + entry.summary + '</a></div>');
					var startDate = $('<div class="date">' + date.getMonthName() + ' ' + date.getDate() + ' at ' + formatAMPM(date) + '</div>');
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