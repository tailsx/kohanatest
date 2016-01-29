# Part 2: Contest

Created a contest module.  Wanted to encapsulation the contest stuff as much as I can.  I kept the fizzbuzz stuff out because in the video, it seemed unrelated and unneccessary.  I spent more time on this part than I would like due to problems I faced which are listed below.

### Problems/Reflection

*  Learned during this part that everything still works even if I make my files in the modules folder.  This is the reason I made a contest module.
*  Problem with deprecated sql connection.  Switched to pdo.
*  pdo had undefined methods, found a [file](https://github.com/tailsx/kohanatest/blob/Part2/application/classes/database/pdo.php) to help me quickly move on from that problem.
*  Had a problem with naming convention of my model.  Had it named User before I changed it to person.  Found the error when exception said lastname was not defined, which isn't a field that is defined.
*  Needed to add a [url](https://github.com/tailsx/kohanatest/blob/Part2/application/config/url.php) file to let application trust localhost
*  Detecting a post request is a bit different than what I was used to in Javascript. 