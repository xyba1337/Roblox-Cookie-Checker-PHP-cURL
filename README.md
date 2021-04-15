# Roblox-Cookie-Checker-PHP-cURL
Maybe the first ever working web application which allows you to check for all the necessary roblox cookie account data.

# How does it work?
  [1] The web-application allows you to enter a valid url parameter which then gets passed to curl in order to set the required headers.
  [2] Once the headers are set we can CURLOPT_RETURNTRANSFER the received data from "https://www.roblox.com/mobileapi/userinfo".
  [3] The received data will be in a json format, which we can easily decode with PHP's json_decode function.
  [4] We can then simply store the decoded data in single variables for all the information we need (UserID, UserName, IsAnyBuildersClubMember etc.).
  [5] All that's left to do is a "for loop", in which we output the collected data by comparing the $x variable in the 2. statement with the total amount of collected cookies.
      => We can then simply replace the information variable's array key with the $x variable which will then allow the array key to auto increment through the collected data.
     
# How to use it?
  First of all it's pretty obvious that you shouldn't use this method when trying to validate insane amounts of cookies. 
  There are more reliable ways of doing that, for example by using python and a strong windows server.
  However, if you are for whatever reason in possession of an insanely fast vps server, you will have a lot of fun with this web-application.
  
  The setup is easy:
  [1] Simply create a text document in which you paste in your cookies line by line.
      => Cookie-Format: _|WARNING:-DO-NOT-SHARE-THIS.--Sharing-this-will-allow-someone-to-log-in-as-you-and-to-steal-your-ROBUX-and- etc.
  
  [2] Simply paste in the url which redirects to your text file in the input field and press the check button

# What's left to do?
  This project was more of a fun project, in which I tried to learn more about curl and especially about it's behaviour when fetching huge chunks of data.
  There are probably still ways to make it fetch even faster, I already added CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4, CURLOPT_ENCODING, which in certain cases allow for a faster  
  data transfer and compression.
  
# Soon
  [1] I want to make it validate each cookie and display the bad and the working cookies.
  [2] I want to add a button which allows you to save the working cookies and filter out the bad ones.
  
