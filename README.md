# L3 91906 DTO Outcome

## How to use
A web server app, such as XAMPP, is required to run the code. This was made with XAMPP in mind, so it is likely the best option. To run the script first paste the code from this repository into the "htdocs" folder, then start the Apache and MySQL servers. The site can then be accessed at "localhost" in the browser.

* To force update the log when locally hosting visit the localhost/php/update-log.php page, there is no check for whether the item has already been logged as it is intended to be called once every 24 hours, entries can be deleted from the http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=dto_db&table=order_log page

## How to download and setup XAMPP
Video Guide from Youtube: https://www.youtube.com/watch?v=6WEhuHD184w

To download XAMPP visit their site, https://www.apachefriends.org/download.html, and download the newest version for your device. Run the installer with all the download options enabled. Once installed locate the "htdocs" folder in the /XAMPP/htdocs directory. Download the files from this github repo and extract them. Delete existing htdocs folders and paste the files within the extracted github folder into the htdocs folder. 
