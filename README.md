TODO LIST
=========

This is a very very basic todo list and is not finished, there are some functionalities that are missing and other are not working correctly.
The idea is create an API with three end points get, post and put (delete is missing).
Create the client side and interact with the api.
The technologies involucrated are php with zf2, mysql, jQuery, bootstrap, datatables and that's it.

#BUGS
Each time that you insert a new task you need to refresh the page, is something related with the datatable, but __the time eat me__.
This is not a bug but is not complete, I mean, the edit action (the logic in the backend is almost done) but I need to include something like an image or stuff like that in the datatable to indicate that you want to edit the task.

#BAD THINGS:
There are many things that I need to improve, but this are the most prominent
* Block Comments under the functions
* Unit Test
* Split in different module the API
* Better use of the config files
* Not use the minimify technique for js files 
* Not use the compile technique to increase the performance
* And the list goes on...

#WHAT YOU NEED?
1. You need composer, php, apache or nginx with a vhost configured plus mysql in your computer
2. Run composer install
3. You need to create a table
```
DROP TABLE IF EXISTS `wizeline`.`tasks` ;
CREATE TABLE IF NOT EXISTS `wizeline`.`tasks` (
`id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR(255) NULL ,
`status` TINYINT(1) NULL ,
PRIMARY KEY (`id`) ,
UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = MyISAM;
```
4. This is the url http://wizeline.webchallange.com/task/taskclient, so yeah, you need to create a vhost like that, I know is awful, but don't worry I will change it.

5. If you wish you can test the API with curl, remember curl is your friend.

```
get-list
curl -i -H "Accept: application/json" http://wizeline.webchallange.com/api/task
create
curl -i -H "Accept: application/json" -X POST -d "name=AC DC&status=1" http://wizeline.webchallange.com/api/task
```

#IMAGE OF THE RESULTED WORK
![alt text][todo]

[todo]: https://github.com/martinn21/todo-list/blob/master/public/img/system.png "System"

I think that's it. See you and visit me in mmmh... the next days and I will change some things here :p
Thank you and see you around.